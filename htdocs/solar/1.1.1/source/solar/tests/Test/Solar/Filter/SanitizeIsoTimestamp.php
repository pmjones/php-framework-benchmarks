<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeIsoTimestamp extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeIsoTimestamp = array(
    );
    
    /**
     * 
     * Test -- Forces the value to an ISO-8601 formatted timestamp using a space separator ("yyyy-mm-dd hh:ii:ss") instead of a "T" separator.
     * 
     */
    public function testSanitizeIsoTimestamp()
    {
        $before = 'Nov 7, 1979, 12:34pm';
        $after = $this->_filter->sanitizeIsoTimestamp($before);
        $this->assertSame($after, '1979-11-07 12:34:00');
    }
}
