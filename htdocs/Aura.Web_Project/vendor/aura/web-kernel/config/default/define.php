<?php
/**
 * Services
 */
$di->set('web_request', $di->lazyNew('Aura\Web\Request'));
$di->set('web_response', $di->lazyNew('Aura\Web\Response'));
$di->set('web_router', $di->lazyNew('Aura\Router\Router'));
$di->set('web_dispatcher', $di->lazyNew('Aura\Dispatcher\Dispatcher'));
$di->set('web_kernel', $di->lazyNew('Aura\Web_Kernel\WebKernel'));

/**
 * Aura\Web_Kernel\WebKernel
 */
$di->params['Aura\Web_Kernel\WebKernel'] = array(
    'router' => $di->lazyNew('Aura\Web_Kernel\WebKernelRouter'),
    'dispatcher' => $di->lazyNew('Aura\Web_Kernel\WebKernelDispatcher'),
    'responder' => $di->lazyNew('Aura\Web_Kernel\WebKernelResponder'),
);

/**
 * Aura\Web_Kernel\WebKernelDispatcher
 */
$di->params['Aura\Web_Kernel\WebKernelDispatcher'] = array(
    'request' => $di->lazyGet('web_request'),
    'dispatcher' => $di->lazyGet('web_dispatcher'),
    'logger' => $di->lazyGet('logger'),
);

/**
 * Aura\Web_Kernel\WebKernelResponder
 */
$di->params['Aura\Web_Kernel\WebKernelResponder'] = array(
    'response' => $di->lazyGet('web_response'),
    'logger' => $di->lazyGet('logger'),
);

/**
 * Aura\Web_Kernel\WebKernelRouter
 */
$di->params['Aura\Web_Kernel\WebKernelRouter'] = array(
    'request' => $di->lazyGet('web_request'),
    'router' => $di->lazyGet('web_router'),
    'logger' => $di->lazyGet('logger'),
);
