<?php
/**
 * Parent test.
 */
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Adapter.php';

/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Access_Adapter_Sql extends Test_Solar_Access_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Access_Adapter_Sql = array(
    );
    
    /**
     * 
     * Setup; runs before each test method.
     * 
     */
    public function preTest()
    {
        $this->_sql = Solar::factory(
            'Solar_Sql',
            array(
                'adapter' => 'Solar_Sql_Adapter_Sqlite',
                'name' => ':memory:',
            )
        );
        
        // forcibly add sql to registry
        Solar_Registry::set('sql', $this->_sql);
        
        $cmd = "CREATE TABLE acl ("
             . "    flag VARCHAR(10),"
             . "    type CHAR(100),"
             . "    name VARCHAR(255),"
             . "    class_name VARCHAR(255),"
             . "    action_name VARCHAR(255),"
             . "    position VARCHAR(255)"
             . ")";
        
        $this->_sql->query($cmd);
        
        $dir = Solar_Class::dir('Mock_Solar_Access_Adapter');
        $lines = file_get_contents($dir . 'access.txt');
        $rows = explode("\n", $lines);
        $pos = 0;
        foreach ($rows as $row) {
            $row = trim($row);
            
            // skip empty lines and comments
            if (empty($row) || substr($row, 0, 1) == '#') {
                continue;
            }
            
            $row = preg_replace('/[ \t]{2,}/', ' ', $row);
            $row = explode(' ', $row);
            
            $data['flag']        = trim($row[0]);
            $data['type']        = trim($row[1]);
            $data['name']        = trim($row[2]);
            $data['class_name']  = trim($row[3]);
            $data['action_name'] = trim($row[4]);
            $data['position']    = $pos;
            
            $this->_sql->insert('acl', $data);
            $pos ++;
        }
        
        parent::preTest();
    }
}
