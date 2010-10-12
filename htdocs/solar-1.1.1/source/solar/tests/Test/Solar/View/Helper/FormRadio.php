<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormRadio extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormRadio = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a set of radio button elements.
     * 
     */
    public function testFormRadio()
    {
        $info = array(
            'name'    => 'test',
            'options' => array(
                'foo' => 'bar',
                'baz' => 'dib',
                'zim' => 'gir',
            ),
        );
        
        // no selection
        $actual = $this->_view->formRadio($info);
        $tmp = array();
        $tmp[] = '<input type="hidden" name="test" value="" />';
        $tmp[] = '<label class="radio"><input type="radio" name="test" value="foo" /> bar</label>';
        $tmp[] = '<label class="radio"><input type="radio" name="test" value="baz" /> dib</label>';
        $tmp[] = '<label class="radio"><input type="radio" name="test" value="zim" /> gir</label>';
        $expect = implode("\n", $tmp);
        $this->assertSame($actual, $expect);
        
        // selected
        $info['value'] = 'baz';
        $actual = $this->_view->formRadio($info);
        $tmp = array();
        $tmp[] = '<input type="hidden" name="test" value="" />';
        $tmp[] = '<label class="radio"><input type="radio" name="test" value="foo" /> bar</label>';
        $tmp[] = '<label class="radio"><input type="radio" name="test" value="baz" checked="checked" /> dib</label>';
        $tmp[] = '<label class="radio"><input type="radio" name="test" value="zim" /> gir</label>';
        $expect = implode("\n", $tmp);
        $this->assertSame($actual, $expect);
    }
}
