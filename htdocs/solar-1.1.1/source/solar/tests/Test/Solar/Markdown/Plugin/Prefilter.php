<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_Prefilter extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_Prefilter = array(
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
    protected $_is_span = false;
    
    public function testCleanup()
    {
        $text = 'foo bar baz dib zim gir';
        $actual = $this->_plugin->cleanup($text);
        $expect = $text;
        $this->assertSame($actual, $text);
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
     * Test -- Parses the source text and replaces with HTML or tokens.
     * 
     */
    public function testParse()
    {
        $text = 'foo bar baz dib zim gir';
        $actual = $this->_plugin->parse($text);
        $expect = $text;
        $this->assertSame($actual, $text);
    }
    
    /**
     * 
     * Test -- Pre-filters source text in the preparation phase.
     * 
     */
    public function testPrepare()
    {
        $text = "Basic text\r\nwith dos lines\nand\t\ttabs\n \n \nand blank lines";
        $expect = "Basic text\nwith dos lines\nand     tabs\n\n\nand blank lines\n\n\n";
        $actual = $this->_plugin->prepare($text);
        $this->assertSame($actual, $expect);
    }
    
    public function testPrepare_unixNewlines()
    {
        $text = "\r\n\r\r\n";
        $expect = "\n\n\n\n\n\n";
        $actual = $this->_plugin->prepare($text);
        $this->assertSame($actual, $expect);
    }
    
    public function testPrepare_addNewlines()
    {
        $text = '';
        $expect = "\n\n\n";
        $actual = $this->_plugin->prepare($text);
        $this->assertSame($actual, $expect);
    }
    
    public function testPrepare_tabsToSpaces()
    {
        $text = "1\t\t22\t\t333\t\t4444\t";
        $expect = "1       22      333     4444    \n\n\n";
        $actual = $this->_plugin->prepare($text);
        $this->assertSame($actual, $expect);
    }
    
    public function testPrepare_blankLines()
    {
        $text = "foo\n  \t  \nbar";
        $expect = "foo\n\nbar\n\n\n";
        $actual = $this->_plugin->prepare($text);
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
