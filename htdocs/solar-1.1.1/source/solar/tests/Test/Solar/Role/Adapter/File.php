<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Role_Adapter_File extends Test_Solar_Role_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Role_Adapter_File = array(
        'file' => null,
    );
    
    protected function _preConfig()
    {
        $dir = Solar_Class::dir('Mock_Solar_Role_Adapter_File');
        $file = $dir . 'roles.txt';
        $this->_Test_Solar_Role_Adapter_File['file'] = $file;
    }
}
