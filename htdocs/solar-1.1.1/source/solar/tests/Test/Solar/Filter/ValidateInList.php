<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateInList extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateInList = array(
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
     * Test -- Validates that the value is in a list of allowed values.
     * 
     */
    public function testValidateInList()
    {
        $test = $this->_opts;
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateInList($val, $this->_opts));
        }
    }
    
    public function testValidateInList_badOrBlank()
    {
        $test = array('a', 'b', 'c', '', ' ');
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateInList($val, $this->_opts));
        }
    }
    
    public function testValidateInList_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = $this->_opts;
        $test[] = "";
        $test[] = " ";
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateInList($val, $this->_opts));
        }
    }
}
