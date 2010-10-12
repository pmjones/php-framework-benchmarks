<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Debug_Var extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Debug_Var = array(
    );
    
    protected $_text;
    
    protected $_html;
    
    public function preTest()
    {
        parent::preTest();
        
        // var dumpers
        $this->_text = Solar::factory('Solar_Debug_Var', array(
            'output' => 'text',
        ));
        
        $this->_html = Solar::factory('Solar_Debug_Var', array(
            'output' => 'html',
        ));
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
        $obj = Solar::factory('Solar_Debug_Var');
        $this->assertInstance($obj, 'Solar_Debug_Var');
    }
    
    /**
     * 
     * Test -- Prints the output of Solar_Debug_Var::fetch() with a label.
     * 
     */
    public function testDisplay()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns formatted output from var_dump().
     * 
     */
    public function testFetch()
    {
        $var    = 'foo < bar > baz " dib & zim ? gir';
        $actual = $this->_text->fetch($var);
        $expect = "string(33) \"foo < bar > baz \" dib & zim ? gir\"\n";
        $this->assertSame($actual, $expect);
    }
    
    public function testFetch_array()
    {
        $var = array(
            'foo' => 'bar',
            'baz' => 'dib',
            'zim' => array(
                'gir', 'irk'
            )
        );
        
        $actual = $this->_text->fetch($var);
        
        $expect = <<<EXPECT
array(3) {
  ["foo"] => string(3) "bar"
  ["baz"] => string(3) "dib"
  ["zim"] => array(2) {
    [0] => string(3) "gir"
    [1] => string(3) "irk"
  }
}

EXPECT;

        $this->assertSame($actual, $expect);
    }
    
    public function testFetch_html()
    {
        $var    = 'foo < bar > baz " dib & zim ? gir';
        $actual = $this->_html->fetch($var);
        $expect = "<pre>string(33) &quot;foo &lt; bar &gt; baz &quot; dib &amp; zim ? gir&quot;\n</pre>";
        $this->assertSame($actual, $expect);
    }
    
    public function testFetch_arrayHtml()
    {
        $var = array(
            'foo' => 'bar',
            'baz' => 'dib',
            'zim' => array(
                'gir', 'irk'
            )
        );
        
        $actual = $this->_html->fetch($var);
        
        $expect = <<<EXPECT
<pre>array(3) {
  [&quot;foo&quot;] =&gt; string(3) &quot;bar&quot;
  [&quot;baz&quot;] =&gt; string(3) &quot;dib&quot;
  [&quot;zim&quot;] =&gt; array(2) {
    [0] =&gt; string(3) &quot;gir&quot;
    [1] =&gt; string(3) &quot;irk&quot;
  }
}
</pre>
EXPECT;
        
        $this->assertSame($actual, $expect);
    }
}
