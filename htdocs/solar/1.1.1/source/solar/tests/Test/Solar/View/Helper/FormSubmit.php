<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormSubmit extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormSubmit = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'submit' button.
     * 
     */
    public function testFormSubmit()
    {
        $info = array(
            'name'  => 'test',
        );
        
        $actual = $this->_view->formSubmit($info);
        $expect = '<input type="submit" name="test" />';
        $this->assertSame($actual, $expect);
        
        $info = array(
            'name'  => 'test',
            'value' => 'Push Me',
        );
        
        $actual = $this->_view->formSubmit($info);
        $expect = '<input type="submit" name="test" value="Push Me" />';
        $this->assertSame($actual, $expect);
    }
}
