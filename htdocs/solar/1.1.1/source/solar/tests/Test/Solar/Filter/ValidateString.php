<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateString extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateString = array(
    );
    
    /**
     * 
     * Test -- Validates that the value can be represented as a string.
     * 
     */
    public function testValidateString()
    {
        $test = array(
            12345,
            123.45,
            true,
            false,
            'string',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateString($val));
        }
    }
    
    public function testValidateString_badOrBlank()
    {
        $test = array(
            array(),
            new StdClass,
            '',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateString($val));
        }
    }
    
    public function testValidateString_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            12345,
            123.45,
            true,
            false,
            'string',
            '', ' ', "\t\n",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateString($val));
        }
    }
}
