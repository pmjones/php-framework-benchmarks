<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeStrReplace extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeStrReplace = array(
    );
    
    /**
     * 
     * Test -- Applies [[php::str_replace() | ]] to the value.
     * 
     */
    public function testSanitizeStrReplace()
    {
        $before = 'abc 123 ,./';
        $after = $this->_filter->sanitizeStrReplace($before, ' ', '@');
        $this->assertSame($after, 'abc@123@,./');
    }
}
