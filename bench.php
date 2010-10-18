<?php
ini_set('error_reporting', E_ALL|E_STRICT);
ini_set('display_errors', true);
abstract class Bench
{
    protected $_apache_restart;
    
    protected $_compare;
    
    protected $_concurrent;
    
    protected $_curl;
    
    protected $_domain;
    
    protected $_log_dir;
    
    protected $_passes; 
    
    protected $_req_sec;
    
    protected $_seconds;
    
    protected $_targets;
    
    protected function _init()
    {
        // make sure we have a target file specified
        if (empty($_SERVER['argv'][1])) {
            $this->_outln("Please specify a benchmark target file; e.g., './target/all.ini'.");
            exit(1);
        } else {
            $targets_file = $_SERVER['argv'][1];
        }
        
        // does the targets file exist?
        $realpath = realpath($targets_file);
        if (! $realpath || ! file_exists($realpath) || ! is_readable($realpath)) {
            $this->_outln("Benchmark target file '$targets_file' does not exist or is not readable.");
            exit(1);
        }
        
        // retain real path to targets file
        $targets_file = $realpath;
        
        // current directory
        $base_dir = __DIR__;
        
        // the ini file with property values
        $data = parse_ini_file("{$base_dir}/bench.ini");
        
        // what properties to load?
        $vars = array_keys(get_class_vars(get_class($this)));
        
        // set all available properties
        foreach ($vars as $var) {
            $key = substr($var, 1);
            if (array_key_exists($key, $data)) {
                $this->$var = $data[$key];
            }
        }
        
        // read in the targets file
        if (substr($this->_targets, -4) == '.ini') {
            // a .ini file with "name = path"
            $this->_targets = parse_ini_file($targets_file);
        } else {
            // a non-ini file with one target URI per line
            $keys = file($targets_file);
            $vals = array_fill(0, count($keys), null);
            $this->_targets = array_combine($keys, $vals);
        }
        
        // make a directory for logs
        $time = date("Y-m-d\TH:i:s");
        $this->_log_dir = "{$base_dir}/log/{$time}";
        @mkdir($this->_log_dir, 0777, true);
        
        // reset the req/sec data
        $this->_req_sec = array();
    }
    
    public function exec()
    {
        // initialize
        $this->_init();
        
        // run against the list of targets
        foreach ($this->_targets as $name => $path) {
            // only run non-blank targets
            $name = trim($name);
            if ($name) {
                $this->_runAllPasses($name, $path);
            }
        }
        
        // print the report
        $this->_report();
        
        // done!
        exit(0);
    }
    
    protected function _out($text = null)
    {
        echo $text;
    }
    
    protected function _outln($text = null)
    {
        $this->_out($text . PHP_EOL);
    }
    
    protected function _runAllPasses($name, $path)
    {
        // make a log dir for this target name
        $log_name = "{$this->_log_dir}/$name";
        @mkdir($log_name, 0777, true);
        
        // restart the server for a fresh environment
        passthru($this->_apache_restart);
        
        // make sure the we have a good href for the target name
        if (strpos($name, '://') === false) {
            $href = "http://{$this->_domain}/$name";
        } else {
            $href = $name;
        }
        
        // add a path if one exists
        if ($path) {
            $href .= "/$path";
        }
        
        // prime the cache
        $this->_outln("$name: prime the cache");
        passthru("{$this->_curl} $href");
        $this->_outln();
        
        // run the benchmark passes
        for ($i = 1; $i <= $this->_passes; $i++) {
            
            // where to log the pass?
            $log_file = "{$log_name}/$i.log";
            
            // run the pass
            $this->_outln("$name: pass $i");
            $this->_runOnePass($href, $log_file);
            
            // show the req/sec from the pass
            $req_sec = $this->_fetchReqSec($log_file);
            $this->_outln("### req/sec: $req_sec ###");
            
            // retain the req/sec data
            $this->_req_sec[$name][$i] = $req_sec;
        }
    }
    
    protected function _report()
    {
        // all report data: keyed by row, then by col
        $report = array();
        
        // keep track of the comparison bench average
        $cmp = 9999999999;
        
        // number formatting
        $format = '%8.2f';
        
        // padding for the framework name column
        $name_pad = 8;
        
        // each of the frameworks benched
        foreach ($this->_req_sec as $name => $pass) {
            
            // keep a padding for the longest target name
            $len = strlen($name);
            if ($len > $name_pad) {
                $name_pad = $len + 2;
            }
            
            // output the bench on its own line
            $report[$name] = array('rel' => null, 'avg' => null);
            
            // read the pass data
            foreach ($pass as $key => $req_sec) {
                $report[$name][$key] = sprintf($format, $req_sec);
            }
            
            // figure the average
            $avg = array_sum($report[$name]) / (count($report[$name]) - 2); // -2 for rel, avg
            $report[$name]['avg'] = sprintf($format, $avg);
            
            // if this is the comparison benchmark, save the comparison value
            if ($name == $this->_compare) {
                $cmp = $avg;
            }
            
            if (strlen($name) > $name_pad) {
            	$name_pad = strlen($name);
            }
        }
        
        // header line
        $this->_outln();
        $this->_out(str_pad('Target', $name_pad));
        $this->_out(' |      rel');
        $this->_out(' |      avg');
        for($i = 1; $i <= $this->_passes; $i++) {
        	$this->_out(' | ' . str_pad($i, 8, ' ', STR_PAD_LEFT));
        }
        $this->_outln();
        
        // separator line
        $this->_out(str_pad('', $name_pad, '-'));
        for ($i = 1; $i <= $this->_passes + 2; $i++) {
        	$this->_out(' | --------');
        }
        $this->_outln();
        
        // output each data line, figuring %-of-php score as we go
        foreach ($report as $key => $val) {
            if ($this->_compare) {
                $val['rel'] = sprintf("%8.4f", $val['avg'] / $cmp);
            } else {
                $val['rel'] = '   n/a  ';
            }
            $line = str_pad($key, $name_pad) . " | " . implode(" | ", $val);
            $this->_outln($line);
        }
    }
    
    abstract protected function _runOnePass($href, $log_file);
    
    abstract protected function _fetchReqSec($log_file);
}
