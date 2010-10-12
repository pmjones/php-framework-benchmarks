<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormHidden extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormHidden = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'hidden' element.
     * 
     */
    public function testFormHidden()
    {
        $info = array(
            'name'  => 'test',
            'value' => '"something\'s quoted"',
        );
        
        $actual = $this->_view->formHidden($info);
        $expect = '<input type="hidden" name="test" value="&quot;something\'s quoted&quot;" />';
        $this->assertSame($actual, $expect);
    }
}
