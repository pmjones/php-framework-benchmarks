<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateMaxLength extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateMaxLength = array(
    );
    
    /**
     * 
     * Test -- Validates that a string is no longer than a certain length.
     * 
     */
    public function testValidateMaxLength()
    {
        $len = strlen("I am the very model");
        $test = array(
            0,
            "I am",
            "I am the very model",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMaxLength($val, $len));
        }
    }
    
    public function testValidateMaxLength_badOrBlank()
    {
        $len = strlen("I am the very model");
        $test = array(
            "", " ",
            "I am the very model of a modern",
            "I am the very model of a moden Major-General",
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateMaxLength($val, $len));
        }
    }
    
    public function testValidateMaxLength_notRequired()
    {
        $len = strlen("I am the very model");
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            "I am",
            "I am the very model",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMaxLength($val, $len));
        }
    }
}
