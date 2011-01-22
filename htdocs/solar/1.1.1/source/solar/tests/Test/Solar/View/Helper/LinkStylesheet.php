<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_LinkStylesheet extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_LinkStylesheet = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <link rel="stylesheet" ...
     * 
     */
    public function testLinkStylesheet()
    {
        $actual = $this->_view->linkStylesheet('styles.css');
        $expect = '<link rel="stylesheet" type="text/css" media="screen" href="/public/styles.css" />';
        $this->assertSame($actual, $expect);
    }
}
