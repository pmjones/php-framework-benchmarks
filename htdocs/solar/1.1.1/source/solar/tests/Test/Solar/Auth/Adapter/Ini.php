<?php
/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Auth_Adapter_Ini extends Test_Solar_Auth_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Auth_Adapter_Ini = array(
    );
    
    protected function _preConfig()
    {
        parent::_preConfig();
        $dir  = Solar_Class::dir('Mock_Solar_Auth_Adapter_Ini');
        $file = $dir . 'users.ini';
        $this->_Test_Solar_Auth_Adapter_Ini['file'] = $file;
    }
    
    protected function _postConstruct()
    {
        parent::_postConstruct();
        $this->_moniker = 'Paul M. Jones';
        $this->_email   = 'pmjones@solarphp.com';
        $this->_uri     = 'http://paul-m-jones.com';
    }
}
