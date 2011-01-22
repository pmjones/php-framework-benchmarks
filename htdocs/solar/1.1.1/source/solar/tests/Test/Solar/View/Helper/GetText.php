<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_GetText extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_GetText = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a localized string, with escaping applied.
     * 
     */
    public function testGetText()
    {
        $actual = $this->_view->getText('ACTION_BROWSE');
        $expect = 'Browse';
        $this->assertSame($actual, $expect);
    }
    
    public function testGetText_badLocaleKey()
    {
        $actual = $this->_view->getText('no such "locale" key');
        $expect = 'no such &quot;locale&quot; key';
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets the class used for translations.
     * 
     */
    public function testSetClass()
    {
        $this->todo('update to new format');
        
        // $example = Solar::factory('Solar_Example');
        // 
        // $helper = $this->_view->getHelper('getText');
        // $helper->setClass('Solar_Example');
        // 
        // $actual = $this->_view->getTextRaw('HELLO_WORLD');
        // $expect = 'hello world';
        // $this->assertSame($actual, $expect);
    }
}
