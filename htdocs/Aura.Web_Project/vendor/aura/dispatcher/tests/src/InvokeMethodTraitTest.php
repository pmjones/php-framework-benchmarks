<?php
namespace Aura\Dispatcher;

class InvokeMethodTraitTest extends \PHPUnit_Framework_TestCase
{
    use InvokeMethodTrait;
    
    public function testInvokeMethod_notCallable()
    {
        $object = new MockBase;
        $this->setExpectedException('Aura\Dispatcher\Exception\MethodNotDefined');
        $object->exec('noSuchMethod');
    }
    
    public function testInvokeMethod_public()
    {
        // works on base object
        $object = new MockBase;
        $expect = 'FOO BAR baz';
        $actual = $object->exec(
            'publicMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
        $this->assertSame($expect, $actual);
        
        // works on extended object
        $object = new MockExtended;
        $expect = 'FOO BAR baz';
        $actual = $object->exec(
            'publicMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
        $this->assertSame($expect, $actual);
    }

    public function testInvokeMethod_protected()
    {
        // works on base object
        $object = new MockBase;
        $expect = 'FOO BAR baz';
        $actual = $object->exec(
            'protectedMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
        $this->assertSame($expect, $actual);
        
        // works on extended object
        $object = new MockExtended;
        $expect = 'FOO BAR baz';
        $actual = $object->exec(
            'protectedMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
        $this->assertSame($expect, $actual);
        
        // fails on external call
        $object = new MockExtended;
        $expect = 'FOO BAR baz';
        $this->setExpectedException('Aura\Dispatcher\Exception\MethodNotAccessible');
        $actual = $this->invokeMethod(
            $object,
            'protectedMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
    }
    
    public function testInvokeMethod_private()
    {
        // works on base object
        $object = new MockBase;
        $expect = 'FOO BAR baz';
        $actual = $object->exec(
            'privateMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
        $this->assertSame($expect, $actual);
        
        // fails on extended object
        $object = new MockExtended;
        $expect = 'FOO BAR baz';
        $this->setExpectedException('Aura\Dispatcher\Exception\MethodNotAccessible');
        $actual = $object->exec(
            'privateMethod',
            [
                'foo' => 'FOO',
                'bar' => 'BAR',
            ]
        );
    }
    
    public function testInvokeMethod_positionalParams()
    {
        $object = new MockBase;
        $expect = 'FOO BAR baz';
        $actual = $object->exec(
            'publicMethod',
            [
                0 => 'FOO',
                1 => 'BAR',
            ]
        );
        $this->assertSame($expect, $actual);
    }
    
    public function testInvokeMethod_directParams()
    {
        $object = new MockBase;
        
        $params = [
            'foo' => 'foo',
            'bar' => 'bar',
            'baz' => 'baz',
        ];
        $params['params'] =& $params;
        
        $expect = 'foo bar baz';
        $actual = $object->exec('directParams', $params);
        $this->assertSame($expect, $actual);
    }
    
    public function testInvokeMethod_paramNotSpecified()
    {
        $object = new MockBase;
        $this->setExpectedException(
            'Aura\Dispatcher\Exception\ParamNotSpecified',
            'Aura\Dispatcher\MockBase::publicMethod(1 : $bar)'
        );
        $object->exec(
            'publicMethod',
            [
                'foo' => 'foo',
                'baz' => 'baz',
            ]
        );
    }
}
