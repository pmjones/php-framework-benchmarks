#!/usr/bin/env php
<?php
require __DIR__ . '/bench-abstract.php';
$bench = new BenchSiege;
$bench->exec();

class BenchSiege extends BenchAbstract
{
    protected $_siege;
    
    protected $_siege_file;
    
    protected $_siege_failures;
    
    protected function _runOnePass($href, $log_file)
    {
        // vars for siege config
        $vars = array (
            'verbose'           => 'false',
            'show-logfile'      => 'false',
            'logging'           => 'true',
            'protocol'          => 'HTTP/1.0',
            'chunked'           => 'true',
            'connection'        => 'close',
            'concurrent'        => $this->_concurrent,
            'time'              => "{$this->_time}s",
            'benchmark'         => 'true',
            'spinner'           => 'false',
            'failures'          => $this->_siege_failures,
            'logfile'           => $log_file,
        );
        
        // build the text for the .siegerc file
        $text = '';
        foreach ($vars as $key => $val) {
            $text .= "$key = $val\n";
        }
        
        // write the siegerc file
        file_put_contents($this->_siege_file, $text);
        
        // run siege
        passthru("{$this->_siege} $href");
    }
    
    protected function _fetchReqSec($log_file)
    {
        $lines = file($log_file);
        $data = explode(',', $lines[1]);
        return (float) $data[5];
    }
}
