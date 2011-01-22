<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateSepWords extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateSepWords = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is composed of one or more words separated by a single separator-character.
     * 
     */
    public function testValidateSepWords()
    {
        $test = array(
            'abc def ghi',
            ' abc def ',
            'a1s_2sd and another',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateSepWords($val));
        }
    }
    
    public function testValidateSepWords_badOrBlank()
    {
        $test = array(
            "", '',
            'a, b, c',
            'ab-db cd-ef',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateSepWords($val));
        }
    }
    
    public function testValidateSepWords_altSeparator()
    {
        // alternative separator
        $test = array(
            'abc,def,ghi',
            'abc,def',
            'a1s_2sd,and,another',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateSepWords($val, ','));
        }
    }
    
    public function testValidateSepWords_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            'abc def ghi',
            ' abc def ',
            'a1s_2sd and another',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateSepWords($val));
        }
    }
}
