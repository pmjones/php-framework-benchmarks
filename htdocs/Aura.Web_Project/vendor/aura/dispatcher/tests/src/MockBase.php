<?php
namespace Aura\Dispatcher;

class MockBase
{
    use InvokeMethodTrait;
    
    public function exec($method, array $params = [])
    {
        return $this->invokeMethod($this, $method, $params);
    }
    
    public function publicMethod($foo, $bar, $baz = 'baz')
    {
        return "$foo $bar $baz";
    }
    
    protected function protectedMethod($foo, $bar, $baz = 'baz')
    {
        return "$foo $bar $baz";
    }
    
    private function privateMethod($foo, $bar, $baz = 'baz')
    {
        return "$foo $bar $baz";
    }
    
    public function directParams(array $params)
    {
        return "{$params['foo']} {$params['bar']} {$params['baz']}";
    }
}
