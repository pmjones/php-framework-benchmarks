<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Sql_Adapter extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Adapter = array(
    );
    
    protected $_extension;
    
    protected $_adapter_class;
    
    protected $_adapter;
    
    protected $_table_def = array(
        'id' => array(
            'type' => 'int',
            'require' => true,
            'primary' => true,
            'autoinc' => true,
        ),
        'name' => array(
            'type' => 'varchar',
            'size' => 64
        ),
    );
    
    protected $_table_name = 'test_solar_sql_create';
    
    protected $_seq_name = 'test_solar_sql_create_id';
    
    protected $_quote_expect = null;
    
    protected $_quote_array_expect = null;
    
    protected $_quote_multi_expect = null;
    
    protected $_quote_into_expect = null;
    
    protected $_describe_table_sql = null;
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    protected function _preConfig()
    {
        if ($this->_extension && ! extension_loaded($this->_extension)) {
            $this->skip("'$this->_extension' extension not loaded");
        }
    }
    
    protected function _postConstruct()
    {
        parent::_postConstruct();
        $this->_adapter_class = substr(get_class($this), 5);
    }
    
    /**
     * 
     * Setup; runs before each test method.
     * 
     */
    public function preTest()
    {
        parent::preTest();
        $this->_adapter = Solar::factory($this->_adapter_class, $this->_config);
        
        // drop existing table
        try {
            $this->_adapter->dropTable($this->_table_name);
        } catch (Exception $e) {
            // do nothing
        }
        
        // drop existing sequence
        try {
            $this->_adapter->dropSequence($this->_seq_name);
        } catch (Exception $e) {
            // do nothing
        }
        
        // recreate table
        $this->_adapter->createTable($this->_table_name, $this->_table_def);
    }
    
    /**
     * 
     * Setup; runs after each test method.
     * 
     */
    public function postTest()
    {
        $this->_adapter = null;
        parent::postTest();
    }
    
    protected function _insertData()
    {
        // insert data
        $insert = array(
            array('id' => '1', 'name' => 'Foo'),
            array('id' => '2', 'name' => 'Bar'),
            array('id' => '3', 'name' => 'Baz'),
            array('id' => '4', 'name' => 'Dib'),
            array('id' => '5', 'name' => 'Zim'),
            array('id' => '6', 'name' => 'Gir'),
        );
        
        foreach ($insert as $row) {
            $this->_adapter->insert($this->_table_name, $row);
        }
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
        $this->assertInstance($this->_adapter, $this->_adapter_class);
    }
    
    /**
     * 
     * Test -- Adds a portable column to a table in the database.
     * 
     */
    public function testAddColumn()
    {
        $this->_insertData();
        
        $info = array(
            'type' => 'varchar',
            'size' => 255,
        );
        $this->_adapter->addColumn($this->_table_name, 'email', $info);
        $this->_adapter->update($this->_table_name, array('email' => 'nobody@example.com'), '1=1');
        
        $actual = $this->_adapter->fetchOne("SELECT * FROM $this->_table_name WHERE id = 1");
        $expect = array('id' => '1', 'name' => 'Foo', 'email' => 'nobody@example.com');
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Leave autocommit mode and begin a transaction.
     * 
     */
    public function testBegin()
    {
        $result = $this->_adapter->begin();
        $this->assertTrue($result);
        $this->_adapter->rollback();
    }
    
    /**
     * 
     * Test -- Commit a transaction and return to autocommit mode.
     * 
     */
    public function testCommit()
    {
        $data = array('id' => 1, 'name' => 'Zim');
        $this->_adapter->begin();
        $this->_adapter->insert($this->_table_name, $data);
        $this->_adapter->commit();
        $result = $this->_adapter->fetchValue("SELECT COUNT(*) FROM $this->_table_name");
        $this->assertEquals($result, '1');
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
        $result = $this->_adapter->createIndex($this->_table_name, 'id');
        $this->assertNotNull($result);
    }
    
    public function testCreateIndex_unique()
    {
        $result = $this->_adapter->createIndex($this->_table_name, 'id', true);
        $this->assertNotNull($result);
    }
    
    public function testCreateIndex_multi()
    {
        $result = $this->_adapter->createIndex($this->_table_name, 'multi', false, array('id', 'name'));
        $this->assertNotNull($result);
    }
    
    public function testCreateIndex_multiUnique()
    {
        $result = $this->_adapter->createIndex($this->_table_name, 'multi', false, array('id', 'name'));
        $this->assertNotNull($result);
    }
    
    public function testCreateIndex_altname()
    {
        $result = $this->_adapter->createIndex($this->_table_name, 'alt_name', true, 'id');
        $this->assertNotNull($result);
    }
    
    public function testCreateIndex_altnameUnique()
    {
        $result = $this->_adapter->createIndex($this->_table_name, 'alt_name', true, 'id');
        $this->assertNotNull($result);
    }
    
    /**
     * 
     * Test -- Creates a sequence in the database.
     * 
     */
    public function testCreateSequence()
    {
        $result = $this->_adapter->createSequence($this->_seq_name);
        $this->diag($result, get_class($this));
        $result = $this->_adapter->nextSequence($this->_seq_name);
        $this->diag($result, get_class($this));
        $this->assertEquals($result, '1');
    }
    
    /**
     * 
     * Test -- Creates a portable table.
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
        // add some test data
        $this->_insertData();
        
        // attempt the delete
        $where = $this->_adapter->quoteInto('id = ?', 5);
        $result = $this->_adapter->delete($this->_table_name, $where);
        $this->assertEquals($result, 1);
        
        $expect = array(
            array('id' => '1', 'name' => 'Foo'),
            array('id' => '2', 'name' => 'Bar'),
            array('id' => '3', 'name' => 'Baz'),
            array('id' => '4', 'name' => 'Dib'),
            array('id' => '6', 'name' => 'Gir'),
        );
        
        // did it work?
        $actual = $this->_adapter->fetchAll("SELECT * FROM $this->_table_name ORDER BY id");
        $this->assertEquals($actual, $expect);
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
        $this->_insertData();
        $this->_adapter->dropColumn($this->_table_name, 'name');
        $actual = $this->_adapter->fetchOne("SELECT * FROM $this->_table_name WHERE id = 1");
        $expect = array('id' => '1');
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Drops an index from a table in the database.
     * 
     */
    public function testDropIndex()
    {
        $result = $this->_adapter->createIndex($this->_table_name, 'id');
        $this->assertTrue($result instanceof PDOStatement);
        
        $result = $this->_adapter->dropIndex($this->_table_name, 'id');
        $this->assertTrue($result instanceof PDOStatement);
    }
    
    /**
     * 
     * Test -- Drops a sequence from the database.
     * 
     */
    public function testDropSequence()
    {
        // create the sequence so next value is 9
        $this->_adapter->createSequence($this->_seq_name, 9);
        $result = $this->_adapter->nextSequence($this->_seq_name);
        $this->assertEquals($result, '9');
        
        // drop and recreate starting at 0, should get 1
        $this->_adapter->dropSequence($this->_seq_name);
        $result = $this->_adapter->nextSequence($this->_seq_name);
        $this->assertEquals($result, '1');
    }
    
    /**
     * 
     * Test -- Drops a table from the database, if it exists.
     * 
     */
    public function testDropTable()
    {
        $this->_adapter->dropTable($this->_table_name);
        $list = $this->_adapter->fetchTableList();
        $actual = in_array($this->_table_name, $list);
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Fetches all rows from the database using sequential keys.
     * 
     */
    public function testFetchAll()
    {
        $this->_insertData();
        $actual = $this->_adapter->fetchAll("SELECT * FROM $this->_table_name ORDER BY id");
        $expect = array(
            array('id' => '1', 'name' => 'Foo'),
            array('id' => '2', 'name' => 'Bar'),
            array('id' => '3', 'name' => 'Baz'),
            array('id' => '4', 'name' => 'Dib'),
            array('id' => '5', 'name' => 'Zim'),
            array('id' => '6', 'name' => 'Gir'),
        );
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches all rows from the database using associative keys (defined by the first column).
     * 
     */
    public function testFetchAssoc()
    {
        $this->_insertData();
        $actual = $this->_adapter->fetchAssoc("SELECT name, id FROM $this->_table_name ORDER BY id");
        $expect = array(
            'Foo' => array('id' => '1', 'name' => 'Foo'),
            'Bar' => array('id' => '2', 'name' => 'Bar'),
            'Baz' => array('id' => '3', 'name' => 'Baz'),
            'Dib' => array('id' => '4', 'name' => 'Dib'),
            'Zim' => array('id' => '5', 'name' => 'Zim'),
            'Gir' => array('id' => '6', 'name' => 'Gir'),
        );
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches the first column of all rows as a sequential array.
     * 
     */
    public function testFetchCol()
    {
        $this->_insertData();
        $actual = $this->_adapter->fetchCol("SELECT name, id FROM $this->_table_name ORDER BY id");
        $expect = array(
            'Foo',
            'Bar',
            'Baz',
            'Dib',
            'Zim',
            'Gir',
        );
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches one row from the database.
     * 
     */
    public function testFetchOne()
    {
        $this->_insertData();
        $cmd = "SELECT id, name FROM $this->_table_name WHERE id = :id";
        $data = array('id' => 5);
        $actual = $this->_adapter->fetchOne($cmd, $data);
        $expect = array('id' => '5', 'name' => 'Zim');
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches an associative array of all rows as key-value pairs (first  column is the key, second column is the value).
     * 
     */
    public function testFetchPairs()
    {
        $this->_insertData();
        $actual = $this->_adapter->fetchPairs("SELECT name, id FROM $this->_table_name ORDER BY id");
        $expect = array(
            'Foo' => '1',
            'Bar' => '2',
            'Baz' => '3',
            'Dib' => '4',
            'Zim' => '5',
            'Gir' => '6',
        );
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches a PDOStatement result object.
     * 
     */
    public function testFetchPdo()
    {
        $this->_insertData();
        $actual = $this->_adapter->fetchPdo("SELECT name, id FROM $this->_table_name ORDER BY id");
        $expect = 'PDOStatement';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Builds the SQL statement and returns it as a string instead of  executing it.
     * 
     */
    public function testFetchSql()
    {
        $expect = "SELECT name, id FROM $this->_table_name WHERE id = :id";
        $actual = $this->_adapter->fetchSql($expect);
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Returns an array describing table columns from the cache; if the cache entry is not available, queries the database for the column descriptions.
     * 
     */
    public function testFetchTableCols()
    {
        $this->_fetchTableCols();
    }
    
    public function testFetchTableCols_cached()
    {
        $table = 'test_solar_sql_describe';
        
        // clear out previous tables
        try {
            $this->_adapter->dropTable($table);
        } catch (Exception $e) {
            // assume the table didn't exist
        }
        
        // create the "describe table" table and make sure it's there
        $this->_adapter->query($this->_describe_table_sql);
        $this->assertTrue(in_array(
            $this->_table_name,
            $this->_adapter->fetchTableList()
        ));
        
        // get the table column descriptions
        $this->_adapter->setProfiling(true);
        $cols = $this->_adapter->fetchTableCols($table);
        $this->assertFalse(empty($cols));
        
        $count_before = count($this->_adapter->getProfile());
        
        $cols = $this->_adapter->fetchTableCols($table);
        $this->assertFalse(empty($cols));
        
        $count_after = count($this->_adapter->getProfile());
        
        $this->assertEquals($count_after, $count_before);
    }
    
    protected function _fetchTableCols($colname = null)
    {
        $table = 'test_solar_sql_describe';
        
        // clear out previous tables
        try {
            $this->_adapter->dropTable($table);
        } catch (Exception $e) {
            // assume the table didn't exist
        }
        
        // create the "describe table" table and make sure it's there
        $this->_adapter->query($this->_describe_table_sql);
        $this->assertTrue(in_array(
            $this->_table_name,
            $this->_adapter->fetchTableList()
        ));
        
        // get the table column descriptions
        $cols = $this->_adapter->fetchTableCols($table);
        
        // return one, or all?
        if ($colname) {
            return $cols[$colname];
        } else {
            return $cols;
        }
    }
    
    public function testFetchTableCols_autoinc_primary()
    {
        $actual = $this->_fetchTableCols('test_autoinc_primary');
        $this->assertEquals($actual['name'], 'test_autoinc_primary');
        $this->assertTrue($actual['autoinc']);
        $this->assertTrue($actual['primary']);
    }
    
    public function testFetchTableCols_require()
    {
        // require, not primary or autoinc
        $actual = $this->_fetchTableCols('test_require');
        $this->assertEquals($actual['name'], 'test_require');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertTrue($actual['require']);
    }
    
    public function testFetchTableCols_bool()
    {
        // bool
        $actual = $this->_fetchTableCols('test_bool');
        $this->assertEquals($actual['name'], 'test_bool');
        $this->assertEquals($actual['type'], 'bool');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_char()
    {
        // char (also, not require)
        $actual = $this->_fetchTableCols('test_char');
        $this->assertEquals($actual['name'], 'test_char');
        $this->assertEquals($actual['type'], 'char');
        $this->assertEquals($actual['size'], 3);
        $this->assertFalse($actual['require']);
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_varchar()
    {
        // varchar
        $actual = $this->_fetchTableCols('test_varchar');
        $this->assertSame($actual['name'], 'test_varchar');
        $this->assertEquals($actual['type'], 'varchar');
        $this->assertEquals($actual['size'], 7);
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_smallint()
    {
        // smallint
        $actual = $this->_fetchTableCols('test_smallint');
        $this->assertEquals($actual['name'], 'test_smallint');
        $this->assertEquals($actual['type'], 'smallint');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_int()
    {
        // int
        $actual = $this->_fetchTableCols('test_int');
        $this->assertEquals($actual['name'], 'test_int');
        $this->assertEquals($actual['type'], 'int');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_bigint()
    {
        // bigint
        $actual = $this->_fetchTableCols('test_bigint');
        $this->assertEquals($actual['name'], 'test_bigint');
        $this->assertEquals($actual['type'], 'bigint');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_numeric_size()
    {
        // numeric, size only
        $actual = $this->_fetchTableCols('test_numeric_size');
        $this->assertEquals($actual['name'], 'test_numeric_size');
        $this->assertEquals($actual['type'], 'numeric');
        $this->assertEquals($actual['size'], 7);
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_numeric_scope()
    {
        // numeric, size and scope
        $actual = $this->_fetchTableCols('test_numeric_scope');
        $this->assertEquals($actual['name'], 'test_numeric_scope');
        $this->assertEquals($actual['type'], 'numeric');
        $this->assertEquals($actual['size'], 7);
        $this->assertEquals($actual['scope'], 3);
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_float()
    {
        // float
        $actual = $this->_fetchTableCols('test_float');
        $this->assertEquals($actual['name'], 'test_float');
        $this->assertEquals($actual['type'], 'float');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_clob()
    {
        // clob
        $actual = $this->_fetchTableCols('test_clob');
        $this->assertEquals($actual['name'], 'test_clob');
        $this->assertEquals($actual['type'], 'clob');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_date()
    {
        // date
        $actual = $this->_fetchTableCols('test_date');
        $this->assertEquals($actual['name'], 'test_date');
        $this->assertEquals($actual['type'], 'date');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_time()
    {
        // time
        $actual = $this->_fetchTableCols('test_time');
        $this->assertEquals($actual['name'], 'test_time');
        $this->assertEquals($actual['type'], 'time');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_timestamp()
    {
        // timestamp
        $actual = $this->_fetchTableCols('test_timestamp');
        $this->assertEquals($actual['name'], 'test_timestamp');
        $this->assertEquals($actual['type'], 'timestamp');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_default_null()
    {
        // default, sql null
        $actual = $this->_fetchTableCols('test_default_null');
        $this->assertEquals($actual['name'], 'test_default_null');
        $this->assertNull($actual['default']);
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_default_string()
    {
        // default, sql literal string
        $actual = $this->_fetchTableCols('test_default_string');
        $this->assertEquals($actual['name'], 'test_default_string');
        $this->assertEquals($actual['default'], 'literal');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_default_integer()
    {
        // default, sql literal integer
        $actual = $this->_fetchTableCols('test_default_integer');
        $this->assertEquals($actual['name'], 'test_default_integer');
        $this->assertEquals($actual['default'], '7');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_default_numeric()
    {
        // default, sql literal numeric
        $actual = $this->_fetchTableCols('test_default_numeric');
        $this->assertEquals($actual['name'], 'test_default_numeric');
        $this->assertEquals($actual['default'], '1234.567');
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    public function testFetchTableCols_default_ignore()
    {
        // default, sql keyword or function (and thus ignored)
        $actual = $this->_fetchTableCols('test_default_ignore');
        $this->assertEquals($actual['name'], 'test_default_ignore');
        $this->assertNull($actual['default']);
        $this->assertFalse($actual['autoinc']);
        $this->assertFalse($actual['primary']);
        $this->assertFalse($actual['require']);
    }
    
    /**
     * 
     * Test -- Returns a list of database tables from the cache; if the cache entry is not available, queries the database for the list of tables.
     * 
     */
    public function testFetchTableList()
    {
        $list = $this->_adapter->fetchTableList();
        $actual = in_array($this->_table_name, $list);
        $this->assertTrue($actual);
    }
    
    public function testFetchTableList_cached()
    {
        $this->_adapter->setProfiling(true);
        $list = $this->_adapter->fetchTableList();
        $actual = in_array($this->_table_name, $list);
        $this->assertTrue($actual);
        
        $count_before = count($this->_adapter->getProfile());
        
        $list = $this->_adapter->fetchTableList();
        $actual = in_array($this->_table_name, $list);
        $this->assertTrue($actual);
        
        $count_after = count($this->_adapter->getProfile());
        
        $this->assertEquals($count_after, $count_before);
    }
    
    /**
     * 
     * Test -- Fetches the very first value (i.e., first column of the first row).
     * 
     */
    public function testFetchValue()
    {
        $this->_insertData();
        $actual = $this->_adapter->fetchValue("SELECT COUNT(*) FROM $this->_table_name");
        $expect = '6';
        $this->assertEquals($actual, $expect);
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
        $data = array('id' => '1', 'name' => 'Zim');
        
        $result = $this->_adapter->insert($this->_table_name, $data);
        $this->assertEquals($result, 1);
        
        $result = $this->_adapter->fetchOne("SELECT * FROM $this->_table_name WHERE id = 1");
        $this->assertEquals($result, $data);
    }
    
    /**
     * 
     * Test -- Get the last auto-incremented insert ID from the database.
     * 
     */
    public function testLastInsertId()
    {
        $data = array('name' => 'Zim');
        
        $result = $this->_adapter->insert($this->_table_name, $data);
        $this->assertEquals($result, 1);
        
        $actual = $this->_adapter->lastInsertId($this->_table_name, 'id');
        $expect = 1;
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Gets the next number in a sequence; creates the sequence if it does not exist.
     * 
     */
    public function testNextSequence()
    {
        $result = $this->_adapter->nextSequence($this->_seq_name);
        $this->assertEquals($result, '1');
    }
    
    /**
     * 
     * Test -- Prepares and executes an SQL statement, optionally binding values to named parameters in the statement.
     * 
     */
    public function testQuery()
    {
        $this->_insertData();
        $result = $this->_adapter->query("SELECT COUNT(*) FROM $this->_table_name");
        $this->assertInstance($result, 'PDOStatement');
    }
    
    public function testQuery_bind()
    {
        $this->_insertData();
        $data = array('id' => 1);
        $stmt = "SELECT * FROM $this->_table_name WHERE id = :id";
        $result = $this->_adapter->query($stmt, $data);
        $this->assertInstance($result, 'PDOStatement');
    }
    
    public function testQuery_exec()
    {
        $result = $this->_adapter->query("DROP TABLE $this->_table_name");
        $this->assertInstance($result, 'PDOStatement');
    }
    
    /**
     * 
     * Test -- Safely quotes a value for an SQL statement.
     * 
     */
    public function testQuote()
    {
        $actual = $this->_adapter->quote('"foo" bar \'baz\'');
        $this->assertEquals($actual, $this->_quote_expect);
    }
    
    public function testQuote_array()
    {
        $actual = $this->_adapter->quote(array('"foo"', 'bar', "'baz'"));
        $this->assertEquals($actual, $this->_quote_array_expect);
    }
    
    /**
     * 
     * Test -- Quotes a value and places into a piece of text at a placeholder.
     * 
     */
    public function testQuoteInto()
    {
        $actual = $this->_adapter->quoteInto("foo = ?", "'bar'");
        $this->assertEquals($actual, $this->_quote_into_expect);
    }
    
    /**
     * 
     * Test -- Quote multiple text-and-value pieces.
     * 
     */
    public function testQuoteMulti()
    {
        $where = array(
            'id = 1',
            'foo = ?' => 'bar',
            'zim IN(?)' => array('dib', 'gir', 'baz'),
        );
        $actual = $this->_adapter->quoteMulti($where, ' AND ');
        $this->assertEquals($actual, $this->_quote_multi_expect);
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
        $data = array('id' => 1, 'name' => 'Zim');
        $this->_adapter->begin();
        $this->_adapter->insert($this->_table_name, $data);
        $this->_adapter->rollback();
        $result = $this->_adapter->fetchValue("SELECT COUNT(*) FROM $this->_table_name");
        $this->assertEquals($result, '0');
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
        $insert = array('id' => '1', 'name' => 'Foo');
        $result = $this->_adapter->insert($this->_table_name, $insert);
        $this->assertEquals($result, 1);
        
        $update = array('name' => 'Bar');
        $where = $this->_adapter->quoteInto("id = ?", 1);
        $result = $this->_adapter->update($this->_table_name, $update, $where);
        $this->assertEquals($result, 1);
        
        $expect = array('id' => '1', 'name' => 'Bar');
        $actual = $this->_adapter->fetchOne("SELECT * FROM $this->_table_name WHERE id = 1");
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Returns an array describing table indexes from the cache; if the cache entry is not available, queries the database for the index information.
     * 
     */
    public function testFetchIndexInfo()
    {
        $this->todo('stub');
    }
}
