<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Anchor extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Anchor = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns an anchor tag or anchor href.
     * 
     */
    public function testAnchor()
    {
        // no translation key
        $actual = $this->_view->anchor(
            '/path/to/script.php', 'example'
        );
        $expect = '<a href="/path/to/script.php">example</a>';
        $this->assertSame($actual, $expect);
        
        // translation key
        $actual = $this->_view->anchor(
            '/path/to/script.php', 'ACTION_BROWSE'
        );
        $expect = '<a href="/path/to/script.php">Browse</a>';
        $this->assertSame($actual, $expect);
        
        // with attribs
        $actual = $this->_view->anchor(
            '/path/to/script.php',
            'ACTION_BROWSE',
            array('foo' => 'bar')
        );
        $expect = '<a href="/path/to/script.php" foo="bar">Browse</a>';
        $this->assertSame($actual, $expect);
        
    }
    
    public function testAnchor_uri()
    {
        $uri = Solar::factory('Solar_Uri');
        
        $uri->setPath('/path/to/script.php');
        $uri->setQuery('page=1');
        
        // no translation key
        $actual = $this->_view->anchor($uri, 'example');
        $expect = '<a href="/path/to/script.php?page=1">example</a>';
        $this->assertSame($actual, $expect);
        
        // translation key
        $actual = $this->_view->anchor($uri, 'ACTION_BROWSE');
        $expect = '<a href="/path/to/script.php?page=1">Browse</a>';
        $this->assertSame($actual, $expect);
        
        // with attribs
        $actual = $this->_view->anchor(
            $uri,
            'ACTION_BROWSE',
            array('foo' => 'bar')
        );
        $expect = '<a href="/path/to/script.php?page=1" foo="bar">Browse</a>';
        $this->assertSame($actual, $expect);
    }
}
