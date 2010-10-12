<?php
/**
 * 
 * Adapter class test.
 * 
 */
class Test_Solar_Sql_Adapter_Sqlite extends Test_Solar_Sql_Adapter {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql_Adapter_Sqlite = array(
        'name' => ':memory:',
    );
    
    protected $_extension = 'pdo_sqlite';
    
    protected $_quote_expect = "'\"foo\" bar ''baz'''";
    
    protected $_quote_array_expect = "'\"foo\"', 'bar', '''baz'''";
    
    protected $_quote_multi_expect = "id = 1 AND foo = 'bar' AND zim IN('dib', 'gir', 'baz')";
    
    protected $_quote_into_expect = "foo = '''bar'''";
    
    protected $_describe_table_sql = "
        CREATE TABLE test_solar_sql_describe (
             test_autoinc_primary   INTEGER PRIMARY KEY AUTOINCREMENT
            ,test_require           INTEGER NOT NULL
            ,test_bool              BOOLEAN
            ,test_char              CHAR(3)
            ,test_varchar           VARCHAR(7)
            ,test_smallint          SMALLINT
            ,test_int               INTEGER
            ,test_bigint            BIGINT
            ,test_numeric_size      NUMERIC(7)
            ,test_numeric_scope     NUMERIC(7,3)
            ,test_float             DOUBLE
            ,test_clob              CLOB
            ,test_date              DATE
            ,test_time              TIME
            ,test_timestamp         TIMESTAMP
            ,test_default_null      CHAR(3) DEFAULT NULL
            ,test_default_string    VARCHAR(7) DEFAULT 'literal'
            ,test_default_integer   INTEGER DEFAULT 7
            ,test_default_numeric   NUMERIC(7,3) DEFAULT 1234.567
            ,test_default_ignore    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    
    public function testDropColumn()
    {
        $this->skip('sqlite does not support drop column');
    }
}
