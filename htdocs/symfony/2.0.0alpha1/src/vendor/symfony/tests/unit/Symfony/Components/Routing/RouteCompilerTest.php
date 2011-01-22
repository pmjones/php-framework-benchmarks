<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../../../bootstrap.php';

use Symfony\Components\Routing\RouteCompiler;
use Symfony\Components\Routing\Route;

$t = new LimeTest(1);

$fixturesPath = __DIR__.'/../../../../fixtures/Symfony/Components/Routing';
require_once $fixturesPath.'/RouteCompilerTest.php';

$fixtures = require $fixturesPath.'/compilerFixtures.php';

// ->compile()
$t->diag('->compile()');

foreach ($fixtures as $name => $fixture)
{
  $r = new ReflectionClass('Symfony\\Components\\Routing\\Route');
  $route = $r->newInstanceArgs($fixture[0]);

  $compiled = $route->compile();
  $t->is($compiled->getStaticPrefix(), $fixture[1][0], $name.' (static prefix)');
  $t->is($compiled->getRegex(), $fixture[1][1], $name.' (regex)');
//print_r($compiled->getVariables());
  $t->is($compiled->getVariables(), $fixture[1][2], $name.' (variables)');
//print_r($compiled->getTokens());
  $t->is($compiled->getTokens(), $fixture[1][3], $name.' (tokens)');
}
