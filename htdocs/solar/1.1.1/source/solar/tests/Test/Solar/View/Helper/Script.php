<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Script extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Script = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <script></script> tag.
     * 
     */
    public function testScript()
    {
        $actual = $this->_view->script('clientside.js');
        $expect = '<script src="/public/clientside.js" type="text/javascript"></script>';
        $this->assertSame($actual, $expect);
    }
}
