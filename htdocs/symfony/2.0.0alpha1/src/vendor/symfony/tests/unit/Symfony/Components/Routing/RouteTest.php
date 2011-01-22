<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../../../bootstrap.php';

use Symfony\Components\Routing\Route;

$t = new LimeTest(19);

// __construct()
$t->diag('__construct()');
$route = new Route('/:foo', array('foo' => 'bar'), array('foo' => '\d+'), array('foo' => 'bar'));
$t->is($route->getPattern(), '/:foo', '__construct() takes a pattern as its first argument');
$t->is($route->getDefaults(), array('foo' => 'bar'), '__construct() takes defaults as its second argument');
$t->is($route->getRequirements(), array('foo' => '\d+'), '__construct() takes requirements as its third argument');
$t->is($route->getOption('foo'), 'bar', '__construct() takes options as its fourth argument');

// ->getPattern() ->setPattern()
$t->diag('->getPattern() ->setPattern()');
$route = new Route('/:foo');
$route->setPattern('/:bar');
$t->is($route->getPattern(), '/:bar', '->setPattern() sets the pattern');
$route->setPattern('');
$t->is($route->getPattern(), '/', '->setPattern() adds a / at the beginning of the pattern if needed');
$route->setPattern('bar');
$t->is($route->getPattern(), '/bar', '->setPattern() adds a / at the beginning of the pattern if needed');
$t->is($route->setPattern(''), $route, '->setPattern() implements a fluent interface');

// ->getOptions() ->setOptions()
$t->diag('->getOptions() ->setOptions()');
$route = new Route('/:foo');
$route->setOptions(array('foo' => 'bar'));
$t->is($route->getOptions(), array_merge(array('variable_prefixes'  => array(':'),
'segment_separators' => array('/'),
'variable_regex'     => '[\w\d_]+',
'text_regex'         => '.+?',
'compiler_class'     => 'Symfony\\Components\\Routing\\RouteCompiler',
), array('foo' => 'bar')), '->setOptions() sets the options');
$t->is($route->setOptions(array()), $route, '->setOptions() implements a fluent interface');

// ->getDefaults() ->setDefaults()
$t->diag('->getDefaults() ->setDefaults()');
$route = new Route('/:foo');
$route->setDefaults(array('foo' => 'bar'));
$t->is($route->getDefaults(), array('foo' => 'bar'), '->setDefaults() sets the defaults');
$t->is($route->setDefaults(array()), $route, '->setDefaults() implements a fluent interface');

// ->getRequirements() ->setRequirements() ->getRequirement()
$t->diag('->getRequirements() ->setRequirements() ->getRequirement()');
$route = new Route('/:foo');
$route->setRequirements(array('foo' => '\d+'));
$t->is($route->getRequirements(), array('foo' => '\d+'), '->setRequirements() sets the requirements');
$t->is($route->getRequirement('foo'), '\d+', '->getRequirement() returns a requirement');
$t->is($route->getRequirement('bar'), null, '->getRequirement() returns null if a requirement is not defined');
$route->setRequirements(array('foo' => '^\d+$'));
$t->is($route->getRequirement('foo'), '\d+', '->getRequirement() removes ^ and $ from the pattern');
$t->is($route->setRequirements(array()), $route, '->setRequirements() implements a fluent interface');

// ->compile()
$t->diag('->compile()');
$route = new Route('/:foo');
$t->is(get_class($compiled = $route->compile()), 'Symfony\\Components\\Routing\\CompiledRoute', '->compile() returns a compiled route');
$t->is($route->compile(), $compiled, '->compile() only compiled the route once');
