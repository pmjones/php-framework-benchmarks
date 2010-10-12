<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeFloat extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeFloat = array(
    );
    
    /**
     * 
     * Test -- Forces the value to a float.
     * 
     */
    public function testSanitizeFloat()
    {
        $before = 'abc ... 123.45 ,.../';
        $after = $this->_filter->sanitizeFloat($before);
        $this->assertSame($after, 123.450);
        
        $before = 'a-bc .1. alkasldjf 23 aslk.45 ,.../';
        $after = $this->_filter->sanitizeFloat($before);
        $this->assertSame($after, -.123450);
        
        $before = '1E5';
        $after = $this->_filter->sanitizeFloat($before);
        $this->assertSame($after, 100000.0);
    }
}
