<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Class_Map extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Class_Map = array(
    );
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $obj = Solar::factory('Solar_Class_Map');
        $this->assertInstance($obj, 'Solar_Class_Map');
    }
    
    /**
     * 
     * Test -- Gets the class-to-file map for a class hierarchy.
     * 
     */
    public function testFetch()
    {
        $dir  = Solar_Class::dir('Solar', '../tests');
        $base = realpath($dir);
        
        $map = Solar::factory('Solar_Class_Map');
        $map->setBase($base);
        
        $actual = $map->fetch('Mock_Solar');
        $expect = array(
            "Mock_Solar_Controller_Page" => "$base/Mock/Solar/Controller/Page.php",
            "Mock_Solar_Example" => "$base/Mock/Solar/Example.php",
            "Mock_Solar_Exception" => "$base/Mock/Solar/Exception.php",
            "Mock_Solar_Exception_CustomCondition" => "$base/Mock/Solar/Exception/CustomCondition.php",
            "Mock_Solar_Model_Areas" => "$base/Mock/Solar/Model/Areas.php",
            "Mock_Solar_Model_Areas_Collection" => "$base/Mock/Solar/Model/Areas/Collection.php",
            "Mock_Solar_Model_Areas_Metadata" => "$base/Mock/Solar/Model/Areas/Metadata.php",
            "Mock_Solar_Model_Areas_Record" => "$base/Mock/Solar/Model/Areas/Record.php",
            "Mock_Solar_Model_Bookmarks" => "$base/Mock/Solar/Model/Bookmarks.php",
            "Mock_Solar_Model_Bookmarks_Collection" => "$base/Mock/Solar/Model/Bookmarks/Collection.php",
            "Mock_Solar_Model_Bookmarks_Record" => "$base/Mock/Solar/Model/Bookmarks/Record.php",
            "Mock_Solar_Model_Comments" => "$base/Mock/Solar/Model/Comments.php",
            "Mock_Solar_Model_Comments_Collection" => "$base/Mock/Solar/Model/Comments/Collection.php",
            "Mock_Solar_Model_Comments_Metadata" => "$base/Mock/Solar/Model/Comments/Metadata.php",
            "Mock_Solar_Model_Comments_Record" => "$base/Mock/Solar/Model/Comments/Record.php",
            "Mock_Solar_Model_Metas" => "$base/Mock/Solar/Model/Metas.php",
            "Mock_Solar_Model_Metas_Collection" => "$base/Mock/Solar/Model/Metas/Collection.php",
            "Mock_Solar_Model_Metas_Metadata" => "$base/Mock/Solar/Model/Metas/Metadata.php",
            "Mock_Solar_Model_Metas_Record" => "$base/Mock/Solar/Model/Metas/Record.php",
            "Mock_Solar_Model_Nodes" => "$base/Mock/Solar/Model/Nodes.php",
            "Mock_Solar_Model_Nodes_Collection" => "$base/Mock/Solar/Model/Nodes/Collection.php",
            "Mock_Solar_Model_Nodes_Metadata" => "$base/Mock/Solar/Model/Nodes/Metadata.php",
            "Mock_Solar_Model_Nodes_Record" => "$base/Mock/Solar/Model/Nodes/Record.php",
            "Mock_Solar_Model_Pages" => "$base/Mock/Solar/Model/Pages.php",
            "Mock_Solar_Model_Pages_Collection" => "$base/Mock/Solar/Model/Pages/Collection.php",
            "Mock_Solar_Model_Pages_Record" => "$base/Mock/Solar/Model/Pages/Record.php",
            "Mock_Solar_Model_Prefs" => "$base/Mock/Solar/Model/Prefs.php",
            "Mock_Solar_Model_Prefs_Collection" => "$base/Mock/Solar/Model/Prefs/Collection.php",
            "Mock_Solar_Model_Prefs_Metadata" => "$base/Mock/Solar/Model/Prefs/Metadata.php",
            "Mock_Solar_Model_Prefs_Record" => "$base/Mock/Solar/Model/Prefs/Record.php",
            "Mock_Solar_Model_Taggings" => "$base/Mock/Solar/Model/Taggings.php",
            "Mock_Solar_Model_Taggings_Collection" => "$base/Mock/Solar/Model/Taggings/Collection.php",
            "Mock_Solar_Model_Taggings_Metadata" => "$base/Mock/Solar/Model/Taggings/Metadata.php",
            "Mock_Solar_Model_Taggings_Record" => "$base/Mock/Solar/Model/Taggings/Record.php",
            "Mock_Solar_Model_Tags" => "$base/Mock/Solar/Model/Tags.php",
            "Mock_Solar_Model_Tags_Collection" => "$base/Mock/Solar/Model/Tags/Collection.php",
            "Mock_Solar_Model_Tags_Metadata" => "$base/Mock/Solar/Model/Tags/Metadata.php",
            "Mock_Solar_Model_Tags_Record" => "$base/Mock/Solar/Model/Tags/Record.php",
            "Mock_Solar_Model_TestSolarBar" => "$base/Mock/Solar/Model/TestSolarBar.php",
            "Mock_Solar_Model_TestSolarBar_Record" => "$base/Mock/Solar/Model/TestSolarBar/Record.php",
            "Mock_Solar_Model_TestSolarDib" => "$base/Mock/Solar/Model/TestSolarDib.php",
            "Mock_Solar_Model_TestSolarFoo" => "$base/Mock/Solar/Model/TestSolarFoo.php",
            "Mock_Solar_Model_TestSolarFoo_Collection" => "$base/Mock/Solar/Model/TestSolarFoo/Collection.php",
            "Mock_Solar_Model_TestSolarFoo_Record" => "$base/Mock/Solar/Model/TestSolarFoo/Record.php",
            "Mock_Solar_Model_TestSolarSpecialCols" => "$base/Mock/Solar/Model/TestSolarSpecialCols.php",
            "Mock_Solar_Model_TestSolarSpecialCols_Collection" => "$base/Mock/Solar/Model/TestSolarSpecialCols/Collection.php",
            "Mock_Solar_Model_TestSolarSpecialCols_Record" => "$base/Mock/Solar/Model/TestSolarSpecialCols/Record.php",
            "Mock_Solar_Model_TestSolarSqlDescribe" => "$base/Mock/Solar/Model/TestSolarSqlDescribe.php",
            "Mock_Solar_Model_TestSolarSqlDescribe_Collection" => "$base/Mock/Solar/Model/TestSolarSqlDescribe/Collection.php",
            "Mock_Solar_Model_TestSolarSqlDescribe_Record" => "$base/Mock/Solar/Model/TestSolarSqlDescribe/Record.php",
            "Mock_Solar_Model_Users" => "$base/Mock/Solar/Model/Users.php",
            "Mock_Solar_Model_Users_Collection" => "$base/Mock/Solar/Model/Users/Collection.php",
            "Mock_Solar_Model_Users_Metadata" => "$base/Mock/Solar/Model/Users/Metadata.php",
            "Mock_Solar_Model_Users_Record" => "$base/Mock/Solar/Model/Users/Record.php",
        );
        
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Gets the base directory for the class map.
     * 
     */
    public function testGetBase()
    {
        $dir  = Solar_Class::dir('Solar', '..');
        $base = Solar_Dir::fix(realpath($dir));
        
        $map = Solar::factory('Solar_Class_Map');
        $map->setBase($base);
        
        $actual = $map->getBase();
        $this->assertSame($actual, $base);
    }
    
    /**
     * 
     * Test -- Sets the base directory for the class map.
     * 
     */
    public function testSetBase()
    {
        $dir  = Solar_Class::dir('Solar', '..');
        $base = Solar_Dir::fix(realpath($dir));
        
        $map = Solar::factory('Solar_Class_Map');
        $map->setBase($base);
        
        $actual = $map->getBase();
        $this->assertSame($actual, $base);
    }
}
