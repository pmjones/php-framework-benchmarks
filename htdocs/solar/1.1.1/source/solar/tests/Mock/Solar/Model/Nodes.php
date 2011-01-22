<?php
/**
 * 
 * Example for testing a model of content "nodes".
 * 
 * @category Solar
 * 
 * @package Mock_Solar
 * 
 * @author Paul M. Jones <pmjones@solarphp.com>
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @version $Id: Nodes.php 4489 2010-03-02 15:34:14Z pmjones $
 * 
 */
class Mock_Solar_Model_Nodes extends Solar_Sql_Model
{
    /**
     * 
     * Establish state of this object prior to _setup().
     * 
     * @return void
     * 
     */
    protected function _preSetup()
    {
        // chain to parent
        parent::_preSetup();
        
        // use metadata generated from make-model
        $metadata          = Solar::factory('Mock_Solar_Model_Nodes_Metadata');
        $this->_table_name = $metadata->table_name;
        $this->_table_cols = $metadata->table_cols;
        $this->_index_info      = $metadata->index_info;
    }
    
    /**
     * 
     * Model-specific setup.
     * 
     * @return void
     * 
     */
    protected function _setup()
    {
        // chain to parent
        parent::_setup();
        
        $this->_belongsTo('area');
        
        $this->_belongsTo('area_false', array(
            'foreign_name' => 'areas',
            'where' => '0=1',
        ));
        
        $this->_belongsTo('user');
        
        $this->_hasOne('meta');
        
        $this->_hasOne('meta_false', array(
            'foreign_name' => 'metas',
            'where' => '0=1',
        ));
        
        $this->_hasMany('comments');
        
        $this->_hasMany('comments_false', array(
            'foreign_name' => 'comments',
            'where' => '0=1',
            'join_flag' => true, // force the eager join
        ));
        
        $this->_hasMany('taggings');
        
        $this->_hasManyThrough('tags', 'taggings');
        
        $this->_hasManyThrough('tags_false', 'taggings', array(
            'foreign_name' => 'tags',
            'where' => '0=1',
        ));
        
        $this->_hasMany('taggings_false', array(
            'foreign_name' => 'taggings',
            'where' => '0=1',
        ));
        
        $this->_hasManyThrough('tags_through_false', 'taggings_false', array(
            'foreign_name' => 'tags',
        ));
        
        $this->_hasManyThrough('tags_false_through_false', 'taggings_false', array(
            'foreign_name' => 'tags',
            'where' => '0=1',
        ));
    }
}