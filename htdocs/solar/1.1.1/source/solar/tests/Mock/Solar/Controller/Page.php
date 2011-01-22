<?php
/**
 * 
 * Example page-controller to support unit tests.
 * 
 * @category Solar
 * 
 * @package Mock_Solar
 * 
 * @author Paul M. Jones <pmjones@solarphp.com>
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @version $Id: Page.php 4263 2009-12-07 19:25:31Z pmjones $
 * 
 */
class Mock_Solar_Controller_Page extends Solar_Controller_Page
{
    /**
     * 
     * Default action.
     * 
     * @var string
     * 
     */
    protected $_action_default = 'foo';
    
    /**
     * 
     * Silly variable for testing.
     * 
     * @var string
     * 
     */
    public $foo = 'bar';
    
    /**
     * 
     * Count of how many time each hook method has been called.
     * 
     * @var array
     * 
     */
    public $hooks = array(
        '_setup'      => 0,
        '_preRun'     => 0,
        '_preAction'  => 0,
        '_postAction' => 0,
        '_postRun'    => 0,
        '_preRender'  => 0,
        '_postRender' => 0,
    );
    
    /**
     * 
     * Turn off the default layout.
     * 
     * @var string
     * 
     */
    protected $_layout_default = null;
    
    /**
     * 
     * Turn off the initial layout.
     * 
     * @var string
     * 
     */
    protected $_layout = null;
    
    /**
     * 
     * Default action.
     * 
     * @return void
     * 
     */
    public function actionFoo()
    {
        // do nothing
    }
    
    /**
     * 
     * Action named in BumpyCase.
     * 
     * @return void
     * 
     */
    public function actionBumpyCase()
    {
        // do nothing
    }
    
    /**
     * 
     * An action method that has no related view script.
     * 
     * @return void
     * 
     */
    public function actionNoRelatedView()
    {
        // do nothing
    }
    
    /**
     * 
     * Tests the _forward() method.
     * 
     * @return void
     * 
     */
    public function actionTestForward()
    {
        return $this->_forward('foo');
    }
    
    /**
     * 
     * Sets the default action for testing.
     * 
     * @param string $val The default action name.
     * 
     * @return void
     * 
     */
    public function setActionDefault($val)
    {
        $this->_action_default = $val;
    }
    
    /**
     * 
     * Hook for extended setups.
     * 
     * @return void
     * 
     */
    protected function _setup()
    {
        parent::_setup();
        $this->hooks[__FUNCTION__] ++;
    }
    
    /**
     * 
     * Hook for pre-run behavior.
     * 
     * @return void
     * 
     */
    protected function _preRun()
    {
        parent::_preRun();
        $this->hooks[__FUNCTION__] ++;
    }
    
    /**
     * 
     * Hook for pre-action behavior.
     * 
     * @return void
     * 
     */
    protected function _preAction()
    {
        parent::_preAction();
        $this->hooks[__FUNCTION__] ++;
    }
    
    /**
     * 
     * Hook for post-action behavior.
     * 
     * @return void
     * 
     */
    protected function _postAction()
    {
        parent::_postAction();
        $this->hooks[__FUNCTION__] ++;
    }
    
    /**
     * 
     * Hook for post-run behavior.
     * 
     * @return void
     * 
     */
    protected function _postRun()
    {
        parent::_postRun();
        $this->hooks[__FUNCTION__] ++;
    }
    
    /**
     * 
     * Hook for pre-render behavior.
     * 
     * @return void
     * 
     */
    protected function _preRender()
    {
        parent::_preRender();
        $this->hooks[__FUNCTION__] ++;
    }
    
    /**
     * 
     * Hook for post-render filtering.
     * 
     * @return void
     * 
     */
    protected function _postRender()
    {
        parent::_postRender();
        $this->hooks[__FUNCTION__] ++;
    }
}
