<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateIsoTimestamp extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateIsoTimestamp = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is an ISO 8601 timestamp string.
     * 
     */
    public function testValidateIsoTimestamp()
    {
        $test = array(
            '0001-01-01T00:00:00',
            '1970-08-08T12:34:56',
            '2004-02-29T24:00:00',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIsoTimestamp($val));
        }
    }
    
    public function testValidateIsoTimestamp_badOrBlank()
    {
        $test = array(
            ' ', '',
            '0000-00-00T00:00:00',
            '0000-01-01T12:34:56',
            '0010-20-40T12:34:56',
            '1979-11-07T12:34',
            '1970-08-08t12:34:56',
            '           24:00:00',
            '          T        ',
            '9999-12-31         ',
            '9999.12:31 ab:cd:ef',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateIsoTimestamp($val));
        }
    }
    
    public function testValidateIsoTimestamp_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            '0001-01-01T00:00:00',
            '1970-08-08T12:34:56',
            '2004-02-29T24:00:00',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIsoTimestamp($val));
        }
    }
}
