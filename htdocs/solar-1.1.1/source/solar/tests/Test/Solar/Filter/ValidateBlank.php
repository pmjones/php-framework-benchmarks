<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Filter_ValidateBlank extends Test_Solar_Filter_Abstract {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Filter_ValidateBlank = array(
    );
    
    /**
     * 
     * Test -- Validates that the value is null, or is a string composed only of whitespace.
     * 
     */
    public function testValidateBlank()
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
            $this->assertTrue($this->_filter->validateBlank($val));
        }
    }
    
    public function testValidateBlank_bad()
    {
        $test = array(
            0, 1, 2, 5,
            '0', '1', '2', '5',
            "Seven 8 nine",
            "non:alpha-numeric's",
            'someThing8else',
        );
        foreach ($test as $val) {
            $this->assertFalse($this->_filter->validateBlank($val));
        }
    }
}
