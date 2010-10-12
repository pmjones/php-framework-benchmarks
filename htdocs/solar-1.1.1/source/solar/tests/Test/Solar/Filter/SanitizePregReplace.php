<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_SanitizePregReplace extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_SanitizePregReplace = array(
    );
    
    /**
     * 
     * Test -- Applies [[php::preg_replace() | ]] to the value.
     * 
     */
    public function testSanitizePregReplace()
    {
        $before = 'abc 123 ,./';
        $after = $this->_filter->sanitizePregReplace($before, '/[^a-z]/', '@');
        $this->assertSame($after, 'abc@@@@@@@@');
    }
}
