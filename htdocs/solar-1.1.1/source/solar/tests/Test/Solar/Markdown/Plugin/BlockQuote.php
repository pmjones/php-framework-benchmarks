<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_BlockQuote extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_BlockQuote = array(
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
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('Solar_Markdown_Plugin_BlockQuote');
        $expect = 'Solar_Markdown_Plugin_BlockQuote';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Cleans up the source text after all parsing occurs.
     * 
     */
    public function testCleanup()
    {
        $source = "foo bar baz";
        $expect = $source;
        $actual = $this->_plugin->cleanup($source);
        $this->assertSame($actual, $expect);
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
     * Test -- Makes <blockquote>...</blockquote> tags from email-style block quotes.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "";
        $source[] = "> line 1";
        $source[] = "> line 2";
        $source[] = "> ";
        $source[] = "> line 3";
        $source[] = "> line 4";
        $source[] = "";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar\n";
        $expect[] = $this->_token . "\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    /**
     * 
     * Test -- Prepares the source text before any parsing occurs.
     * 
     */
    public function testPrepare()
    {
        $source = "foo bar baz";
        $expect = $source;
        $actual = $this->_plugin->prepare($source);
        $this->assertSame($actual, $expect);
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
        $source[] = "";
        $source[] = "> line 1";
        $source[] = "> line 2";
        $source[] = "> ";
        $source[] = "> line 3";
        $source[] = "> line 4";
        $source[] = "";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar" . "\n";
        $expect[] = $this->_tag('blockquote');
        $expect[] = "  line 1";
        $expect[] = "  line 2";
        $expect[] = "  ";
        $expect[] = "  line 3";
        $expect[] = "  line 4";
        $expect[] = $this->_tag('/blockquote');
        $expect[] = "";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    
    public function testRender_nested()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "";
        $source[] = "> line 1";
        $source[] = "> line 2";
        $source[] = "> ";
        $source[] = "> > line 3";
        $source[] = "> > line 4";
        $source[] = "> ";
        $source[] = "> line 5";
        $source[] = "> line 6";
        $source[] = "";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect = array();
        $expect[] = "foo bar";
        $expect[] = $this->_tag('blockquote');
        $expect[] = "line 1";
        $expect[] = "line 2";
        $expect[] = $this->_tag('blockquote');
        $expect[] = "line 3";
        $expect[] = "line 4";
        $expect[] = $this->_tag('/blockquote');
        $expect[] = "line 5";
        $expect[] = "line 6";
        $expect[] = $this->_tag('/blockquote');
        $expect[] = "baz dib";
        $expect = implode("\s+", $expect);
        
        $actual = $this->_render($source);
        $this->assertRegex($actual, "@$expect@");
    }
}
