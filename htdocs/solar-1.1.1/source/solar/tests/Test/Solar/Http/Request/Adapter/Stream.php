<?php
/**
 * Parent test.
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Adapter.php';

/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Http_Request_Adapter_Stream extends Test_Solar_Http_Request_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Http_Request_Adapter_Stream = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Constructor.
     * 
     * @param array $config User-defined configuration parameters.
     * 
     */
    public function __construct($config = null)
    {
        $this->todo('need adapter-specific config');
    }
    
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
        $obj = Solar::factory('Solar_Http_Request_Adapter_Stream');
        $this->assertInstance($obj, 'Solar_Http_Request_Adapter_Stream');
    }
    
    /**
     * 
     * Test -- Returns this object as a string; effectively, the request message to be sent.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches the last Solar_Http_Response object from the specified URI.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches all Solar_Http_Response objects from the specified URI (this includes all intervening redirects).
     * 
     */
    public function testFetchAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches from the specified URI and returns the response message as a string.
     * 
     */
    public function testFetchRaw()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the body content.
     * 
     */
    public function testGetContent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns all options as an array.
     * 
     */
    public function testGetOptions()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets "Basic" authorization credentials.
     * 
     */
    public function testSetBasicAuth()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the character set for the body content.
     * 
     */
    public function testSetCharset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the body content; technically you can use the public $content  property, but this allows method-chaining.
     * 
     */
    public function testSetContent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the content-type for the body content.
     * 
     */
    public function testSetContentType()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a cookie value in $this->_cookies to add to the request.
     * 
     */
    public function testSetCookie()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets multiple cookie values in $this->_cookies to add to the request.
     * 
     */
    public function testSetCookies()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a header value in $this->_headers for sending at fetch() time.
     * 
     */
    public function testSetHeader()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When making the request, allow no more than this many redirects.
     * 
     */
    public function testSetMaxRedirects()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the HTTP method for the request (GET, POST, etc).
     * 
     */
    public function testSetMethod()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Send all requests through this proxy server.
     * 
     */
    public function testSetProxy()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the referer for the request.
     * 
     */
    public function testSetReferer()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Location of Certificate Authority file on local filesystem which should be used with the $_ssl_verify_peer option to authenticate the identity of the remote peer.
     * 
     */
    public function testSetSslCafile()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- If $_ssl_cafile is not specified or if the certificate is not found there, this directory path is searched for a suitable certificate.
     * 
     */
    public function testSetSslCapath()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Path to local certificate file on filesystem.
     * 
     */
    public function testSetSslLocalCert()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Passphrase with which the $_ssl_local_cert file was encoded.
     * 
     */
    public function testSetSslPassphrase()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Require verification of SSL certificate used?
     * 
     */
    public function testSetSslVerifyPeer()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the request timeout in seconds.
     * 
     */
    public function testSetTimeout()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the URI for the request.
     * 
     */
    public function testSetUri()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the User-Agent for the request.
     * 
     */
    public function testSetUserAgent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the HTTP protocol version for the request (1.0 or 1.1).
     * 
     */
    public function testSetVersion()
    {
        $this->todo('stub');
    }
}
