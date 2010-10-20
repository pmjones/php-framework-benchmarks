<?php
namespace bench;
require __DIR__ . '/Base.php';
class HttpLoad extends Base
{
    protected $http_load;
    
    protected $http_load_file;
    
    protected function init()
    {
        parent::init();
        if (! file_exists($this->http_load)) {
            $this->outln("File not found: '{$this->http_load}'.");
            exit(1);
        }
    }
    
    protected function runOnePass($href, $conc, $log_file)
    {
        file_put_contents($this->http_load_file, $href);
        
        $cmd = "{$this->http_load} "
             . "-parallel {$conc} "
             . "-seconds {$this->seconds} "
             . "{$this->http_load_file} > {$log_file}";
        
        passthru($cmd);
    }
    
    protected function fetchReqSec($log_file)
    {
        $lines = file($log_file);
        return (float) $lines[2];
    }
}

$bench = new BenchHttpLoad;
$bench->exec();
