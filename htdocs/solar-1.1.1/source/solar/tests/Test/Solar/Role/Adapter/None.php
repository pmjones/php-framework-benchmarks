<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Role_Adapter_None extends Test_Solar_Role_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Role_Adapter_None = array(
    );
    
    public function testFetch()
    {
        $expect = array();
        $actual = $this->_adapter->fetch('pmjones');
        $this->assertEquals($actual, $expect);
    }
    
    public function testLoad()
    {
        $this->_adapter->load('pmjones');
        $expect = array();
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
    }
    
    public function testLoad_refresh()
    {
        // load the first time
        $this->_adapter->load('pmjones');
        $expect = array();
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
        
        // foribly refresh
        $this->_adapter->load('boshag', true);
        $expect = array();
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
    }
    
    public function testReset()
    {
        // load the first time
        $this->_adapter->load('pmjones');
        $expect = array();
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
        
        // reset to empty
        $this->_adapter->reset();
        $expect = array();
        $actual = $this->_adapter->getList();
        $this->assertEquals($actual, $expect);
    }
    
    public function testIs()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->is('admin');
        $this->assertFalse($actual);
    }
    
    public function testIs_not()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->is('no-such-role');
        $this->assertFalse($actual);
    }
    
    public function testIsAny()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAny(array('no-such-role', 'root'));
        $this->assertFalse($actual);
    }
    
    public function testIsAny_not()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAny(array('no-such-role', 'no-other-role'));
        $this->assertFalse($actual);
    }
    
    public function testIsAll()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAll(array('admin', 'root'));
        $this->assertFalse($actual);
    }
    
    public function testIsAll_not()
    {
        $this->_adapter->load('pmjones');
        $actual = $this->_adapter->isAll(array('admin', 'root', 'no-such-role'));
        $this->assertFalse($actual);
    }
}
