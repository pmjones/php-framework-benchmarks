<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Uri_Public extends Test_Solar_Uri {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Uri_Public = array(
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
        $this->assertInstance($obj, 'Solar_Uri_Public');
    }
    
    public function test_zero()
    {
        $uri = $this->_newUri();
        $uri->set('/foo/bar/baz.0#0');
        $actual = $uri->get();
        $expect = "/public/foo/bar/baz.0#0";
        $this->assertSame($actual, $expect);
    }
    
    public function testGet()
    {
        $uri = $this->_newUri();
        $uri->set('Solar/styles/default.css');
        
        // partial fetch
        $this->assertSame($uri->get(), '/public/Solar/styles/default.css');
        
        // full fetch
        $this->assertSame($uri->get(true), 'http://example.com/public/Solar/styles/default.css');
        
    }
    
    public function testQuick()
    {
        $uri = $this->_newUri();
        
        // partial
        $expect = 'Solar/styles/default.css';
        $actual = $uri->quick($expect);
        $this->assertSame($actual, "/public/$expect");
        
        // full
        $expect = 'http://example.com/public/Solar/styles/default.css';
        $actual = $uri->quick($expect, true);
        $this->assertSame($actual, $expect);
    }
}
