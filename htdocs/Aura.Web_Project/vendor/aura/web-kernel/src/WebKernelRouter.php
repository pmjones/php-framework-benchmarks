<?php
namespace Aura\Web_Kernel;

use Aura\Web\Request;
use Aura\Router\Router;
use Monolog\Logger;

class WebKernelRouter
{
    public function __construct(
        Request $request,
        Router $router,
        Logger $logger
    ) {
        $this->request = $request;
        $this->router = $router;
        $this->logger = $logger;
    }
    
    /**
     * 
     * Route the request.
     * 
     * @return null
     * 
     */
    public function __invoke()
    {
        // get the http verb, the path, and the server vars
        $verb = $this->request->method->get();
        $path = $this->request->url->get(PHP_URL_PATH);
        $server = $this->request->server->get();
        
        // make an allowance for "index.php" in the path
        $pos = strpos($path, '/index.php');
        if ($pos !== false) {
            // read the path after /index.php
            $path = substr($path, $pos + 10);
            if (! $path) {
                $path = '/';
            }
        }
        
        // log that we're routing, and try to get a route
        $this->logger->debug(__METHOD__ . " $verb $path");
        $route = $this->router->match($path, $server);
        
        // log the routes that were tried for matches
        $routes = $this->router->getDebug();
        if (! $routes) {
            $this->logger->debug(__METHOD__ . ' no routes in router');
        } else {
            foreach ($routes as $tried) {
                foreach ($tried->debug as $message) {
                    $name = $tried->name
                          ? $tried->name
                          : $this->request->method->get() . ' ' . $tried->path;
                    $message = __METHOD__ . " $name $message";
                    $this->logger->debug($message);
                }
            }
        }
        
        // did we find a matching route?
        if ($route) {
            // yes, retain the route params
            $this->request->params->set($route->params);
        } else {
            // no, log it and set a controller name
            $this->logger->debug(__METHOD__ . ' missing route');
            $this->request->params['controller'] = 'aura.web_kernel.missing_route';
        }
    }
}
