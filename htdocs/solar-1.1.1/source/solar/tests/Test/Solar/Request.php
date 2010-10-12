<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Request extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Request = array(
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
        $obj = Solar::factory('Solar_Request');
        $this->assertInstance($obj, 'Solar_Request');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$argv]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testArgv()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['argv'] = array('foo');
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->argv(0);
        $this->assertSame($actual, 'foo');
        
        // get a non-existent key
        $actual = $request->argv(1);
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->get(1, 'bar');
        $this->assertSame($actual, 'bar');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$cookie]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testCookie()
    {
        // pre-populate the superglobal with fake value for testing
        $_COOKIE['foo'] = 'bar';
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->cookie('foo');
        $this->assertSame($actual, 'bar');
        
        // get a non-existent key
        $actual = $request->cookie('baz');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->cookie('baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$env]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testEnv()
    {
        // pre-populate the superglobal with fake value for testing
        $_ENV['foo'] = 'bar';
        $request = Solar::factory('Solar_Request');
        
        // env a key
        $actual = $request->env('foo');
        $this->assertSame($actual, 'bar');
        
        // env a non-existent key
        $actual = $request->env('baz');
        $this->assertNull($actual);
        
        // env a non-existent key with default value
        $actual = $request->env('baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$files]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testFiles()
    {
        // pre-populate the superglobal with fake value for testing
        $_FILES['foo'] = array(
            'error'     => null,
            'name'      => 'bar',
            'size'      => null,
            'tmp_name'  => null,
            'type'      => null,
        );
        
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->files('foo');
        $this->assertSame($actual['name'], 'bar');
        
        // get a non-existent key
        $actual = $request->files('baz');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->files('baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$get]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testGet()
    {
        // pre-populate the superglobal with fake value for testing
        $_GET['foo'] = 'bar';
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->get('foo');
        $this->assertSame($actual, 'bar');
        
        // get a non-existent key
        $actual = $request->get('baz');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->get('baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$http]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testHttp()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['HTTP_FOO'] = 'bar';
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->http('Foo');
        $this->assertSame($actual, 'bar');
        
        // get a non-existent key
        $actual = $request->http('Baz');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->http('Baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
    
    /**
     * 
     * Test -- Is this a secure SSL request?
     * 
     */
    public function testIsCli()
    {
        $request = Solar::factory('Solar_Request');
        if (PHP_SAPI == 'cli') {
            $this->assertTrue($request->isCli());
        } else {
            $this->assertFalse($request->isCli());
        }
    }
    
    /**
     * 
     * Test -- Is this a command-line request?
     * 
     */
    public function testIsSsl_https()
    {
        $_SERVER['HTTPS'] = 'on';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isSsl());
    }
    
    public function testIsSsl_serverPort()
    {
        $_SERVER['SERVER_PORT'] = '443';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isSsl());
    }
    
    public function testIsSsl_http()
    {
        $request = Solar::factory('Solar_Request');
        $this->assertfalse($request->isSsl());
    }
    
    /**
     * 
     * Test -- Is this a 'DELETE' request?
     * 
     */
    public function testIsDelete()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isDelete());
        
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'XXX';
        $request = Solar::factory('Solar_Request');
        $this->assertFalse($request->isDelete());
    }
    
    /**
     * 
     * Test -- Is this a 'GET' request?
     * 
     */
    public function testIsGet()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isGet());
        
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'XXX';
        $request = Solar::factory('Solar_Request');
        $this->assertFalse($request->isGet());
    }
    
    /**
     * 
     * Test -- Is this a 'POST' request?
     * 
     */
    public function testIsPost()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isPost());
        
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'XXX';
        $request = Solar::factory('Solar_Request');
        $this->assertFalse($request->isPost());
    }
    
    /**
     * 
     * Test -- Is this a 'PUT' request?
     * 
     */
    public function testIsPut()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isPut());
        
        // pre-populate the superglobal with fake value for testing
        $_SERVER['REQUEST_METHOD'] = 'XXX';
        $request = Solar::factory('Solar_Request');
        $this->assertFalse($request->isPut());
    }
    
    /**
     * 
     * Test -- Is this an XmlHttpRequest?
     * 
     */
    public function testIsXhr()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $request = Solar::factory('Solar_Request');
        $this->assertTrue($request->isXhr());
        
        // pre-populate the superglobal with fake value for testing
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XXX';
        $request = Solar::factory('Solar_Request');
        $this->assertFalse($request->isXhr());
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$post]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testPost()
    {
        // pre-populate the superglobal with fake value for testing
        $_POST['foo'] = 'bar';
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->post('foo');
        $this->assertSame($actual, 'bar');
        
        // get a non-existent key
        $actual = $request->post('baz');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->post('baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$post]] *and*  [[$files]] properties, or an alternate default value if that key does  not exist in either location.
     * 
     */
    public function testPostAndFiles()
    {
        // pre-populate the superglobal with fake value for testing
        $_POST['foo'] = 'bar';
        $_FILES['baz'] = array(
            'error'     => null,
            'name'      => 'dib',
            'size'      => null,
            'tmp_name'  => null,
            'type'      => null,
        );
        
        $request = Solar::factory('Solar_Request');
        
        // get a POST key
        $actual = $request->postAndFiles('foo');
        $this->assertSame($actual, 'bar');
        
        // get a FILES key
        $actual = $request->postAndFiles('baz');
        $this->assertSame($actual['name'], 'dib');
        
        // get a non-existent key
        $actual = $request->postAndFiles('zim');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->postAndFiles('zim', 'gir');
        $this->assertSame($actual, 'gir');
    }
    
    /**
     * 
     * Test -- Reloads properties from the superglobal arrays.
     * 
     */
    public function testReset()
    {
        $_GET['foo'] = 'bar';
        $request = Solar::factory('Solar_Request');
        $this->assertSame($request->get('foo'), 'bar');
        
        $_GET = array();
        $request->reset();
        $this->assertNull($request->get('foo'));
    }
    
    /**
     * 
     * Test -- Retrieves an **unfiltered** value by key from the [[$server]] property, or an alternate default value if that key does not exist.
     * 
     */
    public function testServer()
    {
        // pre-populate the superglobal with fake value for testing
        $_SERVER['foo'] = 'bar';
        $request = Solar::factory('Solar_Request');
        
        // get a key
        $actual = $request->server('foo');
        $this->assertSame($actual, 'bar');
        
        // get a non-existent key
        $actual = $request->server('baz');
        $this->assertNull($actual);
        
        // get a non-existent key with default value
        $actual = $request->server('baz', 'dib');
        $this->assertSame($actual, 'dib');
    }
}
