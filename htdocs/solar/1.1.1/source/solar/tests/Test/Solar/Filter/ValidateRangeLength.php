<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateRangeLength extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateRangeLength = array(
    );
    
    /**
     * 
     * Test -- Validates that the length of the value is within a given range.
     * 
     */
    public function testValidateRangeLength()
    {
        $min = 4;
        $max = 6;
        
        // good
        $test = array(
            "abcd",
            "abcde",
            "abcdef",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateRangeLength($val, $min, $max));
        }
    }
    
    public function testValidateRangeLength_badOrBlank()
    {
        $min = 4;
        $max = 6;
        $test = array(
            "", " ",
            'a', 'ab', 'abc',
            'abcdefg', 'abcdefgh', 'abcdefghi', 
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateRangeLength($val, $min, $max));
        }
    }
    
    public function testValidateRangeLength_notRequired()
    {
        $min = 4;
        $max = 6;
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            "abcd",
            "abcde",
            "abcdef",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateRangeLength($val, $min, $max));
        }
    }
}
