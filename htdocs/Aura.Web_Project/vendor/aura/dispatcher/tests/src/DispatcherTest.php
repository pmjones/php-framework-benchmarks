<?php
namespace Aura\Dispatcher;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    protected $dispatcher;
    
    protected $objects;
    
    protected function setUp()
    {
        $this->objects = [
            'factory' => function () {
                return new MockBase;
            },
            'closure' => function ($foo, $bar, $baz = 'baz') {
                return "$foo $bar $baz";
            },
            'invokable' => function () {
                return new MockInvokable;
            }
        ];
        
        $this->dispatcher = new Dispatcher(
            $this->objects,
            'controller',
            'action'
        );
    }
    
    public function testGetSetHasEtc()
    {
        $foo = function () {
            return new MockBase;
        };
        
        $this->assertFalse($this->dispatcher->hasObject('foo'));
        
        $this->dispatcher->setObject('foo', $foo);
        $this->assertTrue($this->dispatcher->hasObject('foo'));
        
        $actual = $this->dispatcher->getObject('foo');
        $this->assertInstanceOf('Closure', $actual);
        
        $actual = $this->dispatcher->getObjects();
        $expect = array_merge($this->objects, ['foo' => $foo]);
        $this->assertSame($expect, $actual);
        
        $bar = function () {
            return new MockExtended;
        };
        
        $this->dispatcher->addObjects(['bar' => $bar]);
        $actual = $this->dispatcher->getObjects();
        $expect = array_merge($this->objects, [
            'foo' => $foo,
            'bar' => $bar,
        ]);
        $this->assertSame($expect, $actual);
        
        $this->setExpectedException('Aura\Dispatcher\Exception\ObjectNotDefined');
        $this->dispatcher->getObject('NoSuchCallable');
    }
    
    public function testParams()
    {
        $this->dispatcher->setObjectParam('foo');
        $actual = $this->dispatcher->getObjectParam();
        $this->assertSame('foo', $actual);
        
        $this->dispatcher->setMethodParam('bar');
        $actual = $this->dispatcher->getMethodParam();
        $this->assertSame('bar', $actual);
    }
    
    public function testDispatch_objectNotSpecified()
    {
        $params = [];
        $this->setExpectedException('Aura\Dispatcher\Exception\ObjectNotSpecified');
        $this->dispatcher->__invoke($params);
    }
    
    public function testDispatch_objectNotDefined()
    {
        $params = ['controller' => 'undefined_object'];
        $this->setExpectedException('Aura\Dispatcher\Exception\ObjectNotDefined');
        $this->dispatcher->__invoke($params);
    }
    
    public function testDispatch_factory()
    {
        $params = [
            'controller' => 'factory',
            'action' => 'publicMethod',
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $actual = $this->dispatcher->__invoke($params);
        $expect = 'FOO BAR baz';
        $this->assertSame($expect, $actual);
    }
    
    
    public function testDispatch_factoryInParams()
    {
        $params = [
            'controller' => function () {
                return new MockBase;
            },
            'action' => 'publicMethod',
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $actual = $this->dispatcher->__invoke($params);
        $expect = 'FOO BAR baz';
        $this->assertSame($expect, $actual);
    }
    
    public function testDispatch_closure()
    {
        $params = [
            'controller' => 'closure',
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $actual = $this->dispatcher->__invoke($params);
        $expect = 'FOO BAR baz';
        $this->assertSame($expect, $actual);
    }
    
    public function testDispatch_closureInParams()
    {
        $params = [
            'controller' => function ($foo, $bar, $baz = 'baz') {
                return "$foo $bar $baz";
            },
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $actual = $this->dispatcher->__invoke($params);
        $expect = 'FOO BAR baz';
        $this->assertSame($expect, $actual);
    }
    
    public function testDispatch_invokableObject()
    {
        $params = [
            'controller' => 'invokable',
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $actual = $this->dispatcher->__invoke($params);
        $expect = 'FOO BAR baz';
        $this->assertSame($expect, $actual);
    }
}
