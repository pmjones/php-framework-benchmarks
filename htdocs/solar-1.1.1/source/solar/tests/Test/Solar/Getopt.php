<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Getopt extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Getopt = array(
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
        $obj = Solar::factory('Solar_Getopt');
        $this->assertInstance($obj, 'Solar_Getopt');
    }
    
    /**
     * 
     * Test -- Returns a list of invalid options and their error messages (if any).
     * 
     */
    public function testGetInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Populates the options with values from $argv.
     * 
     */
    public function testPopulate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets one option for recognition.
     * 
     */
    public function testSetOption()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets multiple acceptable options.
     * 
     */
    public function testSetOptions()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Applies validation and sanitizing filters to the values.
     * 
     */
    public function testValidate()
    {
        $this->todo('stub');
    }
    
    public function testValidate_paramOpt()
    {
        
    }
    
    public function testValidate_paramOptHasDefault()
    {
        
    }
    
    public function testValidate_paramReq()
    {
        
    }
    
    public function testValidate_paramReqHasDefault()
    {
        
    }
    
    /**
     * 
     * Test -- Returns the populated option values.
     * 
     */
    public function testValues()
    {
        $this->todo('stub');
    }
}
