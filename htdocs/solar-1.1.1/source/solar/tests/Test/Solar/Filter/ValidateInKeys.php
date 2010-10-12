<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateInKeys extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateInKeys = array(
    );
    
    protected $_opts = array(
        0      => 'val0',
        1      => 'val1',
        'key0' => 'val3',
        'key1' => 'val4',
        'key2' => 'val5'
    );
    
    /**
     * 
     * Test -- Validates that the value is a key in the list of allowed options.
     * 
     */
    public function testValidateInKeys()
    {
        $test = array_keys($this->_opts);
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateInKeys($val, $this->_opts));
        }
    }
    
    public function testValidateInKeys_badOrBlank()
    {
        $test = array('a', 'b', 'c', '', ' ');
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateInKeys($val, $this->_opts));
        }
    }
    
    public function testValidateInKeys_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array_keys($this->_opts);
        $test[] = " ";
        $test[] = "\r";
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateInKeys($val, $this->_opts));
        }
    }
}
