<?php
/**
 * 
 * Abstract adapter class test.
 * 
 */
abstract class Test_Solar_Role_Adapter extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Role_Adapter = array(
    );
    
    /**
     * 
     * The adapter class to instantiate.
     * 
     * @var array
     * 
     */
    protected $_adapter_class;
    
    /**
     * 
     * The adapter instance.
     * 
     * @var array
     * 
     */
    protected $_adapter;
    
    /**
     * 
     * Sets $_adapter_class based on the test class name.
     * 
     * @return void
     * 
     */
    protected function _postConstruct()
    {
        parent::_postConstruct();
        
        // Test_Vendor_Foo => Vendor_Foo
        $this->_adapter_class = substr(get_class($this), 5);
    }
    
    /**
     * 
     * Creates an adapter instance.
     * 
     * @return void
     * 
     */
    public function preTest()
    {
        parent::preTest();
        $this->_adapter = Solar::factory(
            $this->_adapter_class,
            $this->_config
        );
    }
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $this->assertInstance($this->_adapter, $this->_adapter_class);
    }
    
    /**
     * 
     * Test -- Provides magic "isRoleName()" to map to "is('role_name')".
     * 
     */
    public function test__call()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Appends a single role to the existing list of roles.
     * 
     */
    public function testAdd()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Appends a list of roles to the existing list of roles.
     * 
     */
    public function testAddList()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adapter-specific method to find roles for loading.
     * 
     */
    public function testFetch()
    {
        $expect = array('admin', 'root');
        $actual = $this->_adapter->fetch('pmjones');
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Gets the list of all loaded roles for the user.
     * 
     */
    public function testGetList()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Check to see if a user is in a role.
     * 
     */
    public function testIs()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->is('admin');
        $this->assertTrue($actual);
    }
    
    public function testIs_not()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->is('no-such-role');
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Check to see if a user is in all of the listed roles.
     * 
     */
    public function testIsAll()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAll(array('admin', 'root'));
        $this->assertTrue($actual);
    }
    
    public function testIsAll_not()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAll(array('admin', 'root', 'no-such-role'));
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Check to see if a user is in any of the listed roles.
     * 
     */
    public function testIsAny()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAny(array('no-such-role', 'root'));
        $this->assertTrue($actual);
    }
    
    public function testIsAny_not()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAny(array('no-such-role', 'no-other-role'));
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Load the list of roles for the given user from the adapter.
     * 
     */
    public function testLoad()
    {
        $this->_adapter->load('pmjones');
        $expect = array('admin', 'root');
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
    }
    
    public function testLoad_refresh()
    {
        // load the first time
        $this->_adapter->load('pmjones');
        $expect = array('admin', 'root');
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
        
        // foribly refresh
        $this->_adapter->load('boshag', true);
        $expect = array('admin');
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Resets the role list to nothing.
     * 
     */
    public function testReset()
    {
        // load the first time
        $this->_adapter->load('pmjones');
        $expect = array('admin', 'root');
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
        
        // reset to empty
        $this->_adapter->reset();
        $expect = array();
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets the list, overriding what is there already.
     * 
     */
    public function testSetList()
    {
        $this->todo('stub');
    }
}
