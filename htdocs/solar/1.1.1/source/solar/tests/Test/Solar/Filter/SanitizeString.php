<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeString extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeString = array(
    );
    
    /**
     * 
     * Test -- Forces the value to a string.
     * 
     */
    public function testSanitizeString()
    {
        $before = 12345;
        $after = $this->_filter->sanitizeString($before);
        $this->assertSame($after, '12345');
    }
}
