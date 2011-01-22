<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Registry extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Registry = array(
    );
    
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
        $this->skip("construction disallowed, static only");
    }
    
    /**
     * 
     * Test -- Check to see if an object name already exists in the registry.
     * 
     */
    public function testExists()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Accesses an object in the registry.
     * 
     */
    public function testGet()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Registers an object under a unique name.
     * 
     */
    public function testSet()
    {
        $this->todo('stub');
    }
}
