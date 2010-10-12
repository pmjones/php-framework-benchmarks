<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateCtype extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateCtype = array(
    );
    
    /**
     * 
     * Test -- Validates the value against a [[php::ctype | ]] function.
     * 
     */
    public function testValidateCtype()
    {
        // good
        $test = array(
            'alphaonly',
            'AlphaOnLy',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateCtype($val, 'alpha'));
        }
    }
    
    public function testValidateCtype_badOrBlank()
    {
        $test = array(
            ' ', '',
            0, 1, 2, 5,
            '0', '1', '2', '5',
            "Seven 8 nine",
            "non:alpha-numeric's",
            'someThing8else',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateCtype($val, 'alpha'));
        }
    }
    
    public function testValidateCtype_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            'alphaonly',
            'AlphaOnLy',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateCtype($val, 'alpha'));
        }
    }
}
