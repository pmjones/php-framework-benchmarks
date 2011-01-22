<?php
namespace bench;
abstract class Base
{
    protected $restart;
    
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
            $this->outln("Please specify a targets file; e.g., './target/all.ini'.");
            exit(1);
        } else {
            $targets_file = $_SERVER['argv'][1];
        }
        
        // does the targets file exist?
        $realpath = realpath($targets_file);
        if (! $realpath || ! file_exists($realpath) || ! is_readable($realpath)) {
            $this->outln("Targets file '$targets_file' does not exist or is not readable.");
            exit(1);
        }
        
        // retain real path to targets file
        $targets_file = $realpath;
        
        // root directory
        $base_dir = dirname(dirname(__DIR__));
        
        // the ini file with property values
        $data = parse_ini_file("{$base_dir}/config.ini");
        
        // what properties to load?
        $vars = array_keys(get_class_vars(get_class($this)));
        
        // set all available properties
        foreach ($vars as $var) {
            if (array_key_exists($var, $data)) {
                $this->$var = $data[$var];
            }
        }
        
        // massage the concurrency levels
        $this->concurrent = explode(',', $this->concurrent);
        
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
        
        // restart the server for a fresh environment
        if ($this->restart) {
            $this->outln("Restarting web server ...");
            passthru($this->restart);
        } else {
            $this->outln("Not restarting web server.");
        }
        
        // prime the cache
        $this->outln("$name: prime the cache");
        passthru("{$this->curl} $href");
        $this->outln();
        
        // for each concurrency level ...
        foreach ($this->concurrent as $conc) {
            
            // make sure we have a concurrency level
            $conc = (int) $conc;
            if (! $conc) {
                continue;
            }
            
            // make a log dir for the target href and concurrency
            $log_name = "{$this->log_dir}/{$conc}/" . urlencode($href);
            @mkdir($log_name, 0777, true);
            
            // run each of the passes
            for ($pass = 1; $pass <= $this->passes; $pass++) {
                
                // where to log the pass?
                $log_file = "{$log_name}/$pass.log";
                
                // run the pass
                $this->out("$name: ");
                $this->out("concurrency $conc, ");
                $this->outln("pass $pass of $this->passes");
                $this->runOnePass($href, $conc, $log_file);
                
                // show the req/sec from the pass
                $req_sec = $this->fetchReqSec($log_file);
                $this->outln("### req/sec: $req_sec ###");
                
                // retain the req/sec data
                $this->req_sec[$name][$conc][$pass] = $req_sec;
            }
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
        
        // padding for the target name column
        $name_pad = 8;
        
        // each of the targets benched
        foreach ($this->req_sec as $name => $concs) {
            
            // keep a padding for the longest name
            $len = strlen($name);
            if ($len > $name_pad) {
                $name_pad = $len;
            }
            
            // each of the concurrency levels for the target
            foreach ($concs as $conc => $passes) {
                
                // output the bench on its own line
                $report[$name][$conc] = array('rel' => null, 'avg' => null);
                
                // read the pass data
                foreach ($passes as $pass => $req_sec) {
                    $report[$name][$conc][$pass] = sprintf($format, $req_sec);
                }
                
                // figure the average
                $numer = array_sum($report[$name][$conc]);
                $denom = (count($report[$name][$conc]) - 2); // -2 for rel, avg
                $avg =  $numer / $denom;
                $report[$name][$conc]['avg'] = sprintf($format, $avg);
                
                // if this is the comparison target, save the comparison value
                if ($name == $this->compare) {
                    $cmp = $avg;
                }
            }
        }
        
        // always add some extra name padding
        $name_pad += 2;
        
        // header line
        $this->outln();
        $this->out(str_pad('Target', $name_pad));
        $this->out(' |  concurr');
        $this->out(' | relative');
        $this->out(' |  average');
        for($i = 1; $i <= $this->passes; $i++) {
            $this->out(' | ' . str_pad($i, 8, ' ', STR_PAD_LEFT));
        }
        $this->outln();
        
        // separator line
        $this->out(str_pad('', $name_pad, '-'));
        for ($i = 1; $i <= $this->passes + 3; $i++) {
            $this->out(' | --------');
        }
        $this->outln();
        
        // go through each reported target ...
        foreach ($report as $name => $concs) {
            
            // for each concurrency level ...
            foreach ($concs as $conc => $data) {
                
                // compute the relative performance as we go
                if ($this->compare) {
                    $data['rel'] = sprintf("%8.4f", $data['avg'] / $cmp);
                } else {
                    $data['rel'] = '   n/a  ';
                }
                
                // the target name
                $this->out(str_pad($name, $name_pad) . " | ");
                
                // the concurrency level
                $this->out(sprintf("%8d", $conc) . " | ");
                
                // relative, average, and passes
                $this->outln(implode(" | ", $data));
            }
        }
    }
    
    abstract protected function runOnePass($href, $conc, $log_file);
    
    abstract protected function fetchReqSec($log_file);
}
