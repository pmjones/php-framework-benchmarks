<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_PublicHref extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_PublicHref = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns an href to a public resource.
     * 
     */
    public function testPublicHref()
    {
        $actual = $this->_view->publicHref('/path/to/file');
        $expect = '/public/path/to/file';
        $this->assertSame($actual, $expect);
    }
    
    public function testPublicHref_uri()
    {
        $uri = Solar::factory('Solar_Uri_Public');
        $uri->setPath('/path/to/file');
        $uri->setQuery('page=1');
        
        $actual = $this->_view->publicHref($uri);
        $expect = '/public/path/to/file?page=1';
        $this->assertSame($actual, $expect);
    }
    
    public function testPublicHref_raw()
    {
        // should escape
        $actual = $this->_view->publicHref('/path/to/<file>');
        $expect = '/public/path/to/&lt;file&gt;';
        $this->assertSame($actual, $expect);
        
        // should not escape
        $actual = $this->_view->publicHref('/path/to/<file>', true);
        $expect = '/public/path/to/<file>';
        $this->assertSame($actual, $expect);
    }
}
