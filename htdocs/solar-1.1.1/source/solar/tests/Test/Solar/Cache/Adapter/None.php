<?php
/**
 * Parent test.
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Adapter.php';

/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Cache_Adapter_None extends Test_Solar_Cache_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cache_Adapter_None = array(
    );
    /**
     * 
     * Test -- Inserts cache entry data *only if it does not already exist*.
     * 
     */
    public function testAdd()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        
        // add for the first time, should not stick
        $this->assertTrue($this->_adapter->add($id, $data));
        $this->assertFalse($this->_adapter->fetch($id));
        
        // add for the second time with a different value, still should not
        // be there
        $this->assertTrue($this->_adapter->add($id, 'Bugs Bunny'));
        $this->assertFalse($this->_adapter->fetch($id));
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
        
        // store it
        $this->_adapter->save($id, $data);
        
        // should not be able to fetch
        $this->assertFalse($this->_adapter->fetch($id));
        
        // should not be able to fetch again
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
            // store some data
            $this->_adapter->save($id, $data);
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
        $this->assertNull($actual);
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
        
        // should still not be there
        $this->assertFalse($this->_adapter->fetch($id), $data);
        
        // deactivate then try to fetch
        $this->_adapter->setActive(false);
        $this->assertFalse($this->_adapter->isActive());
        $this->assertNull($this->_adapter->fetch($id));
        
        // re-activate then try to fetch
        $this->_adapter->setActive(true);
        $this->assertTrue($this->_adapter->isActive());
        $this->assertFalse($this->_adapter->fetch($id));
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
        $this->_adapter = Solar::factory($this->_adapter_class, $this->_config);
        
        // run the standard fetch test
        $this->testFetch();
        
        // sleep for a bit and try to fetch again
        // $id and $data are from testFetch())
        sleep(3);
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        $this->assertFalse($this->_adapter->fetch($id), $data);
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
        $this->assertFalse($this->_adapter->fetch($id));
        
        // wait until just before the lifetime,
        // we should still get data
        sleep($this->_adapter->getLife() - 1);
        $this->assertFalse($this->_adapter->fetch($id));
        
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
            $this->assertNull($actual);
        }
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
        $this->assertFalse($this->_adapter->fetch($id));
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
        $this->assertFalse($this->_adapter->fetch($id));
    }
    
    public function testSave_object()
    {
        $id = 'coyote';
        $data = Solar::factory('Mock_Solar_Example');
        $this->assertTrue($this->_adapter->save($id, $data));
        $this->assertFalse($this->_adapter->fetch($id));
    }
    
    // save with a custom lifespan
    public function testSave_life()
    {
        $id = 'coyote';
        $data = 'Wile E. Coyote';
        $life = 3;
        $this->assertTrue($this->_adapter->save($id, $data, $life));
        $this->assertFalse($this->_adapter->fetch($id), $data);
        
        sleep($life - 1);
        $this->assertFalse($this->_adapter->fetch($id), $data);
        
        sleep(2);
        $this->assertFalse($this->_adapter->fetch($id));
    }
}
