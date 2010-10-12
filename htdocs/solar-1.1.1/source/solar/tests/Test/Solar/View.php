<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View = array(
    );
    
    protected $_view;
    
    public function preTest()
    {
        $this->_view = Solar::factory('Solar_View');
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
        $this->assertInstance($this->_view, 'Solar_View');
    }
    
    /**
     * 
     * Test -- Executes a helper method with arbitrary parameters.
     * 
     */
    public function test__call()
    {
        $expect = 'NO_SUCH_LOCALE_KEY';
        $actual = $this->_view->getTextRaw($expect);
        $this->assertEquals($actual, $expect);
    }
    
    /**
     * 
     * Test -- Disallows setting of underscore-prefixed variables.
     * 
     */
    public function test__set()
    {
        $this->_view->foo = 'bar';
        $this->assertTrue($this->_view->foo === 'bar');
    }
    
    /**
     * 
     * Test -- Add to the helper class stack.
     * 
     */
    public function testAddHelperClass()
    {
        $this->_view->addHelperClass('Other_Helper_Foo');
        $this->_view->addHelperClass('Other_Helper_Bar');
        $actual = $this->_view->getHelperClass();
        $expect = array (
            0 => 'Other_Helper_Bar_',
            1 => 'Other_Helper_Foo_',
            2 => 'Solar_View_Helper_',
        );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Add to the template directory path stack.
     * 
     */
    public function testAddTemplatePath()
    {
        $this->_view->addTemplatePath('path/foo/');
        $this->_view->addTemplatePath('path/bar/');
        $this->_view->addTemplatePath('path/baz/');
        $actual = $this->_view->getTemplatePath();
        $expect = array(
            0 => 'path/baz/',
            1 => 'path/bar/',
            2 => 'path/foo/',
        );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets variables for the view.
     * 
     */
    public function testAssign()
    {
        $this->_view->assign('foo', 'bar');
        $this->assertTrue($this->_view->foo === 'bar');
    }
    
    public function testAssign_byArray()
    {
        $array = array('foo' => 'bar');
        $this->_view->assign($array);
        $this->assertTrue($this->_view->foo === 'bar');
    }
    
    public function testAssign_byObject()
    {
        $obj = new StdClass();
        $obj->foo = 'bar';
        $this->_view->assign($obj);
        $this->assertTrue($this->_view->foo === 'bar');
    }
    
    /**
     * 
     * Test -- Displays a template directly.
     * 
     */
    public function testDisplay()
    {
        $dir = Solar_Class::dir('Mock_Solar_View');
        $this->_view->addTemplatePath($dir);
        $this->_view->foo = 'bar';
        ob_start();
        $this->_view->display('test.view.php');
        $actual = ob_get_clean();
        $expect = 'bar';
        $this->assertSame($expect, $actual);
    }
    
    /**
     * 
     * Test -- Built-in helper for escaping output.
     * 
     */
    public function testEscape()
    {
        $string = "hello <there> i'm a \"quote\"";
        $expect = htmlspecialchars($string);
        $actual = $this->_view->escape($string);
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Fetches template output.
     * 
     */
    public function testFetch()
    {
        $dir = Solar_Class::dir('Mock_Solar_View');
        $this->_view->addTemplatePath($dir);
        $this->_view->foo = 'bar';
        $actual = $this->_view->fetch('test.view.php');
        $expect = 'bar';
        $this->assertSame($expect, $actual);
    }
    
    /**
     * 
     * Test -- Returns an internal helper object; creates it as needed.
     * 
     */
    public function testGetHelper()
    {
        // should reference the same object
        $a = $this->_view->getHelper('getTextRaw');
        $b = $this->_view->getHelper('getTextRaw');
        $this->assertSame($a, $b);
    }
    
    /**
     * 
     * Test -- Returns the helper class stack.
     * 
     */
    public function testGetHelperClass()
    {
        $actual = $this->_view->getHelperClass();
        $expect = array (
            0 => 'Solar_View_Helper_',
        );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Returns the template directory path stack.
     * 
     */
    public function testGetTemplatePath()
    {
        $this->_view->addTemplatePath(dirname(__FILE__) . '/View/templates/');
        $actual = $this->_view->getTemplatePath();
        $expect = array(0 => dirname(__FILE__) . '/View/templates/');
        $this->assertSame($expect, $actual);
    }
    
    /**
     * 
     * Test -- Creates a new standalone helper object.
     * 
     */
    public function testNewHelper()
    {
        // should *not* reference the same object
        $a = $this->_view->newHelper('getTextRaw');
        $b = $this->_view->newHelper('getTextRaw');
        $this->assertNotSame($a, $b);
    }
    
    /**
     * 
     * Test -- Executes a partial template in its own scope, optionally with  variables into its within its scope.
     * 
     */
    public function testPartial()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Reset the helper class stack.
     * 
     */
    public function testSetHelperClass()
    {
        $this->_view->setHelperClass('Other_Helper_Foo');
        $actual = $this->_view->getHelperClass();
        $expect = array(
            0 => 'Other_Helper_Foo_',
            1 => 'Solar_View_Helper_',
        );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Reset the template directory path stack.
     * 
     */
    public function testSetTemplatePath()
    {
        $this->_view->setTemplatePath('path/foo/');
        $actual = $this->_view->getTemplatePath();
        $expect = array(
            0 => 'path/foo/',
        );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Returns the path to the requested template script.
     * 
     */
    public function testTemplate()
    {
        $dir = Solar_Class::dir('Mock_Solar_View');
        $this->_view->addTemplatePath($dir);
        $actual = $this->_view->template('test.view.php');
        $expect = $dir . 'test.view.php';
        $this->assertSame($expect, $actual);
    }
}
