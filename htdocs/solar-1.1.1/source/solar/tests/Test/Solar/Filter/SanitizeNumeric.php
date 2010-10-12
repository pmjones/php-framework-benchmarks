<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeNumeric extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeNumeric = array(
    );
    
    /**
     * 
     * Test -- Strips non-numeric characters from the value.
     * 
     */
    public function testSanitizeNumeric()
    {
        $before = 'abc ... 123.45 ,.../';
        $after = $this->_filter->sanitizeNumeric($before);
        $this->assertSame($after, (string) 123.450);
        
        $before = 'a-bc .1. alkasldjf 23 aslk.45 ,.../';
        $after = $this->_filter->sanitizeNumeric($before);
        $this->assertSame($after, (string) -.123450);
        
        $before = '1E5';
        $after = $this->_filter->sanitizeNumeric($before);
        $this->assertSame($after, (string) 100000.0);
    }
}
