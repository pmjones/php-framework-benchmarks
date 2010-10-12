<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Related_HasMany extends Test_Solar_Sql_Model_Related {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related_HasMany = array(
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
                'comments' => array(
                    'join_flag' => true, // force the join
                ),
            ),
        ));
        $actual = count($eager);
        $this->assertEquals($actual, $expect);
        
        // eager "false" (i.e. eager that gets no records)
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => array(
                'comments_false' => array(
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
        
        $areas = $this->_catalog->getModel('areas');
        
        $related = $this->_newRelated($areas, array(
            'name' => 'nodes',
        ));
        
        $actual = $related->toArray();
        
        // make sure that areas has-many nodes entry
        $expect = array (
            "cols" => array(
                0 => "id",
                1 => "created",
                2 => "updated",
                3 => "area_id",
                4 => "user_id",
                5 => "node_id",
                6 => "inherit",
                7 => "subj",
                8 => "body",
            ),
            "foreign_alias" => "nodes",
            "foreign_class" => "Mock_Solar_Model_Nodes",
            "foreign_col" => "area_id",
            "foreign_key" => "area_id",
            "foreign_name" => "nodes",
            "foreign_primary_col" => "id",
            "foreign_table" => "test_solar_nodes",
            "merge" => "client",
            "name" => "nodes",
            "native_alias" => "areas",
            "native_by" => "wherein",
            "native_class" => "Mock_Solar_Model_Areas",
            "native_col" => "id",
            "order" => array(),
            "type" => "has_many",
            "conditions" => array(),
            "wherein_max" => 100,
        );
        
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
        
        // fetch one area, then see how many sql calls so far
        $areas = $this->_catalog->getModel('areas');
        $params = array(
            'where' => array(
                'id = ?' => rand(1, 2),
            ),
        );
        $area = $areas->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch the nodes and check that the area_id's match
        $nodes = $area->nodes;
        $this->assertInstance($nodes, 'Mock_Solar_Model_Nodes_Collection');
        $this->assertTrue(count($nodes) > 0);
        foreach ($nodes as $node) {
            $this->assertEquals($node->area_id, $area->id);
        }
        
        // the reference to $nodes should result in one extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + 1);
        
        // a second check should *not* make a new SQL call
        $nodes = $area->nodes;
        $this->assertInstance($nodes, 'Mock_Solar_Model_Nodes_Collection');
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_lazyFetchAll()
    {
        $this->_fixture->setup();
        
        // fetch all areas, then see how many sql calls so far
        $areas = $this->_catalog->getModel('areas');
        $collection = $areas->fetchAll();
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch each node
        foreach ($collection as $area) {
            $nodes = $area->nodes;
            $this->assertInstance($nodes, 'Mock_Solar_Model_Nodes_Collection');
            $this->assertTrue(count($nodes) > 0);
            foreach ($nodes as $node) {
                $this->assertEquals($node->area_id, $area->id);
            }
        }
        
        // each reference to $nodes should result in one extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + count($collection));
        
        // a second check should *not* make new SQL calls
        foreach ($collection as $area) {
            $nodes = $area->nodes;
            $this->assertInstance($nodes, 'Mock_Solar_Model_Nodes_Collection');
            // @todo How to check that it has the right nodes in it?
        }
        
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_eagerFetchOne()
    {
        $this->_fixture->setup();
        
        // fetch one area with an eager nodes
        // then see how many sql calls so far
        $areas = $this->_catalog->getModel('areas');
        $params = array(
            'where' => array(
                'areas.id = ?' => rand(1, 2),
            ),
            'eager' => array('nodes'),
        );
        $area = $areas->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // look at the nodes and make sure the area_id's match
        $nodes = $area->nodes;
        $this->assertInstance($nodes, 'Mock_Solar_Model_Nodes_Collection');
        $this->assertTrue(count($nodes) > 0);
        foreach ($nodes as $node) {
            $this->assertEquals($node->area_id, $area->id);
        }
        
        // **should not** have been an extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    public function test_eagerFetchAll()
    {
        $this->_fixture->setup();
        
        // fetch all areas with eager nodes
        // then see how many sql calls so far
        $areas = $this->_catalog->getModel('areas');
        $params = array('eager' => 'nodes');
        $collection = $areas->fetchAll($params);
        $count_before = count($this->_sql->getProfile());
        
        // look at each area
        foreach ($collection as $area) {
            $nodes = $area->nodes;
            $this->assertInstance($nodes, 'Mock_Solar_Model_Nodes_Collection');
            $this->assertTrue(count($nodes) > 0);
            foreach ($nodes as $node) {
                $this->assertEquals($node->area_id, $area->id);
            }
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
     * Test -- Fetches a new related collection.
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
     * Test -- Returns foreign data as a collection object.
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
     * Test -- Saves a related collection from a native record.
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
