<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormReset extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormReset = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'reset' button.
     * 
     */
    public function testFormReset()
    {
        $info = array(
            'name'  => 'test',
        );
        
        $actual = $this->_view->formReset($info);
        $expect = '<input type="reset" name="test" />';
        $this->assertSame($actual, $expect);
        
        $info = array(
            'name'  => 'test',
            'value' => 'Push Me',
        );
        
        $actual = $this->_view->formReset($info);
        $expect = '<input type="reset" name="test" value="Push Me" />';
        $this->assertSame($actual, $expect);
    }
}
