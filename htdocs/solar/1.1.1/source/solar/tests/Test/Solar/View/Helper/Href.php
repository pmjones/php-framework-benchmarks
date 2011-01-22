<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Href extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Href = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns an escaped href or src attribute value for a generic URI.
     * 
     */
    public function testHref()
    {
        $actual = $this->_view->href('/path/to/script.php');
        $expect = '/path/to/script.php';
        $this->assertSame($actual, $expect);
        
        // attribs should not return
        $actual = $this->_view->href(
            '/path/to/script.php', null, array('foo' => 'bar')
        );
        $expect = '/path/to/script.php';
        $this->assertSame($actual, $expect);
    }
    
    public function testHref_uri()
    {
        $uri = Solar::factory('Solar_Uri');
        
        $uri->setPath('/path/to/script.php');
        $uri->setQuery('page=1');
        
        $actual = $this->_view->href($uri);
        $expect = '/path/to/script.php?page=1';
        $this->assertSame($actual, $expect);
    }
    
}
