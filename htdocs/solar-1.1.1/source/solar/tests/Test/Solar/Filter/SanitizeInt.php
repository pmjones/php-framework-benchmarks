<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeInt extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeInt = array(
    );
    
    /**
     * 
     * Test -- Forces the value to an integer.
     * 
     */
    public function testSanitizeInt()
    {
        $before = 'abc ... 123.45 ,.../';
        $after = $this->_filter->sanitizeInt($before);
        $this->assertSame($after, 12345);
        
        $before = 'a-bc .1. alkasldjf 23 aslk.45 ,.../';
        $after = $this->_filter->sanitizeInt($before);
        $this->assertSame($after, -12345);
        
        $before = '1E5';
        $after = $this->_filter->sanitizeInt($before);
        $this->assertSame($after, 100000);
    }
}
