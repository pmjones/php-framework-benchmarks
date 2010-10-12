<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Path_Stack extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Path_Stack = array(
    );
    
    protected function _postConstruct()
    {
        parent::_postConstruct();
        $this->_support_path = Solar_Class::dir('Mock_Solar_Path_Stack');
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
        $obj = Solar::factory('Solar_Path_Stack');
        $this->assertInstance($obj, 'Solar_Path_Stack');
    }
    
    /**
     * 
     * Test -- Adds one or more directories to the stack.
     * 
     */
    public function testAdd()
    {
        // add to the stack as a shell pathspec
        $stack = Solar::factory('Solar_Path_Stack');
        $stack->add('/path/foo:/path/bar:/path/baz');
        
        $expect = array(
            Solar_Dir::fix('/path/foo/'),
            Solar_Dir::fix('/path/bar/'),
            Solar_Dir::fix('/path/baz/'),
        );
        
        $this->assertSame($stack->get(), $expect);
    }
    
    public function testAdd_byArray()
    {
        $stack = Solar::factory('Solar_Path_Stack');
        $stack->add(array('/path/foo', '/path/bar', '/path/baz'));
        
        $expect = array(
            Solar_Dir::fix('/path/foo/'),
            Solar_Dir::fix('/path/bar/'),
            Solar_Dir::fix('/path/baz/'),
        );
        
        $this->assertSame($stack->get(), $expect);
    }
    
    public function testAdd_byLifo()
    {
        $stack = Solar::factory('Solar_Path_Stack');
        $stack->add('/path/foo');
        $stack->add('/path/bar');
        $stack->add('/path/baz');
        
        $expect = array(
            Solar_Dir::fix('/path/baz/'),
            Solar_Dir::fix('/path/bar/'),
            Solar_Dir::fix('/path/foo/'),
        );
        
        $this->assertSame($stack->get(), $expect);
    }
    
    
    /**
     * 
     * Test -- Finds a file in the path stack.
     * 
     */
    public function testFind()
    {
        // get the stack object FIRST
        $stack = Solar::factory('Solar_Path_Stack');
        
        // now reset the include_path
        $old_path = set_include_path($this->_support_path);
        
        // use the testing directory to look for files
        $path = array(
            "a",
            "b",
            "c",
        );
        
        $stack->add($path[0]);
        $stack->add($path[1]);
        $stack->add($path[2]);
        
        // should find it at a
        $actual = $stack->find('target1');
        $expect = Solar_Dir::fix($path[0]) . 'target1';
        $this->assertSame($actual, $expect);
        
        // should find it at b
        $actual = $stack->find('target2');
        $expect = Solar_Dir::fix($path[1]) . 'target2';
        $this->assertSame($actual, $expect);
        
        // should find it at c
        $actual = $stack->find('target3');
        $expect = Solar_Dir::fix($path[2]) . 'target3';
        $this->assertSame($actual, $expect);
        
        // should not find it at all
        $actual = $stack->find('no_such_file');
        $this->assertFalse($actual);
        
        // put the include_path back
        set_include_path($old_path);
    }
    
    /**
     * 
     * Test -- Finds a file in the path stack using realpath().
     * 
     */
    public function testFindReal()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets a copy of the current stack.
     * 
     */
    public function testGet()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Clears the stack and adds one or more directories.
     * 
     */
    public function testSet()
    {
        $expect = array(
            Solar_Dir::fix('/path/foo/'),
            Solar_Dir::fix('/path/bar/'),
            Solar_Dir::fix('/path/baz/'),
        );
        
        $stack = Solar::factory('Solar_Path_Stack');
        $stack->set('/path/foo:/path/bar:/path/baz');
        $this->assertSame($stack->get(), $expect);
    
    }
    
    public function testSet_byArray()
    {
        $expect = array(
            Solar_Dir::fix('/path/foo/'),
            Solar_Dir::fix('/path/bar/'),
            Solar_Dir::fix('/path/baz/'),
        );
        
        $stack = Solar::factory('Solar_Path_Stack');
        $stack->set($expect);
        $this->assertSame($stack->get(), $expect);
    }
    
}
