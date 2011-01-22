<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Markdown_Plugin extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin = array(
    );
    
    /**
     * 
     * Is the plugin expected to be a block processor?
     * 
     * @var bool
     * 
     */
    protected $_is_block;
    
    /**
     * 
     * Is the plugin expected to be a cleanup processor?
     * 
     * @var bool
     * 
     */
    protected $_is_cleanup;
    
    /**
     * 
     * Is the plugin expected to be a prepare processor?
     * 
     * @var bool
     * 
     */
    protected $_is_prepare;
    
    /**
     * 
     * Is the plugin expected to be a span processor?
     * 
     * @var bool
     * 
     */
    protected $_is_span;
    
    /**
     * 
     * A markdown instance to test rendering.
     * 
     * @var Solar_Markdown
     * 
     */
    protected $_markdown;
    
    /**
     * 
     * An instance of the plugin being tested.
     * 
     * @var Solar_Markdown_Plugin
     * 
     */
    protected $_plugin;
    
    protected $_token = "\x0E.*?\x0F";
    
    protected $_encode = "\x02.*?\x03";
    
    protected function _render($text)
    {
        if (is_bool($this->_is_span) && $this->_is_span) {
            $text = $this->_markdown->prepare($text);
            $text = $this->_markdown->processSpans($text);
            $text = $this->_markdown->cleanup($text);
            $text = $this->_markdown->render($text);
            return $text;
        }
        
        if (is_bool($this->_is_block) && $this->_is_block) {
            return $this->_markdown->transform($text);
        }
        
        $this->fail('cannot render non-block non-span plugins');
    }
    
    protected function _tag($tag)
    {
        return "\s*<$tag>\s*";
    }
    
    /**
     * 
     * Pre-test setup.
     * 
     * @return void
     * 
     */
    public function preTest()
    {
        // limit Markdown to the one plugin we're testing
        $this->_plugin_class = substr(get_class($this), 5);
        $config['plugins'] = array($this->_plugin_class);
        $this->_markdown = Solar::factory('Solar_Markdown', $config);
        
        // get the plugin
        $config['markdown'] = $this->_markdown;
        $this->_plugin = Solar::factory($this->_plugin_class, $config);
    }
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory($this->_plugin_class);
        $expect = $this->_plugin_class;
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Cleans up the source text after all parsing occurs.
     * 
     */
    public function testCleanup()
    {
        // should show no changes
        $source = "foo bar baz";
        $expect = $source;
        $actual = $this->_plugin->cleanup($source);
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
     * Test -- Is this a block-level plugin?
     * 
     */
    public function testIsBlock()
    {
        if (! is_bool($this->_is_block)) {
            $this->todo('need to set $_is_block test property');
        }
        
        $actual = $this->_plugin->isBlock();
        $expect = $this->_is_block;
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Run this plugin during the "cleanup" phase?
     * 
     */
    public function testIsCleanup()
    {
        if (! is_bool($this->_is_cleanup)) {
            $this->todo('need to set $_is_cleanup test property');
        }
        
        $actual = $this->_plugin->isCleanup();
        $expect = $this->_is_cleanup;
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Run this plugin during the "prepare" phase?
     * 
     */
    public function testIsPrepare()
    {
        if (! is_bool($this->_is_prepare)) {
            $this->todo('need to set $_is_prepare test property');
        }
        
        $actual = $this->_plugin->isPrepare();
        $expect = $this->_is_prepare;
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Is this a span-level plugin?
     * 
     */
    public function testIsSpan()
    {
        if (! is_bool($this->_is_span)) {
            $this->todo('need to set $_is_span test property');
        }
        
        $actual = $this->_plugin->isSpan();
        $expect = $this->_is_span;
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Parses the source text and replaces with HTML or tokens.
     * 
     */
    public function testParse()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Prepares the source text before any parsing occurs.
     * 
     */
    public function testPrepare()
    {
        // should show no changes
        $source = "foo bar baz";
        $expect = $source;
        $actual = $this->_plugin->prepare($source);
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
    
    public function testRender()
    {
        $this->todo('test rendering variations for this plugin');
    }
}
