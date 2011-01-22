<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_Link extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_Link = array(
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
     * Test -- Converts Markdown links into XHTML anchors.
     * 
     */
    public function testParse()
    {
        $source = 'foo bar [display text](/path/to/file) baz dib';
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
        $source = 'foo bar [display text](/path/to/file) baz dib';
        $expect = 'foo bar <a href="/path/to/file">display text</a> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_inlineWithTitle()
    {
        $source = 'foo bar [display text](/path/to/file "with title") baz dib';
        $expect = 'foo bar <a href="/path/to/file" title="with title">display text</a> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_inlineWithAngles()
    {
        $source = 'foo bar [display text](</path/to/file>) baz dib';
        $expect = 'foo bar <a href="/path/to/file">display text</a> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_reference()
    {
        $this->_markdown->setLink('display text', '/path/to/file', 'with title');
        
        $source = 'foo bar [display text][] baz dib';
        $expect = 'foo bar <a href="/path/to/file" title="with title">display text</a> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_referenceDifferentAlt()
    {
        $this->_markdown->setLink('display text', '/path/to/file', 'with title');
        
        $source = 'foo bar [inline-text][display text] baz dib';
        $expect = 'foo bar <a href="/path/to/file" title="with title">inline-text</a> baz dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
