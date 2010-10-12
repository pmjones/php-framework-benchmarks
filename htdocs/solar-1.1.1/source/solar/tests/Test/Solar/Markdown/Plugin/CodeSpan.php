<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_CodeSpan extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_CodeSpan = array(
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
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('Solar_Markdown_Plugin_CodeSpan');
        $expect = 'Solar_Markdown_Plugin_CodeSpan';
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
     * Test -- Creates code spans from backtick-delimited text.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = "`code`";
        $source[] = "``code``";
        $source[] = "`` `code` ``";
        $source[] = "plain `code` plain `code`";
        $source = implode("\n", $source);
        
        $expect[] = $this->_token;
        $expect[] = $this->_token;
        $expect[] = $this->_token;
        $expect[] = "plain $this->_token plain $this->_token";
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
}
