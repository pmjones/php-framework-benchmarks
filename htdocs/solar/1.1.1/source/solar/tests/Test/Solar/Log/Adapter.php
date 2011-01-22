<?php
/**
 * 
 * Abstract adapter class test.
 * 
 */
abstract class Test_Solar_Log_Adapter extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Log_Adapter = array(
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
     * Test -- Gets the list of events this adapter recognizes.
     * 
     */
    public function testGetEvents()
    {
        // default is always "*"
        $log = Solar::factory($this->_adapter_class);
        $actual = $log->getEvents();
        $expect = array('*');
        $this->assertSame($actual, $expect);
        
        // set some new ones
        $expect = array('foo', 'bar', 'baz');
        $log->setEvents($expect);
        $actual = $log->getEvents();
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Saves (writes) an event and message to the log.
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the list of events this adapter recognizes.
     * 
     */
    public function testSetEvents()
    {
        $expect = array('foo', 'bar', 'baz');
        $this->_adapter->setEvents($expect);
        $actual = $this->_adapter->getEvents();
        $this->assertSame($actual, $expect);
    }
    
    public function testSetEvents_string()
    {
        $expect = array('foo', 'bar', 'baz');
        $string = implode(', ', $expect);
        $this->_adapter->setEvents($string);
        $actual = $this->_adapter->getEvents();
        $this->assertSame($actual, $expect);
    }
    
}
