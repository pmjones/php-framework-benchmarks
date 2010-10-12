<?php
/**
 * 
 * Abstract class test.
 * 
 */
class Test_Solar_Sql_Model extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model = array(
    );
    
    protected $_sql_config = array(
        'adapter' => 'Solar_Sql_Adapter_Sqlite',
    );
    
    protected $_sql = null;
    
    protected $_catalog_config = array(
        'classes' => array(
            'Mock_Solar_Model',
        ),
    );
    
    protected $_catalog = null;
    
    
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
        
        // set up an SQL connection
        $this->_sql = Solar::factory(
            'Solar_Sql',
            $this->_sql_config
        );
        
        // set up a model catalog
        $this->_catalog = Solar::factory(
            'Solar_Sql_Model_Catalog',
            $this->_catalog_config
        );
        
        // register the connection and catalog
        Solar_Registry::set('sql', $this->_sql);
        Solar_Registry::set('model_catalog', $this->_catalog);
    }
    
    /**
     * 
     * Populate the table for special columns.
     * 
     */
    protected function _populateSpecialColsTable()
    {
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        for ($i = 1; $i <= 10; $i++) {
            $record = $model->fetchNew();
            $record->name = chr($i+96); //ascii 'a', 'b', etc
            $record->save();
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
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $this->assertInstance($model, 'Solar_Sql_Model');
        $this->assertInstance($model, 'Mock_Solar_Model_TestSolarSpecialCols');
        
        // did it create the table automatically?
        $list = $this->_sql->fetchTableList();
        $this->assertTrue(in_array('test_solar_special_cols', $list));
    }
    
    public function test__construct_repeated()
    {
        $model_a = $this->_catalog->newModel('TestSolarSpecialCols');
        $this->assertInstance($model_a, 'Solar_Sql_Model');
        $this->assertInstance($model_a, 'Mock_Solar_Model_TestSolarSpecialCols');
        
        $count_before = count($this->_sql->getProfile());
        
        $model_b = $this->_catalog->newModel('TestSolarSpecialCols');
        $this->assertInstance($model_b, 'Solar_Sql_Model');
        $this->assertInstance($model_b, 'Mock_Solar_Model_TestSolarSpecialCols');
        $this->assertNotSame($model_a, $model_b);
        
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    /**
     * 
     * Test -- Magic call implements "fetchOneBy...()" and "fetchAllBy...()" for columns listed in the method name.
     * 
     */
    public function test__call()
    {
        /**
         * populate the table, along with some extra records so we have more
         * to work with
         */
        $this->_populateSpecialColsTable();
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        for ($i = 0; $i < 5; $i++) {
            // id's are 11-15, all named 'z' with seq_foo of 88
            $data = array(
                'name'    => 'z', 
                'seq_foo' => 88,
            );
            $model->insert($data);
        }
        
        // add some extras so we can see if fetchAll() grabs more than it should
        for ($i = 0; $i < 5; $i++) {
            // id's are 16-20, all named 'z' with seq_foo of 88
            $data = array(
                'name'    => 'z', 
                'seq_foo' => 99,
            );
            $model->insert($data);
        }
        
        /**
         * fetchBy*() single-col
         */
        
        // make sure the method "fetchByName" does not actually exist
        $exists = method_exists($model, 'fetchByName');
        $this->assertFalse($exists);
        
        // call the magic method
        $record = $model->fetchByName('z');
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarSpecialCols_Record');
        $this->assertEquals($record->id, 11);
        $this->assertEquals($record->name, 'z');
        
        /**
         * fetchBy*() multi-col
         */
        
        // make sure the method "fetchByNameAndSeqFoo" does not actually exist
        $exists = method_exists($model, 'fetchByNameAndSeqFoo');
        $this->assertFalse($exists);
        
        // call the magic method
        $record = $model->fetchByNameAndSeqFoo('z', 88);
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarSpecialCols_Record');
        $this->assertEquals($record->id, 11);
        $this->assertEquals($record->name, 'z');
        $this->assertEquals($record->seq_foo, '88');
        
        /**
         * fetchOneBy*() single-col
         */
        
        // make sure the method "fetchOneByName" does not actually exist
        $exists = method_exists($model, 'fetchOneByName');
        $this->assertFalse($exists);
        
        // call the magic method
        $record = $model->fetchOneByName('z');
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarSpecialCols_Record');
        $this->assertEquals($record->id, 11);
        $this->assertEquals($record->name, 'z');
        
        /**
         * fetchOneBy*() multi-col
         */
        
        // make sure the method "fetchOneByNameAndSeqFoo" does not actually exist
        $exists = method_exists($model, 'fetchOneByNameAndSeqFoo');
        $this->assertFalse($exists);
        
        // call the magic method
        $record = $model->fetchOneByNameAndSeqFoo('z', 88);
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarSpecialCols_Record');
        $this->assertEquals($record->id, 11);
        $this->assertEquals($record->name, 'z');
        $this->assertEquals($record->seq_foo, '88');
        
        /**
         * fetchAllBy*() single-col
         */
        
        // make sure the method "fetchAllByName" does not actually exist
        $exists = method_exists($model, 'fetchAllByName');
        $this->assertFalse($exists);
        
        // call the magic method
        $collection = $model->fetchAllByName('z');
        $this->assertInstance($collection, 'Solar_Sql_Model_Collection');
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarSpecialCols_Collection');
        $this->assertEquals(count($collection), 10);
        foreach ($collection as $key => $record) {
            $this->assertEquals($record->id, $key + 11);
            $this->assertEquals($record->name, 'z');
        }
        
        /**
         * fetchAllBy*() multi-col
         */
        
        // make sure the method "fetchAllByNameAndSeqFoo" does not actually exist
        $exists = method_exists($model, 'fetchAllByNameAndSeqFoo');
        $this->assertFalse($exists);
        
        // call the magic method
        $collection = $model->fetchAllByNameAndSeqFoo('z', 88);
        $this->assertInstance($collection, 'Solar_Sql_Model_Collection');
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarSpecialCols_Collection');
        $this->assertEquals(count($collection), 5);
        foreach ($collection as $key => $record) {
            $this->assertEquals($record->id, $key + 11);
            $this->assertEquals($record->name, 'z');
            $this->assertEquals($record->seq_foo, 88);
        }
    }
    
    /**
     * 
     * Test -- Read-only access to protected model properties.
     * 
     */
    public function test__get()
    {
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        
        // reads from protected $_primary_col; should be no exception
        $actual = $model->primary_col;
        $expect = 'id';
        $this->assertSame($actual, $expect);
        
        // try for a property that doesn't exist
        try {
            $actual = $model->no_such_property;
            $this->fail('should have thrown an exception here');
        } catch (Solar_Exception $e) {
            // do nothing, this is the expected case :-)
        }
    }
    
    /**
     * 
     * Test -- Fetches count and pages of available records.
     * 
     */
    public function testCountPages()
    {
        $this->_populateSpecialColsTable();
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $model->setPaging(3);
        $actual = $model->countPages();
        $expect = array('count' => 10, 'pages' => 4);
        $this->assertEquals($actual, $expect);
        
        // now count on a WHERE clause
        $where = array(
            'id > 5'
        );
        $actual = $model->countPages(array('where' => $where));
        $expect = array('count' => 5, 'pages' => 2);
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Deletes rows from the model table and deletes cache entries.
     * 
     */
    public function testDelete()
    {
        $this->_populateSpecialColsTable();
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        
        $id = 7;
        
        $record = $model->fetch($id);
        $this->assertEquals($record->id, $id);
        
        $model->delete(array('id = ?' => $id));
        
        // the record should not allow modification now
        try {
            $record->name = 'foo';
            $this->fail('should not have been able to modify deleted record');
        } catch (Solar_Exception $e) {
            // this is the expected case
        }
        
        // should not be able to retrieve the record
        $record = $model->fetch($id);
        $this->assertNull($record);
    }
    
    /**
     * 
     * Test -- Fetches a record or collection by primary key value(s).
     * 
     */
    public function testFetch()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by number to get a Record
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $record = $model->fetch(3);
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarSpecialCols_Record');
        $this->assertEquals($record->name, 'c'); // make sure it's the right one ;-)
        
        // fetch by array to get a Collection
        $list = array(2, 3, 5, 7);
        $collection = $model->fetch($list);
        $this->assertInstance($collection, 'Solar_Sql_Model_Collection');
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarSpecialCols_Collection');
        $this->assertEquals(count($collection), 4);
        foreach ($collection as $record) {
            // make sure they're the right ones ;-)
            $this->assertEquals($record->name, chr($record->id + 96));
        }
    }
    
    /**
     * 
     * Test -- Fetches a collection of all records by arbitrary parameters.
     * 
     */
    public function testFetchAll()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $collection = $model->fetchAll(array('where' => 'id > 5'));
        
        // tests
        $this->assertInstance($collection, 'Solar_Sql_Model_Collection');
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarSpecialCols_Collection');
        $this->assertEquals(count($collection), 5);
        foreach ($collection as $record) {
            // make sure they're the right ones ;-)
            $this->assertEquals($record->name, chr($record->id + 96));
        }
    }
    
    /**
     * 
     * Test -- Fetches an array of rows by arbitrary parameters.
     * 
     */
    public function testFetchAllAsArray()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $array = $model->fetchAllAsArray(array('where' => 'id > 5'));
        
        // generic
        $this->assertTrue(is_array($array));
        $this->assertEquals(count($array), 5);
        
        // specific
        foreach ($array as $key => $val) {
            // make sure they're the right ones ;-)
            $this->assertEquals($val['name'], chr($val['id'] + 96));
        }
    }
    
    /**
     * 
     * Test -- The same as fetchAll(), except the record collection is keyed on the first column of the results (instead of being a strictly sequential array.)  Recognized parameters for the fetch are:  `eager` : (string|array) Eager-fetch records from these related models.
     * 
     */
    public function testFetchAssoc()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $collection = $model->fetchAssoc(array(
            'where' => 'id > 5',
            'order' => 'name',
            'cols' => array(
                'name', 'id', 'seq_foo'
            ),
        ));
        
        // generic
        $this->assertInstance($collection, 'Solar_Sql_Model_Collection');
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarSpecialCols_Collection');
        $this->assertEquals(count($collection), 5);
        
        // specific: array keys should be on 'name', not 'id'
        $array = $collection->toArray();
        $actual = array_keys($array);
        $expect = array('f', 'g', 'h', 'i', 'j');
        $this->assertSame($actual, $expect);
    }
    
    public function testFetchAssocAsArray()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $array = $model->fetchAssocAsArray(array(
            'where' => 'id > 5',
            'order' => 'name',
            'cols' => array(
                'name', 'id', 'seq_foo'
            ),
        ));
        
        // generic
        $this->assertTrue(is_array($array));
        $this->assertEquals(count($array), 5);
        
        // specific: array keys should be on 'name', not 'id'
        $actual = array_keys($array);
        $expect = array('f', 'g', 'h', 'i', 'j');
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches a sequential array of values from the model, using only the first column of the results.
     * 
     */
    public function testFetchCol()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $actual = $model->fetchCol(array(
            'where' => 'id > 5',
            'order' => 'name',
            'cols' => array(
                'name',
            ),
        ));
        
        $expect = array('f', 'g', 'h', 'i', 'j');
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Returns a new record with default values.
     * 
     */
    public function testFetchNew()
    {
        $model = $this->_catalog->getModel('TestSolarSqlDescribe');
        $record = $model->fetchNew();
        
        // these are the default values on the test_solar_sql_describe table
        $this->assertNull($record->test_default_null);
        $this->assertEquals($record->test_default_string, 'literal');
        $this->assertEquals($record->test_default_integer, 7);
        $this->assertEquals($record->test_default_numeric, 1234.567);
        $this->assertNull($record->test_default_ignore);
    }
    
    /**
     * 
     * Test -- Fetches one record by arbitrary parameters.
     * 
     */
    public function testFetchOne()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by number to get a Record
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $record = $model->fetchOne(array(
            'where' => array('name = ?' => 'c'),
        ));
        
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarSpecialCols_Record');
        $this->assertEquals($record->name, 'c'); // make sure it's the right one ;-)
    }
    
    /**
     * 
     * Test -- The same as fetchOne(), but returns an array instead of a record object.
     * 
     */
    public function testFetchOneAsArray()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by number to get a Record
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $array = $model->fetchOneAsArray(array(
            'where' => array('name = ?' => 'c'),
        ));
        
        $this->assertTrue(is_array($array));
        $this->assertEquals($array['name'], 'c'); // make sure it's the right one ;-)
    }
    
    /**
     * 
     * Test -- Fetches an array of key-value pairs from the model, where the first column is the key and the second column is the value.
     * 
     */
    public function testFetchPairs()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $actual = $model->fetchPairs(array(
            'where' => 'id > 5',
            'order' => 'name',
            'cols' => array(
                'name', 'id',
            ),
        ));
        
        // should get back key-value pairs
        $expect = array(
            'f' => '6',
            'g' => '7',
            'h' => '8',
            'i' => '9',
            'j' => '10',
        );
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches a single value from the model (i.e., the first column of the  first record of the returned page set).
     * 
     */
    public function testFetchValue()
    {
        // insert a set of records
        $this->_populateSpecialColsTable();
        
        // fetch by some WHERE clause
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $actual = $model->fetchValue(array(
            'where' => 'id = 5',
            'order' => 'name',
            'cols' => array(
                'name',
            ),
        ));
        
        $expect = 'e';
        $this->assertSame($actual, $expect);
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
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        
        $expect = 50;
        $model->setPaging($expect);
        
        $actual = $model->getPaging();
        $this->assertEquals($actual, $expect);
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
        $model = $this->_catalog->getModel('TestSolarFoo');
        $record = $model->fetchNew();
        
        $data = array(
            'email' => 'nobody@example.com',
            'uri'   => 'http://example.com',
            'name'  => 'Nobody Example',
        );
        
        // insert and make sure we got the ID back
        $id = $model->insert($data);
        $this->assertEquals($id, 1);
        
        // now fetch and make sure the insert "took"
        $record = $model->fetch($id);
        $this->assertEquals($record->email, $data['email']);
        $this->assertEquals($record->uri,   $data['uri']);
        $this->assertEquals($record->name,  $data['name']);
    }
    
    /**
     * 
     * Test -- Filters and inserts a Record into the table, handling exceptions
     * from the database.
     * 
     */
    public function testInsert_invalidAtDatabase()
    {
        $model = $this->_catalog->getModel('TestSolarFoo');
        
        // insert should succeed
        $data = array('email' => 'nobody@example.com');
        $model->insert($data);
        
        // insert should fail **at database** because of unique index on the
        // email column.
        try {
            // insert the same thing, again
            $model->insert($data);
            $this->fail('should have thrown ERR_QUERY_FAILED');
        } catch (Exception $e) {
            $this->assertInstance($e, 'Solar_Sql_Adapter_Exception_QueryFailed');
        }
    }
    
    /**
     * 
     * Test -- Returns the appropriate collection object for this model.
     * 
     */
    public function testNewCollection()
    {
        $data = array();
        
        $model = $this->_catalog->getModel('TestSolarFoo');
        $collection = $model->newCollection($data);
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarFoo_Collection');
        
        // the Foo_Bar model doesn't have its own collection, should fall back to foo
        $model = $this->_catalog->getModel('TestSolarBar');
        $collection = $model->newCollection($data);
        $this->assertInstance($collection, 'Mock_Solar_Model_TestSolarFoo_Collection');
        
        // the Dib mode has no collection and is not inherited, should fall back to Solar_Sql
        $model = $this->_catalog->getModel('TestSolarDib');
        $collection = $model->newCollection($data);
        $this->assertInstance($collection, 'Solar_Sql_Model_Collection');
    }
    
    /**
     * 
     * Test -- Returns the appropriate record object for an inheritance model.
     * 
     */
    public function testNewRecord()
    {
        $data = array(
          'id'      => '88',
          'created' => date('Y-m-d H:i:s'),
          'updated' => date('Y-m-d H:i:s'),
          'inherit' => null,
          'name'    => null,
          'email'   => null,
          'uri'     => null,
        );
        
        // non-inherited
        $model = $this->_catalog->getModel('TestSolarFoo');
        $record = $model->newRecord($data);
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarFoo_Record');
    }
    
    public function testNewRecord_inherit()
    {
        $data = array(
          'id'      => '88',
          'created' => date('Y-m-d H:i:s'),
          'updated' => date('Y-m-d H:i:s'),
          'inherit' => 'TestSolarBar',
          'name'    => null,
          'email'   => null,
          'uri'     => null,
        );
        
        $model = $this->_catalog->getModel('TestSolarFoo');
        $record = $model->newRecord($data);
        $this->assertInstance($record, 'Mock_Solar_Model_TestSolarBar_Record');
    }
    
    public function testNewRecord_inheritNoSuchClass()
    {
        $data = array(
          'id'      => '88',
          'created' => date('Y-m-d H:i:s'),
          'updated' => date('Y-m-d H:i:s'),
          'inherit' => 'NoSuchClass',
          'name'    => null,
          'email'   => null,
          'uri'     => null,
        );
        
        $model = $this->_catalog->getModel('TestSolarFoo');
        try {
            $record = $model->newRecord($data);
            $this->fail('Should have thrown exception when inherit not available');
        } catch (Exception $e) {
            $this->assertInstance($e, 'Solar_Class_Stack_Exception_ClassNotFound');
        }
    }
        
    public function testNewRecord_defaultClass()
    {
        $data = array(
          'id'      => '88',
          'created' => date('Y-m-d H:i:s'),
          'updated' => date('Y-m-d H:i:s'),
          'name'    => null,
          'email'   => null,
          'uri'     => null,
        );
        
        // the Dib model has no record of its own, should use Solar_Sql_Model_Record
        $model = $this->_catalog->getModel('TestSolarDib');
        $record = $model->newRecord($data);
        $this->assertInstance($record, 'Solar_Sql_Model_Record');
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
        $this->_populateSpecialColsTable();
        
        // set it
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        $expect = 3;
        $model->setPaging($expect);
        
        // make sure it's recognized
        $actual = $model->getPaging();
        $this->assertEquals($actual, $expect);
        
        /**
         * make sure the setting is honored
         */
         
        // get the first page of 3 records
        $collection = $model->fetchAll(array('order' => 'id', 'page' => 1));
        $this->assertEquals(count($collection), 3);
        
        // make sure they're the right ones: 1, 2, 3
        foreach ($collection as $key => $record) {
            $this->assertEquals($record->id, $key + 1);
        }
        
        // get the third page of 3 records; this should also be 3 records
        $collection = $model->fetchAll(array('order' => 'id', 'page' => 3));
        $this->assertEquals(count($collection), 3);
        
        // make sure they're the right ones: 7, 8, 9
        foreach ($collection as $key => $record) {
            $this->assertEquals($record->id, $key + 7);
        }
        
        // get the 4th page of 3 records: this should be 1 record, #10
        $collection = $model->fetchAll(array('order' => 'id', 'page' => 4));
        $this->assertEquals(count($collection), 1);
        $this->assertEquals($collection[0]->id, 10);
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
        $model = $this->_catalog->getModel('TestSolarFoo');
        
        $email = 'nobody@example.com';
        $uri   = 'http://example.com';
        $name  = 'Nobody Example';
        
        $data = array(
            'email' => $email,
            'uri'   => $uri,
            'name'  => $name,
        );
        
        // insert and make sure we got the ID back
        $id = $model->insert($data);
        $this->assertEquals($id, 1);
        
        /**
         * fetch and update the record
         */
         
        // fetch and make sure the insert "took"
        $record = $model->fetch($id);
        $this->assertEquals($record->email, $email);
        $this->assertEquals($record->uri, $uri);
        $this->assertEquals($record->name, $name);
        
        // change something and update
        $name = 'Another Example';
        $data = $record->toArray();
        $data['name'] = $name;
        $model->update($data, array("id = ?" => $id));
        
        // did the update "take"?
        $record = $model->fetch($id);
        $this->assertEquals($record->email, $email);
        $this->assertEquals($record->uri, $uri);
        $this->assertEquals($record->name, $name);
    }
    
    /**
     * 
     * Test -- Filters and inserts a Record into the table, handling exceptions
     * from the database.
     * 
     */
    public function testUpdate_invalidAtDatabase()
    {
        $model = $this->_catalog->getModel('TestSolarFoo');
        
        // insert should succeed
        $data = array('email' => 'nobody@example.com');
        $first_id = $model->insert($data);
        
        // insert another record to work with
        $data = array('email' => 'another@example.com');
        $second_id = $model->insert($data);
        $this->assertNotEquals($second_id, $first_id);
        $this->assertTrue($second_id > 0);
        
        // now modify the more-recent record, and fail the uniqueness index
        // at the database.
        $data = array('email' => 'nobody@example.com');
        try {
            $model->sql->setProfiling(true);
            $count = $model->update($data, array("id = ?" => $second_id));
            $this->fail('should have thrown ERR_QUERY_FAILED');
        } catch (Exception $e) {
            $this->assertInstance($e, 'Solar_Sql_Adapter_Exception_QueryFailed');
        }
    }
    
    /**
     * 
     * Test -- Returns the number of rows affected by the last INSERT, UPDATE, or DELETE.
     * 
     */
    public function testGetAffectedRows()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the fully-qualified primary key name.
     * 
     */
    public function testGetPrimary()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a WHERE clause array of conditions to use when fetching from this model; e.g., single-table inheritance.
     * 
     */
    public function testGetWhereMods()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Does this model have single-table inheritance values?
     * 
     */
    public function testIsInherit()
    {
        $this->todo('stub');
    }
}
