<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Sql_Model_Catalog extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Catalog = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('Solar_Sql_Model_Catalog');
        $expect = 'Solar_Sql_Model_Catalog';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Magic get to make it look like model names are object properties.
     * 
     */
    public function test__get()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Frees memory for all models in the catalog.
     * 
     */
    public function testFree()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the model class for a particular model name.
     * 
     */
    public function testGetClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns information about the catalog as an array with keys for 'names' (the model name-to-class mappings), 'store' (the classes actually loaded up and retained), and 'stack' (the search stack for models).
     * 
     */
    public function testGetInfo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a stored model instance by name, creating it if needed.
     * 
     */
    public function testGetModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a stored model instance by class, creating it if needed.
     * 
     */
    public function testGetModelByClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Loads a model from the stack into the catalog by name, returning a  true/false success indicator (instead of throwing an exception when the class cannot be found).
     * 
     */
    public function testLoadModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a new model instance (not stored).
     * 
     */
    public function testNewModel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a model name to be a specific instance or class.
     * 
     */
    public function testSetModel()
    {
        $this->todo('stub');
    }
}
