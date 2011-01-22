<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateAlpha extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateAlpha = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is letters only (upper or lower case).
     * 
     */
    public function testValidateAlpha()
    {
        // good
        $test = array(
            'alphaonly',
            'AlphaOnLy',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateAlpha($val));
        }
    }
    
    public function testValidateAlpha_badOrBlank()
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
            $this->assertFalse($this->_filter->validateAlpha($val));
        }
    }
    
    public function testValidateAlpha_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            'alphaonly',
            'AlphaOnLy',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateAlpha($val));
        }
    }
}
