<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Log_Adapter_File extends Test_Solar_Log_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Log_Adapter_File = array(
        'file' => null,
        'format' => '%e %m',
        'events' => array('info', 'debug', 'notice'),
    );
    
    protected function _preConfig()
    {
        $file = Solar_File::tmp('test_solar_log_adapter_file.log');
        $this->_Test_Solar_Log_Adapter_File['file'] = $file;
    }
    
    public function preTest()
    {
        parent::preTest();
        @unlink($this->_config['file']);
    }
    
    public function postTest()
    {
        parent::postTest();
        @unlink($this->_config['file']);
    }
    
    public function testSave()
    {
        $class = get_class($this);
        $this->_adapter->save($class, 'info', 'some information');
        $this->_adapter->save($class, 'debug', 'a debug description');
        $this->_adapter->save($class, 'notice', 'note this message');
        $actual = file_get_contents($this->_config['file']);
        $expect = "info some information\ndebug a debug description\nnotice note this message\n";
        $this->assertSame($actual, $expect);
    }
    
    public function testSave_notRecognized()
    {
        $class = get_class($this);
        $this->_adapter->save($class, 'info', 'recognized');
        $this->_adapter->save($class, 'qwert', 'not recognized');
        $actual = file_get_contents($this->_config['file']);
        $expect = "info recognized\n";
        $this->assertEquals($actual, $expect);
    }
}
