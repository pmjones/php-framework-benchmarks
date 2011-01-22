<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateMinLength extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateMinLength = array(
    );
    
    /**
     * 
     * Test -- Validates that a string is at least a certain length.
     * 
     */
    public function testValidateMinLength()
    {
        $len = strlen("I am the very model");
        $test = array(
            "I am the very model",
            "I am the very model of a modern",
            "I am the very model of a moden Major-General",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMinLength($val, $len));
        }
    }
    
    public function testValidateMinLength_badOrBlank()
    {
        $len = strlen("I am the very model");
        $test = array(
            "", " ",
            0,
            "I am",
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateMinLength($val, $len));
        }
    }
    
    public function testValidateMinLength_notRequired()
    {
        $len = strlen("I am the very model");
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            "I am the very model",
            "I am the very model of a modern",
            "I am the very model of a moden Major-General",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMinLength($val, $len));
        }
    }
}
