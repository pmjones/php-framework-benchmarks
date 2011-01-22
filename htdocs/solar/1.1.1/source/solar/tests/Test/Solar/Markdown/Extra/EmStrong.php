<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Extra_EmStrong extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Extra_EmStrong = array(
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
     * Test -- Converts emphasis and strong text.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = "*em*";
        $source[] = "**strong**";
        $source[] = "***strong-em***";
        $source[] = "plain *em* plain **strong** plain ***strong-em*** plain";
        $source = implode(" ", $source);
        
        $expect[] = "{$this->_token}em{$this->_token}";
        $expect[] = "{$this->_token}strong{$this->_token}";
        $expect[] = "{$this->_token}{$this->_token}strong-em{$this->_token}{$this->_token}";
        $expect[] = "plain {$this->_token}em{$this->_token} plain {$this->_token}strong{$this->_token} plain {$this->_token}{$this->_token}strong-em{$this->_token}{$this->_token} plain";
        $expect = implode(" ", $expect);
        
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
        $source[] = "*em*";
        $source[] = "**strong**";
        $source[] = "***strong-em***";
        $source[] = "plain *em* plain **strong** plain ***strong-em*** plain";
        $source = implode(" ", $source);
        
        $expect[] = "<em>em</em>";
        $expect[] = "<strong>strong</strong>";
        $expect[] = "<strong><em>strong-em</em></strong>";
        $expect[] = "plain <em>em</em> plain <strong>strong</strong> plain <strong><em>strong-em</em></strong> plain";
        $expect = implode(" ", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_underscores()
    {
        $source = array();
        $source[] = "_em_";
        $source[] = "__strong__";
        $source[] = "___strong-em___";
        $source[] = "plain _em_ plain __strong__ plain ___strong-em___ plain";
        $source = implode(" ", $source);
        
        $expect[] = "<em>em</em>";
        $expect[] = "<strong>strong</strong>";
        $expect[] = "<strong><em>strong-em</em></strong>";
        $expect[] = "plain <em>em</em> plain <strong>strong</strong> plain <strong><em>strong-em</em></strong> plain";
        $expect = implode(" ", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_mixed()
    {
        $source = array();
        $source[] = "_em_";
        $source[] = "**strong**";
        $source[] = "**_strong-em_**";
        $source[] = "plain _em_ plain __strong__ plain __*strong-em*__ plain";
        $source = implode(" ", $source);
        
        $expect[] = "<em>em</em>";
        $expect[] = "<strong>strong</strong>";
        $expect[] = "<strong><em>strong-em</em></strong>";
        $expect[] = "plain <em>em</em> plain <strong>strong</strong> plain <strong><em>strong-em</em></strong> plain";
        $expect = implode(" ", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testRender_underscoreWords()
    {
        $source = array();
        $source[] = "Solar_Example";
        $source[] = "_Solar_Example_";
        $source[] = "_ Solar_Example _";
        $source = implode(" ", $source);
        
        $expect[] = "Solar_Example";
        $expect[] = "<em>Solar_Example</em>";
        $expect[] = "_ Solar_Example _";
        $expect = implode(" ", $expect);
        
        $actual = $this->_render($source);
        $this->assertSame($actual, $expect);
    }
}
