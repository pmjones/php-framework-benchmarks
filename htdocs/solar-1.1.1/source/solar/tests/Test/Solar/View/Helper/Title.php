<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Title extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Title = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <title ...
     * 
     */
    public function testTitle()
    {
        $actual = $this->_view->title('foo & bar');
        $expect = '<title>foo &amp; bar</title>';
        $this->assertSame($actual, $expect);
    }
}
