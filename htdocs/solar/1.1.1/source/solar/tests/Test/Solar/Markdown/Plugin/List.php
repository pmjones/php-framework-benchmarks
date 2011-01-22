<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Plugin_List extends Test_Solar_Markdown_Plugin {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Plugin_List = array(
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
     * Test -- Makes ordered (numbered) and unordered (bulleted) XHTML lists.
     * 
     */
    public function testParse()
    {
        $source = array();
        $source[] = 'foo';
        $source[] = "";
        $source[] = "* foo";
        $source[] = "* bar";
        $source[] = "* baz";
        $source[] = "";
        $source[] = "bar";
        $source[] = "";
        $source[] = "1. dib";
        $source[] = "2. zim";
        $source[] = "3. gir";
        $source[] = "";
        $source[] = "baz";
        $source = implode("\n", $source). "\n\n";
        
        $expect = array();
        $expect[] = 'foo';
        $expect[] = "";
        $expect[] = $this->_token;
        $expect[] = "";
        $expect[] = 'bar';
        $expect[] = "";
        $expect[] = $this->_token;
        $expect[] = "";
        $expect[] = 'baz';
        $expect = implode("\n", $expect);
        
        $actual = $this->_plugin->parse($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    /**
     * 
     * Test -- Resets for a new transformation.
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
    // parse a pair of simple lists
    public function testRender()
    {
        $source = array();
        $source[] = "* foo";
        $source[] = "* bar";
        $source[] = "* baz";
        $source[] = "";
        $source[] = "sep";
        $source[] = "";
        $source[] = "1. dib";
        $source[] = "2. zim";
        $source[] = "3. gir";
        $source = implode("\n", $source). "\n\n";
        
        $expect = array();
        $expect[] = $this->_tag('ul');
        $expect[] = $this->_tag('li') . "foo" . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "bar" . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "baz" . $this->_tag('/li');
        $expect[] = $this->_tag('/ul');
        $expect[] = "";
        $expect[] = "sep";
        $expect[] = "";
        $expect[] = $this->_tag('ol');
        $expect[] = $this->_tag('li') . "dib" . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "zim" . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "gir" . $this->_tag('/li');
        $expect[] = $this->_tag('/ol');
        $expect = implode("\n*", $expect);
        
        $actual = $this->_render($source);
        $this->assertRegex($actual, "@$expect@");
    }
    
    // parse a nested list series
    public function testRender_nested()
    {
        $source[] = "* foo";
        $source[] = "\t* bar";
        $source[] = "\t* baz";
        $source[] = "* dib";
        $source[] = "\t* zim";
        $source[] = "\t* gir";
        $source = implode("\n", $source). "\n\n";
        
        $expect = array();
        $expect[] = $this->_tag('ul');
        $expect[] = $this->_tag('li') . "foo";
        $expect[] = $this->_tag('ul');
        $expect[] = $this->_tag('li') . "bar" . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "baz" . $this->_tag('/li');
        $expect[] = $this->_tag('/ul') . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "dib";
        $expect[] = $this->_tag('ul');
        $expect[] = $this->_tag('li') . "zim" . $this->_tag('/li');
        $expect[] = $this->_tag('li') . "gir" . $this->_tag('/li');
        $expect[] = $this->_tag('/ul') . $this->_tag('/li');
        $expect[] = $this->_tag('/ul');
        $expect = implode('\s*', $expect);
        
        $actual = $this->_render($source);
        $this->assertRegex($actual, "@$expect@");
    }
}
