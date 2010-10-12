<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Mime extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Mime = array(
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
        $obj = Solar::factory('Solar_Mime');
        $this->assertInstance($obj, 'Solar_Mime');
    }
    
    /**
     * 
     * Test -- Applies the requested encoding to a text string.
     * 
     */
    public function testEncode()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Applies "base64" encoding to text.
     * 
     */
    public function testEncodeBase64()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Applies "quoted-printable" encoding to text.
     * 
     */
    public function testEncodeQp()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sanitizes header labels by removing all characters besides [a-zA-z0-9_-].
     * 
     */
    public function testHeaderLabel()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates a header label/value line after sanitizing, encoding, and wrapping.
     * 
     */
    public function testHeaderLine()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Sanitizes a header value, then encodes and wraps as per RFC 2047.
     * 
     */
    public function testHeaderValue()
    {
        $this->todo('stub');
    }
}
