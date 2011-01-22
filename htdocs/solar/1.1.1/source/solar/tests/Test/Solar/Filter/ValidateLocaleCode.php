<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateLocaleCode extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateLocaleCode = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is a locale code.
     * 
     */
    public function testValidateLocaleCode()
    {
        $test = array(
            'en_US',
            'pt_BR',
            'xx_YY',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateLocaleCode($val));
        }
    }
    
    public function testValidateLocaleCode_badOrBlank()
    {
        $test = array(
            ' ', '',
            'PT_br',
            'EN_US',
            '12_34',
            'en_USA',
            'America/Chicago',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateLocaleCode($val));
        }
    }
    
    public function testValidateLocaleCode_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            'en_US',
            'pt_BR',
            'xx_YY',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateLocaleCode($val));
        }
    }
}
