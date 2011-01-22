<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Style extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Style = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <style>...</style> tag.
     * 
     */
    public function testStyle()
    {
        $actual = $this->_view->style('styles.css');
        $expect = '<style type="text/css" media="screen">'
                . '@import url("/public/styles.css");</style>';
        $this->assertSame($actual, $expect);
    }
    
    public function testStyle_remote()
    {
        $actual = $this->_view->style('http://something.com/path/to/styles.css');
        
        $expect = '<style type="text/css" media="screen">'
                . '@import url("http://something.com/path/to/styles.css");</style>';
                
        $this->assertSame($actual, $expect);
    }
}
