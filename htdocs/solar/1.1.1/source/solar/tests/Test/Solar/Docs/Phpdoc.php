<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Docs_Phpdoc extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Docs_Phpdoc = array(
    );
    
    protected $_phpdoc;
    
    public function preTest()
    {
        $this->_phpdoc = Solar::factory('Solar_Docs_Phpdoc');
    }
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $obj = Solar::factory('Solar_Docs_Phpdoc');
        $this->assertInstance($obj, 'Solar_Docs_Phpdoc');
    }
    
    /**
     * 
     * Test -- Returns docblock comment parsed into summary, narrative, and technical information portions.
     * 
     */
    public function testParse()
    {
        $source = '
            /**
             * 
             * This is the initial summary line; note how it passes over
             * two lines. Fuller description of the method.  Lorem ipsum
             * dolor sit amet, consectetuer adipiscing elit. Nunc porta
             * libero quis orci.
             * 
             * @param string $var1 Parameter summary for $var1.  Lorem ipsum
             * dolor sit amet, consectetuer adipiscing elit.
             * 
             * @param object No variable name.
             * 
             * @param int
             * 
             * @param array $var4
             * 
             * @return object Return summary.
             * 
             * @throws Solar_Exception Throws summary.
             * 
             * @see Some other item.
             * 
             * @todo Do this later.
             * 
             */';
    
        $expect = array(
            'summ' => "This is the initial summary line; note how it passes over two lines.",
            'narr' => "Fuller description of the method.  Lorem ipsum\ndolor sit amet, consectetuer adipiscing elit. Nunc porta\nlibero quis orci.",
            'tech' => array(
                'param' => array(
                    'var1' => array(
                        'type' => 'string',
                        'summ' => 'Parameter summary for $var1.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
                    ),
                    1 => array(
                        'type' => 'object',
                        'summ' => 'No variable name.',
                    ),
                    2 => array(
                        'type' => 'int',
                        'summ' => '',
                    ),
                    'var4' => array(
                        'type' => 'array',
                        'summ' => '',
                    ),
                ),
                'return' => array(
                    'type' => 'object',
                    'summ' => 'Return summary.',
                ),
                'see' => array('Some other item.'),
                'todo' => array('Do this later.'),
                'throws' => array(
                    array(
                        'type' => 'Solar_Exception',
                        'summ' => 'Throws summary.',
                    ),
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertEquals($actual, $expect);
    }
    
    public function testParse_compressed()
    {
        $source = '
            /**
             * This is the initial summary line; note how it passes over
             * two lines. Fuller description of the method.  Lorem ipsum
             * dolor sit amet, consectetuer adipiscing elit. Nunc porta
             * libero quis orci.
             * 
             * @param string $var1 Parameter summary for $var1.  Lorem ipsum
             * dolor sit amet, consectetuer adipiscing elit.
             * @param object No variable name.
             * @param int
             * @param array $var4
             * @return object Return summary.
             * @throws Solar_Exception Throws summary.
             * @see Some other item.
             * @todo Do this later.
             */';
    
        $expect = array(
            'summ' => "This is the initial summary line; note how it passes over two lines.",
            'narr' => "Fuller description of the method.  Lorem ipsum\ndolor sit amet, consectetuer adipiscing elit. Nunc porta\nlibero quis orci.",
            'tech' => array(
                'param' => array(
                    'var1' => array(
                        'type' => 'string',
                        'summ' => 'Parameter summary for $var1.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
                    ),
                    1 => array(
                        'type' => 'object',
                        'summ' => 'No variable name.',
                    ),
                    2 => array(
                        'type' => 'int',
                        'summ' => '',
                    ),
                    'var4' => array(
                        'type' => 'array',
                        'summ' => '',
                    ),
                ),
                'return' => array(
                    'type' => 'object',
                    'summ' => 'Return summary.',
                ),
                'see' => array('Some other item.'),
                'todo' => array('Do this later.'),
                'throws' => array(
                    array(
                        'type' => 'Solar_Exception',
                        'summ' => 'Throws summary.',
                    ),
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertEquals($actual, $expect);
    }
    
    public function testParse_noTechData()
    {
        $source = '
            /**
             * This is the initial summary line; note how it passes over
             * two lines. No technical data follows.
             */';
         
        $expect = array(
            'summ' => "This is the initial summary line; note how it passes over two lines.",
            'narr' => "No technical data follows.",
            'tech' => array(),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testParse_summ()
    {
        $source = '
            /**
             * This is the initial summary line.
             * 
             * This is the narrative; note how is passes over multiple lines
             * of the block.
             */';
         
        $expect = array(
            'summ' => "This is the initial summary line.",
            'narr' => "This is the narrative; note how is passes over multiple lines\nof the block.",
            'tech' => array(),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testParse_summNoPunctNoNarr()
    {
        $source = '
            /**
             * This is the initial summary line with no punctuation
             */';
         
        $expect = array(
            'summ' => "This is the initial summary line with no punctuation",
            'narr' => "",
            'tech' => array(),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual, $expect);
        // $this->assertTrue(true);
    }
    
    public function testParse_summNoPunctWithNarr()
    {
        $source = '
            /**
             * This is the initial summary line with no punctuation
             * 
             * This is the narrative; note how is passes over multiple lines
             * of the block.
             *
             * And how it has extra newlines.
             */';
         
        $expect = array(
            'summ' => "This is the initial summary line with no punctuation",
            'narr' => "This is the narrative; note how is passes over multiple lines\nof the block.\n\nAnd how it has extra newlines.",
            'tech' => array(),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Parses one or more @author lines into $this->_info.
     * 
     */
    public function testParseAuthor()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @category line into $this->_info.
     * 
     */
    public function testParseCategory()
    {
        $source = '
            /**
             * @category Test
             */';
        
        $expect = array('category' => 'Test');
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    public function testParseCategory_extraSpaces()
    {
        $source = '
            /**
             * @category Test with extra characters
             */';
        
        // should ignore extra spaces
        $expect = array('category' => 'Test');
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
        
    }
    
    /**
     * 
     * Test -- Parses one @copyright line into $this->_info.
     * 
     */
    public function testParseCopyright()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @deprec line into $this->_info; alias for @deprecated.
     * 
     */
    public function testParseDeprec()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @deprecated line into $this->_info.
     * 
     */
    public function testParseDeprecated()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @example line into $this->_info.
     * 
     */
    public function testParseExample()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one or more @exception lines into $this->_info; alias for @throws.
     * 
     */
    public function testParseException()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @ignore line into $this->_info.
     * 
     */
    public function testParseIgnore()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @license line into $this->_info.
     * 
     */
    public function testParseLicense()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one or more @link lines into $this->_info.
     * 
     */
    public function testParseLink()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @package line into $this->_info.
     * 
     */
    public function testParsePackage()
    {
        $source = '
            /**
             * @package Test_Solar
             */';
        
        $expect = array('package' => array(
            'name' => 'Test_Solar',
            'summ' => '',
        ));
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
        
        
    }
    
    public function testParsePackage_withSummary()
    {
        $source = '
            /**
             * @package Test_Solar This is the summary.
             */';
        
        $expect = array('package' => array(
            'name' => 'Test_Solar',
            'summ' => 'This is the summary.',
        ));
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one or more @param lines into $this->_info.
     * 
     */
    public function testParseParam()
    {
        // full line
        $source = '
            /**
             * @param string $var1 Parameter summary.
             */';
        
        $expect = array(
            'param' => array(
                'var1' => array(
                    'type' => 'string',
                    'summ' => 'Parameter summary.',
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    public function testParseParam_noSummary()
    {
        // partial line, no summary
        $source = '
            /**
             * @param string $var1
             */';
        
        $expect = array(
            'param' => array(
                'var1' => array(
                    'type' => 'string',
                    'summ' => '',
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    public function testParseParam_noVariable()
    {
        // partial line, no variable
        $source = '
            /**
             * @param string Parameter summary.
             */';
        
        $expect = array(
            'param' => array(
                0 => array(
                    'type' => 'string',
                    'summ' => 'Parameter summary.',
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one @return line into $this->_info.
     * 
     */
    public function testParseReturn()
    {
        // full line
        $source = '
            /**
             * @return string Return summary.
             */';
        
        $expect = array(
            'return' => array(
                'type' => 'string',
                'summ' => 'Return summary.',
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    public function testParseReturn_noSummary()
    {
        // partial line
        $source = '
            /**
             * @return string
             */';
    
        $expect = array(
            'return' => array(
                'type' => 'string',
                'summ' => '',
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one or more @see lines into $this->_info.
     * 
     */
    public function testParseSee()
    {
        $source = '
            /**
             * @see See summary.
             */';
    
        $expect = array(
            'see' => array('See summary.'),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one @since line into $this->_info.
     * 
     */
    public function testParseSince()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one or more @staticvar lines into $this->_info.
     * 
     */
    public function testParseStaticvar()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses one @subpackage line into $this->_info.
     * 
     */
    public function testParseSubpackage()
    {
        $source = '
            /**
             * @subpackage Test_Solar_Docs
             */';
        
        $expect = array('subpackage' => 'Test_Solar_Docs');
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    public function testParseSubpackage_extraSpaces()
    {
        $source = '
            /**
             * @subpackage Test_Solar_Docs with extra characters
             */';
        
        // should ignore extra spaces
        $expect = array('subpackage' => 'Test_Solar_Docs');
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one or more @throws lines into $this->_info.
     * 
     */
    public function testParseThrows()
    {
        // full line
        $source = '
            /**
             * @throws Solar_Exception Throws summary.
             */';
        
        $expect = array(
            'throws' => array(
                array(
                    'type' => 'Solar_Exception',
                    'summ' => 'Throws summary.',
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    public function testParseThrows_noSummary()
    {
        // no summary
        $source = '
            /**
             * @throws Solar_Exception
             */';
        
        $expect = array(
            'throws' => array(
                array(
                    'type' => 'Solar_Exception',
                    'summ' => '',
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one ore more @todo lines into $this->_info.
     * 
     */
    public function testParseTodo()
    {
        // todo lines
        $source = '
            /**
             * @todo Todo summary.
             */';
    
        $expect = array(
            'todo' => array('Todo summary.'),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    
    /**
     * 
     * Test -- Parses one @var line into $this->_info.
     * 
     */
    public function testParseVar()
    {
        // full line
        $source = '
            /**
             * 
             * This is the initial summary line; note how it passes over
             * two lines. Fuller description of the variable.  Lorem ipsum
             * dolor sit amet.
             * 
             * @var float
             * 
             */';
    
        $expect = array(
            'summ' => "This is the initial summary line; note how it passes over two lines.",
            'narr' => "Fuller description of the variable.  Lorem ipsum\ndolor sit amet.",
            'tech' => array(
                'var' => array(
                    'type' => 'float',
                    'summ' => '',
                ),
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual, $expect);
    }
    
    public function testParseVar_noSummary()
    {
        // partial line
        $source = '
            /**
             * @var string
             */
            ';
        
        $expect = array(
            'var' => array(
                'type' => 'string',
                'summ' => '',
            ),
        );
        
        $actual = $this->_phpdoc->parse($source);
        $this->assertSame($actual['tech'], $expect);
    }
    /**
     * 
     * Test -- Parses one @version line into $this->_info.
     * 
     */
    public function testParseVersion()
    {
        $this->todo('stub');
    }
}
