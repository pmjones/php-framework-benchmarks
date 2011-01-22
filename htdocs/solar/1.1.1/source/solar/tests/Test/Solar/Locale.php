<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Locale extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Locale = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $obj = Solar::factory('Solar_Locale');
        $this->assertInstance($obj, 'Solar_Locale');
    }
    
    /**
     * 
     * Test -- Returns the translated locale string for a class and key.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the current locale code.
     * 
     */
    public function testGetCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns ISO 3166 country code for current locale code.
     * 
     */
    public function testGetCountryCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the locale code and clears out previous translations.
     * 
     */
    public function testSetCode()
    {
        $this->todo('stub');
    }
}
