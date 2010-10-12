<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Session extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Session = array(
    );
    
    protected $_class;
    
    protected $_session;
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Constructor.
     * 
     * @param array $config User-defined configuration parameters.
     * 
     */
    public function __construct($config = null)
    {
        parent::__construct($config);
        $this->_class = get_class($this);
    }
    
    /**
     * 
     * Setup; runs before each test method.
     * 
     */
    public function preTest()
    {
        parent::preTest();
        $this->_session = Solar::factory('Solar_Session');
        $this->_session->setClass($this->_class);
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
        $obj = Solar::factory('Solar_Session');
        $this->assertInstance($obj, 'Solar_Session');
    }
    
    /**
     * 
     * Test -- Appends a normal value to a key.
     * 
     */
    public function testAdd()
    {
        // add to session object
        $expect = array('bar', 'baz', 'dib');
        foreach ($expect as $val) {
            $this->_session->add('foo', $val);
        }
        
        // check session object
        $actual = $this->_session->get('foo');
        $this->assertSame($actual, $expect);
        
        // check superglobal
        $actual = $_SESSION[$this->_class]['foo'];
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Appends a flash value to a key.
     * 
     */
    public function testAddFlash()
    {
        // add to session object
        $expect = array('bar', 'baz', 'dib');
        foreach ($expect as $val) {
            $this->_session->addFlash('foo', $val);
        }
        
        // test the superglobal value
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // read from the session object
        $actual = $this->_session->getFlash('foo');
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Gets a normal value by key, or an alternative default value if the key does not exist.
     * 
     */
    public function testGet()
    {
        // set the value
        $expect = 'bar';
        $this->_session->set('foo', $expect);
        
        // check the superglobal
        $actual = $_SESSION[$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // read the value from the object
        $actual = $this->_session->get('foo');
        $this->assertSame($actual, $expect);
        
        // ask for nonexistent value and get default instead
        $actual = $this->_session->get('baz', 'dib');
        $expect = 'dib';
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Gets a flash value by key, thereby removing the value.
     * 
     */
    public function testGetFlash()
    {
        // set the value
        $expect = 'bar';
        $this->_session->setFlash('foo', $expect);
        
        // check that it's in the superglobal
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // read the value
        $actual = $this->_session->getFlash('foo');
        $this->assertSame($actual, $expect);
        
        // should have removed it from the superglobal
        $actual = empty($_SESSION['Solar_Session']['flash'][$this->_class]['foo']);
        $this->assertTrue($actual);
        
        // should have removed from the object
        $actual = $this->_session->getFlash('foo');
        $this->assertNull($actual, $expect);
    }
    
    /**
     * 
     * Test -- Whether or not the session currently has a particular flash key stored.
     * 
     */
    public function testHasFlash()
    {
        // set the value
        $expect = 'bar';
        $this->_session->setFlash('foo', $expect);
        
        // check that it's in the superglobal
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // check that it's in the object
        $actual = $this->_session->hasFlash('foo');
        $this->assertTrue($actual);
        
        // should not have removed the value from the superglobal
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Regenerates the session ID and deletes the previous session store.
     * 
     */
    public function testRegenerateId()
    {
        // at the command line, we need to start sessions manually
        session_start();
        
        // get the old ID
        $old = session_id();
        
        // regen the ID. DO NOT output until after regenerating the ID.
        // otherwise it sends the headers, which will cause regenerateID() to
        // faile.
        $this->assertFalse(headers_sent());
        $this->_session->regenerateId();
        $new = session_id();
        
        // check them (now it's safe for output)
        $this->diag("Old ID: $old");
        $this->diag("New ID: $new");
        $this->assertFalse(empty($new));
        $this->assertNotSame($old, $new);
    }
    
    /**
     * 
     * Test -- Resets (clears) all normal keys and values.
     * 
     */
    public function testReset()
    {
        // set the value
        $expect = 'bar';
        $this->_session->set('foo', $expect);
        
        // check in the superglobal
        $actual = $_SESSION[$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // check in the object
        $actual = $this->_session->get('foo');
        $this->assertSame($actual, $expect);
        
        // now reset
        $this->_session->reset();
        $expect = array();
        
        // should not be in the session superglobal
        $actual = $_SESSION[$this->_class];
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Resets both "normal" and "flash" values.
     * 
     */
    public function testResetAll()
    {
        // set the value
        $expect = 'bar';
        $this->_session->set('foo', $expect);
        
        // check in the superglobal
        $actual = $_SESSION[$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // set a flash value
        $this->_session->setFlash('foo', $expect);
        
        // check in the superglobal
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // reset all
        $this->_session->resetAll();
        
        // should be blank in superglobal store ...
        $expect = array();
        $actual = $_SESSION[$this->_class];
        $this->assertSame($actual, $expect);
        
        // ... and in flash.
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class];
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Resets (clears) all flash keys and values.
     * 
     */
    public function testResetFlash()
    {
        // set the value
        $expect = 'bar';
        $this->_session->setFlash('foo', $expect);
        
        // check the superglobal
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
        
        // now reset
        $this->_session->resetFlash();
        
        // check the superglobal
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class];
        $expect = array();
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets a normal value by key.
     * 
     */
    public function testSet()
    {
        // set in the session object
        $expect = 'bar';
        $this->_session->set('foo', $expect);
        
        // check the session object
        $actual = $this->_session->get('foo');
        $this->assertSame($actual, $expect);
        
        // check the superglobal
        $actual = $_SESSION[$this->_class]['foo'];
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets the class segment for $_SESSION.
     * 
     */
    public function testSetClass()
    {
        $expect = get_class($this);
        $this->assertSame($this->_session->getClass(), $expect);
        
        $expect = 'Some_Other_Class';
        $this->_session->setClass($expect);
        $this->assertSame($this->_session->getClass(), $expect);
    }
    
    /**
     * 
     * Test -- Sets a flash value by key.
     * 
     */
    public function testSetFlash()
    {
        $expect = 'bar';
        $this->_session->setFlash('foo', $expect);
        $actual = $_SESSION['Solar_Session']['flash'][$this->_class]['foo'];
        $this->assertSame($actual, $expect);
    }
}
