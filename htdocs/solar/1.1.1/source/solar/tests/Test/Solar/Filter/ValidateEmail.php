<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateEmail extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateEmail = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is an email address.
     * 
     */
    public function testValidateEmail()
    {
        $test = array(
            "pmjones@solarphp.net",
            "no.body@no.where.com",
            "any-thing@gmail.com",
            "any_one@hotmail.com",
            "nobody1234567890@yahoo.co.uk",
            "something+else@example.com",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateEmail($val));
        }
    }
    
    public function testValidateEmail_badOrBlank()
    {
        $test = array(
            "something @ somewhere.edu",
            "the-name.for!you",
            "non:alpha@example.com",
            "",
            "\t\n",
            " ",
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateEmail($val));
        }
    }
    
    public function testValidateEmail_notRequired()
    {
        $this->_filter->setRequire(false);
        $test = array(
            "",
            "\t\n",
            " ",
            "pmjones@solarphp.net",
            "no.body@no.where.com",
            "any-thing@gmail.com",
            "any_one@hotmail.com",
            "nobody1234567890@yahoo.co.uk",
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateEmail($val));
        }
    }
}
