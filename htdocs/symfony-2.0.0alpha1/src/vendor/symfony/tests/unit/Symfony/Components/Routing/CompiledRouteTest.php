<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../../../bootstrap.php';

use Symfony\Components\Routing\CompiledRoute;
use Symfony\Components\Routing\Route;

$t = new LimeTest(9);

$route = new Route('/:foo', array('foo' => 'bar'), array('foo' => '\d+'), array('foo' => 'bar'));

// __construct() ->getRoute() ->getStaticPrefix() ->getRegex() ->getTokens() ->getVariables()
$t->diag('__construct() ->getRoute() ->getStaticPrefix() ->getRegex() ->getTokens() ->getVariables()');
$compiled = new CompiledRoute($route, 'prefix', 'regex', array('tokens'), array('variables'));
$t->is($compiled->getRoute(), $route, '__construct() takes a route as its first argument');
$t->is($compiled->getStaticPrefix(), 'prefix', '__construct() takes a static prefix as its second argument');
$t->is($compiled->getRegex(), 'regex', '__construct() takes a regexp as its third argument');
$t->is($compiled->getTokens(), array('tokens'), '__construct() takes an array of tokens as its fourth argument');
$t->is($compiled->getVariables(), array('variables'), '__construct() takes an array of variables as its fith argument');

// ->getPattern() ->getDefaults() ->getOptions() ->getRequirements()
$compiled = new CompiledRoute($route, 'prefix', 'regex', array('tokens'), array('variables'));
$t->is($compiled->getPattern(), '/:foo', '->getPattern() returns the route pattern');
$t->is($compiled->getDefaults(), array('foo' => 'bar'), '->getDefaults() returns the route defaults');
$t->is($compiled->getRequirements(), array('foo' => '\d+'), '->getRequirements() returns the route requirements');
$t->is($compiled->getOptions(), array_merge(array('variable_prefixes'  => array(':'),
'segment_separators' => array('/'),
'variable_regex'     => '[\w\d_]+',
'text_regex'         => '.+?',
'compiler_class'     => 'Symfony\\Components\\Routing\\RouteCompiler',
), array('foo' => 'bar')), '->getOptions() returns the route options');
