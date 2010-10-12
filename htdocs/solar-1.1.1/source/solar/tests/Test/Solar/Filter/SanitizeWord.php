<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeWord extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeWord = array(
    );
    
    /**
     * 
     * Test -- Strips non-word characters within the value.
     * 
     */
    public function testSanitizeWord()
    {
        $before = 'abc _ 123 - ,./';
        $after = $this->_filter->sanitizeWord($before);
        $this->assertSame($after, 'abc_123');
    }
}
