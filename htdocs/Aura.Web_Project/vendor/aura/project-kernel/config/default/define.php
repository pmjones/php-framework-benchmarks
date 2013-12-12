<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Project_Kernel
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @var Aura\Di\Container $di The DI container.
 * 
 */

/**
 * Services
 */
$di->set('logger', $di->newInstance('Monolog\Logger'));
