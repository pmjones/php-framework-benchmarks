<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Base extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Base = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <base ...
     * 
     */
    public function testBase()
    {
        $actual = $this->_view->base('http://example.com/');
        $expect = '<base href="http://example.com/" />';
        $this->assertSame($actual, $expect);
    }
}
