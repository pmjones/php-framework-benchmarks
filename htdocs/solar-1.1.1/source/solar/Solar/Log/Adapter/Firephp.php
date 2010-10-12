<?php
/**
 * 
 * Log adapter for Firephp/Firebug.
 * 
 * @category Solar
 * 
 * @package Solar_Log
 * 
 * @author Richard Thomas <richard@phpjack.com>
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @version $Id: Firephp.php 3995 2009-09-08 18:49:24Z pmjones $
 * 
 */
class Solar_Log_Adapter_Firephp extends Solar_Log_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @config string|array events The event types this instance
     *   should recognize; a comma-separated string of events, or
     *   a sequential array.  Default is all events ('*').
     * 
     * @config string format The line format for each saved event.
     *   Use '%t' for the timestamp, '%e' for the class name, '%e' for
     *   the event type, '%m' for the event description, and '%%' for a
     *   literal percent.  Default is '%t %c %e %m'.
     * 
     * @config string output Output mode.  Set to 'html' for HTML, or 'text' for plain 
     *   text.  Default autodetects by SAPI version.  Value is ignored by this
     *   adapter, since it encodes everything into JSON format.
     * 
     * @config dependency response A Solar_Http_Response dependency injection.
     * 
     * @var array
     * 
     */
    protected $_Solar_Log_Adapter_Firephp = array(
        'events'   => '*',
        'format'   => '%t %c %e %m', // time, class, event, message
        'output'   => null,
        'response' => 'response',
    );
    
    /**
     * 
     * The Solar_Http_Response where headers will be set.
     * 
     * @var Solar_Http_Response
     * 
     */
    protected $_response;
    
    /**
     * 
     * Post-construction tasks to complete object construction.
     * 
     * @return void
     * 
     */
    protected function _postConstruct()
    {
        parent::_postConstruct();
        
        $this->_response = Solar::dependency(
            'Solar_Http_Response',
            $this->_config['response']
        );
        
        $this->_json = Solar::factory('Solar_Json');
        
        $this->_response->setHeader(
            'X-FirePHP-Data-100000000001',
            '{'
        );
        
        $this->_response->setHeader(
            'X-FirePHP-Data-300000000001',
            '"FirePHP.Firebug.Console":['
        );
        
        $this->_response->setHeader(
            'X-FirePHP-Data-399999999999',
            '["__SKIP__"]],'
        );
        
        $this->_response->setHeader(
            'X-FirePHP-Data-200000000001',
            '"FirePHP.Dump":{'
        );
        
        $this->_response->setHeader(
            'X-FirePHP-Data-299999999999',
            '"__SKIP__":"__SKIP__"},'
        );
        
        $this->_response->setHeader(
            'X-FirePHP-Data-999999999999',
            '"__SKIP__":"__SKIP__"}'
        );
    }
    
    /**
     * 
     * Sends the log message.
     * 
     * @param string $class The class name reporting the event.
     * 
     * @param string $event The event type (for example 'info' or 'debug').
     * 
     * @param string $descr A description of the event. 
     * 
     * @return mixed Boolean false if the event was not saved (usually
     * because it was not recognized), or a non-empty value if it was
     * saved.
     * 
     */
    protected function _save($class, $event, $descr)
    {
        if (strtolower($event) == 'dump') {
            $data = '"' . $class . '":' . $this->_json->encode($descr);
            $type = 2;
        } else {
            $data = $this->_json->encode(array($event, "$class: $descr"));
            $type = 3;
        }
        
        if (strlen($data <= 5000)) {
            $this->_setHeader($data, $type);
        } else {
            $chunks = chunk_split($msg, 5000, "\n");
            $parts = explode("\n", $chunks);
            foreach ($parts as $part) {
                if ($part) {
                    // ensure microtime() increments with each loop.
                    // not very elegant but it works.
                    usleep(1);
                    $this->_setHeader($part, $type);
                }
            }
        }
        
        return true;
    }
    
    /**
     * 
     * Sets the log message in the response headers.
     * 
     * @param string $data The JSON data for the header.
     *
     * @param int $type 3 - normal, 2 - dump
     * 
     * @return void
     * 
     */
    protected function _setHeader($data, $type = 3)
    {
        $utime = explode(' ', microtime());
        $utime = substr($utime[1], 7) . substr($utime[0], 2);  
        $this->_response->setHeader(
            "X-FirePHP-Data-{$type}{$utime}",
            "{$data},"
        );
    }
}
