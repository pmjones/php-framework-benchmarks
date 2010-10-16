#!/usr/bin/env php
<?php
require __DIR__ . '/bench-abstract.php';
class BenchHttpLoad extends BenchAbstract
{
    protected $_http_load;
    
    protected $_http_load_file;
    
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
