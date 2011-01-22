<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Extra_DefList extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Extra_DefList = array(
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
    
    protected $_basic = "
Apple
:   Pomaceous fruit of plants of the genus Malus in 
    the family Rosaceae.

Orange
:   The fruit of an evergreen tree of the genus Citrus.
";
    
    protected $_lazy = "
Apple
:   Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.

Orange
:   The fruit of an evergreen tree of the genus Citrus.
";
    
    protected $_multi_def = "
Apple
:   Pomaceous fruit of plants of the genus Malus in 
    the family Rosaceae.
:   An american computer company.

Orange
:   The fruit of an evergreen tree of the genus Citrus.
";
    
    protected $_multi_term = "
Term 1
Term 2
:   Definition a

Term 3
:   Definition b
";
    
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
     * Test -- Processes source text to find definition lists.
     * 
     */
    public function testParse()
    {
        $source = "foo bar\n$this->_basic\nbaz dib";
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_lazy()
    {
        $source = "foo bar\n$this->_lazy\nbaz dib";
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_multiDef()
    {
        $source = "foo bar\n$this->_multi_def\nbaz dib";
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    public function testParse_multiTerm()
    {
        $source = "foo bar\n$this->_multi_term\nbaz dib";
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
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
        $source = $this->_basic;
        $actual = $this->_render($source);
        $expect = '
<dl>
<dt>Apple</dt>
<dd>Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.</dd>

<dt>Orange</dt>
<dd>The fruit of an evergreen tree of the genus Citrus.</dd>
</dl>
';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_lazy()
    {
        $source = $this->_lazy;
        $actual = $this->_render($source);
        $expect = '
<dl>
<dt>Apple</dt>
<dd>Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.</dd>

<dt>Orange</dt>
<dd>The fruit of an evergreen tree of the genus Citrus.</dd>
</dl>
';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_multiDef()
    {
        $source = $this->_multi_def;
        $actual = $this->_render($source);
        $expect = '
<dl>
<dt>Apple</dt>
<dd>Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.</dd>

<dd>An american computer company.</dd>

<dt>Orange</dt>
<dd>The fruit of an evergreen tree of the genus Citrus.</dd>
</dl>
';
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_multiTerm()
    {
        $source = $this->_multi_term;
        $actual = $this->_render($source);
        $expect = '
<dl>
<dt>Term 1</dt>
<dt>Term 2</dt>
<dd>Definition a</dd>

<dt>Term 3</dt>
<dd>Definition b</dd>
</dl>
';
        $this->assertSame(trim($actual), trim($expect));
    }
}
