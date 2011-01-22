<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../../../bootstrap.php';

use Symfony\Components\Routing\RouteCollection;
use Symfony\Components\Routing\Route;
use Symfony\Components\Routing\FileResource;

$t = new LimeTest(9);

// ->getRoute() ->addRoute() ->getRoutes()
$t->diag('->getRoute() ->addRoute() ->getRoutes()');
$collection = new RouteCollection();
$route = new Route('/foo');
$collection->addRoute('foo', $route);
$t->is($collection->getRoutes(), array('foo' => $route), '->addRoute() adds a route');
$t->is($collection->getRoute('foo'), $route, '->getRoute() returns a route by name');
$t->is($collection->getRoute('bar'), null, '->getRoute() returns null if a route does not exist');

// ->addCollection()
$t->diag('->addCollection()');
$collection = new RouteCollection();
$collection->addRoute('foo', $foo = new Route('/foo'));
$collection1 = new RouteCollection();
$collection1->addRoute('foo', $foo1 = new Route('/foo1'));
$collection1->addRoute('bar', $bar1 = new Route('/bar1'));
$collection->addCollection($collection1);
$t->is($collection->getRoutes(), array('foo' => $foo1, 'bar' => $bar1), '->addCollection() adds routes from another collection');

$collection = new RouteCollection();
$collection->addRoute('foo', $foo = new Route('/foo'));
$collection1 = new RouteCollection();
$collection1->addRoute('foo', $foo1 = new Route('/foo1'));
$collection->addCollection($collection1, '/foo');
$t->is($collection->getRoute('foo')->getPattern(), '/foo/foo1', '->addCollection() can add a prefix to all merged routes');

$collection = new RouteCollection();
$collection->addResource($foo = new FileResource('foo'));
$collection1 = new RouteCollection();
$collection1->addResource($foo1 = new FileResource('foo1'));
$collection->addCollection($collection1);
$t->is($collection->getResources(), array($foo, $foo1), '->addCollection() merges resources');

// ->addPrefix()
$t->diag('->addPrefix()');
$collection = new RouteCollection();
$collection->addRoute('foo', $foo = new Route('/foo'));
$collection->addRoute('bar', $bar = new Route('/bar'));
$collection->addPrefix('/admin');
$t->is($collection->getRoute('foo')->getPattern(), '/admin/foo', '->addPrefix() adds a prefix to all routes');
$t->is($collection->getRoute('bar')->getPattern(), '/admin/bar', '->addPrefix() adds a prefix to all routes');

// ->getResources() ->addResource()
$t->diag('->getResources() ->addResource()');
$collection = new RouteCollection();
$collection->addResource($foo = new FileResource('foo'));
$t->is($collection->getResources(), array($foo), '->addResources() adds a resource');
