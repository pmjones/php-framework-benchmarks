<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormOptions extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormOptions = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a list of options.
     * 
     */
    public function testFormOptions()
    {
        $info = array(
            'options' => array(
                'foo' => 'bar',
                'baz' => 'dib',
                'zim' => 'gir',
            ),
        );
        
        // no selection
        $actual = $this->_view->formOptions($info);
        $tmp = array();
        $tmp[] = '<option value="foo" label="bar">bar</option>';
        $tmp[] = '<option value="baz" label="dib">dib</option>';
        $tmp[] = '<option value="zim" label="gir">gir</option>';
        $expect = implode("\n", $tmp);
        $this->assertSame($actual, $expect);
        
        // selected
        $info['value'] = 'baz';
        $actual = $this->_view->formOptions($info);
        $tmp = array();
        $tmp[] = '<option value="foo" label="bar">bar</option>';
        $tmp[] = '<option value="baz" label="dib" selected="selected">dib</option>';
        $tmp[] = '<option value="zim" label="gir">gir</option>';
        $expect = implode("\n", $tmp);
        $this->assertSame($actual, $expect);
    }
}
