<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_View_Helper_Form extends Test_Solar_View_Helper {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_View_Helper_Form = array(
    );
    
    public function _postConstruct()
    {
        parent::_postConstruct();
        
        // when running from the command line, these elements are empty.
        // add them so that web-like testing can occur.
        $this->_request->server['HTTP_HOST']    = 'example.com';
        $this->_request->server['SCRIPT_NAME']  = '/path/to/index.php';
        $this->_request->server['PATH_INFO']    = '/appname/action';
        $this->_request->server['QUERY_STRING'] = 'foo=bar&baz=dib';
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
     * Test -- Magic __call() for addElement() using element helpers.
     * 
     */
    public function test__call()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a single element to the form.
     * 
     */
    public function testAddElement()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds to the form-level feedback message array.
     * 
     */
    public function testAddFeedback()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a submit button named 'process' to the form, using a translated locale key stub as the submit value.
     * 
     */
    public function testAddProcess()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a group of process buttons with an optional label.
     * 
     */
    public function testAddProcessGroup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Automatically adds multiple pieces to the form.
     * 
     */
    public function testAuto()
    {
        $this->todo('stub');
    }
    
    public function testAuto_attribs()
    {
        // form object with default attribs
        $form = Solar::factory('Solar_Form');
        $form->attribs['foo'] = 'bar';
        
        // form helper: set attribs directly
        $this->_view->form()->setAttrib('action', '/foo/bar/baz');
        
        // auto form object attribs
        $this->_view->form()->auto($form);
        
        // form helper: set attrib directly
        $this->_view->form()->setAttrib('enctype', 'application/x-www-form-urlencoded');
        
        // what do we actually have?
        $actual = $this->_view->form()->fetch();
        
        // what should we have?
        $expect = <<<FORM
<form action="/foo/bar/baz" method="post" enctype="application/x-www-form-urlencoded" foo="bar">
</form>
FORM;

        $this->assertSame(trim($actual), trim($expect));
    }
    
    /**
     * 
     * Test -- Begins a <fieldset> block with a legend/caption.
     * 
     */
    public function testBeginFieldset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Begins a group of form elements under a single label.
     * 
     */
    public function testBeginGroup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Ends a <fieldset> block.
     * 
     */
    public function testEndFieldset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Ends a group of form elements.
     * 
     */
    public function testEndGroup()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Builds and returns the form output.
     * 
     */
    public function testFetch()
    {
        $this->_view->form()->setAttrib('foo', 'bar');
        
        $this->_view->form()->addElement(
            array(
                'name' => 'baz',
                'type' => 'text',
                'size' => '10',
                'label' => 'Zim Gir',
                'value' => 'dib',
            )
        );
        
        $actual = $this->_view->form()->fetch();
        $expect = <<<EXPECT
<form action="/path/to/index.php/appname/action?foo=bar&amp;baz=dib" method="post" enctype="multipart/form-data" foo="bar">
    <dl class="list">
            <dt class="baz">
                <label for="baz" class="baz">Zim Gir</label>
            </dt>
            <dd class="baz">
                <input type="text" name="baz" value="dib" id="baz" class="input-text baz" />
            </dd>
    </dl>
</form>
EXPECT;
        $this->assertSame(trim($actual), trim($expect));
    }
    
    public function testFetch_noFormTag()
    {
        $this->_view->form()->setAttrib('foo', 'bar');
        
        $this->_view->form()->addElement(
            array(
                'name' => 'baz',
                'type' => 'text',
                'size' => '10',
                'label' => 'Zim Gir',
                'value' => 'dib',
            )
        );
        
        $actual = $this->_view->form()->fetch(false);
        $expect = <<<EXPECT
    <dl class="list">
            <dt class="baz">
                <label for="baz" class="baz">Zim Gir</label>
            </dt>
            <dd class="baz">
                <input type="text" name="baz" value="dib" id="baz" class="input-text baz" />
            </dd>
    </dl>
EXPECT;
        $this->assertSame(trim($actual), trim($expect));
    }
    
    /**
     * 
     * Test -- Main method interface to Solar_View.
     * 
     */
    public function testForm()
    {
        // check for fluency
        $actual = $this->_view->form();
        $this->assertInstance($actual, 'Solar_View_Helper_Form');
        
        $expect = $this->_view->getHelper('form');
        $this->assertSame($actual, $expect);
    }
    
    public function testForm_solarFormObject()
    {
        $form = Solar::factory('Solar_Form');
        
        $form->attribs['foo'] = 'bar';
        
        $form->setElement(
            'baz',
            array(
                'type' => 'text',
                'value' => 'dib',
                'label' => 'Zim Gir',
                'attribs' => array('size' => 10),
            )
        );
        
        $actual = $this->_view->form($form);
        $expect = <<<EXPECT
<form action="/path/to/index.php/appname/action?foo=bar&amp;baz=dib" method="post" enctype="multipart/form-data" foo="bar">
    <dl class="list">
            <dt class="baz">
                <label for="baz" class="baz">Zim Gir</label>
            </dt>
            <dd class="baz">
                <input type="text" name="baz" value="dib" size="10" id="baz" class="input-text baz" />
            </dd>
    </dl>
</form>
EXPECT;
        $this->assertSame(trim($actual), trim($expect));
    }
    
    /**
     * 
     * Test -- Gets the form validation status.
     * 
     */
    public function testGetStatus()
    {
        $helper = $this->_view->getHelper('form');
        
        $helper->setStatus(true);
        $this->assertTrue($helper->getStatus());
        
        $helper->setStatus(false);
        $this->assertFalse($helper->getStatus());
        
        $helper->setStatus(null);
        $this->assertNull($helper->getStatus());
    }
    
    /**
     * 
     * Test -- Resets the form entirely.
     * 
     */
    public function testReset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets a form-tag attribute.
     * 
     */
    public function testSetAttrib()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the form validation status.
     * 
     */
    public function testSetStatus()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Magic __toString() to print out the form automatically.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds multiple elements to the form.
     * 
     */
    public function testAddElements()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When fetching output, render elements as part of an HTML definition list.
     * 
     */
    public function testDecorateAsDlList()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When fetching output, render elements without any surrounding decoration.
     * 
     */
    public function testDecorateAsPlain()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- When fetching output, render elements as part of an HTML table.
     * 
     */
    public function testDecorateAsTable()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets multiple form-tag attributes.
     * 
     */
    public function testSetAttribs()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Set the CSS class to use for particular element type.
     * 
     */
    public function testSetCssClass()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Set the CSS classes to use for various element types.
     * 
     */
    public function testSetCssClasses()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Set decoration tag to use for a particular form part.
     * 
     */
    public function testSetDecorator()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the decoration tags to use for various form parts.
     * 
     */
    public function testSetDecorators()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets where the element description goes, 'label' or 'value'.
     * 
     */
    public function testSetDescrPart()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Use this suffix string on all labels; for example, ": ".
     * 
     */
    public function testSetLabelSuffix()
    {
        $this->todo('stub');
    }
}
