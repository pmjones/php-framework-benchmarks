<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormSelect extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormSelect = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates 'select' list of options.
     * 
     */
    public function testFormSelect()
    {
        $info = array(
            'name'    => 'test',
            'options' => array(
                'foo' => 'bar',
                'baz' => 'dib',
                'zim' => 'gir',
            ),
        );
        
        $line = array();
        $line[0] = '<select name="test">';
        $line[1] = '    <option value="foo" label="bar">bar</option>';
        $line[2] = '    <option value="baz" label="dib">dib</option>';
        $line[3] = '    <option value="zim" label="gir">gir</option>';
        $line[4] = '</select>';
        
        // no selection
        $actual = $this->_view->formSelect($info);
        $expect = implode("\n", $line);
        $this->assertSame($actual, $expect);
        
        // selected
        $info['value'] = 'baz';
        $line[2] = '    <option value="baz" label="dib" selected="selected">dib</option>';
        $actual = $this->_view->formSelect($info);
        $expect = implode("\n", $line);
        $this->assertSame($actual, $expect);
    }
    
    public function testFormSelect_multipleImpliedByName()
    {
        $info = array(
            'name'    => 'test[]',
            'options' => array(
                'foo' => 'bar',
                'baz' => 'dib',
                'zim' => 'gir',
            ),
        );
        
        $line = array();
        $line[0] = '<input type="hidden" name="test" value="" /><select name="test[]" multiple="multiple">';
        $line[1] = '    <option value="foo" label="bar">bar</option>';
        $line[2] = '    <option value="baz" label="dib">dib</option>';
        $line[3] = '    <option value="zim" label="gir">gir</option>';
        $line[4] = '</select>';
        
        // no selection
        $actual = $this->_view->formSelect($info);
        $expect = implode("\n", $line);
        $this->assertSame($actual, $expect);
        
        // selected
        $info['value'] = array('foo', 'zim');
        $line[1] = '    <option value="foo" label="bar" selected="selected">bar</option>';
        $line[3] = '    <option value="zim" label="gir" selected="selected">gir</option>';
        $actual = $this->_view->formSelect($info);
        $expect = implode("\n", $line);
        $this->assertSame($actual, $expect);
    }
    
    public function testFormSelect_multipleImpliedByAttribs()
    {
        $info = array(
            'name'    => 'test',
            'options' => array(
                'foo' => 'bar',
                'baz' => 'dib',
                'zim' => 'gir',
            ),
            'attribs' => array(
                'multiple' => 'multiple',
            ),
        );
        
        $line = array();
        $line[0] = '<input type="hidden" name="test" value="" /><select name="test[]" multiple="multiple">';
        $line[1] = '    <option value="foo" label="bar">bar</option>';
        $line[2] = '    <option value="baz" label="dib">dib</option>';
        $line[3] = '    <option value="zim" label="gir">gir</option>';
        $line[4] = '</select>';
        
        // no selection
        $actual = $this->_view->formSelect($info);
        $expect = implode("\n", $line);
        $this->assertSame($actual, $expect);
        
        // selected
        $info['value'] = array('foo', 'zim');
        $line[1] = '    <option value="foo" label="bar" selected="selected">bar</option>';
        $line[3] = '    <option value="zim" label="gir" selected="selected">gir</option>';
        $actual = $this->_view->formSelect($info);
        $expect = implode("\n", $line);
        $this->assertSame($actual, $expect);
    }
}
