<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateNumeric extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateNumeric = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is numeric (any number or number string).
     * 
     */
    public function testValidateNumeric()
    {
        $test = array(
            "+123456.7890",
            12345.67890,
            -123456789.0,
            -123.4567890,
            '-123',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateNumeric($val));
        }
    }
    
    public function testValidateNumeric_badOrBlank()
    {
        $test = array(
            ' ', '',
            "-abc.123",
            "123.abc",
            "123,456",
            '00.00123.4560.00',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateNumeric($val));
        }
    }
    
    public function testValidateNumeric_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            "+123456.7890",
            12345.67890,
            -123456789.0,
            -123.4567890,
            '-123',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateNumeric($val));
        }
    }
}
