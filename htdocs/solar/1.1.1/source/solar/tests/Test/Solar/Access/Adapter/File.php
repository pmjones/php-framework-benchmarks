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
class Test_Solar_Access_Adapter_File extends Test_Solar_Access_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Access_Adapter_File = array(
    );
    
    protected function _preConfig()
    {
        parent::_preConfig();
        $dir = Solar_Class::dir('Mock_Solar_Access_Adapter');
        $file = $dir . 'access.txt';
        $this->_Test_Solar_Access_Adapter_File['file'] = $file;
    }
}
