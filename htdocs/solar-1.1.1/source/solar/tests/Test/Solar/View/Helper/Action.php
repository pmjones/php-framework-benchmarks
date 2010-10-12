<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Action extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Action = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns an action anchor, or just an action href.
     * 
     */
    public function testAction()
    {
        // no translation key
        $actual = $this->_view->action('/controller/action/id', 'example');
        $expect = '<a href="/index.php/controller/action/id">example</a>';
        $this->assertSame($expect, $actual);
        
        // translation key
        $actual = $this->_view->action('/controller/action/id', 'ACTION_BROWSE');
        $expect = '<a href="/index.php/controller/action/id">Browse</a>';
        $this->assertSame($expect, $actual);
    }
    
    public function testAction_attribs()
    {
        $attribs = array('foo' => 'bar');
        
        // no translation key
        $actual = $this->_view->action('/controller/action/id', 'example', $attribs);
        $expect = '<a href="/index.php/controller/action/id" foo="bar">example</a>';
        $this->assertSame($expect, $actual);
        
        // translation key
        $actual = $this->_view->action('/controller/action/id', 'ACTION_BROWSE', $attribs);
        $expect = '<a href="/index.php/controller/action/id" foo="bar">Browse</a>';
        $this->assertSame($expect, $actual);
    }
    
    public function testAction_uri()
    {
        $uri = Solar::factory('Solar_Uri_Action');
        $uri->setPath('/controller/action/id');
        $uri->setQuery('page=1');
        
        // no translation key
        $actual = $this->_view->action($uri, 'example');
        $expect = '<a href="/index.php/controller/action/id?page=1">example</a>';
        $this->assertSame($expect, $actual);
        
        // translation key
        $actual = $this->_view->action($uri, 'ACTION_BROWSE');
        $expect = '<a href="/index.php/controller/action/id?page=1">Browse</a>';
        $this->assertSame($expect, $actual);
    }
}
