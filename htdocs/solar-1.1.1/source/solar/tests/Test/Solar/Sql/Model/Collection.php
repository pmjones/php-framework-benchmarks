<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Collection extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Collection = array(
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
    
    protected $_fixture = null;
    
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
        $this->_sql->setProfiling(true);
        
        // set up a model catalog
        $this->_catalog = Solar::factory(
            'Solar_Sql_Model_Catalog',
            $this->_catalog_config
        );
        
        // register the connection and catalog
        Solar_Registry::set('sql', $this->_sql);
        Solar_Registry::set('model_catalog', $this->_catalog);
        
        // fixture to populate tables
        $this->_fixture = Solar::factory('Fixture_Solar_Sql_Model');
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
        $obj = Solar::factory('Solar_Sql_Model_Collection');
        $this->assertInstance($obj, 'Solar_Sql_Model_Collection');
    }
    
    /**
     * 
     * Test -- Returns a record from the collection based on its key value.
     * 
     */
    public function test__get()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAssoc($params);
        
        $record = $coll->handle_1;
        $this->assertEquals($record->handle, 'handle_1');
        
        $record->free();
    }
    
    /**
     * 
     * Test -- Does a certain key exist in the data?
     * 
     */
    public function test__isset()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAssoc($params);
        
        $this->assertTrue(isset($coll->handle_1));
        $this->assertFalse(isset($coll->no_such_handle));
        
        $coll->free();
    }
    
    /**
     * 
     * Test -- Sets a key value.
     * 
     */
    public function test__set()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAssoc($params);
        
        // get a record, make sure it's the right one
        $record = $coll->handle_1;
        $this->assertEquals($record->handle, 'handle_1');
        
        // clone it and replace within the collection
        $clone = clone $record;
        $clone->handle = 'zim-zim';
        $coll->handle_1 = $clone;
        
        // make sure it was really replaced
        $this->assertSame($coll->handle_1, $clone);
        $this->assertNotSame($coll->handle_1, $record);
        
        $clone->free();
        $record->free();
        $coll->free();
    }
    
    /**
     * 
     * Test -- Sets a key in the data to null.
     * 
     */
    public function test__unset()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAssoc($params);
        
        // get a record, make sure it's the right one
        $record = $coll->handle_1;
        $this->assertEquals($record->handle, 'handle_1');
        
        // unset it from the collection
        unset($coll->handle_1);
        
        // make sure it's not set any more
        $this->assertFalse(isset($coll->handle_1));
        
        $coll->free();
        $record->free();
    }
    
    /**
     * 
     * Test -- Countable: how many keys are there?
     * 
     */
    public function testCount()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        
        $sql    = $model->sql;
        $stmt   = "SELECT COUNT(*) FROM {$model->table_name}";
        $expect = $sql->fetchValue($stmt);
        $this->assertTrue($expect > 0);
        
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAll($params);
        $this->assertEquals($coll->count(), $expect);
        $this->assertEquals(count($coll), $expect);
        
        $coll->free();
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
     * Test -- Deletes each record in the collection one-by-one.
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the model from which the data originates.
     * 
     */
    public function testGetModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the injected pager information for the collection.
     * 
     */
    public function testGetPagerInfo()
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
     * Test -- Loads the struct with data from an array or another struct.
     * 
     */
    public function testLoad()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Loads *related* data for the collection.
     * 
     */
    public function testLoadRelated()
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
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAll($params);
        
        $this->assertTrue(isset($coll[0]));
        $this->assertFalse(isset($coll[99])); // fixture has no more than 30
        
        $coll->free();
    }
    
    /**
     * 
     * Test -- ArrayAccess: get a key value.
     * 
     */
    public function testOffsetGet()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAll($params);
        
        $record = $coll[0];
        $this->assertEquals($record->handle, 'handle_1');
        
        $record->free();
        $coll->free();
    }
    
    /**
     * 
     * Test -- ArrayAccess: set a key value; appends to the array when using [] notation.
     * 
     */
    public function testOffsetSet()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAll($params);
        
        // get a record, make sure it's the right one
        $record = $coll[0];
        $this->assertEquals($record->handle, 'handle_1');
        
        // clone it and replace within the collection
        $clone = clone $record;
        $clone->handle = 'dib-dib';
        $coll[0] = $clone;
        
        // make sure it was really replaced
        $this->assertSame($coll[0], $clone);
        $this->assertNotSame($coll[0], $record);
        
        $clone->free();
        $record->free();
        $coll->free();
    }
    
    /**
     * 
     * Test -- ArrayAccess: unset a key.
     * 
     */
    public function testOffsetUnset()
    {
        $this->_fixture->setup();
        $model = $this->_catalog->getModel('users');
        $params = array(
            'cols'  => array('handle', 'id', 'created', 'updated'),
            'order' => 'handle',
        );
        $coll = $model->fetchAll($params);
        
        // get a record, make sure it's the right one
        $record = $coll[0];
        $this->assertEquals($record->handle, 'handle_1');
        
        // unset it from the collection
        unset($coll[0]);
        
        // make sure it's not set any more
        $this->assertFalse(isset($coll[0]));
        
        $record->free();
        $coll->free();
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
     * Test -- Saves all the records from this collection to the database one-by-one, inserting or updating as needed.
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Injects the model from which the data originates.
     * 
     */
    public function testSetModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Injects pager information for the collection.
     * 
     */
    public function testSetPagerInfo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the data for each record in this collection as an array.
     * 
     */
    public function testToArray()
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
     * Test -- Returns a string representation of the object.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a new record and appends it to the collection.
     * 
     */
    public function testAppendNew()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes each record in the collection one-by-one.
     * 
     */
    public function testDeleteAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes a record from the database and removes it from the collection.
     * 
     */
    public function testDeleteOne()
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
     * Test -- Returns an array of all values for a single column in the collection.
     * 
     */
    public function testGetColVals()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array of invalidation messages from each invalid record,  keyed on the record offset within the collection.
     * 
     */
    public function testGetInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array of the invalid record objects within the collection, keyed on the record offset within the collection.
     * 
     */
    public function testGetInvalidRecords()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array of the unique primary keys contained in this  collection.
     * 
     */
    public function testGetPrimaryVals()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Given a record object, looks up its offset value in the collection.
     * 
     */
    public function testGetRecordOffset()
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
     * Test -- Are there any invalid records in the collection?
     * 
     */
    public function testIsInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Removes all records from the collection but **does not** delete them from the database.
     * 
     */
    public function testRemoveAll()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Removes one record from the collection but **does not** delete it from the database.
     * 
     */
    public function testRemoveOne()
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
}
