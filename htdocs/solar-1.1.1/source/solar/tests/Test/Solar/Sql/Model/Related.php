<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Sql_Model_Related extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related = array(
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
    
    protected $_class;
    
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
        
        // set the class name for relateds
        $len = strlen('Test_');
        $this->_class = substr(get_class($this), $len);
        
        // fixture to populate tables
        $this->_fixture = Solar::factory('Fixture_Solar_Sql_Model');
    }
    
    protected function _newRelated($native_model, $opts)
    {
        $related = Solar::factory($this->_class);
        $related->setNativeModel($native_model);
        $related->load($opts);
        return $related;
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
        $obj = Solar::factory($this->_class);
        $this->assertInstance($obj, $this->_class);
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
        $this->todo('stub');
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
        $this->skip('abstract method');
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
        $this->todo('stub');
    }
    
    public function test_lazyFetchAll()
    {
        $this->todo('stub');
    }
    
    public function test_eagerFetchOne()
    {
        $this->todo('stub');
    }
    
    public function test_eagerFetchAll()
    {
        $this->todo('stub');
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
     * Test -- Fetch an empty value appropriate for this association.
     * 
     */
    public function testFetchEmpty()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Fetches a new record or collection object.
     * 
     */
    public function testFetchNew()
    {
        $this->skip('abstract method');
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
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Is this related to one record?
     * 
     */
    public function testIsOne()
    {
        $this->skip('abstract method');
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
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Packages foreign data as a record or collection object.
     * 
     */
    public function testNewObject()
    {
        $this->skip('abstract method');
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
     * Test -- Saves a related record or collection from a native record.
     * 
     */
    public function testSave()
    {
        $this->skip('abstract method');
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
    
    public function test_nativeWithoutEagerSameAsWithEager()
    {
        $this->todo('stub');
    }
    
    public function test_eagerSameAsLazy()
    {
        $this->todo('stub');
    }
}
