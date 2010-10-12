<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateIsoDate extends Test_Solar_Filter_ValidateIsoTimestamp {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateIsoDate = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is an ISO 8601 date string.
     * 
     */
    public function testValidateIsoDate()
    {
        $test = array(
            '0001-01-01',
            '1970-08-08',
            '1979-11-07',
            '2004-02-29',
            '9999-12-31',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIsoDate($val));
        }
    }
    
    public function testValidateIsoDate_badOrBlank()
    {
        $test = array(
            ' ', '',
            '1-2-3',
            '0001-1-1',
            '1-01-1',
            '1-1-01',
            '0000-00-00',
            '0000-01-01',
            '0010-20-40',
            '2005-02-29',
            '9999.12:31',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateIsoDate($val));
        }
    }
    
    public function testValidateIsoDate_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            '0001-01-01',
            '1970-08-08',
            '1979-11-07',
            '9999-12-31',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIsoDate($val));
        }
    }
}
