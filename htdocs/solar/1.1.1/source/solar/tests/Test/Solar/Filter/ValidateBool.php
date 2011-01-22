<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateBool extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateBool = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is a boolean representation.
     * 
     */
    public function testValidateBool()
    {
        $list = array(
            true,
            'on', 'On', 'ON',
            'yes', 'Yes', 'YeS',
            'y', 'Y',
            'true', 'True', 'TrUe',
            't', 'T',
            1, '1',
            false,
            'off', 'Off', 'OfF',
            'no', 'No', 'NO',
            'n', 'N',
            'false', 'False', 'FaLsE',
            'f', 'F',
            0, '0',
        );
        
        foreach ($list as $val) {
            $bool = $this->_filter->validateBool($val, false);
            $this->assertTrue($bool);
        }
    }
    
    public function testValidateBool_badOrBlank()
    {
        $list = array(
            'nothing', 123,
        );
        
        foreach ($list as $val) {
            $bool = $this->_filter->validateBool($val, false);
            $this->assertFalse($bool);
        }
    }
    
    public function testValidateBool_notRequired()
    {
        $this->_filter->setRequire(false);
        $list = array(
            '', '    ',
        );
        
        foreach ($list as $val) {
            $bool = $this->_filter->validateBool($val);
            $this->assertTrue($bool);
        }
    }
}
