<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter = array(
    );
    
    public function preTest()
    {
        $this->_filter = Solar::factory('Solar_Filter');
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
        $this->assertInstance($this->_filter, 'Solar_Filter');
    }
    
    /**
     * 
     * Test -- Magic call to filter methods represented as classes.
     * 
     */
    public function test__call()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds one filter-chain method for a data key.
     * 
     */
    public function testAddChainFilter()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds many filter-chain methods for a data key.
     * 
     */
    public function testAddChainFilters()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Add to the filter class stack.
     * 
     */
    public function testAddFilterClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Applies the filter chain to an array of data in-place.
     * 
     */
    public function testApplyChain()
    {
        // required, but no filter
        $this->_filter->setChainRequire('foo');
        
        // one filter
        $this->_filter->addChainFilter('bar', 'validateInt');
        
        // many filters
        $this->_filter->addChainFilters('baz', array(
            'sanitizeInt',
            array('validateRange', 1, 9),
        ));
        
        // required, one filter
        $this->_filter->setChainRequire('dib');
        $this->_filter->addChainFilter('dib', 'validateInt');
        
        // required, many filters
        $this->_filter->setChainRequire('zim');
        $this->_filter->addChainFilters('zim', array(
            'sanitizeInt',
            array('validateRange', 1, 9),
        ));
        
        /**
         * expected output after being sanitized
         */
        $expect = array(
            'foo' => 'anything',
            'bar' => 123,
            'baz' => 4,
            'dib' => 678,
            'zim' => 7,
        );
        
        /**
         * apply filter with "valid" user input
         */
        
        // user input
        $data = array(
            'foo' => 'anything',
            'bar' => 123,
            'baz' => 4.5,
            'dib' => 678,
            'zim' => 7.9,
        );
        
        // valid?
        $valid = $this->_filter->applyChain($data);
        $this->assertTrue($valid);
        
        // should have sanitized the data in-place
        $this->assertSame($data, $expect);
        
        /**
         * apply filter with invalid user input
         */
        
        // user input
        $data = array(
            'foo' => 'anything',
            'bar' => 'abc',         // validateInt
            'baz' => 123,           // validateRange
            'dib' => 456,
            'zim' => -78,           // validateRange
        );
        
        // valid?
        $valid = $this->_filter->applyChain($data);
        $this->assertFalse($valid);
        
        // get the list of invalid elements
        $invalid = $this->_filter->getChainInvalid();
        $keys = array_keys($invalid);
        $this->assertSame($keys, array('bar', 'baz', 'zim'));
        
        /**
         * apply filter with missing requires
         */
        
        // user input
        $data = array(
            'foo' => null,
            'bar' => 123,
            'baz' => 4.5,
            'dib' => '',
        );
        
        // valid?
        $valid = $this->_filter->applyChain($data);
        $this->assertFalse($valid);
        
        // get the list of invalid elements
        $invalid = $this->_filter->getChainInvalid();
        $keys = array_keys($invalid);
        $this->assertSame($keys, array('foo', 'dib', 'zim'));
        
        /**
         * apply filter with invalid user input and missing requires
         */
        
        // user input
        $data = array(
            'bar' => 'abc',         // validateInt
            'baz' => 123,           // validateRange
            'dib' => 4.5,
        );
        
        // valid?
        $valid = $this->_filter->applyChain($data);
        $this->assertFalse($valid);
        
        // get the list of invalid elements
        $invalid = $this->_filter->getChainInvalid();
        $keys = array_keys($invalid);
        $this->assertEquals($keys, array('foo', 'zim', 'bar', 'baz', 'dib'));
    }
    
    /**
     * 
     * Test -- Call this method before you unset() this instance to fully recover memory from circular-referenced objects.
     * 
     */
    public function testFree()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the list of invalid keys and feedback messages from the filter chain.
     * 
     */
    public function testGetChainInvalid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets a copy of the data array, or a specific element of data, being processed by [[applyChain()]].
     * 
     */
    public function testGetData()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the current data key being processed by the filter chain.
     * 
     */
    public function testGetDataKey()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Gets the stored filter object by method name.
     * 
     */
    public function testGetFilter()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the filter class stack.
     * 
     */
    public function testGetFilterClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the value of the 'require' flag.
     * 
     */
    public function testGetRequire()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates a new filter object by method name.
     * 
     */
    public function testNewFilter()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Resets the filter chain and required keys.
     * 
     */
    public function testResetChain()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the object used for getting locale() translations during [[applyChain()]].
     * 
     */
    public function testSetChainLocaleObject()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets whether or not a particular data key is required to be present and non-blank in the data being processed by [[applyChain()]].
     * 
     */
    public function testSetChainRequire()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets one data element being processed by [[applyChain()]].
     * 
     */
    public function testSetData()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Reset the filter class stack.
     * 
     */
    public function testSetFilterClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the value of the 'require' flag.
     * 
     */
    public function testSetRequire()
    {
        $this->todo('stub');
    }
}
