<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateUri extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateUri = array(
    );
    
    /**
     * 
     * Test -- Validates the value as a URI.
     * 
     */
    public function testValidateUri()
    {
        $test = array(
            "http://example.com",
            "https://example.com/path/to/file.php",
            "ftp://example.com/path/to/file.php/info",
            "news://example.com/path/to/file.php/info?foo=bar&baz=dib#zim",
            "gopher://example.com/?foo=bar&baz=dib#zim",
            "mms://user:pass@site.info/path/to/file.php/info?foo=bar&baz=dib#zim",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateUri($val));
        }
    }
    
    public function testValidateUri_badOrBlank()
    {
        $test = array(
            "", '',
            'a,', '^b', '%',
            'ab-db cd-ef',
            'example.com',
            'http://',
            "http://example.com\r/index.html",
            "http://example.com\n/index.html",
            "http://example.com\t/index.html",
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateUri($val));
        }
    }
    
    public function testValidateUri_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "", ' ',
            "foo://example.com/path/to/file.php/info?foo=bar&baz=dib#zim",
            "mms://user:pass@site.info/path/to/file.php/info?foo=bar&baz=dib#zim",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateUri($val));
        }
    }
}
