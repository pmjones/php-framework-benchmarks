<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Image extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Image = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns an <img ...
     * 
     */
    public function testImage()
    {
        $src = '/images/example.gif';
        $actual = $this->_view->image($src);
        $expect = '<img src="/public/images/example.gif" alt="example.gif" />';
        $this->assertSame($actual, $expect);
    }
}
