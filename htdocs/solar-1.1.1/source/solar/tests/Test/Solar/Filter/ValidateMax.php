<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateMax extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateMax = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is less than than or equal to a maximum.
     * 
     */
    public function testValidateMax()
    {
        $max = 3;
        $test = array(
            1, 2, 3,
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMax($val, $max));
        }
    }
    
    public function testValidateMax_badOrBlank()
    {
        $max = 3;
        $test = array(
            ' ', '',
            4, 5, 6
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateMax($val, $max));
        }
    }
    
    public function testValidateMax_notRequired()
    {
        $max = 3;
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            1, 2, 3,
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMax($val, $max));
        }
    }
}
