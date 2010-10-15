#!/usr/bin/env php
<?php
ini_set('error_reporting', E_ALL|E_STRICT);
ini_set('display_errors', true);

$bench = new Bench;
$bench->exec();

class Bench
{
    protected $_base_dir;
    
    protected $_log_dir;
    
    protected $_curl;
    
    protected $_apache_restart;
    
    protected $_url_file;
    
    protected $_targets;
    
    protected $_concurrent;
    
    protected $_time;
    
    protected $_http_load;
    
    public function exec()
    {
        // validation
        if (empty($_SERVER['argv'][1])) {
            $this->_outln("Please specify a benchmark target file; e.g., './target/all.ini'.");
            exit(1);
        } else {
            $file = $_SERVER['argv'][1];
        }
        
        // prep work
        $this->_setup();
        $this->_makeLogDir();
        $this->_setTargets(realpath($file));
        
        // run against the list of targets
        foreach ($this->_targets as $name => $path) {
            $this->_run($name, $path);
        }
        
        // do reporting
        $this->_report();
        
        // done!
        exit(0);
    }
    
    protected function _outln($text)
    {
        echo $text . PHP_EOL;
    }
    
    protected function _setup()
    {
        // the directory of this class file
        $this->_base_dir = __DIR__;
        
        // what properties to load?
        $vars = array_keys(get_class_vars(get_class($this)));
        
        // the ini file with property values
        $data = parse_ini_file("{$this->_base_dir}/config.ini");
        
        // don't set these props from ini file
        unset($data['base_dir']);
        unset($data['target_file']);
        
        // set all the other properties, if they are available
        foreach ($vars as $var) {
            $key = substr($var, 1);
            if (array_key_exists($key, $data)) {
                $this->$var = $data[$key];
            }
        }
    }
    
    protected function _makeLogDir()
    {
        // store logs broken down by time
        $time = date("Y-m-d\TH:i:s");
        $this->_log_dir = "{$this->_base_dir}/log/{$time}";
        passthru("mkdir -p {$this->_log_dir}");
    }
    
    protected function _setTargets($file)
    {
        $this->_targets = parse_ini_file($file);
    }
    
    protected function _run($name, $path)
    {
        // what href are we targeting?
        $href = "http://localhost/$name/$path";
        
        // write the url_file for this framework
        $this->_writeUrlFile($href);
        
        // restart the server for a fresh environment
        passthru($this->_apache_restart);
        
        // prime the cache
        $this->_outln("$name: prime the cache");
        passthru("{$this->_curl} $href");
        echo "\n";
        
        // bench runs
        for ($i = 1; $i <= 5; $i++) {
            
            $this->_outln("$name: pass $i");
            
            $cmd = "{$this->_http_load} "
                 . "-parallel {$this->_concurrent} "
                 . "-seconds {$this->_time} "
                 . "{$this->_url_file} > {$this->_log_dir}/$name/$i.log";
            
            passthru($cmd);
            
            echo "\n";
            
        }
    }
    
    // write out the siegerc file, mostly so we can maintain a log location
    protected function _writeUrlFile($href)
    {
        file_put_contents($this->_url_file, $href);
    }
    
    protected function _report()
    {
        $this->_outln("Processing logs in {$this->_log_dir}.\n");
        
        // all report data: keyed by row, then by col
        $report = array();
        
        // keep track of the comparison bench average
        $cmp = 99999999;
        
        // number formatting
        $format = '%8.2f';
        
        // each of the frameworks benched
        $logdirs = glob("{$this->_log_dir}/*", GLOB_ONLYDIR);
        foreach ($logdirs as $logdir) {
            
            // the framework name
            $name = basename($logdir);
            
            // output the bench on its own line
            $report[$name] = array('rel' => null, 'avg' => null);
            
            // read the log files
            $files = glob("{$logdir}/*.log");
            foreach ($files as $key => $file) {
                $i = $key + 1;
                $lines = file($file);
                $val = (float) $lines[2];
                $report[$name][(string) $i] = sprintf($format, $val);
            }
            
            // figure the average
            $avg = array_sum($report[$name]) / (count($report[$name]) - 2); // -2 for rel, avg
            $report[$name]['avg'] = sprintf($format, $avg);
            
            // if this is the baseline-php report, save the comparison value
            if ($name == 'baseline-php') {
                $cmp = $avg;
            }
        }
        
        $fwpad = 24;
        
        // header line
        $val = array('     rel', '     avg', '       1', '       2', '       3', '       4', '       5');
        $line = str_pad('framework', $fwpad) . " | " . implode(" | ", $val);
        $this->_outln($line);
        
        // separator line
        $val = array('--------', '--------', '--------', '--------', '--------', '--------', '--------');
        $line = str_pad('', $fwpad, '-') . " | " . implode(" | ", $val);
        $this->_outln($line);
        
        // output each data line, figuring %-of-php score as we go
        foreach ($report as $key => $val) {
            $val['rel'] = sprintf("%8.4f", $val['avg'] / $cmp);
            $line = str_pad($key, $fwpad) . " | " . implode(" | ", $val);
            $this->_outln($line);
        }
    }
}
