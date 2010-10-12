<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateMin extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateMin = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is greater than or equal to a minimum.
     * 
     */
    public function testValidateMin()
    {
        $min = 4;
        $test = array(
            4, 5, 6
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMin($val, $min));
        }
    }
    
    public function testValidateMin_badOrBlank()
    {
        $min = 4;
        $test = array(
            ' ', '',
            0, 1, 2, 3, ' ', ''
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateMin($val, $min));
        }
    }
    
    public function testValidateMin_notRequired()
    {
        $min = 4;
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            4, 5, 6
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMin($val, $min));
        }
    }
}
