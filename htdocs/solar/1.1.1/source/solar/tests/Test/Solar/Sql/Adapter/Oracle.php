<?php
/**
 * Parent test.
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Adapter.php';

/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Sql_Adapter_Oracle extends Test_Solar_Sql_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Adapter_Oracle = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Constructor.
     * 
     * @param array $config User-defined configuration parameters.
     * 
     */
    public function __construct($config = null)
    {
        $this->todo('need adapter-specific config');
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
        $obj = Solar::factory('Solar_Sql_Adapter_Oracle');
        $this->assertInstance($obj, 'Solar_Sql_Adapter_Oracle');
    }
    
    /**
     * 
     * Test -- Adds a portable column to a table in the database.
     * 
     */
    public function testAddColumn()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Leave autocommit mode and begin a transaction.
     * 
     */
    public function testBegin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Commit a transaction and return to autocommit mode.
     * 
     */
    public function testCommit()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates a PDO object and connects to the database.
     * 
     */
    public function testConnect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates a portable index on a table.
     * 
     */
    public function testCreateIndex()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates a sequence in the database.
     * 
     */
    public function testCreateSequence()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Overrides the adapter's create Table to manage Oracle's specific needs for table creation.
     * 
     */
    public function testCreateTable()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes rows from the table based on a WHERE clause.
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Closes the database connection.
     * 
     */
    public function testDisconnect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Drops a column from a table in the database.
     * 
     */
    public function testDropColumn()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Drops an index from a table in the database.
     * 
     */
    public function testDropIndex()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Drops a sequence from the database.
     * 
     */
    public function testDropSequence()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Drops a table from the database, if it exists.
     * 
     */
    public function testDropTable()
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
     * Test -- Returns an array describing table columns from the cache; if the cache entry is not available, queries the database for the column descriptions.
     * 
     */
    public function testFetchTableCols()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a list of database tables from the cache; if the cache entry is not available, queries the database for the list of tables.
     * 
     */
    public function testFetchTableList()
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
     * Test -- Returns the cache object.
     * 
     */
    public function testGetCache()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the connection-specific cache key prefix.
     * 
     */
    public function testGetCacheKeyPrefix()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Get the PDO connection object (connects to the database if needed).
     * 
     */
    public function testGetPdo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Get the query profile array.
     * 
     */
    public function testGetProfile()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Inserts a row of data into a table.
     * 
     */
    public function testInsert()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Get the last auto-incremented insert ID from the database.
     * 
     */
    public function testLastInsertId()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the next number in a sequence; creates the sequence if it does not exist.
     * 
     */
    public function testNextSequence()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Prepares and executes an SQL statement, optionally binding values to named parameters in the statement.
     * 
     */
    public function testQuery()
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
     * Test -- Quotes a single identifier name (table, table alias, table column,  index, sequence).
     * 
     */
    public function testQuoteName()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Quotes all fully-qualified identifier names ("table.col") in a string, typically an SQL snippet for a SELECT clause.
     * 
     */
    public function testQuoteNamesIn()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Roll back a transaction and return to autocommit mode.
     * 
     */
    public function testRollback()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Injects a cache dependency for [[$_cache]].
     * 
     */
    public function testSetCache()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the connection-specific cache key prefix.
     * 
     */
    public function testSetCacheKeyPrefix()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Turns profiling on and off.
     * 
     */
    public function testSetProfiling()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Updates a table with specified data based on a WHERE clause.
     * 
     */
    public function testUpdate()
    {
        $this->todo('stub');
    }
}
