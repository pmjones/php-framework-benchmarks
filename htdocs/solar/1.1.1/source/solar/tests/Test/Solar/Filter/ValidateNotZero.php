<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateNotZero extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateNotZero = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is not exactly zero.
     * 
     */
    public function testValidateNotZero()
    {
        // good (are non-zero)
        $test = array(
            '1', '2', '5',
            "Seven 8 nine",
            "non:alpha-numeric's",
            'someThing8else',
            '+-0.0',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateNotZero($val));
        }
    }
    
    public function testValidateNotZero_badOrBlank()
    {
        // bad (are in fact zero, or are blank)
        $test = array(
            ' ', '',
            '0', 0, '00000.00', '+0', '-0', "+00.00",
        );
        foreach ($test as $key => $val) {
            $this->assertFalse($this->_filter->validateNotZero($val));
        }
    }
    
    public function testValidateNotZero_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            ' ', '',
            '1', '2', '5',
            "Seven 8 nine",
            "non:alpha-numeric's",
            'someThing8else',
            '+-0.0',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateNotZero($val));
        }
    }
}
