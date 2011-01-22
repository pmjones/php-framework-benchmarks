<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_HorizRule extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_HorizRule = array(
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
     * Test -- Replaces markup for horizontal rules.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "---";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect = array();
        $expect[] = "foo bar\n";
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
        $source[] = "-";
        $source[] = "--";
        $source[] = "---";
        $source[] = "----";
        $source[] = "- - -";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect = array();
        $expect[] = "foo bar";
        $expect[] = "-";
        $expect[] = "--";
        $expect[] = "\n<hr />\n";
        $expect[] = "\n<hr />\n";
        $expect[] = "\n<hr />\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_starsUnderscores()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "-";
        $source[] = "--";
        $source[] = "***";
        $source[] = "___";
        $source[] = "* * *";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect = array();
        $expect[] = "foo bar";
        $expect[] = "-";
        $expect[] = "--";
        $expect[] = "\n<hr />\n";
        $expect[] = "\n<hr />\n";
        $expect[] = "\n<hr />\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
