<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Controller_Front extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Controller_Front = array(
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
        $obj = Solar::factory('Solar_Controller_Front');
        $this->assertInstance($obj, 'Solar_Controller_Front');
    }
    
    /**
     * 
     * Test -- Displays the output of an page/action/info specification URI.
     * 
     */
    public function testDisplay()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches the output of a page/action/info specification URI.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
}
