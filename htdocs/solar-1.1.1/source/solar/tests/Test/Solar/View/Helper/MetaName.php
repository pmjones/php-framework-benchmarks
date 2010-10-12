<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_MetaName extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_MetaName = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <meta name="" content="" /> tag.
     * 
     */
    public function testMetaName()
    {
        $attribs = array('foo' => 'bar');
        $actual = $this->_view->metaName('foo', 'bar');
        $expect = '<meta name="foo" content="bar" />';
        $this->assertSame($actual, $expect);
    }
}
