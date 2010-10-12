<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Filter_Abstract extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_Abstract = array(
    );
    
    protected $_filter;
    
    protected $_plugin;
    
    protected $_plugin_name;
    
    protected $_plugin_class;
    
    public function _postConstruct()
    {
        parent::_postConstruct();
        $this->_plugin_name  = substr(get_class($this), 18);
        $this->_plugin_class = substr(get_class($this), 5);
    }
    
    public function preTest()
    {
        parent::preTest();
        $this->_filter = Solar::factory('Solar_Filter');
        $this->_plugin = $this->_filter->getFilter($this->_plugin_name);
        $this->_filter->setRequire(true);
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
        $this->assertInstance($this->_plugin, $this->_plugin_class);
    }
    
    /**
     * 
     * Test -- Returns the value of the $_invalid property.
     * 
     */
    public function testGetInvalid()
    {
        if (substr($this->_plugin_name, 0, 8) == 'Sanitize') {
            // sanitizers don't have invalidation strings
            $expect = null;
        } else {
            // 'ValidateFooBar' => 'invalidFooBar'
            $expect = 'invalid' . substr($this->_plugin_name, 8);
    
            // 'invalidFoobar' => 'INVALID_FOO_BAR'
            $expect = strtoupper(preg_replace(
                '/([a-z])([A-Z])/',
                '$1_$2',
                $expect
            ));
        }
        
        $actual = $this->_plugin->getInvalid();
        $this->assertSame($actual, $expect);
    }
}
