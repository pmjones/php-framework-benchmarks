<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateIsoTime extends Test_Solar_Filter_ValidateIsoTimestamp {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateIsoTime = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is an ISO 8601 time string (hh:ii::ss format).
     * 
     */
    public function testValidateIsoTime()
    {
        $test = array(
            '00:00:00',
            '12:34:56',
            '23:59:59',
            '24:00:00',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIsoTime($val));
        }
    }
    
    public function testValidateIsoTime_badOrBlank()
    {
        $test = array(
            ' ', '',
            '24:00:01',
            '12.00.00',
            '12-34_56',
            ' 12:34:56 ',
            '  :34:56',
            '12:  :56',
            '12:34   ',
            '12:34'
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateIsoTime($val));
        }
    }
    
    public function testValidateIsoTime_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            '00:00:00',
            '12:34:56',
            '23:59:59',
            '24:00:00',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIsoTime($val));
        }
    }
}
