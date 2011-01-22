<?php
/**
 * 
 * Abstract class test.
 * 
 */
abstract class Test_Solar_Sql_Model_Related_ToMany extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Model_Related_ToMany = array(
    );
    
    /**
     * 
     * Skips the test because this is an abstract class.
     * 
     * @return void
     * 
     */
    protected function _preConfig()
    {
        $this->skip('abstract class');
    }
    
}
