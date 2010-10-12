<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Form_Load_Model extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Form_Load_Model = array(
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
        $obj = Solar::factory('Solar_Form_Load_Model');
        $this->assertInstance($obj, 'Solar_Form_Load_Model');
    }
    
    /**
     * 
     * Test -- Loads Solar_Form elements based on Solar_Sql_Model columns.
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
}
