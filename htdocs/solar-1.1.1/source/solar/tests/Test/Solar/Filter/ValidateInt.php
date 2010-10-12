<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateInt extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateInt = array(
    );
    
    /**
     * 
     * Test -- Validates that the value represents an integer.
     * 
     */
    public function testValidateInt()
    {
        $test = array(
            "+1234567890",
            1234567890,
            -123456789.0,
            -1234567890,
            '-123',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateInt($val));
        }
    }
    
    public function testValidateInt_badOrBlank()
    {
        $test = array(
            ' ', '',
            "-abc.123",
            "123.abc",
            "123,456",
            '0000123.456000',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateInt($val));
        }
    }
    
    public function testValidateInt_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            "+1234567890",
            1234567890,
            -123456789.0,
            -1234567890,
            '-123',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateInt($val));
        }
    }
}
