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
class Test_Solar_Access_Adapter_Open extends Test_Solar_Access_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Access_Adapter_Open = array(
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
        
        // allow all override
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Deny',
            '*'
        ));
        
        // allow for role bar
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Example',
            'read'
        ));
        
        // test wildcard actions
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Example2',
            'read'
        ));
        
        // test specific action
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Example3',
            'edit'
        ));
        
        // allow access to all authenticated users ('+')
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Example4',
            'read'
        ));
        
        $this->_access->load('someone', array('foo'));
        
        // allow access for role 'foo'
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Example',
            'read'
        ));
        
        // non-authenticated user
        $this->_access->load(null, array());
        
        $this->assertTrue($this->_access->isAllowed(
            'Vendor_App_Auth',
            'read'
        ));
    }
    
    public function testIsAllowed_objectSpec()
    {
        $controller = Solar::factory('Fixture_Solar_App_Example');
        
        // deny for role bar
        $this->_access->load('gir', array('bar'));
        $this->assertTrue($this->_access->isAllowed(
            $controller,
            'read'
        ));
        
        // deny access for role 'foo'
        $this->_access->load('someone', array('foo'));
        $this->assertTrue($this->_access->isAllowed(
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
