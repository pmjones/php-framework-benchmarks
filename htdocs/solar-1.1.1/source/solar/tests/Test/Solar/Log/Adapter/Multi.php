<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Log_Adapter_Multi extends Test_Solar_Log_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Log_Adapter_Multi = array(
    );
    
    protected function _preConfig()
    {
        // easier to do this here than as a property, since we use functions.
        $this->_Test_Solar_Log_Adapter_Multi = array(
            'adapters' => array(
                array(
                    'adapter' => 'Solar_Log_Adapter_File',
                    'events'  => 'debug',
                    'file'    => Solar_File::tmp('test_solar_log_adapter_multi.debug.log'),
                    'format'  => '%e %m',
                ),
                array(
                    'adapter' => 'Solar_Log_Adapter_File',
                    'events'  => 'info, notice',
                    'file'    => Solar_File::tmp('test_solar_log_adapter_multi.other.log'),
                    'format'  => '%e %m',
                ),
            ),
        );
    }
    
    public function preTest()
    {
        parent::preTest();
        @unlink($this->_config['adapters'][0]['file']);
        @unlink($this->_config['adapters'][1]['file']);
    }
    
    public function postTest()
    {
        parent::postTest();
        @unlink($this->_config['adapters'][0]['file']);
        @unlink($this->_config['adapters'][1]['file']);
    }
    
    public function testSave()
    {
        $class = get_class($this);
        $this->_adapter->save($class, 'info', 'some information');
        $this->_adapter->save($class, 'debug', 'a debug description');
        $this->_adapter->save($class, 'notice', 'note this message');
        
        // the debug log
        $actual = file_get_contents($this->_config['adapters'][0]['file']);
        
        $expect = "debug a debug description\n";
        $this->assertSame($actual, $expect);
        
        // the other log
        $actual = file_get_contents($this->_config['adapters'][1]['file']);
        $expect = "info some information\nnotice note this message\n";
        $this->assertSame($actual, $expect);
    }
    
    public function testSave_notRecognized()
    {
        $class = get_class($this);
        $this->_adapter->save($class, 'debug', 'recognized');
        $this->_adapter->save($class, 'info', 'recognized');
        $this->_adapter->save($class, 'qwert', 'not recognized');
        
        // the debug log
        $actual = file_get_contents($this->_config['adapters'][0]['file']);
        $expect = "debug recognized\n";
        $this->assertSame($actual, $expect);
        
        // the other log
        $actual = file_get_contents($this->_config['adapters'][1]['file']);
        $expect = "info recognized\n";
        $this->assertSame($actual, $expect);
    }
}
