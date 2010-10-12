<?php
class Test_Solar_Sql_Model_Related_Queries extends Solar_Test
{
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related_Queries = array(
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
        $this->_fixture->setup();
        
        // preload all models to get discovery out of the way
        $this->_catalog->users;
        $this->_catalog->prefs;
        $this->_catalog->areas;
        $this->_catalog->nodes;
        $this->_catalog->metas;
        $this->_catalog->tags;
        $this->_catalog->taggings;
        $this->_catalog->comments;

        $this->_sql->setProfiling(true);
    }
    
    protected function _diagProfile()
    {
        $profile = $this->_sql->getProfile();
        foreach ($profile as $key => $val) {
            $this->diag($val['data'], "$key: {$val['stmt']}");
        }
    }
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    public function test_chainedEagerToOneUsesSingleQuery()
    {
        $this->diag('ticket 210');
        
        $area = $this->_catalog->areas->fetchOne(array(
            'eager' => array(
                'user' => array( // is in master fetch as it should be
                    'eager' => array(
                        'pref', // should also be in master fetch, but isn't
                    ),
                ),
            ),
        ));
        
        $this->todo();
    }
    
    // when you use native-by select, the native should drop unnecessary
    // joins (typically left joins).
    public function test_nativeBySelectOnEagerFetch()
    {
        $this->diag('ticket 211');
        
        $nodes = $this->_catalog->nodes->fetchAllAsArray(array(
            'where' => 'nodes.id <= 10',
            'eager' => array(
                'meta',
                'comments' => array(
                    'native_by' => 'select',
                ),
            ),
        ));
        
        // did we actually get nodes?
        $this->assertTrue(count($nodes) == 10);
        
        // get the profile and find the second statement
        // (first was the node+meta, second is comments)
        $profile = $this->_sql->getProfile();
        $actual = $profile[1]['stmt'];
        
        // the expected statement
        $expect = '
SELECT
    "comments"."id" AS "id",
    "comments"."created" AS "created",
    "comments"."updated" AS "updated",
    "comments"."node_id" AS "node_id",
    "comments"."email" AS "email",
    "comments"."uri" AS "uri",
    "comments"."body" AS "body"
FROM
    "test_solar_comments" "comments"
INNER JOIN (SELECT
    "id" AS "id"
FROM
    "test_solar_nodes" "nodes"
WHERE
    "nodes"."id" <= 10
) "nodes" ON "nodes"."id" = "comments"."node_id"
';
        
        // check it
        $this->assertEquals(trim($actual), trim($expect));
    }
    
    public function test_relatedConditions()
    {
        /** PART 1 */
        
        // area should be a *left* join, and *should not* be used in count-pages
        $nodes = $this->_catalog->nodes->fetchAll(array(
            'eager' => array(
                'area' => array(
                ),
            ),
            'count_pages' => true,
        ));
        
        // did we actually get nodes?
        $this->assertTrue(count($nodes) > 0);
        
        // get the profile
        $profile = $this->_sql->getProfile();
        
        // areas should be a left join on the fetch statement
        $actual = $profile[0]['stmt'];
        
        $expect = '
SELECT
    "nodes"."id" AS "id",
    "nodes"."created" AS "created",
    "nodes"."updated" AS "updated",
    "nodes"."area_id" AS "area_id",
    "nodes"."user_id" AS "user_id",
    "nodes"."node_id" AS "node_id",
    "nodes"."inherit" AS "inherit",
    "nodes"."subj" AS "subj",
    "nodes"."body" AS "body",
    "area"."id" AS "area__id",
    "area"."created" AS "area__created",
    "area"."updated" AS "area__updated",
    "area"."user_id" AS "area__user_id",
    "area"."name" AS "area__name"
FROM
    "test_solar_nodes" "nodes"
LEFT JOIN "test_solar_areas" "area" ON "nodes"."area_id" = "area"."id"
';
        $this->assertEquals(trim($actual), trim($expect));
        
        // areas should not be in the count-pages statement
        $actual = $profile[1]['stmt'];
        
        $expect = '
SELECT
    COUNT("nodes"."id")
FROM
    "test_solar_nodes" "nodes"
LIMIT 1
';
        
        $this->assertEquals(trim($actual), trim($expect));
        
        
        /** PART 2 */
        
        // area should be an *inner* join, and *should* be used in count-pages
        $nodes = $this->_catalog->nodes->fetchAll(array(
            'eager' => array(
                'area' => array(
                    'conditions' => array(
                        'area.id = ?' => '1',
                    ),
                ),
            ),
            'count_pages' => true,
        ));
        
        // get the profile
        $profile = $this->_sql->getProfile();
        
        // areas should be an inner join on the fetch statement
        $actual = $profile[2]['stmt'];
        
        $expect = '
SELECT
    "nodes"."id" AS "id",
    "nodes"."created" AS "created",
    "nodes"."updated" AS "updated",
    "nodes"."area_id" AS "area_id",
    "nodes"."user_id" AS "user_id",
    "nodes"."node_id" AS "node_id",
    "nodes"."inherit" AS "inherit",
    "nodes"."subj" AS "subj",
    "nodes"."body" AS "body",
    "area"."id" AS "area__id",
    "area"."created" AS "area__created",
    "area"."updated" AS "area__updated",
    "area"."user_id" AS "area__user_id",
    "area"."name" AS "area__name"
FROM
    "test_solar_nodes" "nodes"
INNER JOIN "test_solar_areas" "area" ON "nodes"."area_id" = "area"."id" AND "area"."id" = 1
';
        
        $this->assertEquals(trim($actual), trim($expect));
        
        // areas should be in the count-pages statement
        $actual = $profile[3]['stmt'];
        
        $expect = '
SELECT
    COUNT("nodes"."id")
FROM
    "test_solar_nodes" "nodes"
INNER JOIN "test_solar_areas" "area" ON "nodes"."area_id" = "area"."id" AND "area"."id" = 1
LIMIT 1
';
        
        $this->assertEquals(trim($actual), trim($expect));
    }
}
