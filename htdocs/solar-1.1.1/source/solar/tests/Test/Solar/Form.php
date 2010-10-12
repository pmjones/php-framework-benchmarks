<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Form extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Form = array(
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
        $obj = Solar::factory('Solar_Form');
        $this->assertInstance($obj, 'Solar_Form');
    }
    
    /**
     * 
     * Test -- Adds one filter to an element.
     * 
     */
    public function testAddFilter()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds many filters to one element.
     * 
     */
    public function testAddFilters()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds one or more invalid message to an element, sets the element status to false (invalid), and sets the form status to false (invalid).
     * 
     */
    public function testAddInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds invalidation messages to multiple elements, sets their status to false (invalid) and sets the form status to false (invalid).
     * 
     */
    public function testAddInvalids()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the current overall form validation status.
     * 
     */
    public function testGetStatus()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns one form element value.
     * 
     */
    public function testGetValue()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the form element values as an array.
     * 
     */
    public function testGetValues()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Loads form attributes and elements from an external source.
     * 
     */
    public function testLoad()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Reorders the existing elements.
     * 
     */
    public function testOrderElements()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Automatically populates form elements with specified values.
     * 
     */
    public function testPopulate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Resets the form object to its originally-configured state.
     * 
     */
    public function testReset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the attributes of one element.
     * 
     */
    public function testSetAttribs()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets one element in the form.
     * 
     */
    public function testSetElement()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets multiple elements in the form.
     * 
     */
    public function testSetElements()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Tells the internal filter what object it should use for locale translations.
     * 
     */
    public function testSetFilterLocaleObject()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Forcibly sets the overall form validation status.
     * 
     */
    public function testSetStatus()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the type of one element.
     * 
     */
    public function testSetType()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Manually set the value of one element.
     * 
     */
    public function testSetValue()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Manually set the value of several elements.
     * 
     */
    public function testSetValues()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Applies the filter chain to the form element values; in particular, checks validation and updates the 'invalid' keys for each element that fails.
     * 
     */
    public function testValidate()
    {
        $this->todo('stub');
    }
}
