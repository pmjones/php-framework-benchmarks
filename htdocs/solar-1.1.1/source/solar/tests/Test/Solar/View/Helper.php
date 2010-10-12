<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_View_Helper extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper = array(
    );
    
    protected $_helper;
    
    protected $_helper_name;
    
    protected $_helper_class;
    
    protected $_request;
    
    protected $_view;
    
    protected function _postConstruct()
    {
        parent::_postConstruct();
        
        // "Test_Solar_View_Helper_" = 23
        $this->_helper_name  = substr(get_class($this), 23);
        $this->_helper_class = substr(get_class($this), 5);
        $this->_request      = Solar_Registry::get('request');
        $this->_view         = Solar::factory('Solar_View');
    }
    
    public function preTest()
    {
        parent::preTest();
        $this->_helper = $this->_view->getHelper($this->_helper_name);
    }
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $this->assertInstance($this->_helper, $this->_helper_class);
    }
}
