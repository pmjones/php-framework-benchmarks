<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_MetaHttp extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_MetaHttp = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <meta http-equiv="" content="" /> tag.
     * 
     */
    public function testMetaHttp()
    {
        $attribs = array('foo' => 'bar');
        $actual = $this->_view->metaHttp('foo', 'bar');
        $expect = '<meta http-equiv="foo" content="bar" />';
        $this->assertSame($actual, $expect);
    }
}
