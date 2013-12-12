<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Web_Project
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @var Aura\Di\Container $di The DI container.
 * 
 */

// get the project and logger services
$project = $di->get('project');
$logger = $di->get('logger');

// add a log handler
$logger->pushHandler($di->newInstance('Monolog\Handler\StreamHandler', array(
    'stream' => $project->getTmpPath('web.log'),
)));
