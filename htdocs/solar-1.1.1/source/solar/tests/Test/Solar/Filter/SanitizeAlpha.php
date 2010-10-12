<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeAlpha extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeAlpha = array(
    );
    
    /**
     * 
     * Test -- Strips non-alphabetic characters from the value.
     * 
     */
    public function testSanitizeAlpha()
    {
        $before = 'abc 123 ,./';
        $after = $this->_filter->sanitizeAlpha($before);
        
        $this->assertNotSame($before, $after);
        $this->assertSame($after, 'abc');
    }
}
