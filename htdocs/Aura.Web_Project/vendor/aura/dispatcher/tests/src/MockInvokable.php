<?php
namespace Aura\Dispatcher;

class MockInvokable extends MockBase
{
    public function __invoke($foo, $bar, $baz = 'baz')
    {
        return "$foo $bar $baz";
    }
}
