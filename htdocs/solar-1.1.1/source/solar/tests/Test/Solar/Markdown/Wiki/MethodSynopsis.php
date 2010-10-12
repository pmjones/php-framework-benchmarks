<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Wiki_MethodSynopsis extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Wiki_MethodSynopsis = array(
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

{{method: methodName
   @access public
   @param  int
   @param  bool, \$var2
   @param  float, \$var3, \"value\"
   @return string
   @throws Class_1
   @throws Class_2
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
     * Test -- Converts method synopsis to XHTML markup.
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

<div class="method-synopsis">
    <span class="access">public</span>
    <span class="return">string</span>
    <span class="method">methodName</span> (
        <span class="param"><span class="type">int</span> <span class="name">$</span>, 
        <span class="param"><span class="type">bool</span> <span class="name">$var2</span>, 
        <span class="param-default"><span class="type">float</span> <span class="name">$var3</span> default <span class="default">&quot;value&quot;</span>
    )
    <span class="throws">throws <span class="type">Class_1</span></span>, 
    <span class="throws">throws <span class="type">Class_2</span></span>
</div>

baz dib';
        $this->assertSame(trim($actual), trim($expect));
    }
}
