<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Select extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Select = array(
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
        $obj = Solar::factory('Solar_Sql_Select');
        $this->assertInstance($obj, 'Solar_Sql_Select');
    }
    
    /**
     * 
     * Test -- Returns this object as an SQL statement string.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Backend support for multiHaving().
     * 
     */
    public function test_multiHaving()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Backend support for multiWhere().
     * 
     */
    public function test_multiWhere()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds data to bind into the query.
     * 
     */
    public function testBind()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Clears query properties and row sources.
     * 
     */
    public function testClear()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds 1 or more columns to the SELECT, without regard to a FROM or JOIN.
     * 
     */
    public function testCols()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Get the count of rows and number of pages for the current query.
     * 
     */
    public function testCountPages()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Makes the query SELECT DISTINCT.
     * 
     */
    public function testDistinct()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetch the results based on the current query properties.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches all rows from the database using sequential keys.
     * 
     */
    public function testFetchAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches all rows from the database using associative keys (defined by the first column).
     * 
     */
    public function testFetchAssoc()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches the first column of all rows as a sequential array.
     * 
     */
    public function testFetchCol()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches one row from the database.
     * 
     */
    public function testFetchOne()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches an associative array of all rows as key-value pairs (first  column is the key, second column is the value).
     * 
     */
    public function testFetchPairs()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a PDOStatement result object.
     * 
     */
    public function testFetchPdo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Builds the SQL statement and returns it as a string instead of  executing it.
     * 
     */
    public function testFetchSql()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches the very first value (i.e., first column of the first row).
     * 
     */
    public function testFetchValue()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a FROM table and columns to the query.
     * 
     */
    public function testFrom()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a sub-select and columns to the query.
     * 
     */
    public function testFromSelect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the number of rows per page.
     * 
     */
    public function testGetPaging()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds grouping to the query.
     * 
     */
    public function testGroup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a HAVING condition to the query by AND.
     * 
     */
    public function testHaving()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds an INNER JOIN table and columns to the query.
     * 
     */
    public function testInnerJoin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a JOIN table and columns to the query.
     * 
     */
    public function testJoin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a LEFT JOIN table and columns to the query.
     * 
     */
    public function testLeftJoin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a limit count and offset to the query.
     * 
     */
    public function testLimit()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the limit and count by page number.
     * 
     */
    public function testLimitPage()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds multiple HAVING conditions to the query.
     * 
     */
    public function testMultiHaving()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds multiple WHERE conditions to the query.
     * 
     */
    public function testMultiWhere()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a HAVING condition to the query by OR.
     * 
     */
    public function testOrHaving()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a WHERE condition to the query by OR.
     * 
     */
    public function testOrWhere()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a row order to the query.
     * 
     */
    public function testOrder()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Safely quotes a value for an SQL statement.
     * 
     */
    public function testQuote()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Quotes a value and places into a piece of text at a placeholder.
     * 
     */
    public function testQuoteInto()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Quote multiple text-and-value pieces.
     * 
     */
    public function testQuoteMulti()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the number of rows per page.
     * 
     */
    public function testSetPaging()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Unsets bound data.
     * 
     */
    public function testUnbind()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a WHERE condition to the query by AND.
     * 
     */
    public function testWhere()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a *compound* limit count and offset to the query; used only in UNION (etc) queries.
     * 
     */
    public function testCompoundLimit()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the *compound* limit and count by page number; used only in UNION (etc) queries.
     * 
     */
    public function testCompoundLimitPage()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a *compound* row order to the query; used only in UNION (etc) queries.
     * 
     */
    public function testCompoundOrder()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds an INNER JOIN sub-select and columns to the query.
     * 
     */
    public function testInnerJoinSelect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a LEFT JOIN sub-select and columns to the query.
     * 
     */
    public function testLeftJoinSelect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds multiple JOINs to the query.
     * 
     */
    public function testMultiJoin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Takes the current select properties and prepares them for UNION with the next set of select properties.
     * 
     */
    public function testUnion()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Takes the current select properties and prepares them for UNION ALL with the next set of select properties.
     * 
     */
    public function testUnionAll()
    {
        $this->todo('stub');
    }
}
