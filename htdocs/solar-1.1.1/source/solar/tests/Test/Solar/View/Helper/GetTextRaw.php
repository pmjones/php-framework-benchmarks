<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_GetTextRaw extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_GetTextRaw = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Returns a localized string WITH NO ESCAPING.
     * 
     */
    public function testGetTextRaw()
    {
        $actual = $this->_view->getTextRaw('ACTION_BROWSE');
        $expect = 'Browse';
        $this->assertSame($actual, $expect);
    }
    
    public function testGetTextRaw_badLocaleKey()
    {
        $actual = $this->_view->getTextRaw('no such "locale" key');
        $expect = 'no such "locale" key';
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Sets the class used for translations.
     * 
     */
    public function testSetClass()
    {
        $this->todo('convert to new format');
        
        // $example = Solar::factory('Solar_Example');
        // 
        // $helper = $this->_view->getHelper('getTextRaw');
        // $helper->setClass('Solar_Example');
        // 
        // $actual = $this->_view->getTextRaw('HELLO_WORLD');
        // $expect = 'hello world';
        // $this->assertSame($actual, $expect);
    }
}
