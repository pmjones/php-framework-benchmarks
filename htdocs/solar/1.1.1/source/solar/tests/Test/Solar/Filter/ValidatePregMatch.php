<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidatePregMatch extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidatePregMatch = array(
    );
    
    /**
     * 
     * Test -- Validates the value against a regular expression.
     * 
     */
    public function testValidatePregMatch()
    {
        $expr = '/^[\+\-]?[0-9]+$/';
        $test = array(
            "+1234567890",
            1234567890,
            -123456789.0,
            -1234567890,
            '-123',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validatePregMatch($val, $expr));
        }
    }
    
    public function testValidatePregMatch_badOrBlank()
    {
        $expr = '/^[\+\-]?[0-9]+$/';
        $test = array(
            ' ', '',
            "-abc.123",
            "123.abc",
            "123,456",
            '0000123.456000',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validatePregMatch($val, $expr));
        }
    }
    
    public function testValidatePregMatch_notRequired()
    {
        $expr = '/^[\+\-]?[0-9]+$/';
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
            $this->assertTrue($this->_filter->validatePregMatch($val, $expr));
        }
    }
}
