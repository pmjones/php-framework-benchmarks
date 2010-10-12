<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_File extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_File = array(
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
        $obj = Solar::factory('Solar_File');
        $this->assertInstance($obj, 'Solar_File');
    }
    
    /**
     * 
     * Test -- Hack for [[php::file_exists() | ]] that checks the include_path.
     * 
     */
    public function testExists()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Uses [[php::include() | ]] to run a script in a limited scope.
     * 
     */
    public function testLoad()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the OS-specific directory for temporary files, with a file name appended.
     * 
     */
    public function testTmp()
    {
        $this->todo('stub');
    }
}
