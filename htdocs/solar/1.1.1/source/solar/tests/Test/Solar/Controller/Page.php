<?php
/**
 * 
 * Concrete class test using a separate instance.
 * 
 */
class Test_Solar_Controller_Page extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Controller_Page = array(
    );
    
    protected $_page;
    
    protected $_page_class = 'Mock_Solar_Controller_Page';
    
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
        $this->_page = Solar::factory($this->_page_class);
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
        $this->assertInstance($this->_page, 'Solar_Controller_Page');
    }
    
    /**
     * 
     * Test -- Try to force users to define what their view variables are.
     * 
     */
    public function test__get()
    {
        $actual = $this->_page->foo;
        $this->assertSame($this->_page->foo, 'bar');
        
        try {
            $actual = $this->_page->noSuchVar;
            $this->fail('should have thrown exception on no-existing var');
        } catch (Solar_Exception_NoSuchProperty $e) {
            // we expect this, do nothing
        }
    }
    
    /**
     * 
     * Test -- Try to force users to define what their view variables are.
     * 
     */
    public function test__set()
    {
        try {
            $this->_page->foo = 'baz';
        } catch (Exception $e) {
            // should *not* have thrown an exception
            $this->fail('shoud not have thrown exception: ' . $e->__toString());
        }
        
        try {
            $this->_page->zim = 'dib';
            $this->fail('should have thrown exception on non-existing var');
        } catch (Solar_Exception_NoSuchProperty $e) {
            // we expect this, do nothing
        }
        
        // done, we need at least one assertion to pass
        $this->assertSame($this->_page->foo, 'baz');
    }
    
    /**
     * 
     * Test -- Executes the requested action and displays its output.
     * 
     */
    public function testDisplay()
    {
        ob_start();
        $this->_page->display('foo');
        $actual = ob_get_clean();
        $expect = 'foo = bar';
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Executes the requested action and returns its output with layout.
     * 
     */
    public function testFetch()
    {
        $actual = $this->_page->fetch('foo');
        $this->assertEquals($actual->content, 'foo = bar');
        $this->assertEquals($actual->getStatusCode(), 200);
        $this->assertEquals($actual->getVersion(), '1.1');
    }
    
    public function testFetch_hooks()
    {
        // basic hook execution
        $this->_page->fetch();
        $expect = array(
            '_setup'      => 1,
            '_preRun'     => 1,
            '_preAction'  => 1,
            '_postAction' => 1,
            '_postRun'    => 1,
            '_preRender'  => 1,
            '_postRender' => 1,
        );
        $this->assertSame($this->_page->hooks, $expect);
        
        // fetch again; setup should not trigger this time.
        $this->_page->fetch();
        $expect = array(
            '_setup'      => 1,
            '_preRun'     => 2,
            '_preAction'  => 2,
            '_postAction' => 2,
            '_postRun'    => 2,
            '_preRender'  => 2,
            '_postRender' => 2,
        );
        $this->assertSame($this->_page->hooks, $expect);
        
        // fetch **again** with an action that forwards internally;
        // the run hooks should hit once, but the action hooks should 
        // hit twice (once for the orginal method, once for the 
        // forwarded method).
        $this->_page->fetch('test-forward');
        $expect = array(
            '_setup'      => 1,
            '_preRun'     => 3,
            '_preAction'  => 4,
            '_postAction' => 4,
            '_postRun'    => 3,
            '_preRender'  => 3,
            '_postRender' => 3,
        );
        $this->assertSame($this->_page->hooks, $expect);
    }
    
    /**
     * @todo refactor this test so it doesn't concern itself with the internal
     * state of the object so much as the way the internal state adjusts how
     * the object reacts.
     */
    public function testFetch_string()
    {
        $spec = "foo/bar/baz";
        $this->_page->fetch($spec);
        
        // check the action
        $expect = 'foo';
        $this->assertProperty($this->_page, '_action', 'same', $expect);
        
        // check the pathinfo
        $expect = array('bar', 'baz');
        $this->assertProperty($this->_page, '_info', 'same', $expect);
    }
    
    /**
     * @todo refactor this test so it doesn't concern itself with the internal
     * state of the object so much as the way the internal state adjusts how
     * the object reacts.
     */
    public function testFetch_notFound()
    {
        $this->_page->fetch("no-such-action");
        $this->todo('need to rewrite to examine page output');
    }
    
    /**
     * @todo refactor this test so it doesn't concern itself with the internal
     * state of the object so much as the way the internal state adjusts how
     * the object reacts.
     */
    public function testFetch_uri()
    {
        $spec = Solar::factory('Solar_Uri_Action');
        $spec->setPath('/foo/bar/baz');
        $this->_page->fetch($spec);
        
        // check the action
        $expect = 'foo';
        $this->assertProperty($this->_page, '_action', 'same', $expect);
        
        // check the pathinfo
        $expect = array('bar', 'baz');
        $this->assertProperty($this->_page, '_info', 'same', $expect);
    }
    
    public function testFetch_niceActionNames()
    { 
        $expect = "found actionBumpyCase";
        
        $actual = $this->_page->fetch("bumpy-case");
        $this->assertSame($actual->content, $expect);
        
        $actual = $this->_page->fetch("bumpyCase");
        $this->assertSame($actual->content, $expect);
        
        $actual = $this->_page->fetch("BumpyCase");
        $this->assertSame($actual->content, $expect);
    }
    
    public function testFetch_actionDefaultNotFound()
    {
        $this->_page->setActionDefault('no-such-action');
        $this->todo('need to rewrite to examine page output');
    }
    
    public function testFetch_noRelatedView()
    {
        $this->_page->fetch("no-related-view");
        $this->todo('need to rewrite to examine page output');
    }
    
    /**
     * 
     * Test -- Sets the name for this page-controller; generally used only by the  front-controller when static routing leads to this page.
     * 
     */
    public function testSetController()
    {
        $expect = 'testname';
        $this->_page->setController($expect);
        $this->assertProperty($this->_page, '_controller', 'same', $expect);
    }
    
    /**
     * 
     * Test -- Injects the front-controller object that invoked this page-controller.
     * 
     */
    public function testSetFrontController()
    {
        $front = Solar::factory('Solar_Controller_Front');
        $this->_page->setFrontController($front);
        $this->assertProperty($this->_page, '_front', 'same', $front);
    }
}
