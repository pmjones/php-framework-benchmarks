<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Meta extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Meta = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <meta ...
     * 
     */
    public function testMeta()
    {
        $attribs = array('foo' => 'bar');
        $actual = $this->_view->meta($attribs);
        $expect = '<meta foo="bar" />';
        $this->assertSame($actual, $expect);
    }
}
