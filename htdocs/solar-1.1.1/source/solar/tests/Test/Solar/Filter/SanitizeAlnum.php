<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeAlnum extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeAlnum = array(
    );
    
    /**
     * 
     * Test -- Strips non-alphanumeric characters from the value.
     * 
     */
    public function testSanitizeAlnum()
    {
        $before = 'abc 123 ,./';
        $after = $this->_filter->sanitizeAlnum($before);
        
        $this->assertNotSame($before, $after);
        $this->assertSame($after, 'abc123');
    }
}
