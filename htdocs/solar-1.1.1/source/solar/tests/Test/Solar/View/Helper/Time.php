<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Time extends Test_Solar_View_Helper_Timestamp {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Time = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Outputs a formatted time using [[php::date() | ]] format codes.
     * 
     */
    public function testTime()
    {
        $string = '12:34';
        $actual = $this->_view->time($string);
        $expect = '12:34:00';
        $this->assertSame($actual, $expect);
    }
    
    public function testTime_int()
    {
        $int = strtotime('Nov 7, 1970 12:34pm');
        $actual = $this->_view->time($int);
        $expect = '12:34:00';
        $this->assertSame($actual, $expect);
    }
    
    public function testTime_reformat()
    {
        $string = 'Nov 7, 1970, 11:45pm';
        $actual = $this->_view->time($string, 'H:i');
        $expect = '23:45';
        $this->assertEquals($actual, $expect);
    }
    
    public function testTime_configFormat()
    {
        $helper = $this->_view->newHelper('time', array('format' => 'H:i'));
        $string = 'Nov 7, 1970, 12:34:56';
        $actual = $helper->time($string);
        $expect = '12:34';
        $this->assertEquals($actual, $expect);
    }
}
