<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_StripLinkDefs extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_StripLinkDefs = array(
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
     * Test -- Removes link definitions from source and saves for later use.
     * 
     */
    public function testPrepare()
    {
        $source   = array();
        $source[] = "foo bar";
        $source[] = "[a]:         href1";
        $source[] = "[b]:         href2 \"Title2\"";
        $source[] = "[c]:         href3\n    \"Title3\"";
        $source[] = "[UpperCase]: href4";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect = "foo bar\nbaz dib";
        $actual = $this->_plugin->prepare($source);
        $this->assertSame($actual, $expect);
    }
    
    
    public function testPrepare_getLinks()
    {
        $source   = array();
        $source[] = "foo bar";
        $source[] = "[a]: href1";
        $source[] = "[b]: href2 \"Title2\"";
        $source[] = "[c]: href3\n    \"Title3\"";
        $source[] = "[UpperCase]: href4";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $this->_plugin->prepare($source);
        
        $expect = array(
            'a' => array(
                'href' => 'href1',
                'title' => null,
            ),
            'b' => array(
                'href' => 'href2',
                'title' => 'Title2',
            ),
            'c' => array(
                'href' => 'href3',
                'title' => 'Title3',
            ),
            'uppercase' => array(
                'href' => 'href4',
                'title' => null,
            ),
        );
        
        $actual = $this->_markdown->getLinks();
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
