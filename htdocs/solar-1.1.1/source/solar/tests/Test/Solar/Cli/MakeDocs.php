<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Cli_MakeDocs extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Cli_MakeDocs = array(
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
        $obj = Solar::factory('Solar_Cli_MakeDocs');
        $this->assertInstance($obj, 'Solar_Cli_MakeDocs');
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
    
    /**
     * 
     * Test -- Writes the Constants file.
     * 
     */
    public function testWriteClassConstants()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the table-of-contents XML file.
     * 
     */
    public function testWriteClassContents()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes an individual method file.
     * 
     */
    public function testWriteClassMethod()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the Methods file.
     * 
     */
    public function testWriteClassMethods()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the Overview file.
     * 
     */
    public function testWriteClassOverview()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the Properties file.
     * 
     */
    public function testWriteClassProperties()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the "class" directory.
     * 
     */
    public function testWriteClasses()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the contents file for the list of classes.
     * 
     */
    public function testWriteClassesList()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes one package description file.
     * 
     */
    public function testWritePackageClassList()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Writes the entire "packages" directory.
     * 
     */
    public function testWritePackages()
    {
        $this->todo('stub');
    }
}
