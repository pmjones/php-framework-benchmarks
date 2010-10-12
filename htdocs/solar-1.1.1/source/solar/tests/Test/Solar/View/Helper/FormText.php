<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormText extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormText = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'text' element.
     * 
     */
    public function testFormText()
    {
        $info = array(
            'name'  => 'test',
            'value' => '"quoted\'s"',
        );
        
        $actual = $this->_view->formText($info);
        $expect = '<input type="text" name="test" value="&quot;quoted\'s&quot;" />';
        $this->assertSame($actual, $expect);
    }
}
