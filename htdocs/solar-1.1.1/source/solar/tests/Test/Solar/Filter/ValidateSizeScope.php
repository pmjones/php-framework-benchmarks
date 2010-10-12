<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateSizeScope extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateSizeScope = array(
    );
    
    /**
     * 
     * Test -- See the value has only a certain number of digits and decimals.
     * 
     */
    public function testValidateSizeScope()
    {
        $size = 10;
        $scope = 4;
        
        $test = array(
            "+1234567890",
            '0000123.456000',
            123.4560000,
            12345.67890,
            123456.7890,
            1234567.890,
            12345678.90,
            123456789.0,
            1234567890,
            -12345.67890,
            -123456.7890,
            -1234567.890,
            -12345678.90,
            -123456789.0,
            -1234567890,
        );
        
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateSizeScope($val, $size, $scope));
        }
        
    }
    
    public function testValidateSizeScope_badOrBlank()
    {
        $size = 10;
        $scope = 4;
        
        $test = array(
            ' ', '',
            "-abc.123",
            "123,456",
            .1234567890,
            1.234567890,
            12.34567890,
            123.4567890,
            1234.567890,
            -.1234567890,
            -1.234567890,
            -12.34567890,
            -123.4567890,
            -1234.567890,
        );
        
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateSizeScope($val, $size, $scope));
        }
        
    }
    
    public function testValidateSizeScope_notRequired()
    {
        $size = 10;
        $scope = 4;
        
        $test = array(
            "+1234567890",
            '0000123.456000',
            123.4560000,
            12345.67890,
            123456.7890,
            1234567.890,
            12345678.90,
            123456789.0,
            1234567890,
            -12345.67890,
            -123456.7890,
            -1234567.890,
            -12345678.90,
            -123456789.0,
            -1234567890,
            "", " ",
        );
        
        $this->_filter->setRequire(false);
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateSizeScope($val, $size, $scope));
        }
    }
}
