<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_Solar_Json extends Solar_Test {
    
    /**
     * 
     * Configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Json = array(
    );
    
    public function _newJson()
    {
        return Solar::factory('Solar_Json', array(
            'bypass_ext' => true,
            'bypass_mb' => true,
        ));
    }
    
    public function _newExtJson()
    {
        if (! function_exists('json_encode')) {
            $this->skip('cannot test ext/json, extension not loaded');
        }
        
        return Solar::factory('Solar_Json');
    }
    
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
        $obj = Solar::factory('Solar_Json');
        $this->assertInstance($obj, 'Solar_Json');
    }
    
    /**
     * 
     * Test -- Decodes the $encodedValue string which is encoded in the JSON format.
     * 
     */
    public function testDecode()
    {
        $json = $this->_newJson();
        
        $before = '{ "test": { "foo": "bar" } }';
        
        $actual = var_export($json->decode($before), 1);
        
        $expect = "stdClass::__set_state(array(\n"
                . "   'test' => \n"
                . "  stdClass::__set_state(array(\n"
                . "     'foo' => 'bar',\n"
                . "  )),\n"
                . "))";
        
        $this->assertSame($actual, $expect);
    }
    
    public function testDecode_failure()
    {
        $dir = Solar_Class::dir('Mock_Solar_Json');
        $tests = scandir($dir);
        natsort($tests);
        
        $json = $this->_newJson();
        
        foreach ($tests as $file) {
            if (substr($file, 0, 4) == 'fail' && substr($file, -4) == 'json') {
                $before = file_get_contents("$dir$file");
                $this->assertNull($json->decode($before));
            }
        }
    }
    
    public function testDecode_array()
    {
        $json = $this->_newJson();
        
        $before = '[[[[[[[[[[[[[[[[[[["Not too deep"]]]]]]]]]]]]]]]]]]]';
        $actual = $json->decode($before);
        
        $expect = array(
            array(
              array(
                array(
                  array(
                    array(
                      array(
                        array(
                          array(
                            array(
                              array(
                                array(
                                  array(
                                    array(
                                      array(
                                        array(
                                          array(
                                            array(
                                              array('Not too deep')
                                            )
                                          )
                                        )
                                      )
                                    )
                                  )
                                )
                              )
                            )
                          )
                        )
                      )
                    )
                  )
                )
              )
            )
          );
        $this->assertSame($actual, $expect);
    
    }
    
    public function testDecode_nullTrueFalse()
    {
        $json = $this->_newJson();
        $this->assertNull($json->decode('null'));
        
        $this->assertNull($json->decode('true'));
        $expect = "stdClass::__set_state(array(\n"
        . "   'foo' => true,\n"
        . "))";
        $this->assertSame(var_export($json->decode('{"foo": true}'), 1), $expect);
        
        $this->assertNull($json->decode('false'));
        $expect = "stdClass::__set_state(array(\n"
        . "   'foo' => false,\n"
        . "))";
        $this->assertSame(var_export($json->decode('{"foo": false}'), 1), $expect);
    }
    
    public function testDecode_numeric()
    {
        $json = $this->_newJson();
        
        // NULL for strings-only, numeric value when in legit container
        $this->assertNull($json->decode('1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => 1,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[1]}'), 1), $expect);
        
        $this->assertNull($json->decode('-1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => -1,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[-1]}'), 1), $expect);
        
        $this->assertNull($json->decode('1.0'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => 1,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[1.0]}'), 1), $expect);
        
        $this->assertNull($json->decode('1.1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => 1.1,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[1.1]}'), 1), $expect);
        
        $this->assertNull($json->decode('1.1e1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => 11,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[1.1e1]}'), 1), $expect);
        
        $this->assertNull($json->decode('1.10e+1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => 11,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[1.10e+1]}'), 1), $expect);
        
        $this->assertNull($json->decode('1.1e-1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => 0.11,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[1.1e-1]}'), 1), $expect);
        
        $this->assertNull($json->decode('-1.1e-1'));
        $expect = "stdClass::__set_state(array(\n"
                . "   'foo' => \n"
                . "  array (\n"
                . "    0 => -0.11,\n"
                . "  ),\n"
                . "))";
        $this->assertSame(var_export($json->decode('{"foo":[-1.1e-1]}'), 1), $expect);
    }
    
    public function testDecode_object()
    {
        $json = $this->_newJson();
        
        $before = '{ "test": { "foo": "bar" } }';
        $actual = var_export($json->decode($before), 1);
        $expect = "stdClass::__set_state(array(\n"
                . "   'test' => \n"
                . "  stdClass::__set_state(array(\n"
                . "     'foo' => 'bar',\n"
                . "  )),\n"
                . "))";
        $this->assertSame($actual, $expect);
        
        $before = '{"a_string":"\"he\":llo}:{world","an_array":[1,2,3],"obj":{"a_number":123}}';
        $actual = var_export($json->decode($before), 1);
        $expect = "stdClass::__set_state(array(\n"
                . "   'a_string' => '\"he\":llo}:{world',\n"
                . "   'an_array' => \n"
                . "  array (\n"
                . "    0 => 1,\n"
                . "    1 => 2,\n"
                . "    2 => 3,\n"
                . "  ),\n"
                . "   'obj' => \n"
                . "  stdClass::__set_state(array(\n"
                . "     'a_number' => 123,\n"
                . "  )),\n"
                . "))";
        $this->assertSame($actual, $expect);
        
        $before = '{ "JSON Test Pattern pass3": { "The outermost value": "must be an object or array.", "In this test": "It is an object." } }';
        $actual = var_export($json->decode($before), 1);
        $expect = "stdClass::__set_state(array(\n"
                . "   'JSON Test Pattern pass3' => \n"
                . "  stdClass::__set_state(array(\n"
                . "     'The outermost value' => 'must be an object or array.',\n"
                . "     'In this test' => 'It is an object.',\n"
                . "  )),\n"
                . "))";
        $this->assertSame($actual, $expect);
    }
    
    public function testDecode_stress()
    {
        $dir = Solar_Class::dir('Mock_Solar_Json');
        $before = file_get_contents($dir . 'pass1.json');
        
        $json = $this->_newJson();
        $actual = $json->decode($before);
    
        $expect = array();
        $expect[0] = 'JSON Test Pattern pass1';
        $expect[1] = (object) array('object with 1 member' => array('array with 1 element'));
        $expect[2] = new stdClass;
        $expect[3] = array();
        $expect[4] = -42;
        $expect[5] = true;
        $expect[6] = false;
        $expect[7] = null;
        
        $megakey = "/\\\""
                 . $this->_unicodeToUtf8(array(51966))
                 . $this->_unicodeToUtf8(array(47806))
                 . $this->_unicodeToUtf8(array(43928))
                 . $this->_unicodeToUtf8(array(64734))
                 . $this->_unicodeToUtf8(array(48346))
                 . $this->_unicodeToUtf8(array(61258))
                 . chr(0x08)
                 . chr(0x0C)."\n\r\t"
                 . "`1~!@#$%^&*()_+-=[]{}|;:',./<>?";
        
        $expect[8] = (object) array(
            'integer'   => 1234567890,
            'real'      => -9876.543210,
            'e'         => 0.123456789e-12,
            'E'         => 1.234567890E+34,
            '_empty_'   => INF,
            'zero'      => 0,
            'one'       => 1,
            'space'     => ' ',
            'quote'     => '"',
            'backslash' => '\\',
            'controls'  => chr(0x08). chr(0x0C)."\n\r\t",
            'slash'     => "/ & /",
            'alpha'     => 'abcdefghijklmnopqrstuvwyz',
            'ALPHA'     => 'ABCDEFGHIJKLMNOPQRSTUVWYZ',
            'digit'     => '0123456789',
            'special'   => "`1~!@#$%^&*()_+-={':[,]}|;.</>?",
            'hex'       => $this->_unicodeToUtf8(array(291)).
                           $this->_unicodeToUtf8(array(17767)).
                           $this->_unicodeToUtf8(array(35243)).
                           $this->_unicodeToUtf8(array(52719)).
                           $this->_unicodeToUtf8(array(43981)).
                           $this->_unicodeToUtf8(array(61258)),
            'true'      => true,
            'false'     => false,
            'null'      => null,
            'array'     => array(),
            'object'    => new stdClass(),
            'address'   => '50 St. James Street',
            'url'       => 'http://www.JSON.org/',
            'comment'   => "// /* <!-- --",
            '# -- --> */' => ' ',
            ' s p a c e d ' => array(1,2,3,4,5,6,7),
            'compact'   => array(1,2,3,4,5,6,7),
            'jsontext'  => "{\"object with 1 member\":[\"array with 1 element\"]}",
            'quotes'    => "&#34; \" %22 0x22 034 &#x22;",
            "$megakey" => 'A key can be any string',
        );
        $expect[9] = 0.5;
        $expect[10] = 98.6;
        $expect[11] = 99.44;
        $expect[12] = 1066;
        $expect[13] = 'rosebud';
        //print_r($expect);
    
    
        // Commented out portion illustrates that the only differences in the 
        // UNserialized versions is the value of the 'object' property:
        
        /*
        
        actual
        object(stdClass)#27 (0) {
        }
        expect
        object(stdClass)#25 (0) {
        }
        
        */
        // ... so we serialize both values for comparison in the assertion
        
        // $a8 = $actual[8];
        // $e8 = $expect[8];
        // $avars = get_object_vars($a8);
        // $evars = get_object_vars($e8);
        // 
        // foreach ($avars as $key => $val) {
        //     if (!array_key_exists($key, $evars)) {
        //         var_dump($key);
        //         echo "key: {$key} not found in expected\n";
        //     } else {
        //         if ($val !== $evars[$key]) {
        //             echo "actual\n";
        //             var_dump($val);
        //             echo "expect\n";
        //             var_dump($evars[$key]);                    
        //         }
        //     }
        //     
        // }
    
        $this->assertSame(serialize($actual), serialize($expect));        
    }
    
    
    /**
     * 
     * Test -- Encodes the mixed $valueToEncode into JSON format.
     * 
     */
    public function testEncode()
    {
        $json = $this->_newJson();
        $before = 'hello world';
        $actual = $json->encode($before);
        $expect = '"hello world"';
        $this->assertSame($actual, $expect);
    }
    
    public function testEncode_array()
    {
        $json = $this->_newJson();
        
        // array with elements and nested arrays
        $before = array(null, true, array(1, 2, 3), "hello\"],[world!");
        $expect = '[null,true,[1,2,3],"hello\"],[world!"]';
        $this->assertSame($json->encode($before), $expect);
        
        // associative array with nested associative arrays
        $before = array('car1' => array(
                                    'color'=> 'tan',
                                    'model' => 'sedan'
                                ),
                        'car2' => array(
                                    'color' => 'red',
                                    'model' => 'sports'
                                )
                        );
        $expect = '{"car1":{"color":"tan","model":"sedan"},"car2":{"color":"red","model":"sports"}}';
        $this->assertSame($json->encode($before), $expect);
        
        // associative array with nested associative arrays, and some numeric keys thrown in
        $before = array(0=> array(0=> 'tan\\', 'model\\' => 'sedan'), 1 => array(0 => 'red', 'model' => 'sports'));
        $expect = '[{"0":"tan\\\\","model\\\\":"sedan"},{"0":"red","model":"sports"}]';
        $this->assertSame($json->encode($before), $expect);
        
        // associative array numeric keys which are not fully populated in a range of 0 to length-1
        $before = array (1 => 'one', 2 => 'two', 5 => 'five');
        $expect = '{"1":"one","2":"two","5":"five"}';
        $this->assertSame($json->encode($before), $expect);
    }
    
    public function testEncode_dequote()
    {
        $json = $this->_newJson();
        
        $before = array(
            'parameters'=> "Form.serialize('foo')",
            'asynchronous' => true,
            'onSuccess' => 'function(t) { new Effect.Highlight(el, {"duration":1});}',
            'on404'     => 'function(t) { alert(\'Error 404: location not found\'); }',
            'onFailure' => 'function(t) { alert(\'Ack!\'); }',
            'requestHeaders' => array('X-Solar-Version', Solar::apiVersion(), 'X-Foo', 'Bar')
        );
        
        $after = $json->encode($before, array('onSuccess', 'on404', 'onFailure', 'parameters'));
        
        $expect = <<< ENDEXPECT
{"parameters":Form.serialize('foo'),"asynchronous":true,"onSuccess":function(t) { new Effect.Highlight(el, {"duration":1});},"on404":function(t) { alert('Error 404: location not found'); },"onFailure":function(t) { alert('Ack!'); },"requestHeaders":["X-Solar-Version","1.1.1","X-Foo","Bar"]}
ENDEXPECT;
        
        $this->assertSame($after, trim($expect));
    
    }
    
    public function testEncode_nullTrueFalse()
    {
        $json = $this->_newJson();
        $this->assertSame($json->encode(null), 'null');
        $this->assertSame($json->encode(true), 'true');
        $this->assertSame($json->encode(false), 'false');
    }
    
    public function testEncode_numeric()
    {
        $json = $this->_newJson();
        $this->assertSame($json->encode(1), '1');
        $this->assertSame($json->encode(-1), '-1');
        $this->assertSame($json->encode(1.0), '1');
        $this->assertSame($json->encode(1.1), '1.1');
    }
    
    public function testEncode_object()
    {
        $json = $this->_newJson();
        
        // object with properties, nested object and arrays
        $obj = new stdClass();
        $obj->a_string = '"he":llo}:{world';
        $obj->an_array = array(1, 2, 3);
        $obj->obj = new stdClass();
        $obj->obj->a_number = 123;
        
        $expect = '{"a_string":"\"he\":llo}:{world","an_array":[1,2,3],"obj":{"a_number":123}}';
        $this->assertSame($json->encode($obj), $expect);
    }
    
    public function testEncode_string()
    {
        $json = $this->_newJson();
        
        $this->assertSame($json->encode('hello world'), '"hello world"');
        
        $expect = '"hello\\t\\"world\\""';
        $this->assertSame($json->encode("hello\t\"world\""), $expect);
        
        $expect = '"\\\\\\r\\n\\t\\"\\/"';
        $this->assertSame($json->encode("\\\r\n\t\"/"), $expect);
        
        $expect = '"h\u00c3\u00a9ll\u00c3\u00b6 w\u00c3\u00b8r\u00c5\u201ad"';
        $this->assertSame($json->encode('hÃ©llÃ¶ wÃ¸rÅ‚d'), $expect);
        
        $expect = '"\u0440\u0443\u0441\u0441\u0438\u0448"';
        $this->assertSame($json->encode("руссиш"), $expect);
    }
    
    /**
     * 
     * Compatibility between userland and ext/json implementations.
     * 
     */
    
    public function testEncode_compat()
    {
        $json = $this->_newExtJson();
        $before = 'hello world';
        $actual = $json->encode($before);
        $expect = '"hello world"';
        $this->assertSame($actual, $expect);
    }
    
    public function testEncode_compatNullTrueFalse()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $this->assertSame($pjson->encode(null), $njson->encode(null));
        $this->assertSame($pjson->encode(true), $njson->encode(true));
        $this->assertSame($pjson->encode(false), $njson->encode(false));
    }
    
    public function testEncode_compatNumeric()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $this->assertSame($pjson->encode(1), $njson->encode(1));
        $this->assertSame($pjson->encode(-1), $njson->encode(-1));
        $this->assertSame($pjson->encode(1.0), $njson->encode(1.0));
        $this->assertSame($pjson->encode(1.1), $njson->encode(1.1));
    }
    
    public function testEncode_compatString()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $this->assertSame($pjson->encode('hello world'),
                          $njson->encode('hello world'));
        
        $this->assertSame($pjson->encode("hello\t\"world\""),
                          $njson->encode("hello\t\"world\""));
        
        $this->assertSame($pjson->encode("\\\r\n\t\"/"),
                          $njson->encode("\\\r\n\t\"/"));
        
        $this->assertSame($pjson->encode('hÃ©llÃ¶ wÃ¸rÅ‚d'),
                          $njson->encode('hÃ©llÃ¶ wÃ¸rÅ‚d'));
        
        $this->assertSame($pjson->encode("руссиш"),
                          $njson->encode("руссиш"));
    }
    
    
    public function testEncode_compatArray()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        // array with elements and nested arrays
        $before = array(null, true, array(1, 2, 3), "hello\"],[world!");
        $this->assertSame($pjson->encode($before),
                          $njson->encode($before));
        
        // associative array with nested associative arrays
        $before = array('car1' => array(
                                    'color'=> 'tan',
                                    'model' => 'sedan'
                                ),
                        'car2' => array(
                                    'color' => 'red',
                                    'model' => 'sports'
                                )
                        );
        $this->assertSame($pjson->encode($before),
                          $njson->encode($before));
        
        // associative array with nested associative arrays, and some numeric keys thrown in
        $before = array(0=> array(0=> 'tan\\', 'model\\' => 'sedan'), 1 => array(0 => 'red', 'model' => 'sports'));
        $this->assertSame($pjson->encode($before),
                          $njson->encode($before));
        
        // associative array numeric keys which are not fully populated in a range of 0 to length-1
        $before = array (1 => 'one', 2 => 'two', 5 => 'five');
        $this->assertSame($pjson->encode($before),
                          $njson->encode($before));
    }
    
    public function testEncode_compatObject()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        // object with properties, nested object and arrays
        $obj = new stdClass();
        $obj->a_string = '"he":llo}:{world';
        $obj->an_array = array(1, 2, 3);
        $obj->obj = new stdClass();
        $obj->obj->a_number = 123;
        
        $this->assertSame($pjson->encode($obj),
                          $njson->encode($obj));
    }
    
    public function testDecode_compat()
    {
        $json = $this->_newExtJson();
        
        $before = '{ "test": { "foo": "bar" } }';
        
        $actual = var_export($json->decode($before), 1);
        
        $expect = "stdClass::__set_state(array(\n"
                . "   'test' => \n"
                . "  stdClass::__set_state(array(\n"
                . "     'foo' => 'bar',\n"
                . "  )),\n"
                . "))";
        
        $this->assertSame($actual, $expect);
    }
    
    public function testDecode_compatNullTrueFalse()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $this->assertSame($pjson->decode('null'),
                          $njson->decode('null'));
        $this->assertSame($pjson->decode('true'),
                          $njson->decode('true'));
        $this->assertSame(var_export($pjson->decode('{"foo": true}'), 1),
                          var_export($njson->decode('{"foo": true}'), 1));
        $this->assertSame($pjson->decode('false'),
                          $njson->decode('false'));
        $this->assertSame(var_export($pjson->decode('{"foo": false}'), 1),
                          var_export($njson->decode('{"foo": false}'), 1));
    }
    
    public function testDecode_compatNumeric()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $this->assertSame($pjson->decode('1'), $njson->decode('1'));
        $before = '{"foo":[1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('-1'), $njson->decode('-1'));
        $before = '{"foo":[-1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('1.0'), $njson->decode('1.0'));
        $before = '{"foo":[1.0]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('1.1'), $njson->decode('1.1'));
        $before = '{"foo":[1.1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('1.1e1'), $njson->decode('1.1e1'));
        $before = '{"foo":[1.1e1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('1.10e+1'), $njson->decode('1.10e+1'));
        $before = '{"foo":[1.10e+1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('1.1e-1'), $njson->decode('1.1e-1'));
        $before = '{"foo":[1.1e-1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $this->assertSame($pjson->decode('-1.1e-1'), $njson->decode('-1.1e-1'));
        $before = '{"foo":[-1.1e-1]}';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
                
    }
    
    public function testDecode_compatArray()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $before = '[[[[[[[[[[[[[[[[[[["Not too deep"]]]]]]]]]]]]]]]]]]]';
        $this->assertSame($pjson->decode($before),
                          $njson->decode($before));
    }
    
    public function testDecode_compatObject()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $before = '{ "test": { "foo": "bar" } }';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
        
        $before = '{ "JSON Test Pattern pass3": { "The outermost value": "must be an object or array.", "In this test": "It is an object." } }';
        $this->assertSame(var_export($pjson->decode($before), 1),
                          var_export($njson->decode($before), 1));
    }
    
    public function testDecode_compatStress()
    {
        $dir = Solar_Class::dir('Mock_Solar_Json');
        $before = file_get_contents($dir . 'pass1.json');
        
        $pjson = $this->_newJson();
        $pexpect = serialize($pjson->decode($before));
        
        $njson = $this->_newExtJson();
        $nexpect = serialize($njson->decode($before));
        
        $this->assertSame($pexpect, $nexpect);
    }
    
    public function testDecode_compatFailure()
    {
        $pjson = $this->_newJson();
        $njson = $this->_newExtJson();
        
        $dir = Solar_Class::dir('Mock_Solar_Json');
        $tests = scandir($dir);
        natsort($tests);
        
        foreach ($tests as $file) {
            
            if ($file == 'fail18.json') {
                // skip this one, because the userland implementation can't
                // handle it, but ext/json can.
                continue;
            }
            
            if (substr($file, 0, 4) == 'fail' && substr($file, -4) == 'json') {
                $before = file_get_contents($dir.$file);
                $this->diag("p: $file");
                $this->assertNull($pjson->decode($before));
                $this->diag("n: $file");
                $this->assertNull($njson->decode($before));
            }
        }
    }
    
    /**
     * 
     * Hats off to Scott Reynen
     * http://www.randomchaos.com/documents/?source=php_and_unicode
     * 
     * @param array $str Array of unicode bytes
     * 
     */
    protected function _unicodeToUtf8($str)
    {    
        $utf8 = '';
        
        foreach ($str as $unicode) {
            
            if ($unicode < 128) {
                
                $utf8 .= chr($unicode);
            
            } elseif ($unicode < 2048) {
                
                $utf8 .= chr(192 +  ( ( $unicode - ( $unicode % 64 ) ) / 64 ));
                $utf8 .= chr(128 + ( $unicode % 64 ));
            
            } else {
                
                $utf8 .= chr( 224 + (( $unicode - ( $unicode % 4096 ) ) / 4096 ));
                $utf8 .= chr( 128 + (( ( $unicode % 4096 ) - ( $unicode % 64 ) ) / 64 ));
                $utf8 .= chr( 128 + ($unicode % 64 ));
            
            } // if
        
        } // foreach
        
        return $utf8;
    }
    
}
