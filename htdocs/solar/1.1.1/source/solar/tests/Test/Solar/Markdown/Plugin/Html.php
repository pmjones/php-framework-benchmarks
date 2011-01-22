<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_Html extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_Html = array(
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
     * Test -- When cleaning up after parsing, replace all HTML tokens with their saved blocks.
     * 
     */
    public function testCleanup()
    {
        $source = <<<EOT
foo bar

<div onclick="return alert('xss');">
    <p>zim gir</p>
</div>

baz dib
EOT;
        $expect = <<<EOT
foo bar



<div onclick="return alert('xss');">
    <p>zim gir</p>
</div>



baz dib
EOT;
        $result = $this->_plugin->parse($source);
        $actual = $this->_plugin->cleanup($result);
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
     * Test -- Removes HTML blocks and replaces with delimited tokens.
     * 
     */
    public function testParse()
    {
        $source = <<<EOT
foo bar

<div onclick="return alert('xss');">
    <p>zim gir</p>
</div>

baz dib
EOT;
        
        $expect = "foo bar\n\s+" . $this->_token . "\n\s+baz dib";
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "/$expect/");
    }
    
    /**
     * 
     * Test -- When preparing text for parsing, remove pre-existing HTML blocks.
     * 
     */
    public function testPrepare()
    {
        $this->todo('stub');
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
