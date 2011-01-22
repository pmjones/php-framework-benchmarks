<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Related_HasOne extends Test_Solar_Sql_Model_Related {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related_HasOne = array(
    );
    
    public function test_nativeWithoutEagerSameAsWithEager()
    {
        $this->_fixture->setup();
        
        $nodes = $this->_catalog->getModel('nodes');
        
        // no eager
        $plain = $nodes->fetchAllAsArray();
        $expect = count($plain);
        
        // eager "normal"
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => array(
                'meta' => array(
                    'join_flag' => true, // force the join
                ),
            ),
        ));
        $actual = count($eager);
        $this->assertEquals($actual, $expect);
        
        // eager "false" (i.e. eager that gets no records)
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => array(
                'meta_false' => array(
                    'join_flag' => true, // force the join
                ),
            ),
        ));
        $actual = count($eager);
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches foreign data as an array.
     * 
     */
    public function testFetchArray()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches foreign data as a record or collection object.
     * 
     */
    public function testFetchObject()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the related (foreign) model instance.
     * 
     */
    public function testGetModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Loads this relationship object with user-defined characteristics (options), and corrects them as needed.
     * 
     */
    public function testLoad()
    {
        $this->_fixture->setup();
        
        $nodes = $this->_catalog->getModel('nodes');
        
        $related = $this->_newRelated($nodes, array(
            'name' => 'meta',
        ));
        
        $actual = $related->toArray();
        
        // make sure that nodes has-one meta entry
        $expect = array(
            "cols" => array(
                0 => "id",
                1 => "node_id",
                2 => "last_comment_id",
                3 => "last_comment_by",
                4 => "last_comment_at",
                5 => "comment_count",
            ),
            "foreign_alias" => "meta",
            "foreign_class" => "Mock_Solar_Model_Metas",
            "foreign_col" => "node_id",
            "foreign_key" => "node_id",
            "foreign_name" => "metas",
            "foreign_primary_col" => "id",
            "foreign_table" => "test_solar_metas",
            "merge" => "server",
            "name" => "meta",
            "native_alias" => "nodes",
            "native_by" => "wherein",
            "native_class" => "Mock_Solar_Model_Nodes",
            "native_col" => "id",
            "order" => array(),
            "type" => "has_one",
            "conditions" => array(),
            "wherein_max" => 100,
        );
        
        $actual = $nodes->getRelated('meta')->toArray();
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Modifies the SELECT from a native model countPages() call to join with the foreign model (especially on eager fetches).
     * 
     */
    public function testModSelectCountPages()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When the native model is doing a select and an eager-join is requested for this relation, this method modifies the select to add the eager join.
     * 
     */
    public function testModSelectEager()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates a new selection object for fetching records from this relation.
     * 
     */
    public function testNewSelect()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the native (origin) model instance.
     * 
     */
    public function testSetNativeModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the relation characteristics as an array.
     * 
     */
    public function testToArray()
    {
        $this->todo('stub');
    }
    
    public function test_lazyFetchOne()
    {
        $this->_fixture->setup();
        
        // fetch one node, then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'id = ?' => rand(1, 10),
            ),
        );
        $node = $nodes->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch the meta; make sure it's an meta record with the right
        // ID
        $meta = $node->meta;
        $this->assertInstance($meta, 'Mock_Solar_Model_Metas_Record');
        $this->assertEquals($meta->node_id, $node->id);
        
        // the reference to $meta should result in one extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + 1);
        
        // a second check should *not* make a new SQL call
        $meta = $node->meta;
        $this->assertInstance($meta, 'Mock_Solar_Model_Metas_Record');
        $this->assertEquals($meta->node_id, $node->id);
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_lazyFetchAll()
    {
        $this->_fixture->setup();
        
        // fetch all nodes, then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $collection = $nodes->fetchAll();
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch each meta
        foreach ($collection as $node) {
            $meta = $node->meta;
            $this->assertInstance($meta, 'Mock_Solar_Model_Metas_Record');
            $this->assertEquals($meta->node_id, $node->id);
        }
        
        // each reference to $meta should result in one extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + count($collection));
        
        // a second check should *not* make new SQL calls
        foreach ($collection as $node) {
            $meta = $node->meta;
            $this->assertInstance($meta, 'Mock_Solar_Model_Metas_Record');
            $this->assertEquals($meta->node_id, $node->id);
        }
        
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_eagerFetchOne()
    {
        $this->_fixture->setup();
        
        // fetch one node with an eager meta
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'nodes.id = ?' => rand(1, 10),
            ),
            'eager' => array('meta'),
        );
        $node = $nodes->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // look at the meta
        $meta = $node->meta;
        $this->assertInstance($meta, 'Mock_Solar_Model_Metas_Record');
        $this->assertEquals($meta->node_id, $node->id);
        
        // **should not** have been an extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    public function test_eagerFetchAll()
    {
        $this->_fixture->setup();
        
        // fetch all nodes with eager meta
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array('eager' => 'meta');
        $collection = $nodes->fetchAll($params);
        $count_before = count($this->_sql->getProfile());
        
        // look at each meta
        foreach ($collection as $node) {
            $meta = $node->meta;
            $this->assertInstance($meta, 'Mock_Solar_Model_Metas_Record');
            $this->assertEquals($meta->node_id, $node->id);
        }
        
        // **should not** have been extra SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    /**
     * 
     * Test -- Fetches the related record or collection for a native ID or record.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches an empty value for the related.
     * 
     */
    public function testFetchEmpty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches a new related record.
     * 
     */
    public function testFetchNew()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is the related record or collection valid?
     * 
     */
    public function testIsInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is this related to many records?
     * 
     */
    public function testIsMany()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is this related to one record?
     * 
     */
    public function testIsOne()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fixes the native fetch params and eager params; then, if the join_flag is set on the eager, calles _modEagerFetch() to modify the native fetch params based on the eager params.
     * 
     */
    public function testModEagerFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Modifies the parent result array to add eager records.
     * 
     */
    public function testModEagerResult()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a record object populated with the passed data; if data is  empty, returns a brand-new record object.
     * 
     */
    public function testNewObject()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Pre-save hook for saving related records or collections from a native record.
     * 
     */
    public function testPreSave()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Saves a related record from a native record.
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the foreign-model WHERE conditions and merges with the WHERE conditions on this relationship.
     * 
     */
    public function testGetForeignWhereMods()
    {
        $this->todo('stub');
    }
}
