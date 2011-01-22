<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_Solar_Role_Adapter_Sql extends Test_Solar_Role_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Role_Adapter_Sql = array(
        'sql'        => null,
        'table'      => 'roles',
        'handle_col' => 'handle',
        'role_col'   => 'name',
    );
    
    protected $_sql;
    
    protected function _postConfig()
    {
        parent::_postConfig();
        
        $this->_sql = Solar::factory(
            'Solar_Sql',
            array(
                'adapter' => 'Solar_Sql_Adapter_Sqlite',
                'name'    => ':memory:',
            )
        );
        
        $this->_config['sql'] = $this->_sql;
    }
    
    public function preTest()
    {
        parent::preTest();
        
        // create the table
        $cmd = "CREATE TABLE {$this->_config['table']} (
            {$this->_config['handle_col']} VARCHAR(255),
            {$this->_config['role_col']}   CHAR(32)
        )";
        
        $this->_sql->query($cmd);
        
        // get the roles
        $dir = Solar_Class::dir('Mock_Solar_Role_Adapter_Sql');
        $file = $dir . 'roles.ini';
        $roles = parse_ini_file($file, true);
        
        // insert the roles
        foreach ($roles as $role => $val) {
            $handles = explode(',', $val['handles']);
            foreach ($handles as $handle) {
                $data[$this->_config['handle_col']] = trim($handle);
                $data[$this->_config['role_col']]   = trim($role);
                $this->_sql->insert('roles', $data);
            }
        }
    }
}
