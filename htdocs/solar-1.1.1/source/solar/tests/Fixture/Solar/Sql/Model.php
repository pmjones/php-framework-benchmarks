<?php
class Fixture_Solar_Sql_Model extends Solar_Base
{
    protected $_model;
    
    public function setup()
    {
        $this->_model = Solar::dependency('Solar_Sql_Model_Catalog', 'model_catalog');
        $sql = Solar::dependency('Solar_Sql', 'sql');
        $sql->begin();
        $this->_setupUsers();
        $this->_setupPrefs();
        $this->_setupAreas();
        $this->_setupNodes();
        $this->_setupMetas();
        $this->_setupTags();
        $this->_setupTaggings();
        $this->_setupComments();
        $sql->commit();
    }
    
    // add 20-30 users
    protected function _setupUsers()
    {
        $users = $this->_model->users;
        $k = rand(20, 30);
        for ($i = 0; $i < $k; $i ++) {
            $id = $i + 1;
            $user = $users->fetchNew(array(
                'handle' => "handle_$id",
                'passwd' => "passwd_$id",
            ));
            $user->save();
            $user = null;
            unset($user);
        }
    }
    
    // add prefs for each user
    protected function _setupPrefs()
    {
        $prefs = $this->_model->prefs;
        $user_ids = $this->_model->users->fetchCol(array('id'));
        foreach ($user_ids as $id) {
            $pref = $prefs->fetchNew(array(
                'user_id' => $id,
                'email'   => "user_$id@example.com",
                'uri'     => "http://user_$id.example.com",
                'moniker' => "Moniker $id",
            ));
            
            $pref->save();
            $pref = null;
            unset($pref);
        }
    }
    
    // add 3-5 areas, with a random user from 1-5 as owner
    protected function _setupAreas()
    {
        $areas = $this->_model->areas;
        $k = rand(3, 5);
        for ($i = 0; $i < $k; $i ++) {
            $id = $i + 1;
            $area = $areas->fetchNew(array(
                'name'    => "area_$id",
                'user_id' => rand(1, 5),
            ));
            $area->save();
            $area = null;
            unset($area);
        }
    }
    
    // for each area, create 8-12 nodes,
    // each for a random user from 1-20
    protected function _setupNodes()
    {
        $nodes = $this->_model->nodes;
        $area_ids = $this->_model->areas->fetchCol(array('id'));
        foreach ($area_ids as $area_id) {
            $k = rand(8, 12);
            for ($i = 0; $i < $k; $i ++) {
                $id = $i + 1;
                $node = $nodes->fetchNew(array(
                    'subj'    => "Subj $id",
                    'body'    => "Body $id",
                    'area_id' => $area_id,
                    'user_id' => rand(1, 20),
                ));
                $node->save();
                $node = null;
                unset($node);
            }
        }
    }
    
    // one meta for each node
    protected function _setupMetas()
    {
        $metas = $this->_model->metas;
        $node_ids = $this->_model->nodes->fetchCol(array('id'));
        foreach ($node_ids as $id) {
            $meta = $metas->fetchNew(array(
                'node_id' => $id,
            ));
            $meta->save();
            $meta = null;
            unset($meta);
        }
    }
    
    // 8-12 tags
    protected function _setupTags()
    {
        $tags = $this->_model->tags;
        $k = rand(8, 12);
        for ($i = 0; $i < $k; $i ++) {
            $id = $i + 1;
            $tag = $tags->fetchNew(array(
                'name' => "tag_$id",
            ));
            $tag->save();
            $tag = null;
            unset($tag);
        }
    }
    
    // 3-5 tags per node
    protected function _setupTaggings()
    {
        $tag_coll  = $this->_model->tags->fetchAll();
        $tag_last  = count($tag_coll) - 1;
        $node_coll = $this->_model->nodes->fetchAll();
        $taggings  = $this->_model->taggings;
        
        // add some tags on each node through taggings
        foreach ($node_coll as $node) {
            
            // add 3-5 tags on this node
            $k = rand(3,5);
            
            // which tags have we used already?
            $tags_used = array();
            
            // add each of the tags
            for ($i = 0; $i < $k; $i ++) {
                
                // pick a random tag that has not been used yet
                do {
                    $tagno = rand(0, $tag_last);
                } while (in_array($tagno, $tags_used));
                
                // mark it as used
                $tags_used[] = $tagno;
                
                // get the tag from the collection
                $tag = $tag_coll[$tagno];
                
                // match the node to the tag with a tagging
                $tagging = $taggings->fetchNew(array(
                    'node_id' => $node->id,
                    'tag_id'  => $tag->id,
                ));
                
                $tagging->save();
                
                $tag = null;
                unset($tag);
                
                $tagging = null;
                unset($tagging);
            }
        }
        
        $node_coll->free();
        $tag_coll->free();
    }
    
    // add 0-3 comments on each node
    protected function _setupComments()
    {
        $comments = $this->_model->comments;
        $node_ids = $this->_model->nodes->fetchCol(array('id'));
        foreach ($node_ids as $node_id) {
            $k = rand(0,3);
            for ($i = 0; $i < $k; $i ++) {
                $key = $i + 1;
                $comment = $comments->fetchNew(array(
                    'node_id' => $node_id,
                    'body'    => "Anonymous #$key on node ID $node_id",
                    'email'   => "anon_$key@example.com",
                ));
                $comment->save();
                $comment = null;
                unset($comment);
            }
        }
    }
}