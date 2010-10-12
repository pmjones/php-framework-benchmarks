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
class Test_Solar_Access_Adapter_None extends Test_Solar_Access_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Access_Adapter_None = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    public function testFetch()
    {
        // anonymous user
        $list = $this->_access->fetch(null, array());
        $this->assertTrue(count($list) == 1);
        
        $list = $this->_access->fetch('gir', array());
        $this->assertTrue(count($list) == 1);
        
        $list = $this->_access->fetch('gir', array('bar'));
        $this->assertTrue(count($list) == 1);
    }
    
    public function testIsAllowed()
    {
        $this->_access->load('gir', array('bar'));
        
        // deny all override
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Deny',
            '*'
        ));
        
        // deny for role bar
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example',
            'read'
        ));
        
        // test wildcard actions
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example2',
            'read'
        ));
        
        // test specific action
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example3',
            'edit'
        ));
        
        // allow access to all authenticated users ('+')
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example4',
            'read'
        ));
        
        $this->_access->load('someone', array('foo'));
        
        // deny access for role 'foo'
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Example',
            'read'
        ));
        
        // non-autenticated user
        $this->_access->load(null, array());
        
        $this->assertFalse($this->_access->isAllowed(
            'Fixture_Solar_App_Auth',
            'read'
        ));
    }
    
    public function testIsAllowed_objectSpec()
    {
        $controller = Solar::factory('Fixture_Solar_App_Example');
        
        // deny for role bar
        $this->_access->load('gir', array('bar'));
        $this->assertFalse($this->_access->isAllowed(
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
    
    public function testLoad()
    {
        // load with literal handle and roles
        $this->_access->load('gir', array('bar'));
        $this->diag($this->_access->list);
        
        // simply test there's correct amount of acl rows
        $actual = count($this->_access->list);
        $expect = 1;
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
        $expect = 1;
        $this->assertEquals($actual, $expect);
    }
}
