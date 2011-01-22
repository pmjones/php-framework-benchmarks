<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateWord extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateWord = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is composed only of word characters.
     * 
     */
    public function testValidateWord()
    {
        $test = array(
            'abc', 'def', 'ghi',
            'abc_def',
            'A1s_2Sd',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateWord($val));
        }
    }
    
    public function testValidateWord_badOrBlank()
    {
        $test = array(
            "", '',
            'a,', '^b', '%',
            'ab-db cd-ef',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateWord($val));
        }
    }
    
    public function testValidateWord_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            'abc', 'def', 'ghi',
            'abc_def',
            'A1s_2Sd',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateWord($val));
        }
    }
}
