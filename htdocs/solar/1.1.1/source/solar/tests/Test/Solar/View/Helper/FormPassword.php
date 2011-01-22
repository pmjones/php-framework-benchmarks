<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormPassword extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormPassword = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'password' element.
     * 
     */
    public function testFormPassword()
    {
        $info = array(
            'name'  => 'test',
        );
        
        $actual = $this->_view->formPassword($info);
        $expect = '<input type="password" name="test" value="" auto_complete="off" />';
        $this->assertSame($actual, $expect);
    }
}
