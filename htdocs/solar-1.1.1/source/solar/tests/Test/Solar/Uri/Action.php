<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Uri_Action extends Test_Solar_Uri {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Uri_Action = array(
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
        $obj = $this->_newUri();
        $this->assertInstance($obj, 'Solar_Uri_Action');
    }
    
    public function test_zero()
    {
        $uri = $this->_newUri();
        $uri->set('/foo/bar/baz.0#0');
        $actual = $uri->get();
        $expect = "/index.php/foo/bar/baz.0#0";
        $this->assertSame($actual, $expect);
    }
    
    public function testGet()
    {
        $uri = $this->_newUri();
        $uri->set('/controller/action/id/?page=1');
        
        // partial fetch
        $this->assertSame($uri->get(), '/index.php/controller/action/id?page=1');
        
        // full fetch
        $this->assertSame($uri->get(true), 'http://example.com/index.php/controller/action/id?page=1');
    }
    
    public function testQuick()
    {
        $uri = $this->_newUri();
        
        // partial
        $actual = $uri->quick('/controller/action/id?foo=bar');
        $expect = '/index.php/controller/action/id?foo=bar';
        $this->assertSame($actual, $expect);
        
        // semi-partial
        $expect = '/index.php/controller/action/id?foo=bar';
        $actual = $uri->quick($expect);
        $this->assertSame($actual, $expect);
        
        // full
        $expect = 'http://example.com/index.php/controller/action?foo=bar';
        $actual = $uri->quick($expect, true);
        $this->assertSame($actual, $expect);
    }
}
