<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Cache extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Cache = array(
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
        $obj = Solar::factory('Solar_Sql_Model_Cache');
        $this->assertInstance($obj, 'Solar_Sql_Model_Cache');
    }
    
    /**
     * 
     * Test -- Adds data to the cache under a specified key.
     * 
     */
    public function testAdd()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes the cache for this model.
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes the cache for this model and all related models.
     * 
     */
    public function testDeleteAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the key for a cache entry based on fetch parameters for a select.
     * 
     */
    public function testEntry()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches the data for a cache entry.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the model this cache will work with; picks up the SQL cache key prefix along with it.
     * 
     */
    public function testSetModel()
    {
        $this->todo('stub');
    }
}
