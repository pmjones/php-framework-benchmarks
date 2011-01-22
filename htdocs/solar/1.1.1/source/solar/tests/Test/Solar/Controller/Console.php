<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Controller_Console extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Controller_Console = array(
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
        $obj = Solar::factory('Solar_Controller_Console');
        $this->assertInstance($obj, 'Solar_Controller_Console');
    }
    
    /**
     * 
     * Test -- Finds and invokes a command.
     * 
     */
    public function testExec()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a list of commands recognized by this console controller, and the related classes for those commands.
     * 
     */
    public function testGetCommandList()
    {
        $this->todo('stub');
    }
}
