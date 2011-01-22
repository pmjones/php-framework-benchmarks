<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Wiki_Header extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Wiki_Header = array(
    );
    
    /**
     * 
     * Is the plugin expected to be a block processor?
     * 
     * @var bool
     * 
     */
    protected $_is_block = true;
    
    /**
     * 
     * Is the plugin expected to be a span processor?
     * 
     * @var bool
     * 
     */
    protected $_is_span = false;
    
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
     * Test -- Turns setext-style headers into XHTML header tags.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "Top-Level Header";
        $source[] = "================";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = $this->_token . "\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    /**
     * 
     * Test -- Resets this plugin to its original state (for multiple parsings).
     * 
     */
    public function testReset()
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
        $source = array();
        $source[] = "foo bar";
        $source[] = "=====";
        $source[] = "Title";
        $source[] = "=====";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h1>Title</h1>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_superSection()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "-------------";
        $source[] = "Super-Section";
        $source[] = "-------------";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h2>Super-Section</h2>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_section()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "Section";
        $source[] = "=======";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h3>Section</h3>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_subSection()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "Sub-Section";
        $source[] = "-----------";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h4>Sub-Section</h4>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_Atx()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "# Title";
        $source[] = "## Super-Section";
        $source[] = "### Section";
        $source[] = "#### Sub-Section";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect = array();
        $expect[] = "foo bar";
        $expect[] = "<h1>Title</h1>\n";
        $expect[] = "<h2>Super-Section</h2>\n";
        $expect[] = "<h3>Section</h3>\n";
        $expect[] = "<h4>Sub-Section</h4>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
