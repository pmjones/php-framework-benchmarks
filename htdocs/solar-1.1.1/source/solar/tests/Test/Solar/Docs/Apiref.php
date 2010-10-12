<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Docs_Apiref extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Docs_Apiref = array(
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
        $obj = Solar::factory('Solar_Docs_Apiref');
        $this->assertInstance($obj, 'Solar_Docs_Apiref');
    }
    
    /**
     * 
     * Test -- Adds a class to the API docs.
     * 
     */
    public function testAddClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds classes from a file hierarchy.
     * 
     */
    public function testAddFiles()
    {
        $this->todo('stub');
    }
}
