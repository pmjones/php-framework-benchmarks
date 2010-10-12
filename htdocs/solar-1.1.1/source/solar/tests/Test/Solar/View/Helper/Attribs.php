<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Attribs extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Attribs = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Converts an associative array to an attribute string.
     * 
     */
    public function testAttribs()
    {
        $attr = array(
            'foo' => 'bar',
            'baz' => '"dib"',
            'zim' => array('irk', 'gir'),
        );
        
        $actual = $this->_view->attribs($attr);
        $expect = ' foo="bar" baz="&quot;dib&quot;" zim="irk gir"';
        $this->assertSame($actual, $expect);
    }
}
