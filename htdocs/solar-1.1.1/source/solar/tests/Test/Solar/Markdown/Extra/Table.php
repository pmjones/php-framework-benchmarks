<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Extra_Table extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Extra_Table = array(
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
    
    protected $_plain = "
First Header  | Second Header
------------- | -------------
Content A     | Content C    
Content B     | Content D    
";
    
    protected $_pipes = "
| First Header  | Second Header |
| ------------- | ------------- |
| Content A     | Content C     |
| Content B     | Content D     |
";
    
    protected $_align = "
| Left      | Right     |
| :-------- | --------: |
| Content A | Content C |
| Content B | Content D |
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
     * Test -- Transforms Markdown syntax to XHTML tables.
     * 
     */
    public function testParse()
    {
        $source = "foo bar\n$this->_plain\nbaz dib";
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
   
    public function testParse_pipes()
    {
        $source = "foo bar\n$this->_pipes\nbaz dib";
        $expect = "foo bar\n\n$this->_token\n\nbaz dib";
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
   
    public function testParse_align()
    {
        $source = "foo bar\n$this->_align\nbaz dib";
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
        $source = $this->_plain;
        $actual = $this->_render($source);
        
        $expect = '
<table>
    <thead>
        <tr>
            <th>First Header</th>
            <th>Second Header</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Content A</td>
            <td>Content C</td>
        </tr>
        <tr>
            <td>Content B</td>
            <td>Content D</td>
        </tr>
    </tbody>
</table>';
        
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_pipes()
    {
        $source = $this->_pipes;
        $actual = $this->_render($source);
        
        $expect = '
<table>
    <thead>
        <tr>
            <th>First Header</th>
            <th>Second Header</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Content A</td>
            <td>Content C</td>
        </tr>
        <tr>
            <td>Content B</td>
            <td>Content D</td>
        </tr>
    </tbody>
</table>';
        
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testRender_align()
    {
        $source = $this->_align;
        $actual = $this->_render($source);
        
        $expect = '
<table>
    <thead>
        <tr>
            <th align="left">Left</th>
            <th align="right">Right</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="left">Content A</td>
            <td align="right">Content C</td>
        </tr>
        <tr>
            <td align="left">Content B</td>
            <td align="right">Content D</td>
        </tr>
    </tbody>
</table>';
        
        $this->assertSame(trim($actual), trim($expect));
    }
}
