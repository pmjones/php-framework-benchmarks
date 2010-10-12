<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Head extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Head = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Adds a <link> tag.
     * 
     */
    public function testAddLink()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <meta> tag.
     * 
     */
    public function testAddMeta()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <meta> HTTP-Equivalent tag.
     * 
     */
    public function testAddMetaHttp()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <meta> name tag.
     * 
     */
    public function testAddMetaName()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <script> tag as part of the "additional" (override) scripts.
     * 
     */
    public function testAddScript()
    {
        $this->todo('stub');
    }
    
    // public function testAddFile()
    // {
    //     $this->markTestSkipped('brittle test');
    //     $helper = $this->_view->js()->addFile('foo.js')
    //                                 ->addFile('bar.js');
    //     
    //     $expect = array(
    //         0 => 'foo.js',
    //         1 => 'bar.js'
    //     );
    //     $this->assertProperty($helper, 'files', 'same', $expect);
    //     
    //     // check for fluency
    //     $this->assertInstance($helper, 'Solar_View_Helper_Js');
    //     $this->assertSame($helper, $this->_view->getHelper('js'));
    // }
    // 
    // public function testFetch_Files_Inline()
    // {
    //     
    //     // one second highlight of #test
    //     $this->_view->jsScriptaculous()->effect->highlight('#test', array('duration' => 1));
    //     
    //     $helper = $this->_view->js()->addFile('foo.js')
    //                                 ->addFile('bar.js');
    //     
    //     $actual = $helper->fetchFiles();
    //     $actual .= $helper->fetchInline();
    //     
    //     $expect = '    <script src="/public/Solar/scripts/prototype/prototype.js" type="text/javascript"></script>'."\n";
    //     $expect .= '    <script src="/public/Solar/scripts/scriptaculous/effects.js" type="text/javascript"></script>'."\n";
    //     $expect .= '    <script src="/public/foo.js" type="text/javascript"></script>'."\n";
    //     $expect .= '    <script src="/public/bar.js" type="text/javascript"></script>'."\n";
    //     $expect .= '<script type="text/javascript">'."\n";
    //     $expect .= "//<![CDATA[\n";
    //     $expect .= "Event.observe(window,'load',function() {\n";
    //     $expect .= "    \$\$('#test').each(function(el){\n";
    //     $expect .= "        new Effect.Highlight(el, {\"duration\":1});\n";
    //     $expect .= "    });\n";
    //     $expect .= "});\n";
    //     $expect .= "//]]>\n";
    //     $expect .= "</script>\n";
    //     $this->assertSame(trim($actual), trim($expect));
    // }
    // 
    // public function testReset()
    // {
    //     $this->markTestSkipped('brittle test');
    //     $helper = $this->_view->js()->addFile('foo.js')
    //                                 ->addFile('bar.js');
    //     
    //     $expect = array(
    //         0 => 'foo.js',
    //         1 => 'bar.js'
    //     );
    //     $this->assertProperty($helper, 'files', 'same', $expect);
    //     
    //     $helper = $this->_view->js()->reset();
    //     
    //     $expect = array();
    //     $this->assertProperty($helper, 'files', 'same', $expect);
    //     $this->assertProperty($helper, 'scripts', 'same', $expect);
    //     $this->assertProperty($helper, 'selectors', 'same', $expect);
    //     
    //     // check for fluency
    //     $this->assertInstance($helper, 'Solar_View_Helper_Js');
    //     $this->assertSame($helper, $this->_view->getHelper('js'));
    // }
    // 
    // public function testAddFile_Array()
    // {
    //     $this->markTestSkipped('brittle test');
    //     
    //     $files = array('foo.js', 'bar.js');
    //     $helper = $this->_view->js()->addFile($files);
    //     $expect = array(
    //         0 => 'foo.js',
    //         1 => 'bar.js'
    //     );
    //     $this->assertProperty($helper, 'files', 'same', $expect);
    //     
    //     // check for fluency
    //     $this->assertInstance($helper, 'Solar_View_Helper_Js');
    //     $this->assertSame($helper, $this->_view->getHelper('js'));
    // }
    
    /**
     * 
     * Test -- Adds a <script> tag as part of the "baseline" (foundation) scripts.
     * 
     */
    public function testAddScriptBase()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <script> tag with inline code.
     * 
     */
    public function testAddScriptInline()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <style> tag as part of the "additional" (override) styles.
     * 
     */
    public function testAddStyle()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a <style> tag as part of the "baseline" (foundation) styles.
     * 
     */
    public function testAddStyleBase()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Builds and returns all the tags for the <head> section.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Main helper method; fluent interface.
     * 
     */
    public function testHead()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the <base> URI string.
     * 
     */
    public function testSetBase()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the indent string.
     * 
     */
    public function testSetIndent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the <title> string.
     * 
     */
    public function testSetTitle()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Appends to the end of the current <title> string.
     * 
     */
    public function testAddTitle()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the current title string.
     * 
     */
    public function testGetTitle()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Prepends to the beginning of the current <title> string.
     * 
     */
    public function testPreTitle()
    {
        $this->todo('stub');
    }
}
