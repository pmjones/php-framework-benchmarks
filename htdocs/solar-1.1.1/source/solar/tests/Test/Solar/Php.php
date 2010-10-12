<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Php extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Php = array(
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
        $obj = Solar::factory('Solar_Php');
        $this->assertInstance($obj, 'Solar_Php');
    }
    
    /**
     * 
     * Test -- Add a command-line argument for the code.
     * 
     */
    public function testAddArgv()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the exit code from the separate process.
     * 
     */
    public function testGetExitCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the last line of output from the separate process.
     * 
     */
    public function testGetLastLine()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets all lines of output from the separate process.
     * 
     */
    public function testGetOutput()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs the named file as the PHP code for the process.
     * 
     */
    public function testRun()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs the given string as the PHP code for the process.
     * 
     */
    public function testRunCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs a file as a Solar script.
     * 
     */
    public function testRunSolar()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Runs a code string as a Solar script.
     * 
     */
    public function testRunSolarCode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Set all command-line arguments for the code at one time; clears all previous argument values.
     * 
     */
    public function testSetArgv()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Turns execution process output on and off.
     * 
     */
    public function testSetEcho()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets an array of php.ini values, overriding the php.ini file.
     * 
     */
    public function testSetIniArray()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the location of the php.ini file to use.
     * 
     */
    public function testSetIniFile()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets one php.ini value, overriding the php.ini file.
     * 
     */
    public function testSetIniVal()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the PHP command to call at the command line.
     * 
     */
    public function testSetPhp()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When calling Solar::start() in the new process, use this as the $config value.
     * 
     */
    public function testSetSolarConfig()
    {
        $this->todo('stub');
    }
}
