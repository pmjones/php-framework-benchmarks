<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Record extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Record = array(
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
        $obj = Solar::factory('Solar_Sql_Model_Record');
        $this->assertInstance($obj, 'Solar_Sql_Model_Record');
    }
    
    /**
     * 
     * Test -- Magic getter for record properties; automatically calls __getColName() methods when they exist.
     * 
     */
    public function test__get()
    {
        $this->todo('stub');
    }
    
    public function test__get_related_eagerBelongsTo()
    {
        $this->todo('stub');
    }
    
    public function test__get_related_eagerHasMany()
    {
        $this->_fixture->setup();
        
        // the "before" count includes creating the tables and inserting
        // all the records.
        $before = count($this->_sql->getProfile());
        $this->diag("before: $before");
        
        // get areas and nodes
        $areas = $this->_catalog->getModel('areas');
        $list = $areas->fetchAll(array(
            'eager' => 'nodes',
        ));
        
        // all fetches should be *done* by now
        $expect = count($this->_sql->getProfile()) - $before;
        $this->diag("expect: $expect");
        
        foreach ($list as $area) {
            foreach ($area->nodes as $node) {
                $this->diag("{$node->id}: {$node->subj}");
                $this->assertTrue($node->subj != '');
            }
        }
        
        // should have been *no more fetches*
        $actual = count($this->_sql->getProfile()) - $before;
        $this->assertSame($actual, $expect);
    }
    
    public function test__get_related_eagerHasManyThrough()
    {
        $this->_fixture->setup();
        
        // the "before" count includes creating the tables and inserting
        // all the records.
        $before = count($this->_sql->getProfile());
        $this->diag("before: $before");
        
        // get nodes and tags
        $nodes = $this->_catalog->getModel('nodes');
        $list = $nodes->fetchAll(array(
            'eager' => 'tags',
        ));
        
        // all fetches should be *done* by now
        $expect = count($this->_sql->getProfile()) - $before;
        $this->diag("expect: $expect");
        
        foreach ($list as $node) {
            foreach ($node->tags as $tag) {
                $this->diag("{$node->id}: {$tag->name}");
                $this->assertTrue($tag->name != '');
            }
        }
        
        // should have been *no more fetches*
        $actual = count($this->_sql->getProfile()) - $before;
        $this->assertSame($actual, $expect);
    }
    
    public function test__get_related_eagerHasOne()
    {
        $this->todo('stub');
    }
    
    public function test__get_related_eagerHasMany_empty()
    {
        $this->_fixture->setup();
        
        // get rid of all the nodes
        $nodes = $this->_catalog->getModel('nodes');
        $nodes->delete('id > 0');
        
        // the "before" count includes creating the tables, inserting
        // all the records, and deleting the nodes.
        $before = count($this->_sql->getProfile());
        $this->diag("before: $before");
        
        // get areas and nodes
        $areas = $this->_catalog->getModel('areas');
        $list = $areas->fetchAll(array(
            'eager' => 'nodes',
        ));
        
        // all fetches should be *done* by now
        $expect = count($this->_sql->getProfile()) - $before;
        $this->diag("expect: $expect");
        
        foreach ($list as $k => $area) {
            $this->diag($area->nodes->toArray());
            foreach ($area->nodes as $node) {
                $this->diag("{$node->id}: {$node->subj}");
                $this->assertTrue($node->subj != '');
            }
        }
        
        // should have been *no more fetches*, even though there were no
        // nodes pulled (because they didn't exist)
        $actual = count($this->_sql->getProfile()) - $before;
        $this->assertSame($actual, $expect);
    }
    
    public function test__get_related_lazyBelongsTo()
    {
        $this->todo('stub');
    }
    
    public function test__get_related_lazyHasMany()
    {
        $this->todo('stub');
    }
    
    public function test__get_related_lazyHasManyThrough()
    {
        $this->todo('stub');
    }
    
    public function test__get_related_lazyHasOne()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Checks if a data key is set.
     * 
     */
    public function test__isset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Magic setter for record properties; automatically calls __setColName() methods when they exist.
     * 
     */
    public function test__set()
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
     * Test -- Adds a column filter to this record instance.
     * 
     */
    public function testAddFilter()
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
     * Test -- Deletes this record from the database.
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Filter the data.
     * 
     */
    public function testFilter()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a Solar_Form object pre-populated with column properties, values, and filters ready for processing (all based on the model for this record).
     * 
     */
    public function testForm()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets a list of all changed table columns.
     * 
     */
    public function testGetChanged()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the validation failure message for one or more properties.
     * 
     */
    public function testGetInvalid()
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
     * Test -- Gets the name of the primary-key column.
     * 
     */
    public function testGetPrimaryCol()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the value of the primary-key column.
     * 
     */
    public function testGetPrimaryVal()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the exception (if any) generated by the most-recent call to the save() method.
     * 
     */
    public function testGetSaveException()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the status of this record.
     * 
     */
    public function testGetStatus()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Increments the value of a column **immediately at the database** and retains the incremented value in the record.
     * 
     */
    public function testIncrement()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Tells if a particular table-column has changed.
     * 
     */
    public function testIsChanged()
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
     * Test -- Refreshes data for this record from the database.
     * 
     */
    public function testRefresh()
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
     * Test -- Saves this record and all related records to the database, inserting or updating as needed.
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Perform a save() within a transaction, with automatic commit and rollback.
     * 
     */
    public function testSaveInTransaction()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Forces one property to be "invalid" and sets a validation failure message for it.
     * 
     */
    public function testSetInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Forces multiple properties to be "invalid" and sets validation failure message for them.
     * 
     */
    public function testSetInvalids()
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
     * Test -- Forces the status of this record.
     * 
     */
    public function testSetStatus()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Converts the properties of this model Record or Collection to an array, including related models stored in properties.
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
     * Test -- special column behaviors.
     * 
     */
    public function test_specialColumns()
    {
        $this->todo('convert from Model test case');
        
        
        $model = $this->_catalog->getModel('TestSolarSpecialCols');
        
        /**
         * Correct population of new columns
         */
        
        $data = $model->fetchNew()->toArray();
        $model->insert($data);
        $now = date('Y-m-d H:i:s');
        
        $record = $model->fetchOne();
        
        // autoincremented id
        $this->assertEquals($record->id, 1);
        
        // created & updated
        $created = $record->created;
        $this->assertEquals($record->created, $now);
        $this->assertEquals($record->updated, $now);
        
        // auto-sequence foo & bar
        $this->assertEquals($record->seq_foo, 1);
        $this->assertEquals($record->seq_bar, 1);
        
        /**
         * Correct "updated" and sequence numbering
         */
        
        $data = $model->fetch(1)->toArray();
        $data['seq_bar'] = null;
        $model->update($data, array("id = ?" => $data['id']));
        $now = date('Y-m-d H:i:s');
        
        $record->refresh();
        
        // created should be as original
        $this->assertEquals($record->created, $created);
        
        // updated should have changed
        $this->assertEquals($record->updated, $now);
        
        // seq_foo should still be 1, but seq_bar should have been increased
        $this->assertEquals($record->seq_foo, 1);
        $this->assertEquals($record->seq_bar, 2);
        
        /**
         * Serializing
         */
        // first, save something to be serialized
        $expect = array('foo', 'bar', 'baz');
        $record->serialize = $expect;
        $model->update($record, null);
        
        // should have been unserialized after saving
        $this->assertSame($record->serialize, $expect);
        
        // now retrieve from the database and see if it unserialized
        $record = $model->fetch(1);
        $this->assertSame($record->serialize, $expect);
        
        /**
         * 
         * Autoinc and sequences on a second record
         * 
         */
        $record = $model->fetchNew();
        $model->insert($record);
        $this->assertEquals($record->id, 2);
        $this->assertEquals($record->seq_foo, 2);
        $this->assertEquals($record->seq_bar, 3);
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
     * Test -- Frees memory used by this struct.
     * 
     */
    public function testFree()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the SQL status of this record at the database.
     * 
     */
    public function testGetSqlStatus()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Initialize the record object.
     * 
     */
    public function testInit()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Initialize the record object as a "new" record; as with init(), this is effectively a "first load" method.
     * 
     */
    public function testInitNew()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Has this record been deleted?
     * 
     */
    public function testIsDeleted()
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
     * Test -- Is the record or one of its relateds invalid?
     * 
     */
    public function testIsInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is the record new?
     * 
     */
    public function testIsNew()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a new filter object with the filters from the record model.
     * 
     */
    public function testNewFilter()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a new Solar_Form object pre-populated with column properties, values, and filters ready for processing (all based on the model for this record).
     * 
     */
    public function testNewForm()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Create a new record related to this one.
     * 
     */
    public function testNewRelated()
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
