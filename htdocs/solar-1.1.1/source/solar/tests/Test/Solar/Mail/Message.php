<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Mail_Message extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Mail_Message = array(
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
        $obj = Solar::factory('Solar_Mail_Message');
        $this->assertInstance($obj, 'Solar_Mail_Message');
    }
    
    /**
     * 
     * Test -- Adds a "Bcc:" address recipient.
     * 
     */
    public function testAddBcc()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a "Cc:" address recipient.
     * 
     */
    public function testAddCc()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a custom header to the message.
     * 
     */
    public function testAddHeader()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Adds a "To:" address recipient.
     * 
     */
    public function testAddTo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Attaches a file to the message.
     * 
     */
    public function testAttachFile()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Attaches a Solar_Mail_Message_Part to the message.
     * 
     */
    public function testAttachPart()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches all the content parts of this message as a string.
     * 
     */
    public function testFetchContent()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetches all the headers of this message as a sequential array.
     * 
     */
    public function testFetchHeaders()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the character set for this message.
     * 
     */
    public function testGetCharset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the CRLF sequence for this message.
     * 
     */
    public function testGetCrlf()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the "From:" address for this message.
     * 
     */
    public function testGetFrom()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the Solar_Mail_Message_Part for the HTML portion.
     * 
     */
    public function testGetHtml()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array of all recipient addresses.
     * 
     */
    public function testGetRcpt()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the "Reply-To:" address for this message.
     * 
     */
    public function testGetReplyTo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the current Return-Path address for the email.
     * 
     */
    public function testGetReturnPath()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the message subject.
     * 
     */
    public function testGetSubject()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the Solar_Mail_Message_Part for the plain-text portion.
     * 
     */
    public function testGetText()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- If a transport dependency has been injected, use it to send this email.
     * 
     */
    public function testSend()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the character set for this message.
     * 
     */
    public function testSetCharset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the CRLF sequence for this message.
     * 
     */
    public function testSetCrlf()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the "From:" (sender) on this message.
     * 
     */
    public function testSetFrom()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the part for the HTML portion of this message.
     * 
     */
    public function testSetHtml()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the "Reply-To:" on this message.
     * 
     */
    public function testSetReplyTo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the Return-Path header for an email.
     * 
     */
    public function testSetReturnPath()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the subject of the message.
     * 
     */
    public function testSetSubject()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the part for the plain-text portion of this message.
     * 
     */
    public function testSetText()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sets the Solar_Mail_Transport dependency.
     * 
     */
    public function testSetTransport()
    {
        $this->todo('stub');
    }
}
