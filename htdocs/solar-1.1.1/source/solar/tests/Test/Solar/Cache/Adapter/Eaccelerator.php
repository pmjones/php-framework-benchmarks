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
class Test_Solar_Cache_Adapter_Eaccelerator extends Test_Solar_Cache_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cache_Adapter_Eaccelerator = array(
    );
    
    protected $_extension = 'eaccelerator';
}
