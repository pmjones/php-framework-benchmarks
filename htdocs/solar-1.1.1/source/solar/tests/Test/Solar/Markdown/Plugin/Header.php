<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_Header extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_Header = array(
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
     * Test -- Get the list of characters this plugin uses for parsing.
     * 
     */
    public function testGetChars()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Turns ATX- and setext-style headers into XHTML header tags.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "Top-Level Header";
        $source[] = "================";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = $this->_token . "\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
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
        $source = array();
        $source[] = "foo bar";
        $source[] = "Top-Level Header";
        $source[] = "================";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h1>Top-Level Header</h1>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_sub()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "Sub-Level Header";
        $source[] = "----------------";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h2>Sub-Level Header</h2>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_atx()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "# 1";
        $source[] = "## 2";
        $source[] = "### 3";
        $source[] = "#### 4";
        $source[] = "##### 5";
        $source[] = "###### 6";
        $source[] = "####### 7";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h1>1</h1>\n";
        $expect[] = "<h2>2</h2>\n";
        $expect[] = "<h3>3</h3>\n";
        $expect[] = "<h4>4</h4>\n";
        $expect[] = "<h5>5</h5>\n";
        $expect[] = "<h6>6</h6>\n";
        $expect[] = "<h6># 7</h6>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_atxTrailingHashes()
    {
        $source = array();
        $source[] = "foo bar";
        $source[] = "# 1 #";
        $source[] = "# 2 ##";
        $source[] = "# 5 ###";
        $source[] = "baz dib";
        $source = implode("\n", $source);
        
        $expect[] = "foo bar";
        $expect[] = "<h1>1</h1>\n";
        $expect[] = "<h1>2</h1>\n";
        $expect[] = "<h1>5</h1>\n";
        $expect[] = "baz dib";
        $expect = implode("\n", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
