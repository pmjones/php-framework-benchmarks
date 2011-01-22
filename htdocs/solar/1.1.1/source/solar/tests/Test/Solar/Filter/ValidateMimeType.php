<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateMimeType extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateMimeType = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is formatted as a MIME type.
     * 
     */
    public function testValidateMimeType()
    {
        $test = array(
            'text/plain',
            'text/xhtml+xml',
            'application/vnd.ms-powerpoint',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMimeType($val));
        }
    }
    
    public function testValidateMimeType_limitedTypes()
    {
        // only certain types allowed
        $allowed = array('text/plain', 'text/html', 'text/xhtml+xml');
        $this->assertTrue($this->_filter->validateMimeType('text/html', $allowed));
        $this->assertFalse($this->_filter->validateMimeType('application/vnd.ms-powerpoint', $allowed));
    }
    
    public function testValidateMimeType_badOrBlank()
    {
        $test = array(
            ' ', '',
            'text/',
            '/something',
            0, 1, 2, 5,
            '0', '1', '2', '5',
            "Seven 8 nine",
            "non:alpha-numeric's",
            'someThing8else',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateMimeType($val));
        }
    }
    
    public function testValidateMimeType_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            '', ' ',
            'text/plain',
            'text/xhtml+xml',
            'application/vnd.ms-powerpoint',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateMimeType($val));
        }
    }
}
