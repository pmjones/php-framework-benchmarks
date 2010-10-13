<?php
session_id('foobar');

$root = dirname(__FILE__);
set_include_path("$root/library");
define('APPLICATION_PATH', "$root/minapp");
 
function autoload($class) {
    include str_replace('_', '/', $class) . '.php';
}

spl_autoload_register('autoload');

$front = Zend_Controller_Front::getInstance();
$front->setControllerDirectory(APPLICATION_PATH . '/controllers');
$front->dispatch();

