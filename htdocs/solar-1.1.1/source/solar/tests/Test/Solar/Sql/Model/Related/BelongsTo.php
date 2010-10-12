<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Related_BelongsTo extends Test_Solar_Sql_Model_Related {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related_BelongsTo = array(
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
            'eager' => 'area',
        ));
        $actual = count($eager);
        $this->assertEquals($actual, $expect);
        
        // eager "false" (i.e. eager that gets no records)
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => 'area_false',
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
            'name' => 'area',
        ));
        
        $actual = $related->toArray();
        
        $expect = array (
            "cols" => array (
                0 => "id",
                1 => "created",
                2 => "updated",
                3 => "user_id",
                4 => "name",
            ),
            "foreign_alias" => "area",
            "foreign_class" => "Mock_Solar_Model_Areas",
            "foreign_col" => "id",
            "foreign_key" => "area_id",
            "foreign_name" => "areas",
            "foreign_primary_col" => "id",
            "foreign_table" => "test_solar_areas",
            "merge" => "server",
            "name" => "area",
            "native_alias" => "nodes",
            "native_by" => "wherein",
            "native_class" => "Mock_Solar_Model_Nodes",
            "native_col" => "area_id",
            "order" => array(),
            "type" => "belongs_to",
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
        
        // get table-creation out the way after caches are cleared
        $this->_catalog->getModel('nodes');
        $this->_catalog->getModel('areas');
        
        // fetch one node, then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'id = ?' => rand(1, 10),
            ),
        );
        $node = $nodes->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch the area; make sure it's an area record with the right
        // ID
        $area = $node->area;
        
        $this->assertInstance($area, 'Mock_Solar_Model_Areas_Record');
        $this->assertEquals($node->area_id, $area->id);
        
        // the reference to $area should result in extra SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + 1);
        
        // a second check should *not* make a new SQL call
        $area = $node->area;
        $this->assertInstance($area, 'Mock_Solar_Model_Areas_Record');
        $this->assertEquals($node->area_id, $area->id);
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_lazyFetchAll()
    {
        $this->_fixture->setup();
        
        // get table-creation out the way after caches are cleared
        $this->_catalog->getModel('nodes');
        $this->_catalog->getModel('areas');
        
        // fetch all nodes, then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $collection = $nodes->fetchAll();
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch each area
        foreach ($collection as $node) {
            $area = $node->area;
            $this->assertInstance($area, 'Mock_Solar_Model_Areas_Record');
            $this->assertEquals($node->area_id, $area->id);
        }
        
        // each reference to $area should result in extra SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + count($collection));
        
        // a second check should *not* make new SQL calls
        foreach ($collection as $node) {
            $area = $node->area;
            $this->assertInstance($area, 'Mock_Solar_Model_Areas_Record');
            $this->assertEquals($node->area_id, $area->id);
        }
        
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_eagerFetchOne()
    {
        $this->_fixture->setup();
        
        // get table-creation out the way after caches are cleared
        $this->_catalog->getModel('nodes');
        $this->_catalog->getModel('areas');
        
        // fetch one node with an eager area
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'nodes.id = ?' => rand(1, 10),
            ),
            'eager' => array('area'),
        );
        $node = $nodes->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // look at the area
        $area = $node->area;
        $this->assertInstance($area, 'Mock_Solar_Model_Areas_Record');
        $this->assertEquals($node->area_id, $area->id);
        
        // **should not** have been an extra SQL call
        $count_after = count($this->_sql->getProfile());
        $this->_diagProfile($count_before, $count_after);
        $this->assertEquals($count_after, $count_before);
    }
    
    protected function _diagProfile($count_before, $count_after)
    {
        $profile = $this->_sql->getProfile();
        for ($i = $count_before; $i < $count_after; $i++) {
            $this->diag($profile[$i]);
        }
    }
    
    public function test_eagerFetchAll()
    {
        $this->_fixture->setup();
        
        // get table-creation out the way after caches are cleared
        $this->_catalog->getModel('nodes');
        $this->_catalog->getModel('areas');
        
        global $verbose;
        $verbose = true;
        
        // fetch all nodes with eager area
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array('eager' => 'area');
        $collection = $nodes->fetchAll($params);
        $count_before = count($this->_sql->getProfile());
        
        // look at each area
        foreach ($collection as $node) {
            $area = $node->area;
            $this->assertInstance($area, 'Mock_Solar_Model_Areas_Record');
            $this->assertEquals($node->area_id, $area->id);
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
     * Test -- Pre-save behavior when saving foreign records through this  relationship.
     * 
     */
    public function testPreSave()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Save a foreign records through this relationship; the belongs-to relationship *does not* save the belonged-to record, to avoid recursion issues.
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
