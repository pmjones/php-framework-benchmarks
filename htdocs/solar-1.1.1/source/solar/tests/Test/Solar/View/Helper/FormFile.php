<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_FormFile extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_FormFile = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a 'file' element.
     * 
     */
    public function testFormFile()
    {
        $info = array(
            'name'  => 'test',
        );
        
        $actual = $this->_view->formFile($info);
        $expect = '<input type="file" name="test" />';
        $this->assertSame($actual, $expect);
    }
}
