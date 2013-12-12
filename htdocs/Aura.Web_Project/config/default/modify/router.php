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

// get the router service
$router = $di->get('web_router');

// example route for 'hello world' using request and response services
$request  = $di->get('web_request');
$response = $di->get('web_response');
$router->add('hello', '/')
    ->addValues(array(
        'controller' => function () use ($request, $response) {
            $response->content->set('Hello World!');
        }
    ));

// add routes below
