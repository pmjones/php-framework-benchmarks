#!/usr/bin/env php
<?php
require dirname(__DIR__) . '/bench.php';
class BenchApache extends Bench
{
    protected $_ab;
    
    protected function _runOnePass($href, $log_file)
    {
        $cmd = "{$this->_ab} "
             . "-c {$this->_concurrent} "
             . "-t {$this->_seconds} "
             . "$href > {$log_file}";
        
        passthru($cmd);
    }
    
    protected function _fetchReqSec($log_file)
    {
        $text = file_get_contents($log_file);
        preg_match('/Requests per second: *(.*)/', $text, $matches);
        return (float) $matches[1];
    }
}

$bench = new BenchApache;
$bench->exec();
