<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizeIsoDate extends Test_Solar_Filter_SanitizeIsoTimestamp {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizeIsoDate = array(
    );
    
    /**
     * 
     * Test -- Forces the value to an ISO-8601 formatted date ("yyyy-mm-dd").
     * 
     */
    public function testSanitizeIsoDate()
    {
        $before = 'Nov 7, 1979, 12:34pm';
        $after = $this->_filter->sanitizeIsoDate($before);
        $this->assertSame($after, '1979-11-07');
    }
}
