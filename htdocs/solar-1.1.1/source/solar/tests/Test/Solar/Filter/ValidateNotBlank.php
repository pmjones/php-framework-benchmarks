<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateNotBlank extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateNotBlank = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is not blank whitespace.
     * 
     */
    public function testValidateNotBlank()
    {
        $test = array(
            0, 1, 2, 5,
            '0', '1', '2', '5',
            "Seven 8 nine",
            "non:alpha-numeric's",
            'someThing8else',
        );
        foreach ($test as $val) {
            $this->assertTrue($this->_filter->validateNotBlank($val));
        }
    }
    
    public function testValidateNotBlank_bad()
    {
        $test = array(
            'empty'   => "",
            'space'   => " ",
            'tab'     => "\t",
            'newline' => "\n",
            'return'  => "\r",
            'multi'   => " \t \n \r ",
        );
        foreach ($test as $key => $val) {
            $this->assertFalse($this->_filter->validateNotBlank($val));
        }
    }
}
