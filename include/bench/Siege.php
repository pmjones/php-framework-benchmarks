<?php
namespace bench;
require __DIR__ . '/Base.php';
class Siege extends Base
{
    protected $siege;
    
    protected $siege_file;
    
    protected $siege_failures;
    
    protected function init()
    {
        parent::init();
        if (! file_exists($this->siege)) {
            $this->outln("File not found: '{$this->siege}'.");
            exit(1);
        }
    }
    
    protected function runOnePass($href, $conc, $log_file)
    {
        // vars for siege config
        $vars = array (
            'verbose'           => 'false',
            'show-logfile'      => 'false',
            'logging'           => 'true',
            'protocol'          => 'HTTP/1.0',
            'chunked'           => 'true',
            'connection'        => 'close',
            'concurrent'        => $conc,
            'time'              => "{$this->seconds}s",
            'benchmark'         => 'true',
            'spinner'           => 'false',
            'failures'          => $this->siege_failures,
            'logfile'           => $log_file,
        );
        
        // build the text for the .siegerc file
        $text = '';
        foreach ($vars as $key => $val) {
            $text .= "$key = $val\n";
        }
        
        // write the siegerc file
        file_put_contents($this->siege_file, $text);
        
        // run siege
        passthru("{$this->siege} $href");
    }
    
    protected function fetchReqSec($log_file)
    {
        $lines = file($log_file);
        $data = explode(',', $lines[1]);
        return (float) $data[5];
    }
}
