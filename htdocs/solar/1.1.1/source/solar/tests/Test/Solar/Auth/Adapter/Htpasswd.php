<?php
/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Auth_Adapter_Htpasswd extends Test_Solar_Auth_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Auth_Adapter_Htpasswd = array(
    );
    
    protected function _preConfig()
    {
        parent::_preConfig();
        $dir  = Solar_Class::dir('Mock_Solar_Auth_Adapter_Htpasswd');
        $file = $dir . 'users.htpasswd';
        $this->_Test_Solar_Auth_Adapter_Htpasswd['file'] = $file;
    }
}
