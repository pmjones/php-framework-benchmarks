<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Log_Adapter_Echo extends Test_Solar_Log_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Log_Adapter_Echo = array(
        'output' => 'text',
        'format' => '%e %m',
        'events' => array('info', 'debug', 'notice'),
    );
    
    public function testSave()
    {
        ob_start();
        $class = get_class($this);
        $this->_adapter->save($class, 'info', 'some information');
        $this->_adapter->save($class, 'debug', 'a debug description');
        $this->_adapter->save($class, 'notice', 'note this message');
        $actual = ob_get_clean();
        
        $expect = "info some information" . PHP_EOL
                . "debug a debug description" . PHP_EOL
                . "notice note this message" . PHP_EOL;
                
        $this->assertSame($actual, $expect);
    }
    
    public function testSave_notRecognized()
    {
        ob_start();
        $class = get_class($this);
        $this->_adapter->save($class, 'qwert', 'not recognized');
        $actual = ob_get_clean();
        $expect = '';
        $this->assertEquals($actual, $expect);
    }
}
