<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormButton extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormButton = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'button' element.
     * 
     */
    public function testFormButton()
    {
        $info = array(
            'name'  => 'test',
            'value' => 'Push Me',
        );
        
        $actual = $this->_view->formButton($info);
        $expect = '<input type="button" name="test" value="Push Me" />';
        $this->assertSame($actual, $expect);
    }
}
