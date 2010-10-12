<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Cli_MakeModel extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cli_MakeModel = array(
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
        $obj = Solar::factory('Solar_Cli_MakeModel');
        $this->assertInstance($obj, 'Solar_Cli_MakeModel');
    }
    
    /**
     * 
     * Test -- Public interface to execute the command.
     * 
     */
    public function testExec()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the help text for this command.
     * 
     */
    public function testGetInfoHelp()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array of option flags and descriptions for this command.
     * 
     */
    public function testGetInfoOptions()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Injects the console-controller object (if any) that invoked this command.
     * 
     */
    public function testSetConsoleController()
    {
        $this->todo('stub');
    }
}
