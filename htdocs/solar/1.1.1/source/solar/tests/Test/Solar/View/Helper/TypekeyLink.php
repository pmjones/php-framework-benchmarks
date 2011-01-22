<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_TypekeyLink extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_TypekeyLink = array(
    );
    
    public function preTest()
    {
        parent::preTest();
        
        // when running from the command line, these elements are empty.
        // add them so that web-like testing can occur.
        $this->_request->server['HTTP_HOST']  = 'example.com';
        $this->_request->server['SCRIPT_NAME']  = '/index.php';
        $this->_request->server['PATH_INFO']    = '/control/action';
        $this->_request->server['QUERY_STRING'] = 'foo=bar&baz=dib&process=zim';
        $this->_request->server['REQUEST_URI']  = $this->_request->server['SCRIPT_NAME']
                                                . $this->_request->server['PATH_INFO']
                                                . '?'
                                                . $this->_request->server['QUERY_STRING'];
        
        // emulate GET vars from the URI
        parse_str($this->_request->server['QUERY_STRING'], $this->_request->get);
    }
    
    // -----------------------------------------------------------------
    // 
    // Test methods.
    // 
    // -----------------------------------------------------------------
    
    /**
     * 
     * Test -- Generates a link to the TypeKey login site.
     * 
     */
    public function testTypekeyLink()
    {
        // note that the 'process' key should have been removed
        $expect = '<a href="https://www.typekey.com/t/typekey/login?need_email=0&amp;_return=http%3A%2F%2Fexample.com%2Findex.php%2Fcontrol%2Faction%3Ffoo%3Dbar%26baz%3Ddib">Sign In</a>';
        
        $actual = $this->_view->typekeyLink('Sign In');
        $this->assertSame($actual, $expect);
    }
}
