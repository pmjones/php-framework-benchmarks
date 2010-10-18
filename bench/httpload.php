#!/usr/bin/env php
<?php
require dirname(__DIR__) . '/bench.php';
class BenchHttpLoad extends Bench
{
    protected $_http_load;
    
    protected $_http_load_file;
    
    protected function _init()
    {
        parent::_init();
        if (! file_exists($this->_http_load)) {
            $this->_outln("File not found: '{$this->_http_load}'.");
            exit(1);
        }
    }
    
    protected function _runOnePass($href, $log_file)
    {
        file_put_contents($this->_http_load_file, $href);
        
        $cmd = "{$this->_http_load} "
             . "-parallel {$this->_concurrent} "
             . "-seconds {$this->_seconds} "
             . "{$this->_http_load_file} > {$log_file}";
        
        passthru($cmd);
    }
    
    protected function _fetchReqSec($log_file)
    {
        $lines = file($log_file);
        return (float) $lines[2];
    }
}

$bench = new BenchHttpLoad;
$bench->exec();
