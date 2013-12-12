<?php
namespace Aura\Dispatcher;

class InvokeClosureTraitTest extends \PHPUnit_Framework_TestCase
{
    use InvokeClosureTrait;
    
    public function testInvokeClosure_namedParams()
    {
        $closure = function ($foo, $bar, $baz = 'baz') {
            return "$foo $bar $baz";
        };
        $expect = 'FOO BAR baz';
        $actual = $this->invokeClosure($closure, [
            'foo' => 'FOO',
            'bar' => 'BAR',
        ]);
        $this->assertSame($expect, $actual);
    }
    
    public function testInvokeClosure_positionalParams()
    {
        $closure = function ($foo, $bar, $baz = 'baz') {
            return "$foo $bar $baz";
        };
        $expect = 'FOO BAR baz';
        $actual = $this->invokeClosure($closure, [
            0 => 'FOO',
            1 => 'BAR',
        ]);
        $this->assertSame($expect, $actual);
    }
    
    public function testInvokeClosure_directParams()
    {
        $closure = function (array $params) {
            return "{$params['foo']} {$params['bar']} {$params['baz']}";
        };
        
        $params = [
            'foo' => 'foo',
            'bar' => 'bar',
            'baz' => 'baz',
        ];
        $params['params'] =& $params;
        
        $expect = 'foo bar baz';
        $actual = $this->invokeClosure($closure, $params);
        $this->assertSame($expect, $actual);
    }
    
    public function testInvokeClosure_paramNotSpecified()
    {
        $closure = function ($foo, $bar, $baz = 'baz') {
            return "$foo $bar $baz";
        };
        
        $this->setExpectedException(
            'Aura\Dispatcher\Exception\ParamNotSpecified',
            'Closure(1 : $bar)'
        );
        
        $this->invokeClosure($closure, [
                'foo' => 'foo',
                'baz' => 'baz',
        ]);
    }
}
