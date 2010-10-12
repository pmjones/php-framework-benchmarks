<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Model extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Model = array(
    );
    
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
        parent::preTest();
        Solar_Registry::set('sql', 'Solar_Sql');
        Solar_Registry::set('model_catalog', 'Solar_Sql_Model_Catalog');
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
        $obj = Solar::factory('Solar_Model');
        $this->assertInstance($obj, 'Solar_Model');
    }
    
    /**
     * 
     * Test -- Magic call implements "fetchOneBy...()" and "fetchAllBy...()" for columns listed in the method name.
     * 
     */
    public function test__call()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Read-only access to protected model properties.
     * 
     */
    public function test__get()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a data result and the select used to fetch the data.
     * 
     */
    public function test_fetchResultSelect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches count and pages of available records.
     * 
     */
    public function testCountPages()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes rows from the model table and deletes cache entries.
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a record or collection by primary key value(s).
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a collection of all records by arbitrary parameters.
     * 
     */
    public function testFetchAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches an array of rows by arbitrary parameters.
     * 
     */
    public function testFetchArray()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- The same as fetchAll(), except the record collection is keyed on the first column of the results (instead of being a strictly sequential array.)  Recognized parameters for the fetch are:  `eager` : (string|array) Eager-fetch records from these related models.
     * 
     */
    public function testFetchAssoc()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a sequential array of values from the model, using only the first column of the results.
     * 
     */
    public function testFetchCol()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a new record with default values.
     * 
     */
    public function testFetchNew()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches one record by arbitrary parameters.
     * 
     */
    public function testFetchOne()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches an array of key-value pairs from the model, where the first column is the key and the second column is the value.
     * 
     */
    public function testFetchPairs()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a single value from the model (i.e., the first column of the  first record of the returned page set).
     * 
     */
    public function testFetchValue()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- "Cleans up" SELECT clause parameters.
     * 
     */
    public function testFixSelectParams()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Call this before you unset the instance so that you release the memory from all the internal child objects.
     * 
     */
    public function testFree()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the number of records per page.
     * 
     */
    public function testGetPaging()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the control object for a named relationship.
     * 
     */
    public function testGetRelated()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Inserts one row to the model table and deletes cache entries.
     * 
     */
    public function testInsert()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the appropriate collection object for this model.
     * 
     */
    public function testNewCollection()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the appropriate record object for an inheritance model.
     * 
     */
    public function testNewRecord()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a new Solar_Sql_Select tool, with the proper SQL object injected automatically, and with eager "to-one" associations joined.
     * 
     */
    public function testNewSelect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Serializes data values in-place based on $this->_serialize_cols.
     * 
     */
    public function testSerializeCols()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the number of records per page.
     * 
     */
    public function testSetPaging()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Un-serializes data values in-place based on $this->_serialize_cols.
     * 
     */
    public function testUnserializeCols()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Updates rows in the model table and deletes cache entries.
     * 
     */
    public function testUpdate()
    {
        $this->todo('stub');
    }
}
