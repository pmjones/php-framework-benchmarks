<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_Image extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_Image = array(
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
     * Test -- Get the list of characters this plugin uses for parsing.
     * 
     */
    public function testGetChars()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Span plugin to place image tags.
     * 
     */
    public function testParse()
    {
        $source = 'foo bar ![alt text](/path/to/image) baz dib';
        $expect = "foo bar $this->_token baz dib";
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
        $source = 'foo bar ![alt text](/path/to/image) baz dib';
        $expect = 'foo bar <img src="/path/to/image" alt="alt text" /> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_inlineWithTitle()
    {
        $source = 'foo bar ![alt text](/path/to/image "with title") baz dib';
        $expect = 'foo bar <img src="/path/to/image" alt="alt text" title="with title" /> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_reference()
    {
        $this->_markdown->setLink('alt text', '/path/to/image', 'with title');
        
        $source = 'foo bar ![alt text][] baz dib';
        $expect = 'foo bar <img src="/path/to/image" alt="alt text" title="with title" /> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_referenceDifferentAlt()
    {
        $this->_markdown->setLink('alt text', '/path/to/image', 'with title');
        
        $source = 'foo bar ![inline text][alt text] baz dib';
        $expect = 'foo bar <img src="/path/to/image" alt="inline text" title="with title" /> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
