<?php
/**
 * 
 * Abstract class test.
 * 
 */
class Test_Solar_Base extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Base = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Support methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Constructor.
     * 
     * @param array $config User-defined configuration parameters.
     * 
     */
    public function __construct($config = null)
    {
        $this->skip('abstract class');
        parent::__construct($config);
    }
    
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
        $obj = Solar::factory('Solar_Base');
        $this->assertInstance($obj, 'Solar_Base');
    }
}
