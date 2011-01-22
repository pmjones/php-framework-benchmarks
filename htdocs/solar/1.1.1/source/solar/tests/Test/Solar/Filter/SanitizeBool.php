<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeBool extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeBool = array(
    );
    
    /**
     * 
     * Test -- Forces the value to a boolean.
     * 
     */
    public function testSanitizeBool()
    {
        $list = array(
            true,
            'on', 'On', 'ON',
            'yes', 'Yes', 'YeS',
            'y', 'Y',
            'true', 'True', 'TrUe',
            't', 'T',
            1, '1',
            'not empty',
        );
        
        foreach ($list as $val) {
            $bool = $this->_filter->sanitizeBool($val);
            $this->assertTrue($bool);
        }
        
        $list = array(
            false,
            'off', 'Off', 'OfF',
            'no', 'No', 'NO',
            'n', 'N',
            'false', 'False', 'FaLsE',
            'f', 'F',
            0, '0',
            '', '    ',
        );
        
        foreach ($list as $val) {
            $bool = $this->_filter->sanitizeBool($val);
            $this->assertFalse($bool);
        }
    }
}
