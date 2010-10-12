<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Wiki_Link extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Wiki_Link = array(
    );
    
    /**
     * 
     * Is the plugin expected to be a block processor?
     * 
     * @var bool
     * 
     */
    protected $_is_block = false;
    
    /**
     * 
     * Is the plugin expected to be a span processor?
     * 
     * @var bool
     * 
     */
    protected $_is_span = true;
    
    protected $_encode = "\x1BSolar_Markdown_Wiki_Link:.*?\x1B";
    
    /**
     * 
     * Test -- Cleans up text to replace encoded placeholders with anchors.
     * 
     */
    public function testCleanup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Get the list of characters this plugin uses for parsing.
     * 
     */
    public function testGetChars()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the list of interwiki mappings.
     * 
     */
    public function testGetInterwiki()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the list of pages found in the source text.
     * 
     */
    public function testGetPages()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses the source text for wiki page and interwiki links.
     * 
     */
    public function testParse()
    {
        $source = 'foo [[page name]] bar';
        $actual = $this->_plugin->parse($source);
        $expect = "foo {$this->_encode} bar";
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_frag()
    {
        $source = 'foo [[page name#frag]] bar';
        $actual = $this->_plugin->parse($source);
        $expect = "foo {$this->_encode} bar";
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_text()
    {
        $source = 'foo [[page name | text]] bar';
        $actual = $this->_plugin->parse($source);
        $expect = "foo {$this->_encode} bar";
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_atch()
    {
        $source = 'foo [[page name atch]]es bar';
        $actual = $this->_plugin->parse($source);
        $expect = "foo {$this->_encode} bar";
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_combo()
    {
        $source = 'foo [[page name#frag | display]]s bar';
        $actual = $this->_plugin->parse($source);
        $expect = "foo {$this->_encode} bar";
        $this->assertRegex($actual, "@$expect@");
    }
    
    /**
     * 
     * Test -- Resets this plugin for a new transformation.
     * 
     */
    public function testReset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets one anchor attribute.
     * 
     */
    public function testSetAttrib()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets all attributes for one anchor type.
     * 
     */
    public function testSetAttribs()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the callback to check if pages exist.
     * 
     */
    public function testSetCheckPagesCallback()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets one or more interwiki name and href mapping.
     * 
     */
    public function testSetInterwiki()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the "parent" Markdown object.
     * 
     */
    public function testSetMarkdown()
    {
        $this->todo('stub');
    }
    
    public function testRender()
    {
        $source = 'foo [[page name]] bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="/wiki/read/Page_name">page name</a> bar';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_frag()
    {
        $source = 'foo [[page name#frag]] bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="/wiki/read/Page_name#frag">page name#frag</a> bar';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_text()
    {
        $source = 'foo [[page name | text]] bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="/wiki/read/Page_name">text</a> bar';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_atch()
    {
        $source = 'foo [[page name atch]]es bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="/wiki/read/Page_name_atch">page name atches</a> bar';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_combo()
    {
        $source = 'foo [[page name#frag | display]]s bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="/wiki/read/Page_name#frag">displays</a> bar';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_comboCollapse()
    {
        $source = 'foo [[page name#frag | ]]s bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="/wiki/read/Page_name#frag">page names</a> bar';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_interwiki()
    {
        $source = 'foo [[php::print()]] bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="http://php.net/print()">php::print()</a> bar';
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_interwikiFrag()
    {
        $source = 'foo [[php::print() #anchor]] bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="http://php.net/print()#anchor">php::print()#anchor</a> bar';
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_interwikiText()
    {
        $source = 'foo [[php::print() | other]] bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="http://php.net/print()">other</a> bar';
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_interwikiAtch()
    {
        $source = 'foo [[php::print]]ers bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="http://php.net/print">php::printers</a> bar';
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_interwikiCombo()
    {
        $source = 'foo [[php::print()#anchor | print]]ers bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="http://php.net/print()#anchor">printers</a> bar';
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_interwikiComboCollapse()
    {
        $source = 'foo [[php::print#anchor | ]]ers bar';
        $actual = $this->_render($source);
        $expect = 'foo <a href="http://php.net/print#anchor">printers</a> bar';
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_manyPerLine()
    {
        $source = 'foo [[page one]] '
                . 'bar [[page two]] '
                . 'baz [[page three]] '
                . 'dib';
        
        $expect = 'foo <a href="/wiki/read/Page_one">page one</a> '
                . 'bar <a href="/wiki/read/Page_two">page two</a> '
                . 'baz <a href="/wiki/read/Page_three">page three</a> '
                . 'dib';
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_interwikiManyPerLine()
    {
        $source = 'foo [[php::print()]] '
                . 'bar [[php::echo | ]] '
                . 'baz [[php::phpinfo()]] '
                . 'dib';
        
        $expect = 'foo <a href="http://php.net/print()">php::print()</a> '
                . 'bar <a href="http://php.net/echo">echo</a> '
                . 'baz <a href="http://php.net/phpinfo()">php::phpinfo()</a> '
                . 'dib';
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_mixed()
    {
        $source = 'foo [[page one]] '
                . 'bar [[php::print()]] '
                . 'baz [[page two]] '
                . 'dib [[php::echo | ]] '
                . 'zim [[page three]] '
                . 'gir [[php::phpinfo()]] '
                . 'irk';
        
        $expect = 'foo <a href="/wiki/read/Page_one">page one</a> '
                . 'bar <a href="http://php.net/print()">php::print()</a> '
                . 'baz <a href="/wiki/read/Page_two">page two</a> '
                . 'dib <a href="http://php.net/echo">echo</a> '
                . 'zim <a href="/wiki/read/Page_three">page three</a> '
                . 'gir <a href="http://php.net/phpinfo()">php::phpinfo()</a> '
                . 'irk';
                
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
