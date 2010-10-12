<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateRange extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateRange = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is within a given range.
     * 
     */
    public function testValidateRange()
    {
        $min = 4;
        $max = 6;
        $test = array(
            4, 5, 6
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateRange($val, $min, $max));
        }
    }
    
    public function testValidateRange_badOrBlank()
    {
        $min = 4;
        $max = 6;
        $test = array(
            ' ', '',
            0, 1, 2, 3, 7, 8, 9,
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateRange($val, $min, $max));
        }
    }
    
    public function testValidateRange_notRequired()
    {
        $min = 4;
        $max = 6;
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            4, 5, 6
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateRange($val, $min, $max));
        }
    }
}
