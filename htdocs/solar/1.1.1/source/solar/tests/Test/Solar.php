<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar = array(
    );
    
    protected $_test_config = array(
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
        // why does this work?  because although __construct() is private,
        // Solar::factory() is operating inside the class.
        $obj = Solar::factory('Solar');
        $this->assertInstance($obj, 'Solar');
    }
    
    /**
     * 
     * Test -- Runs a series of callbacks using call_user_func_array().
     * 
     */
    public function testCallbacks()
    {
        $file = Solar_Class::dir('Mock_Solar') . 'callbacks.php';
        Solar::callbacks($file);
        $this->assertTrue($GLOBALS['SOLAR_CALLBACKS']);
    }
    
    public function testCallbacks_function()
    {
        $file = Solar_Class::dir('Mock_Solar') . 'callbacks-function.php';
        Solar_File::load($file);
        Solar::callbacks(array(
            array(null, 'solar_callbacks_function')
        ));
        $this->assertTrue($GLOBALS['SOLAR_CALLBACKS_FUNCTION']);
    }
    
    public function testCallbacks_staticMethod()
    {
        $file = Solar_Class::dir('Mock_Solar') . 'callbacks-static-method.php';
        Solar_File::load($file);
        Solar::callbacks(array(
            array('Solar_Callbacks_Static_Method', 'callback')
        ));
        $this->assertTrue($GLOBALS['SOLAR_CALLBACKS_STATIC_METHOD']);
    }
    
    public function testCallbacks_instanceMethod()
    {
        $file = Solar_Class::dir('Mock_Solar') . 'callbacks-instance-method.php';
        Solar_File::load($file);
        $instance = Solar::factory('Solar_Callbacks_Instance_Method');
        Solar::callbacks(array(
            array($instance, 'callback')
        ));
        $this->assertTrue($GLOBALS['SOLAR_CALLBACKS_INSTANCE_METHOD']);
    }
    
    /**
     * 
     * Test -- Cleans the global scope of all variables that are found in other super-globals.
     * 
     */
    public function testCleanGlobals()
    {
        $GLOBALS['foo'] = 'bar';
        $GLOBALS['baz'] = 'dib';
        $_POST['foo'] = 'bar';
        Solar::cleanGlobals();
        $this->assertTrue(empty($GLOBALS['foo']));
        $this->assertFalse(empty($GLOBALS['baz']));
    }
    
    /**
     * 
     * Test -- Combination dependency-injection and service-locator method; 
     * returns a dependency object as passed, or an object from the registry, 
     * or a new factory instance.
     * 
     */
    public function testDependency()
    {
        // a direct dependency object
        $expect = Solar::factory('Mock_Solar_Example');
        $actual = Solar::dependency('Mock_Solar_Example', $expect);
        $this->assertSame($actual, $expect);
    }
    
    public function testDependency_registry()
    {
        $expect = Solar::factory('Mock_Solar_Example');
        Solar_Registry::set('example', $expect);
        $actual = Solar::dependency('Mock_Solar_Example', 'example');
        $this->assertSame($actual, $expect);
    }
    
    public function testDependency_config()
    {
        // set a random config-key and value so we know we're getting back
        // the "right" factoried object.
        $key = __FUNCTION__;
        $val = rand();
        $actual = Solar::dependency('Mock_Solar_Example', array(
            $key => $val,
        ));
        
        $this->assertInstance($actual, 'Mock_Solar_Example');
        $this->assertEquals($actual->getConfig($key), $val);
    }
    
    /**
     * 
     * Test -- Generates a simple exception, but does not throw it.
     * 
     * @todo test exception hierarchy fallbacks
     * 
     */
    public function testException()
    {
        $actual = Solar::exception(
            'Solar',
            'ERR_FOO_BAR',
            'Foo bar error.',
            array(
                'foo' => 'bar'
            )
        );
        
        $this->assertInstance($actual, 'Solar_Exception');
        $this->assertEquals($actual->getClass(), 'Solar');
        $this->assertEquals($actual->getCode(), 'ERR_FOO_BAR');
        $this->assertEquals($actual->getClassCode(), 'Solar::ERR_FOO_BAR');
        $this->assertEquals($actual->getMessage(), 'Foo bar error.');
        $this->assertSame($actual->getInfo(), array('foo' => 'bar'));
    }
    
    /**
     * 
     * Test -- Convenience method to instantiate and configure an object.
     * 
     */
    public function testFactory()
    {
        $class = 'Mock_Solar_Example';
        $this->assertFalse(class_exists($class, false));
        $actual = Solar::factory('Mock_Solar_Example');
        $this->assertInstance($actual, $class);
    }
    
    /**
     * 
     * Test -- Starts Solar: loads configuration values and and sets up the environment.
     * 
     */
    public function testStart()
    {
        // @todo Maybe do this with Solar_Php?
        $this->skip("Can't test Solar::start() within a Solar environment.");
    }
    
    /**
     * 
     * Test -- Stops Solar: runs stop scripts and cleans up the Solar environment.
     * 
     */
    public function testStop()
    {
        // @todo Maybe do this with Solar_Php?
        $this->skip("Can't test Solar::stop() within a Solar environment.");
    }
}
