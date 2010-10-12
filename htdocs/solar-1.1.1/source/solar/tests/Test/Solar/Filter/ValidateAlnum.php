<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateAlnum extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateAlnum = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is only letters (upper or lower case) and digits.
     * 
     */
    public function testValidateAlnum()
    {
        $test = array(
            0, 1, 2, 5,
            '0', '1', '2', '5',
            'alphaonly',
            'AlphaOnLy',
            'someThing8else',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateAlnum($val));
        }
    }
    
    public function testValidateAlnum_badOrBlank()
    {
        $test = array(
            "", '',
            "Seven 8 nine",
            "non:alpha-numeric's",
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateAlnum($val));
        }
    }
    
    public function testValidateAlnum_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            0, 1, 2, 5,
            '0', '1', '2', '5',
            'alphaonly',
            'AlphaOnLy',
            'someThing8else',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateAlnum($val));
        }
    }
}
