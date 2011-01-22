<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_ScriptInline extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_ScriptInline = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a <script></script> block that properly commented for inclusion in XHTML documents.
     * 
     */
    public function testScriptInline()
    {
        $actual = $this->_view->scriptInline('alert(\'Hello world!\');');
        $expect = '<script type="text/javascript">
//<![CDATA[
alert(\'Hello world!\');
//]]>
</script>';
        $this->assertSame(trim($actual), trim($expect));
    }
}
