<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Cache_Adapter extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cache_Adapter = array(
        'life' => 7, // 7-second life by default
    );
    
    protected $_extension;
    
    protected $_adapter_class;
    
    protected $_adapter;
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Constructor.
     * 
     * @param array $config User-defined configuration parameters.
     * 
     */
    public function __construct($config = null)
    {
        parent::__construct($config);
        
        if ($this->_extension && ! extension_loaded($this->_extension)) {
            $this->skip("'$this->_extension' extension not loaded");
        }
        
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
     * Test -- Inserts cache entry data *only if it does not already exist*.
     * 
     */
    public function testAdd()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        
        // add for the first time
        $this->assertTrue($this->_adapter->add($id, $data));
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        // add for the second time with a different value, should fail
        $this->assertFalse($this->_adapter->add($id, 'Bugs Bunny'));
        
        // make sure it really didn't overwrite the data
        $this->assertSame($this->_adapter->fetch($id), $data);
    }
    
    /**
     * 
     * Test -- Deletes a cache entry.
     * 
     */
    public function testDelete()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        
        // data has not been stored yet
        $this->assertFalse($this->_adapter->fetch($id));
        
        // store it
        $this->assertTrue($this->_adapter->save($id, $data));
        
        // and we should be able to fetch now
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        // delete it, should not be able to fetch again
        $this->_adapter->delete($id);
        $this->assertFalse($this->_adapter->fetch($id));
    }
    
    /**
     * 
     * Test -- Deletes all entries from the cache.
     * 
     */
    public function testDeleteAll()
    {
        $list = array(1, 2, 'five', 'foo/bar/baz');
        $data = 'Wile E. Coyote';
        
        foreach ($list as $id) {
            // data has not been stored yet
            $this->assertFalse($this->_adapter->fetch($id));
            // so store some data
            $this->assertTrue($this->_adapter->save($id, $data));
            // and we should be able to fetch now
            $this->assertSame($this->_adapter->fetch($id), $data);
        }
        
        // delete everything
        $this->_adapter->deleteAll();
        
        // should not be able to fetch again
        foreach ($list as $id) {
            $this->assertFalse($this->_adapter->fetch($id));
        }
    }
    
    /**
     * 
     * Test -- Returns the adapter-specific name for the entry key.
     * 
     */
    public function testEntry()
    {
        $id = 'wile-e-coyote';
        $actual = $this->_adapter->entry($id);
        $expect = $id;
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Gets cache entry data.
     * 
     */
    public function testFetch()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        
        // data has not been stored yet
        $this->assertFalse($this->_adapter->fetch($id));
        
        // store it
        $this->assertTrue($this->_adapter->save($id, $data));
        
        // and we should be able to fetch now
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        // deactivate then try to fetch
        $this->_adapter->setActive(false);
        $this->assertFalse($this->_adapter->isActive());
        $this->assertNull($this->_adapter->fetch($id));
        
        // re-activate then try to fetch
        $this->_adapter->setActive(true);
        $this->assertTrue($this->_adapter->isActive());
        $this->assertSame($this->_adapter->fetch($id), $data);
    }
    
    /**
     * 
     * Test -- gets cache entry data when the life is zero (i.e., forever).
     * 
     */
    public function testFetch_lifeZero()
    {
        // set up a "live forever" adapter
        $config = $this->_config;
        $config['life'] = 0;
        $this->_adapter = Solar::factory($this->_adapter_class, $config);
        
        // run the standard fetch test
        $this->testFetch();
        
        // sleep for a bit and try to fetch again
        // $id and $data are from testFetch())
        sleep(3);
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        $this->assertSame($this->_adapter->fetch($id), $data);
    }
    
    /**
     * 
     * Test -- Gets the cache lifetime in seconds.
     * 
     */
    public function testGetLife()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        
        // configured from setup
        $this->assertSame($this->_adapter->getLife(), $this->_config['life']);
        
        // store something
        $this->assertTrue($this->_adapter->save($id, $data));
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        // wait until just before the lifetime,
        // we should still get data
        sleep($this->_adapter->getLife() - 1);
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        // wait until just after the lifetime,
        // we should get nothing
        sleep(2);
        $this->assertFalse($this->_adapter->fetch($id));
    }
    
    /**
     * 
     * Test -- Increments a cache entry value by the specified amount.
     * 
     */
    public function testIncrement()
    {
        $id = 'foo';
        
        // make sure the value doesn't exist yet
        $actual = $this->_adapter->fetch($id);
        $this->assertFalse($actual);
        
        // increment it a few times, check return values
        for ($i = 1; $i <= 5; $i ++) {
            $this->diag("increment $i");
            $actual = $this->_adapter->increment($id);
            $this->assertSame($i, $actual);
        }
    }
    
    /**
     * 
     * Test -- Gets the current activity state of the cache (on or off).
     * 
     */
    public function testIsActive()
    {
        // should be active by default
        $this->assertTrue($this->_adapter->isActive());
        
        // turn it off
        $this->_adapter->setActive(false);
        $this->assertFalse($this->_adapter->isActive());
        
        // turn it back on
        $this->_adapter->setActive(true);
        $this->assertTrue($this->_adapter->isActive());
    }
    
    /**
     * 
     * Test -- Updates cache entry data, inserting if it does not already exist.
     * 
     */
    public function testSave()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        $this->assertTrue($this->_adapter->save($id, $data));
        $this->assertSame($this->_adapter->fetch($id), $data);
    }
    
    public function testSave_array()
    {
        $id = 'coyote';
        $data = array(
            'name' => 'Wile E.',
            'type' => 'Coyote',
            'eats' => 'Roadrunner',
            'flag' => 'Not again!',
        );
        $this->assertTrue($this->_adapter->save($id, $data));
        $this->assertSame($this->_adapter->fetch($id), $data);
    }
    
    public function testSave_object()
    {
        $id = 'coyote';
        $data = Solar::factory('Mock_Solar_Example');
        $this->assertTrue($this->_adapter->save($id, $data));
        $this->assertEquals($this->_adapter->fetch($id), $data);
    }
    
    // save with a custom lifespan
    public function testSave_life()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        $life = 3;
        $this->assertTrue($this->_adapter->save($id, $data, $life));
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        sleep($life - 1);
        $this->assertSame($this->_adapter->fetch($id), $data);
        
        sleep(2);
        $this->assertFalse($this->_adapter->fetch($id));
    }
    
    /**
     * 
     * Test -- Makes the cache active (true) or inactive (false).
     * 
     */
    public function testSetActive()
    {
        // should be active by default
        $this->assertTrue($this->_adapter->isActive());
        
        // turn it off
        $this->_adapter->setActive(false);
        $this->assertFalse($this->_adapter->isActive());
        
        // turn it back on
        $this->_adapter->setActive(true);
        $this->assertTrue($this->_adapter->isActive());
    }
    
    /**
     * 
     * Test -- Fetches data if it exists; if not, uses a callback to create the data and adds it to the cache in a race-condition-safe way.
     * 
     */
    public function testFetchOrAdd()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches data if it exists; if not, uses a callback to create the data and saves it to the cache.
     * 
     */
    public function testFetchOrSave()
    {
        $this->todo('stub');
    }
}
