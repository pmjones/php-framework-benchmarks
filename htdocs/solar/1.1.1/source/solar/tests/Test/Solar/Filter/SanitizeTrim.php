<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeTrim extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeTrim = array(
    );
    
    /**
     * 
     * Test -- Trims characters from the beginning and end of the value.
     * 
     */
    public function testSanitizeTrim()
    {
        $before = '  abc 123 ,./  ';
        $after = $this->_filter->sanitizeTrim($before);
        $this->assertSame($after, 'abc 123 ,./');
    }
    
    public function testSanitizeTrim_OtherChars()
    {
        $before = '  abc 123 ,./  ';
        $after = $this->_filter->sanitizeTrim($before, ' ,./');
        $this->assertSame($after, 'abc 123');
    }
}
