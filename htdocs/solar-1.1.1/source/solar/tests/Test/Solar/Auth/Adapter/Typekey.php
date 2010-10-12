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
class Test_Solar_Auth_Adapter_Typekey extends Test_Solar_Auth_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Auth_Adapter_Typekey = array(
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
        $obj = Solar::factory('Solar_Auth_Adapter_Typekey');
        $this->assertInstance($obj, 'Solar_Auth_Adapter_Typekey');
    }
    
    /**
     * 
     * Test -- Retrieves a "read-once" session value for Solar_Auth.
     * 
     */
    public function testGetFlash()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is the current page-load a login request?
     * 
     */
    public function testIsLoginRequest()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Tells if the current page load appears to be the result of an attempt to log out.
     * 
     */
    public function testIsLogoutRequest()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Tells whether the current authentication is valid.
     * 
     */
    public function testIsValid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Processes login attempts and sets user credentials.
     * 
     */
    public function testProcessLogin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Processes logout attempts.
     * 
     */
    public function testProcessLogout()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Resets any authentication data in the session.
     * 
     */
    public function testReset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Starts a session with authentication.
     * 
     */
    public function testStart()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Updates idle and expire times, invalidating authentication if they are exceeded.
     * 
     */
    public function testUpdateIdleExpire()
    {
        $this->todo('stub');
    }
}
