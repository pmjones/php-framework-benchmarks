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
    
    protected $_siege;
    
    protected $_curl;
    
    protected $_apache_restart;
    
    protected $_siegerc_file;
    
    protected $_targets;
    
    protected $_concurrent;
    
    protected $_time;
    
    protected $_failures;
    
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
        
        // run siege against the list of targets
        foreach ($this->_targets as $name => $path) {
            $this->_siege($name, $path);
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
    
    protected function _siege($name, $path)
    {
        // write the siegerc file for this framework
        $this->_writeSiegercFile(array(
            'logfile' => "{$this->_log_dir}/$name.log",
        ));
        
        // restart the server for a fresh environment
        passthru($this->_apache_restart);
        
        // what href are we targeting?
        $href = "http://localhost/$name/$path";
        
        // prime the cache
        $this->_outln("$name: prime the cache");
        passthru("{$this->_curl} $href");
        echo "\n";
        
        // bench runs
        for ($i = 1; $i <= 5; $i++) {
            $this->_outln("$name: pass $i");
            passthru("{$this->_siege} $href");
            echo "\n";
        }
    }
    
    // write out the siegerc file, mostly so we can maintain a log location
    protected function _writeSiegercFile($vars = array())
    {
        // the base config vars
        $base = array (
            'verbose'           => 'false',
            'show-logfile'      => 'false',
            'logging'           => 'true',
            'protocol'          => 'HTTP/1.0',
            'chunked'           => 'true',
            'connection'        => 'close',
            'concurrent'        => $this->_concurrent,
            'time'              => $this->_time,
            'benchmark'         => 'true',
            'spinner'           => 'false',
            'failures'          => $this->_failures,
        );
        
        // make sure we have base vars for everything
        $vars = array_merge($base, $vars);
        
        // build the text for the file
        $text = '';
        foreach ($vars as $key => $val) {
            $text .= "$key = $val\n";
        }
    
        // write the siegerc file
        file_put_contents($this->_siegerc_file, $text);
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
        $files = glob("{$this->_log_dir}/*.log");
        foreach ($files as $file) {
            
            // what is the famework name? (less the ".log" extension)
            $name = substr(basename($file), 0, -4);
            
            // output the bench on its own line
            $report[$name] = array('rel' => null, 'avg' => null);
            
            // get the CSV data from siege
            $data = $this->_fetchSiegeCsv($file);
            foreach ($data as $key => $val) {
                // save the req/sec
                $i = $key + 1;
                $report[$name][(string) $i] = sprintf($format, $val[5]);
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
    
    protected function _fetchSiegeCsv($file)
    {
        $line = 0;
        $handle = fopen($file, "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // skip blank lines
            $k = count($data);
            if (! $k) {
                continue;
            }
            // retain the line of data
            for ($i = 0; $i < $k; $i++) {
                $list[$line][$i] = $data[$i];
            }
            $line ++;
        }
        fclose($handle);
        
        // remove the fields line from the list
        array_shift($list);
        
        // done!
        return $list;
    }
    
}
