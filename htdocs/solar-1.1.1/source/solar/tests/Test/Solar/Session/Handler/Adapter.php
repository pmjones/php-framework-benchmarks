<?php
/**
 * 
 * Abstract adapter class test.
 * 
 */
abstract class Test_Solar_Session_Handler_Adapter extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Session_Handler_Adapter = array(
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
     * Test -- Closes the session handler.
     * 
     */
    public function testClose()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Destroys session data.
     * 
     */
    public function testDestroy()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Removes old session data (garbage collection).
     * 
     */
    public function testGc()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Opens the session handler.
     * 
     */
    public function testOpen()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Reads session data.
     * 
     */
    public function testRead()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Writes session data.
     * 
     */
    public function testWrite()
    {
        $this->skip('abstract method');
    }
}
