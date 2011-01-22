<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeIsoTime extends Test_Solar_Filter_SanitizeIsoTimestamp {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeIsoTime = array(
    );
    
    /**
     * 
     * Test -- Forces the value to an ISO-8601 formatted time ("hh:ii:ss").
     * 
     */
    public function testSanitizeIsoTime()
    {
        $before = 'Nov 7, 1979, 12:34pm';
        $after = $this->_filter->sanitizeIsoTime($before);
        $this->assertSame($after, '12:34:00');
    }
}
