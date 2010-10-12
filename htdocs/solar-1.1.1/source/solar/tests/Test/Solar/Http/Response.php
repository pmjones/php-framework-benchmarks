<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Http_Response extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Http_Response = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $obj = Solar::factory('Solar_Http_Response');
        $this->assertInstance($obj, 'Solar_Http_Response');
    }
    
    /**
     * 
     * Test -- Sends all headers and cookies, then returns the body.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sends all headers and cookies, then prints the response content.
     * 
     */
    public function testDisplay()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the body content of the response.
     * 
     */
    public function testGetContent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the value and options for a single cookie.
     * 
     */
    public function testGetCookie()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the array of cookies that will be set by the response.
     * 
     */
    public function testGetCookies()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the value of a single header.
     * 
     */
    public function testGetHeader()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the array of all headers to be sent with the response.
     * 
     */
    public function testGetHeaders()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the current status code.
     * 
     */
    public function testGetStatusCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the current status text.
     * 
     */
    public function testGetStatusText()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the HTTP version for this response.
     * 
     */
    public function testGetVersion()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Issues an immediate "Location" redirect.
     * 
     */
    public function testRedirect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Redirects to another page and action after disabling HTTP caching.
     * 
     */
    public function testRedirectNoCache()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the content of the response.
     * 
     */
    public function testSetContent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a cookie value in $this->_cookies; will be sent to the client at display() time.
     * 
     */
    public function testSetCookie()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- By default, should cookies be sent by HTTP only?
     * 
     */
    public function testSetCookiesHttponly()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a header value in $this->_headers; will be sent to the client at display() time.
     * 
     */
    public function testSetHeader()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the HTTP response status code.
     * 
     */
    public function testSetStatusCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the HTTP response status text.
     * 
     */
    public function testSetStatusText()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the HTTP version to '1.0' or '1.1'.
     * 
     */
    public function testSetVersion()
    {
        $this->todo('stub');
    }
}
