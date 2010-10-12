<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Params_Fetch extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Params_Fetch = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('Solar_Sql_Model_Params_Fetch');
        $expect = 'Solar_Sql_Model_Params_Fetch';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Performs a "deep" clone of objects in the data.
     * 
     */
    public function test__clone()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets a data value.
     * 
     */
    public function test__get()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Does a certain key exist in the data?
     * 
     */
    public function test__isset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a key value and marks the struct as "dirty"; also marks all parent structs as "dirty" too.
     * 
     */
    public function test__set()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a string representation of the object.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a key in the data to null.
     * 
     */
    public function test__unset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the alias to use for this eager or fetch.
     * 
     */
    public function testAlias()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds named-placeholder values to bind to the resulting fetch query.
     * 
     */
    public function testBind()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Should the fetch attempt use cached results when available?
     * 
     */
    public function testCache()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When fetching from and saving to the cache, what key should be used?
     * 
     */
    public function testCacheKey()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds new columns to the existing list of columns.
     * 
     */
    public function testCols()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Countable: how many keys are there?
     * 
     */
    public function testCount()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Should the fetch issue a followup query to count the total number of records and pages?
     * 
     */
    public function testCountPages()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Iterator: get the current value for the array pointer.
     * 
     */
    public function testCurrent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Should the fetch use a SELECT DISTINCT?
     * 
     */
    public function testDistinct()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a new related eager-fetch (with options) to the params.
     * 
     */
    public function testEager()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Frees memory used by this struct.
     * 
     */
    public function testFree()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the cache key being used for this fetch.
     * 
     */
    public function testGetCacheKey()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the cache key being used for "count pages" on this fetch.
     * 
     */
    public function testGetCacheKeyForCount()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds GROUP BY columns to the fetch.
     * 
     */
    public function testGroup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a HAVING condition to the fetch, optionally with a value to bind to the condition.
     * 
     */
    public function testHaving()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is the struct dirty?
     * 
     */
    public function testIsDirty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a single arbitrary JOIN to the fetch.
     * 
     */
    public function testJoin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Iterator: get the current key for the array pointer.
     * 
     */
    public function testKey()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a LIMIT COUNT and OFFSET on the fetch.
     * 
     */
    public function testLimit()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Loads this params object with an array or struct.
     * 
     */
    public function testLoad()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Iterator: move to the next position.
     * 
     */
    public function testNext()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- ArrayAccess: does the requested key exist?
     * 
     */
    public function testOffsetExists()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- ArrayAccess: get a key value.
     * 
     */
    public function testOffsetGet()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- ArrayAccess: set a key value.
     * 
     */
    public function testOffsetSet()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- ArrayAccess: unset a key.
     * 
     */
    public function testOffsetUnset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds ORDER BY columns to the fetch.
     * 
     */
    public function testOrder()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets which page number of records the fetch should return.
     * 
     */
    public function testPage()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the number of rows-per-page on the fetch.
     * 
     */
    public function testPaging()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Iterator: move to the first position.
     * 
     */
    public function testRewind()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a copy of the struct as an array, recursively descending to convert child structs into arrays as well.
     * 
     */
    public function testToArray()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a string representation of the struct.
     * 
     */
    public function testToString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Iterator: is the current position valid?
     * 
     */
    public function testValid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a WHERE condition to the fetch, optionally with a value to bind to the condition.
     * 
     */
    public function testWhere()
    {
        $this->todo('stub');
    }
}
