<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Params_Eager extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Params_Eager = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('Solar_Sql_Model_Params_Eager');
        $expect = 'Solar_Sql_Model_Params_Eager';
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
     * Test -- Adds new columns to the existing list of columns.
     * 
     */
    public function testCols()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the column-prefix to use when selecting columns.
     * 
     */
    public function testColsPrefix()
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
     * Test -- Iterator: get the current value for the array pointer.
     * 
     */
    public function testCurrent()
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
     * Test -- Is the struct dirty?
     * 
     */
    public function testIsDirty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the join condition to use; note that this overrides the existing join condition.
     * 
     */
    public function testJoinCond()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the join flag; i.e., whether or not this eager should be used to control which parent records are selected.
     * 
     */
    public function testJoinFlag()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Whether or not this is a "join-only"; in a join-only, the eager is joined, but no rows are selected.
     * 
     */
    public function testJoinOnly()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the join type to use (null, 'left', or 'inner').
     * 
     */
    public function testJoinType()
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
     * Test -- Loads this params object with an array or struct.
     * 
     */
    public function testLoad()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the merge type to use ('client' or 'server').
     * 
     */
    public function testMerge()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Should native records be selected by "WHERE IN (...)" a list of IDs, or by a sub-SELECT?
     * 
     */
    public function testNativeBy()
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
     * Test -- When automatically choosing a "native-by" strategy, the maximum number of records to use a "WHERE IN (...)" for; past this amount, use a sub- SELECT.
     * 
     */
    public function testWhereinMax()
    {
        $this->todo('stub');
    }
}
