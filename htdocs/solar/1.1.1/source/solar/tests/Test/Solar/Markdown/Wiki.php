<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Markdown_Wiki extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Markdown_Wiki = array(
    );
    
    protected $_markdown;
    
    protected function _tidy($text)
    {
        // tidy up the text
        $tidy = new tidy;
        $tidy->parseString($text, array(), 'utf8');
        $tidy->cleanRepair();
        
        // get only the body portion
        $body = tidy_get_body($tidy);
        return $body->value;
    }
    
    public function preTest()
    {
        parent::preTest();
        $this->_markdown = Solar::factory('Solar_Markdown_Wiki');
    }
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('Solar_Markdown_Wiki');
        $expect = 'Solar_Markdown_Wiki';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Runs the processed text through each plugin's cleanup() method.
     * 
     */
    public function testCleanup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Encodes special Markdown characters so they are not recognized when parsing.
     * 
     */
    public function testEncode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Escapes HTML in source text.
     * 
     */
    public function testEscape()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the href and title of a named link reference.
     * 
     */
    public function testGetLink()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array of all defined link references.
     * 
     */
    public function testGetLinks()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an internal Markdown plugin object for direct manipulation and inspection.
     * 
     */
    public function testGetPlugin()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the number of spaces per tab.
     * 
     */
    public function testGetTabWidth()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is a piece of text a delimited HTML token?
     * 
     */
    public function testIsHtmlToken()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Prepares the text for processing by running the prepare()  method of each plugin, in order, on the source text.
     * 
     */
    public function testPrepare()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs the source text through all block-type plugins.
     * 
     */
    public function testProcessBlocks()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs the source text through all span-type plugins.
     * 
     */
    public function testProcessSpans()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a final rendering of the processed text.
     * 
     */
    public function testRender()
    {
        if (! extension_loaded('tidy')) {
            $this->skip("Tidy extension not loaded");
        }
        
        $dir = Solar_Class::dir('Mock_Solar_Markdown_Wiki');
        $text_file = $dir . 'basic.text';
        $html_file = $dir . 'basic.html';
        
        $source = file_get_contents($text_file);
        $actual = $this->_tidy($this->_markdown->transform($source));
        $expect = $this->_tidy(file_get_contents($html_file));
        
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Resets Markdown and all its plugins for a new transformation.
     * 
     */
    public function testReset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the value of a named link reference.
     * 
     */
    public function testSetLink()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Saves a pieces of text as HTML and returns a delimited token.
     * 
     */
    public function testToHtmlToken()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- One-step transformation of source text using plugins.
     * 
     */
    public function testTransform()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Un-encodes special Markdown characters.
     * 
     */
    public function testUnEncode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Replaces all HTML tokens in source text with saved HTML.
     * 
     */
    public function testUnHtmlToken()
    {
        $this->todo('stub');
    }
}
