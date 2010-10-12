<?php
/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Auth_Adapter_Sql extends Test_Solar_Auth_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Auth_Adapter_Sql = array(
    );
    
    protected $_sql;
    
    public function preTest()
    {
        $this->_sql = Solar::factory(
            'Solar_Sql',
            array(
                'adapter' => 'Solar_Sql_Adapter_Sqlite',
                'name' => ':memory:',
            )
        );
        
        $cmd = "CREATE TABLE members ("
             . "    handle VARCHAR(255),"
             . "    passwd CHAR(32),"
             . "    email VARCHAR(255),"
             . "    moniker VARCHAR(255),"
             . "    uri VARCHAR(255)"
             . ")";
        
        $this->_sql->query($cmd);
        
        $dir = Solar_Class::dir('Mock_Solar_Auth_Adapter_Ini');
        $insert = parse_ini_file($dir . 'users.ini', true);
        foreach ($insert as $handle => $data) {
            $data['handle'] = $handle;
            $data['passwd'] = hash('md5', $data['passwd']);
            $this->_sql->insert('members', $data);
        }
        
        $this->_moniker = 'Paul M. Jones';
        $this->_email = 'pmjones@solarphp.com';
        $this->_uri = 'http://paul-m-jones.com';
        
        $this->_config['sql']         = $this->_sql;
        $this->_config['table']       = 'members';
        $this->_config['email_col']   = 'email';
        $this->_config['moniker_col'] = 'moniker';
        $this->_config['uri_col']     = 'uri';
        
        parent::preTest();
    }
}
