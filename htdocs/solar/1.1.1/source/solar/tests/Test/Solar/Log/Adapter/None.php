<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Log_Adapter_None extends Test_Solar_Log_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Log_Adapter_None = array(
        'format' => '%e %m',
        'events' => array('info', 'debug', 'notice'),
    );
    
    public function testSave()
    {
        $class = get_class($this);
        
        $actual = $this->_adapter->save($class, 'info', 'some information');
        $this->assertTrue($actual);
        
        $actual = $this->_adapter->save($class, 'debug', 'a debug description');
        $this->assertTrue($actual);
        
        $actual = $this->_adapter->save($class, 'notice', 'note this message');
        $this->assertTrue($actual);
    }
    
    public function testSave_notRecognized()
    {
        $class = get_class($this);
        $actual = $this->_adapter->save($class, 'qwert', 'not recognized');
        $this->assertFalse($actual);
    }
}
