<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateIpv4 extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateIpv4 = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is a legal IPv4 address.
     * 
     */
    public function testValidateIpv4()
    {
        $test = array(
            '141.225.185.101',
            '255.0.0.0',
            '0.255.0.0',
            '0.0.255.0',
            '0.0.0.255',
            '127.0.0.1',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIpv4($val));
        }
    }
    
    public function testValidateIpv4_badOrBlank()
    {
        $test = array(
            ' ', '',
            '127.0.0.1234',
            '127.0.0.0.1',
            '256.0.0.0',
            '0.256.0.0',
            '0.0.256.0',
            '0.0.0.256',
            '1.',
            '1.2.',
            '1.2.3.',
            '1.2.3.4.',
            'a.b.c.d',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateIpv4($val));
        }
    }
    
    public function testValidateIpv4_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            '141.225.185.101',
            '255.0.0.0',
            '0.255.0.0',
            '0.0.255.0',
            '0.0.0.255',
            '127.0.0.1',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateIpv4($val));
        }
    }
}
