<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Access_Adapter extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Access_Adapter = array(
    );
    
    protected $_access;
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Setup; runs before each test method.
     * 
     */
    public function preTest()
    {
        // remove "Test_" prefix
        $this->_class = substr(get_class($this), 5);
        
        $this->_access = Solar::factory($this->_class, $this->_config);
        
        parent::preTest();
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
        $obj = Solar::factory($this->_class);
        $this->assertInstance($obj, $this->_class);
    }
    
    /**
     * 
     * Test -- Fetch access privileges for a user handle and roles.
     * 
     */
    public function testFetch()
    {
        // anonymous user
        $list = $this->_access->fetch(null, array());
        $this->assertTrue(count($list) == 1);
        
        $list = $this->_access->fetch('gir', array());
        $this->assertTrue(count($list) == 4);
        
        $list = $this->_access->fetch('gir', array('bar'));
        $this->assertTrue(count($list) == 5);
    }
    
    /**
     * 
     * Test -- Tells whether or not to allow access to a class/action/process combination.
     * 
     */
    public function testIsAllowed()
    {
        $this->_access->load('gir', array('bar'));
        
        // deny all override
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Deny',
            '*'
        ));
        
        // allowed for role bar
        $this->assertTrue($this->_access->isAllowed(
            'Fixture_Solar_App_Example',
            'read'
        ));
        
        // test wildcard actions
        $this->assertTrue($this->_access->isAllowed(
            'Fixture_Solar_App_Example2',
            'read'
        ));
        
        // test specific action
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example3',
            'edit'
        ));
        
        // allow access to all authenticated users ('+')
        $this->assertTrue($this->_access->isAllowed(
            'Fixture_Solar_App_Example4',
            'read'
        ));
        
        $this->_access->load('someone', array('foo'));
        
        // deny access for role 'foo'
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example',
            'read'
        ));
        
        // non-authenticated user
        $this->_access->load(null, array());
        
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Auth',
            'read'
        ));
    }
    
    public function testIsAllowed_objectSpec()
    {
        $controller = Solar::factory('Fixture_Solar_App_Example');
        
        // allowed for role bar
        $this->_access->load('gir', array('bar'));
        $this->assertTrue($this->_access->isAllowed(
            $controller,
            'read'
        ));
        
        // deny access for role 'foo'
        $this->_access->load('someone', array('foo'));
        $this->assertFalse($this->_access->isAllowed(
            $controller,
            'read'
        ));
    }
    
    /**
     * 
     * Test -- Checks to see if the current user is the owner of application-specific content.
     * 
     */
    public function testIsOwner()
    {
        $this->skip('Not implemented by this adapter');
    }
    
    /**
     * 
     * Test -- Fetches the access list from the adapter into $this->list.
     * 
     */
    public function testLoad()
    {
        // load with literal handle and roles
        $this->_access->load('gir', array('bar'));
        $this->diag($this->_access->list);
        
        // simply test there's correct amount of acl rows
        $actual = count($this->_access->list);
        $expect = 5;
        $this->assertEquals($actual, $expect);
    }
    
    
    public function testLoad_object()
    {
        $auth = Solar::factory('Solar_Auth');
        $auth->handle = 'gir';
        
        $role = Solar::factory('Solar_Role');
        $role->setList(array('bar'));
        
        // load with auth and role object
        $this->_access->load($auth, $role);
        $this->diag($this->_access->list);
        
        // simply test there's correct amount of acl rows
        $actual = count($this->_access->list);
        $expect = 5;
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Resets the current access controls to a blank array, along with the  $_auth and $_role properties.
     * 
     */
    public function testReset()
    {
        $this->_access->reset();
        $this->assertProperty($this->_access, '_auth', 'same', null);
        $this->assertProperty($this->_access, '_role', 'same', null);
        $this->assertSame($this->_access->list, array());
    }
}
