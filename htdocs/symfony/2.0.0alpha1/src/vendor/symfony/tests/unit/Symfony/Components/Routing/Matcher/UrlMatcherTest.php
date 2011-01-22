<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../../../../bootstrap.php';

use Symfony\Components\Routing\Matcher\UrlMatcher;
use Symfony\Components\Routing\RouteCollection;
use Symfony\Components\Routing\Route;

$t = new LimeTest(1);

$collection = new RouteCollection();
$collection->addRoute('foo', new Route('/:foo'));

class UrlMatcherTest extends UrlMatcher
{
  public function normalizeUrl($url)
  {
    return parent::normalizeUrl($url);
  }
}

$matcher = new UrlMatcherTest($collection, array(), array());

// ->normalizeUrl()
$t->diag('->normalizeUrl()');
$t->is($matcher->normalizeUrl(''), '/', '->normalizeUrl() adds a / at the beginning of the URL if needed');
$t->is($matcher->normalizeUrl('foo'), '/foo', '->normalizeUrl() adds a / at the beginning of the URL if needed');
$t->is($matcher->normalizeUrl('/foo?foo=bar'), '/foo', '->normalizeUrl() removes the query string');
$t->is($matcher->normalizeUrl('/foo//bar'), '/foo/bar', '->normalizeUrl() removes duplicated /');

// ->match()
$t->diag('->match()');

//var_export($matcher->match('/foo'));
//print_R($compiler->compile(new route('/:foo')));
