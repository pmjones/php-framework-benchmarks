<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_ActionHref extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_ActionHref = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns an escaped href or src attribute value for an action URI.
     * 
     */
    public function testActionHref()
    {
        $actual = $this->_view->actionHref('/controller/action/id');
        $expect = '/index.php/controller/action/id';
        $this->assertSame($expect, $actual);
    }
    
    public function testActionHref_uri()
    {
        $uri = Solar::factory('Solar_Uri_Action');
        $uri->setPath('/controller/action/id');
        $uri->setQuery('page=1');
        
        $actual = $this->_view->actionHref($uri);
        $expect = '/index.php/controller/action/id?page=1';
        $this->assertSame($expect, $actual);
    }
}
