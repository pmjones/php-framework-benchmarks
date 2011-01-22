<?php
/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Auth_Adapter_None extends Test_Solar_Auth_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Auth_Adapter_None = array(
    );
    
    // no such thing as a valid login with the 'none' adapter
    
    public function preTest()
    {
        $this->_handle = null;
        parent::preTest();
    }
    
    public function testIsValid()
    {
        $this->_fakePostLogin_valid();
        $this->_auth->start();
        $this->assertFalse($this->_auth->isValid());
    }
    
    public function testProcessLogin()
    {
        $this->_fakePostLogin_valid();
        $this->assertTrue($this->_auth->isLoginRequest());
        $this->assertFalse($this->_auth->processLogin());
    }
    
    public function testProcessLogout()
    {
        $this->_fakePostLogin_valid();
        $this->assertTrue($this->_auth->isLoginRequest());
        $this->assertFalse($this->_auth->processLogin());
        $this->assertFalse($this->_auth->isValid());
        
        $this->_fakePostLogout();
        $this->assertTrue($this->_auth->isLogoutRequest());
        
        $this->_auth->processLogout();
        $this->assertFalse($this->_auth->isValid());
    }
    
    public function test_handle()
    {
        $this->_fakePostLogin_valid();
        $this->assertTrue($this->_auth->isLoginRequest());
        $this->assertFalse($this->_auth->processLogin());
        $this->assertNull($this->_auth->handle);
    }
    
    public function test_email()
    {
        $this->_fakePostLogin_valid();
        $this->assertTrue($this->_auth->isLoginRequest());
        $this->assertFalse($this->_auth->processLogin());
        $this->assertNull($this->_auth->email);
    }
    
    public function test_moniker()
    {
        $this->_fakePostLogin_valid();
        $this->assertTrue($this->_auth->isLoginRequest());
        $this->assertFalse($this->_auth->processLogin());
        $this->assertNull($this->_auth->moniker);
    }
    
    public function test_uri()
    {
        $this->_fakePostLogin_valid();
        $this->assertTrue($this->_auth->isLoginRequest());
        $this->assertFalse($this->_auth->processLogin());
        $this->assertNull($this->_auth->email);
    }
    
    public function testStart()
    {
        $this->_fakePostLogin_valid();
        $this->_auth->start();
        $this->assertFalse($this->_auth->isValid());
    }
    
    public function testStart_logout()
    {
        $this->_fakePostLogin_valid();
        $this->_auth->start();
        $this->assertFalse($this->_auth->isValid());
        
        $this->_fakePostLogout();
        $this->_auth->start();
        $this->assertFalse($this->_auth->isValid());
    }
    
}
