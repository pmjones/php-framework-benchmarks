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
class Test_Solar_Cache_Adapter_Apc extends Test_Solar_Cache_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cache_Adapter_Apc = array(
    );
    
    protected $_extension = 'apc';
    
    public function __construct($config = null)
    {
        parent::__construct($config);
        if (PHP_SAPI == 'cli' && ! ini_get('apc.enable_cli')) {
            $this->skip('apc loaded but not enabled for cli');
        }
    }
    
    public function testGetLife()
    {
        $this->skip('per Rasmus, apc is not accurate to the second');
    }
    
    public function testSave_life()
    {
        $this->skip('per Rasmus, apc is not accurate to the second');
    }
}
