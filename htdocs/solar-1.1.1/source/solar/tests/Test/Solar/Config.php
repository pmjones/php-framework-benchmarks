<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Config extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Config = array(
    );
    
    protected $_store = array(
        'foo' => 'bar',
        'baz' => array(
            'dib' => 'zim',
            'gir' => 'irk',
        ),
    );

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
        $obj = Solar::factory('Solar_Config');
        $this->assertInstance($obj, 'Solar_Config');
    }
    
    /**
     * 
     * Test -- Fetches config file values.
     * 
     */
    public function testFetch()
    {
        $file = Solar_Class::dir('Mock_Solar_Config') . 'fetch.php';
        $actual = Solar_Config::fetch($file);
        $expect = array(
            'foo' => 'bar',
            'baz' => 'sub',
            'zim' => 'gir',
        );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Safely gets a configuration group array or element value.
     * 
     */
    public function testGet()
    {
        Solar_Config::set('__TEST__', null, $this->_store);
        $expect = $this->_store;
        $actual = Solar_Config::get('__TEST__');
        $this->assertSame($actual, $expect);
    }
    
    public function testGet_elem()
    {
        Solar_Config::set('__TEST__', null, $this->_store);
        $expect = $this->_store['foo'];
        $actual = Solar_Config::get('__TEST__', 'foo');
        $this->assertSame($actual, $expect);
    }
    
    public function testGet_groupDefault()
    {
        Solar_Config::set('__TEST__', null, $this->_store);
        $expect = '*default*';
        $actual = Solar_Config::get('no-such-group', null, $expect);
        $this->assertSame($actual, $expect);
    }
    
    public function testGet_elemDefault()
    {
        Solar_Config::set('__TEST__', null, $this->_store);
        $expect = '*default*';
        $actual = Solar_Config::get('__TEST__', 'no-such-elem', $expect);
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Loads the config values from the specified location.
     * 
     */
    public function testLoad()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the retained build config for a class.
     * 
     */
    public function testGetBuild()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the config values for a class and key.
     * 
     */
    public function testSet()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the build config to retain for a class.
     * 
     */
    public function testSetBuild()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- 
     * 
     */
    public function testNerfle()
    {
        $this->todo('stub');
    }
}
