<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_Uri extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_Uri = array(
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
     * Test -- Converts inline URIs to anchors.
     * 
     */
    public function testParse()
    {
        $source = 'foo <http://example.com/?foo=bar&baz=dib> bar';
        $expect = "foo $this->_token bar";
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
        $source = '<http://example.com/?foo=bar&baz=dib>';
        $expect = '<a href="http://example.com/?foo=bar&amp;baz=dib">http://example.com/?foo=bar&amp;baz=dib</a>';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_noAngles()
    {
        $source = 'http://example.com/?foo=bar&baz=dib';
        $expect = 'http://example.com/?foo=bar&baz=dib';
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
