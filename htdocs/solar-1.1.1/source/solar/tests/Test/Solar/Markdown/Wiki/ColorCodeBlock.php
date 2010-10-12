<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Wiki_ColorCodeBlock extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Wiki_ColorCodeBlock = array(
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
    
    protected $_source = "foo bar

{{code: php
    phpinfo();
}}

baz dib";
    
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
     * Test -- Makes <pre><code>...</code></pre> blocks and colorizes.
     * 
     */
    public function testParse()
    {
        $actual = $this->_plugin->parse($this->_source);
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
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
        $actual = $this->_render($this->_source);
        $expect = 'foo bar

<pre><code><span style="color: #0000BB">&lt;?php
phpinfo</span><span style="color: #007700">();
</span><span style="color: #0000BB">?&gt;</span></code></pre>

baz dib';
        $this->assertSame(trim($actual), trim($expect));
    }
}
