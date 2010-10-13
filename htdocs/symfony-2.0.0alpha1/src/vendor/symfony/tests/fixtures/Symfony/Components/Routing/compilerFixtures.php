<?php

return array(
  'Static route' => array(
    array('/foo'),
    array('/foo', '#^/foo$#x', array(), array(
      array('separator', '', '/', null),
      array('text', '/', 'foo', null),
    ))),

  'Route with a variable' => array(
    array('/foo/:bar'),
    array('/foo', '#^/foo/(?P<bar>[^/]+?)$#x', array('bar' => ':bar'), array(
      array('separator', '', '/', null),
      array('text', '/', 'foo', null),
      array('separator', '', '/', null),
      array('variable', '/', ':bar', 'bar'),
    ))),

  'Route with a variable that has a default value' => array(
    array('/foo/:bar', array('bar' => 'bar')),
    array('/foo', '#^/foo(?:/(?P<bar>[^/]+?))?$#x', array('bar' => ':bar'), array(
      array('separator', '', '/', null),
      array('text', '/', 'foo', null),
      array('separator', '', '/', null),
      array('variable', '/', ':bar', 'bar'),
    ))),

  'Route with several variables' => array(
    array('/foo/:bar/:foobar'),
    array('/foo', '#^/foo/(?P<bar>[^/]+?)/(?P<foobar>[^/]+?)$#x', array('bar' => ':bar', 'foobar' => ':foobar'), array(
      array('separator', '', '/', null),
      array('text', '/', 'foo', null),
      array('separator', '', '/', null),
      array('variable', '/', ':bar', 'bar'),
      array('separator', '', '/', null),
      array('variable', '/', ':foobar', 'foobar'),
    ))),

  'Route with several variables that have default values' => array(
    array('/foo/:bar/:foobar', array('bar' => 'bar', 'foobar' => 'foobar')),
    array('/foo', '#^/foo(?:/(?P<bar>[^/]+?) (?:/(?P<foobar>[^/]+?) )?)?$#x', array('bar' => ':bar', 'foobar' => ':foobar'), array(
      array('separator', '', '/', null),
      array('text', '/', 'foo', null),
      array('separator', '', '/', null),
      array('variable', '/', ':bar', 'bar'),
      array('separator', '', '/', null),
      array('variable', '/', ':foobar', 'foobar'),
    ))),

  'Route with several variables but some of them have no default values' => array(
    array('/foo/:bar/:foobar', array('bar' => 'bar')),
    array('/foo', '#^/foo/(?P<bar>[^/]+?)/(?P<foobar>[^/]+?)$#x', array('bar' => ':bar', 'foobar' => ':foobar'), array(
      array('separator', '', '/', null),
      array('text', '/', 'foo', null),
      array('separator', '', '/', null),
      array('variable', '/', ':bar', 'bar'),
      array('separator', '', '/', null),
      array('variable', '/', ':foobar', 'foobar'),
    ))),

  'Route with a custom token' => array(
    array('/=foo', array(), array(), array('compiler_class' => 'RouteCompilerTest')),
    array('/foo', '#^/foo/(?P<foo>[^/]+?)$#x', array('foo' => '=foo'), array(
      array('separator', '', '/', null),
      array('label', '/', '=foo', 'foo'),
    ))),
);
