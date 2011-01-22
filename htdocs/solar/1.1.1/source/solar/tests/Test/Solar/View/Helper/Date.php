<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Date extends Test_Solar_View_Helper_Timestamp {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Date = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Outputs a formatted date.
     * 
     */
    public function testDate()
    {
        $string = 'Nov 7, 1979';
        $actual = $this->_view->date($string);
        $expect = '1979-11-07';
        $this->assertSame($actual, $expect);
    }
    
    public function testDate_int()
    {
        $int = strtotime('Nov 7, 1979');
        $actual = $this->_view->date($int);
        $expect = '1979-11-07';
        $this->assertSame($actual, $expect);
    }
    
    public function testDate_reformat()
    {
        $string = 'Nov 7, 1979';
        $actual = $this->_view->date($string, 'U');
        $expect = strtotime($string);
        $this->assertEquals($actual, $expect);
    }
    
    public function testDate_configFormat()
    {
        $helper = $this->_view->newHelper('date', array('format' => 'U'));
        $string = 'Nov 7, 1979';
        $actual = $helper->date($string);
        $expect = strtotime($string);
        $this->assertEquals($actual, $expect);
    }
}
