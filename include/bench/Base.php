<?php
namespace bench;
abstract class Base
{
    protected $apache_restart;
    
    protected $compare;
    
    protected $concurrent;
    
    protected $curl;
    
    protected $domain;
    
    protected $log_dir;
    
    protected $passes; 
    
    protected $req_sec;
    
    protected $seconds;
    
    protected $targets;
    
    public function exec()
    {
        // initialize
        $this->init();
        
        // run against the list of targets
        foreach ($this->targets as $name => $path) {
            // only run non-blank targets
            $name = trim($name);
            if ($name) {
                $this->runAllPasses($name, $path);
            }
        }
        
        // print the report
        $this->report();
        
        // done!
        exit(0);
    }
    
    protected function init()
    {
        // make sure we have a target file specified
        if (empty($_SERVER['argv'][1])) {
            $this->outln("Please specify a benchmark target file; e.g., './target/all.ini'.");
            exit(1);
        } else {
            $targets_file = $_SERVER['argv'][1];
        }
        
        // does the targets file exist?
        $realpath = realpath($targets_file);
        if (! $realpath || ! file_exists($realpath) || ! is_readable($realpath)) {
            $this->outln("Benchmark target file '$targets_file' does not exist or is not readable.");
            exit(1);
        }
        
        // retain real path to targets file
        $targets_file = $realpath;
        
        // current directory
        $base_dir = dirname(dirname(__DIR__));
        
        // the ini file with property values
        $data = parse_ini_file("{$base_dir}/bench.ini");
        
        // what properties to load?
        $vars = array_keys(get_class_vars(get_class($this)));
        
        // set all available properties
        foreach ($vars as $var) {
            if (array_key_exists($var, $data)) {
                $this->$var = $data[$var];
            }
        }
        
        // read in the targets file
        if (substr($targets_file, -4) == '.ini') {
            // a .ini file with "name = path"
            $this->targets = parse_ini_file($targets_file);
        } else {
            // a non-ini file with one target URI per line
            $keys = file($targets_file);
            $vals = array_fill(0, count($keys), null);
            $this->targets = array_combine($keys, $vals);
        }
        
        // make a directory for logs
        $time = date("Y-m-d\TH:i:s");
        $this->log_dir = "{$base_dir}/log/{$time}";
        @mkdir($this->log_dir, 0777, true);
        
        // reset the req/sec data
        $this->req_sec = array();
    }
    
    protected function out($text = null)
    {
        echo $text;
    }
    
    protected function outln($text = null)
    {
        $this->out($text . PHP_EOL);
    }
    
    protected function runAllPasses($name, $path)
    {
        // make sure the we have a good href for the target name
        if (strpos($name, '://') === false) {
            $href = "http://{$this->domain}/$name";
        } else {
            $href = $name;
        }
        
        // add a path if one exists
        if ($path) {
            $href .= "/$path";
        }
        
        // make a log dir for the target href
        $log_name = "{$this->log_dir}/" . urlencode($href);
        @mkdir($log_name, 0777, true);
        
        // restart the server for a fresh environment
        if ($this->apache_restart) {
            passthru($this->apache_restart);
        }
        
        // prime the cache
        $this->outln("$name: prime the cache");
        passthru("{$this->curl} $href");
        $this->outln();
        
        // run the benchmark passes
        for ($i = 1; $i <= $this->passes; $i++) {
            
            // where to log the pass?
            $log_file = "{$log_name}/$i.log";
            
            // run the pass
            $this->outln("$name: pass $i");
            $this->runOnePass($href, $log_file);
            
            // show the req/sec from the pass
            $req_sec = $this->fetchReqSec($log_file);
            $this->outln("### req/sec: $req_sec ###");
            
            // retain the req/sec data
            $this->req_sec[$name][$i] = $req_sec;
        }
    }
    
    protected function report()
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
        foreach ($this->req_sec as $name => $pass) {
            
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
            if ($name == $this->compare) {
                $cmp = $avg;
            }
            
            if (strlen($name) > $name_pad) {
                $name_pad = strlen($name);
            }
        }
        
        // header line
        $this->outln();
        $this->out(str_pad('Target', $name_pad));
        $this->out(' |      rel');
        $this->out(' |      avg');
        for($i = 1; $i <= $this->passes; $i++) {
            $this->out(' | ' . str_pad($i, 8, ' ', STR_PAD_LEFT));
        }
        $this->outln();
        
        // separator line
        $this->out(str_pad('', $name_pad, '-'));
        for ($i = 1; $i <= $this->passes + 2; $i++) {
            $this->out(' | --------');
        }
        $this->outln();
        
        // output each data line, figuring %-of-php score as we go
        foreach ($report as $key => $val) {
            if ($this->compare) {
                $val['rel'] = sprintf("%8.4f", $val['avg'] / $cmp);
            } else {
                $val['rel'] = '   n/a  ';
            }
            $line = str_pad($key, $name_pad) . " | " . implode(" | ", $val);
            $this->outln($line);
        }
    }
    
    abstract protected function runOnePass($href, $log_file);
    
    abstract protected function fetchReqSec($log_file);
}
