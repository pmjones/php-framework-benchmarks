<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Link extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Link = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <link ...
     * 
     */
    public function testLink()
    {
        $attribs = array('foo' => 'bar');
        $actual = $this->_view->link($attribs);
        $expect = '<link foo="bar" />';
        $this->assertSame($actual, $expect);
    }
}
