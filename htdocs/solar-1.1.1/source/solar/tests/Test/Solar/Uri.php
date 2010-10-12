<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Uri extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Uri = array(
    );
    
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
        
        // when running from the command line, these elements are empty.
        // fake them so that web-like testing can occur.
        $_SERVER['HTTP_HOST']    = 'example.com';
        $_SERVER['SCRIPT_NAME']  = '/path/to/index.php';
        $_SERVER['PATH_INFO']    = '/appname/action';
        $_SERVER['QUERY_STRING'] = 'foo=bar&baz=dib';
        $_SERVER['REQUEST_URI']  = $_SERVER['SCRIPT_NAME']
                                 . $_SERVER['PATH_INFO']
                                 . '?'
                                 . $_SERVER['QUERY_STRING'];
    }
    
    /**
     * 
     * Returns a new URI instance.  Because this class is extended to test
     * Solar_Uri_Action and Solar_Uri_Public, we want to make sure we're 
     * getting the right class type.
     * 
     * @return Solar_Uri
     * 
     */
    protected function _newUri()
    {
        // get the class name, minus the 'Test_' prefix
        $class = substr(get_class($this), 5);
        return Solar::factory($class);
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
        $obj = $this->_newUri();
        $this->assertInstance($obj, 'Solar_Uri');
        
    }
    
    public function test_default()
    {
        $uri = $this->_newUri();
        $this->assertSame($uri->scheme, 'http');
        $this->assertSame($uri->host, 'example.com');
        $this->assertSame($uri->port, null);
        $this->assertSame($uri->user, null);
        $this->assertSame($uri->pass, null);
        $this->assertSame($uri->path, array('path', 'to', 'index.php', 'appname', 'action'));
        $this->assertSame($uri->query, array('foo'=>'bar', 'baz'=>'dib'));
    }
    
    public function test_zero()
    {
        $uri = $this->_newUri();
        $uri->set('/foo/bar/baz.0#0');
        $actual = $uri->get();
        $expect = "/foo/bar/baz.0#0";
        $this->assertSame($actual, $expect);
    }
    
    public function test_secureHttps()
    {
        $_SERVER['HTTPS'] = 'on';
        $uri = $this->_newUri();
        $this->assertSame($uri->scheme, 'https');
        $this->assertSame($uri->host, 'example.com');
        $this->assertSame($uri->port, null);
        $this->assertSame($uri->user, null);
        $this->assertSame($uri->pass, null);
        $this->assertSame($uri->path, array('path', 'to', 'index.php', 'appname', 'action'));
        $this->assertSame($uri->query, array('foo'=>'bar', 'baz'=>'dib'));
    }
    
    public function test_secureServerPort()
    {
        $_SERVER['SERVER_PORT'] = '443';
        $uri = $this->_newUri();
        $this->assertSame($uri->scheme, 'https');
        $this->assertSame($uri->host, 'example.com');
        $this->assertSame($uri->port, null);
        $this->assertSame($uri->user, null);
        $this->assertSame($uri->pass, null);
        $this->assertSame($uri->path, array('path', 'to', 'index.php', 'appname', 'action'));
        $this->assertSame($uri->query, array('foo'=>'bar', 'baz'=>'dib'));
    }
    
    /**
     * 
     * Test -- Implements access to $_query **by reference** so that it appears to be a public $query property.
     * 
     */
    public function test__get()
    {
        $uri = $this->_newUri();
        $this->assertSame($uri->query, array('foo'=>'bar', 'baz'=>'dib'));
    }
    
    /**
     * 
     * Test -- Implements the virtual $query property.
     * 
     */
    public function test__set()
    {
        $uri = $this->_newUri();
        $uri->query['zim'] = 'gir';
        $expect = array('foo'=>'bar', 'baz'=>'dib', 'zim'=>'gir');
        $this->assertSame($uri->query, $expect);
    }
    
    /**
     * 
     * Test -- Returns a URI based on the object properties.
     * 
     */
    public function testGet()
    {
        $uri = $this->_newUri();
        
        // preliminaries
        $scheme = 'http';
        $host = 'www.example.net';
        $port = 8080;
        $path = '/some/path/index.php';
        
        $info = array(
            'more', 'path', 'info'
        );
        
        $istr = implode('/', $info);
        
        $query = array(
            'a"key' => 'a&value',
            'b?key' => 'this that other',
            'c\'key' => 'tag+tag+tag',
        );
        
        $tmp = array();
        foreach ($query as $k => $v) {
            $tmp[] .= urlencode($k) . '=' . urlencode($v);
        }
        
        $qstr = implode('&', $tmp);
        
        // set up expectations
        $expect_full = "$scheme://$host:$port$path/$istr?$qstr";
        $expect_part = "$path/$istr?$qstr";
        
        // set the URI
        $uri->set($expect_full);
        
        // full fetch
        $this->assertSame($uri->get(true), $expect_full);
        
        // partial fetch
        $this->assertSame($uri->get(false), $expect_part);
    }
    
    /**
     * 
     * Test -- Returns the query portion as a string.
     * 
     */
    public function testGetQuery()
    {
        $uri = $this->_newUri();
        $uri->setQuery('a=b&c=d');
        $this->assertSame($uri->getQuery(), 'a=b&c=d');
    }
    
    /**
     * 
     * Test -- Returns a URI based on the specified string.
     * 
     */
    public function testQuick()
    {
        $uri = $this->_newUri();
        
        // partial
        $expect = '/path/to/index.php?foo=bar';
        $actual = $uri->quick("http://example.com$expect");
        $this->assertSame($actual, $expect);
        
        // full
        $expect = 'http://example.com/path/to/index.php?foo=bar';
        $actual = $uri->quick($expect, true);
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets properties from a specified URI.
     * 
     */
    public function testSet()
    {
        $uri = $this->_newUri();
        
        // set up the expected values
        $scheme = 'http';
        $host = 'www.example.net';
        $port = 8080;
        $path = 'some/path/index.php/more/path/info';
        $query = array(
            'a"key' => 'a&value',
            'b?key' => 'this that other',
            'c\'key' => 'tag+tag+tag',
        );
        
        $spec = "$scheme://$host:$port/$path/";
        
        $tmp = array();
        foreach ($query as $k => $v) {
            $tmp[] .= urlencode($k) . '=' . urlencode($v);
        }
        $spec .= '?' . implode('&', $tmp);
        
        // import the URI spec and test that it imported properly
        $uri->set($spec);
        $this->assertSame($uri->scheme, $scheme);
        $this->assertSame($uri->host, $host);
        $this->assertSame($uri->port, $port);
        $this->assertSame($uri->path, explode('/', $path));
        $this->assertSame($uri->query, $query);
        
        // npw export in full, then re-import and check again.
        // do this to make sure there are no translation errors.
        $spec = $uri->get(true);
        $uri->set($spec);
        $this->assertSame($uri->scheme, $scheme);
        $this->assertSame($uri->host, $host);
        $this->assertSame($uri->port, $port);
        $this->assertSame($uri->path, explode('/', $path));
        $this->assertSame($uri->query, $query);
    }
    
    public function testSet_format()
    {
        $uri = $this->_newUri();
        
        // set up the expected values
        $scheme = 'http';
        $host = 'www.example.net';
        $port = 8080;
        $path = 'some/path/index.php/more/path/info';
        $format = 'xml';
        $query = array(
            'a"key' => 'a&value',
            'b?key' => 'this that other',
            'c\'key' => 'tag+tag+tag',
        );
        
        $spec = "$scheme://$host:$port/$path.$format";
        
        $tmp = array();
        foreach ($query as $k => $v) {
            $tmp[] .= urlencode($k) . '=' . urlencode($v);
        }
        $spec .= '?' . implode('&', $tmp);
        
        // import the URI spec and test that it imported properly
        $uri->set($spec);
        $this->assertSame($uri->scheme, $scheme);
        $this->assertSame($uri->host, $host);
        $this->assertSame($uri->port, $port);
        $this->assertSame($uri->path, explode('/', $path));
        $this->assertSame($uri->format, $format);
        $this->assertSame($uri->query, $query);
        
        // npw export in full, then re-import and check again.
        // do this to make sure there are no translation errors.
        $spec = $uri->get(true);
        $uri->set($spec);
        $this->assertSame($uri->scheme, $scheme);
        $this->assertSame($uri->host, $host);
        $this->assertSame($uri->port, $port);
        $this->assertSame($uri->path, explode('/', $path));
        $this->assertSame($uri->format, $format);
        $this->assertSame($uri->query, $query);
    }
    
    /**
     * 
     * Test -- Sets the Solar_Uri::$path array from a string.
     * 
     */
    public function testSetPath()
    {
        $uri = $this->_newUri();
        $uri->setPath('/very/special/example/');
        $this->assertSame($uri->path, array('very', 'special', 'example'));
    }
    
    public function testSetPath_format()
    {
        $uri = $this->_newUri();
        $uri->setPath('/very/special/example.rss');
        $this->assertSame($uri->path, array('very', 'special', 'example'));
        $this->assertSame($uri->format, 'rss');
        
        $actual = $uri->get();
        $expect = "/index.php/very/special/example.rss?foo=bar&baz=dib";
    }
    
    /**
     * 
     * Test -- Sets the query string in the URI, for Solar_Uri::getQuery() and Solar_Uri::$query.
     * 
     */
    public function testSetQuery()
    {
        $uri = $this->_newUri();
        $uri->setQuery('a=b&c=d');
        $this->assertSame($uri->query, array('a' => 'b', 'c' => 'd'));
    }
}
