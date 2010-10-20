<?php
namespace bench;
require __DIR__ . '/Base.php';
class Ab extends Base
{
    protected $ab;
    
    protected function init()
    {
        parent::_init();
        if (! file_exists($this->ab)) {
            $this->outln("File not found: '{$this->ab}'.");
            exit(1);
        }
    }
    
    protected function runOnePass($href, $log_file)
    {
        $cmd = "{$this->ab} "
             . "-c {$this->concurrent} "
             . "-t {$this->seconds} "
             . "$href > {$log_file}";
        
        passthru($cmd);
    }
    
    protected function fetchReqSec($log_file)
    {
        $text = file_get_contents($log_file);
        preg_match('/Requests per second: *(.*)/', $text, $matches);
        return (float) $matches[1];
    }
}
