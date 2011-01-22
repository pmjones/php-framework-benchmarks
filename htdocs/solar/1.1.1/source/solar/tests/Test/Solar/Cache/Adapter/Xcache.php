<?php
/**
 * Parent test.
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Adapter.php';

/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Cache_Adapter_Xcache extends Test_Solar_Cache_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cache_Adapter_Xcache = array(
    );
    
    protected $_extension = 'xcache';
    
    /**
     * 
     * Constructor; sets the test as 'todo' until you provide adapter-specific
     * configuration values.  Delete the constructor method after you do so.
     * 
     */
    public function __construct($config = null)
    {
        $this->todo('need adapter-specific config');
    }
}
