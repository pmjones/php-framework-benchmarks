<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Test_Suite extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Test_Suite = array(
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
        $obj = Solar::factory('Solar_Test_Suite');
        $this->assertInstance($obj, 'Solar_Test_Suite');
    }
    
    /**
     * 
     * Test -- Finds tests, loads them with the plan.
     * 
     */
    public function testLoadTests()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs the test suite (or the sub-test series) and logs as it goes.
     * 
     */
    public function testRun()
    {
        $this->todo('stub');
    }
}
