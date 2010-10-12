<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Related_HasManyThrough extends Test_Solar_Sql_Model_Related {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related_HasManyThrough = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
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
                'tags' => array(
                    'join_flag' => true, // force the join
                ),
            ),
        ));
        
        $actual = count($eager);
        $this->assertEquals($actual, $expect);
        
        // foreign "false"
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => array(
                'tags_false' => array(
                    'join_flag' => true, // force the join
                ),
            ),
        ));
        $actual = count($eager);
        
        // normal, through "false"
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => array(
                'tags_through_false' => array(
                    'join_flag' => true, // force the join
                ),
            ),
        ));
        $actual = count($eager);
        $this->assertEquals($actual, $expect);
        
        // foreign "false" through "false"
        $eager = $nodes->fetchAllAsArray(array(
            'eager' => array(
                'tags_false_through_false' => array(
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
        $taggings = $this->_catalog->getModel('taggings');
        $tags = $this->_catalog->getModel('tags');
        
        $related = $this->_newRelated($nodes, array(
            'name'    => 'tags',
            'through' => 'taggings',
        ));
        
        $actual = $related->toArray();
        
        // make sure that areas has-many nodes entry
        $expect = array(
            "cols" => array(
                0 => "id",
                1 => "name",
                2 => "summ",
            ),
            "foreign_alias" => "tags",
            "foreign_class" => "Mock_Solar_Model_Tags",
            "foreign_col" => "id",
            "foreign_key" => "id",
            "foreign_name" => "tags",
            "foreign_primary_col" => "id",
            "foreign_table" => "test_solar_tags",
            "merge" => "client",
            "name" => "tags",
            "native_alias" => "nodes",
            "native_by" => "wherein",
            "native_class" => "Mock_Solar_Model_Nodes",
            "native_col" => "id",
            "order" => array(),
            "through" => "taggings",
            "through_alias" => "taggings",
            "through_foreign_col" => "tag_id",
            "through_join_type" => "left",
            "through_key" => null,
            "through_native_col" => "node_id",
            "through_table" => "test_solar_taggings",
            "through_conditions" => array(),
            "type" => "has_many_through",
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
        
        // fetch one node, then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'id = ?' => rand(1, 10),
            ),
        );
        $node = $nodes->fetchOne($params);
        $count0 = count($this->_sql->getProfile());
        
        // lazy-fetch the taggings and check that the node_id's match
        $taggings = $node->taggings;
        $this->assertInstance($taggings, 'Mock_Solar_Model_Taggings_Collection');
        foreach ($taggings as $tagging) {
            $this->assertEquals($tagging->node_id, $node->id);
        }
        
        // make sure we got an extra SQL call
        $count1 = count($this->_sql->getProfile());
        $this->assertEquals($count1, $count0 + 1);
        
        // lazy fetch the tags through the taggings
        $tags = $node->tags;
        $this->assertInstance($tags, 'Mock_Solar_Model_Tags_Collection');
        
        // make sure the tags/taggings counts match
        $this->assertEquals(count($taggings), count($tags));
        
        // make sure each tag has a match with a tagging
        foreach ($tags as $tag) {
            $found = false;
            foreach ($taggings as $tagging) {
                if ($tagging->tag_id == $tag->id) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found);
        }
        
        // make sure we got only one extra SQL call overall
        $count2 = count($this->_sql->getProfile());
        $this->assertEquals($count2, $count1 + 1);
        
        // a second check should *not* make a new SQL call
        $tags = $node->tags;
        $this->assertInstance($tags, 'Mock_Solar_Model_Tags_Collection');
        $count3 = count($this->_sql->getProfile());
        $this->assertEquals($count3, $count2);
    }
    
    public function test_lazyFetchAll()
    {
        $this->_fixture->setup();
        
        // fetch all nodes, then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $node_coll = $nodes->fetchAll();
        $count_before = count($this->_sql->getProfile());
        
        // lazy-fetch each collection of taggings and tags on each node
        $extra_calls = 0;
        foreach ($node_coll as $node) {
            
            // get the taggings
            $taggings = $node->taggings;
            $this->assertInstance($taggings, 'Mock_Solar_Model_Taggings_Collection');
            $extra_calls ++;
            
            // get the tags
            $tags = $node->tags;
            $this->assertInstance($tags, 'Mock_Solar_Model_Tags_Collection');
            $extra_calls ++;
            
            // make sure the taggings/tags counts match
            $this->assertEquals(count($taggings), count($tags));
            
            // make sure each tagging has the right node ID
            foreach ($taggings as $tagging) {
                $this->assertEquals($tagging->node_id, $node->id);
            }
            
            // make sure each tag has a match with a tagging
            foreach ($tags as $tag) {
                $found = false;
                foreach ($taggings as $tagging) {
                    if ($tagging->tag_id == $tag->id) {
                        $found = true;
                        break;
                    }
                }
                $this->assertTrue($found);
            }
        }
        
        // make sure we have the right number of SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before + $extra_calls);
        
        // a second check should *not* make new SQL calls
        foreach ($node_coll as $node) {
            $taggings = $node->taggings;
            $this->assertInstance($taggings, 'Mock_Solar_Model_Taggings_Collection');
            $tags = $node->tags;
            $this->assertInstance($tags, 'Mock_Solar_Model_Tags_Collection');
        }
        
        $count_final = count($this->_sql->getProfile());
        $this->assertEquals($count_final, $count_after);
    }
    
    public function test_eagerFetchOne()
    {
        $this->_fixture->setup();
        
        // fetch one node with an eager tags
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'nodes.id = ?' => rand(1, 10),
            ),
            'eager' => 'tags',
        );
        
        $node = $nodes->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // get the tags, make sure there are some.
        // (can't tell how many there should have been without taggings.)
        $tags = $node->tags;
        $this->assertInstance($tags, 'Mock_Solar_Model_Tags_Collection');
        $this->assertTrue(count($tags) > 0);
        
        // should have been no extra SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    public function test_eagerFetchAll()
    {
        $this->_fixture->setup();
        
        // fetch all nodes with eager tags
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array('eager' => 'tags');
        $node_coll = $nodes->fetchAll($params);
        $count_before = count($this->_sql->getProfile());
        
        // get the tags, make sure there are some.
        // (can't tell how many there should have been without taggings.)
        foreach ($node_coll as $node) {
            $tags = $node->tags;
            $this->assertInstance($tags, 'Mock_Solar_Model_Tags_Collection');
            $this->assertTrue(count($tags) > 0);
        }
        
        // should have been no extra SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    public function test_eagerFetchOne_noneRelated()
    {
        $this->_fixture->setup();
        
        // remove taggings on one of the nodes
        $node_id = rand(1,10);
        $taggings = $this->_catalog->getModel('taggings');
        $table = $taggings->table_name;
        $cmd = "DELETE FROM $table WHERE node_id = $node_id";
        $this->_sql->query($cmd);
        
        // fetch one node with an eager tags
        // then see how many sql calls so far
        $nodes = $this->_catalog->getModel('nodes');
        $params = array(
            'where' => array(
                'nodes.id = ?' => $node_id,
            ),
            'eager' => 'tags',
        );
        
        $node = $nodes->fetchOne($params);
        $count_before = count($this->_sql->getProfile());
        
        // get the tags, make sure there aren't any.
        $tags = $node->tags;
        $this->assertInstance($tags, 'Solar_Sql_Model_Collection');
        $this->assertTrue(count($tags) == 0);
        
        // should have been no extra SQL calls
        $count_after = count($this->_sql->getProfile());
        $this->assertEquals($count_after, $count_before);
    }
    
    /**
     * 
     * Test -- Fetches the related collection for a native ID or record.
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
     * Test -- Are the related "foreign" and "through" collections valid?
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
     * Test -- Saves the related "through" collection *and* the foreign collection from a native record.
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
