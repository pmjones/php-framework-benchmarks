<?php
namespace Aura\Web_Kernel;

use Aura\Web\Request;
use Aura\Dispatcher\Dispatcher;
use Exception;
use Monolog\Logger;

class WebKernelDispatcher
{
    public function __construct(
        Request $request,
        Dispatcher $dispatcher,
        Logger $logger
    ) {
        $this->request = $request;
        $this->dispatcher = $dispatcher;
        $this->logger = $logger;
    }
    
    /**
     * 
     * Dispatch the request.
     * 
     * @return null
     * 
     */
    public function __invoke()
    {
        $controller = $this->request->params->get('controller');
        
        $missing_controller = ! is_object($controller)
                           && ! $this->dispatcher->hasObject($controller);
        if ($missing_controller) {
            $this->logger->debug(__METHOD__ . " missing controller '$controller'");
            $this->request->params['controller']  = 'aura.web_kernel.missing_controller';
            $this->request->params['missing_controller'] = $controller;
        };
        
        $message = __METHOD__ . ' to ';
        if (is_object($controller)) {
            $message .= 'object';
        } else {
            $message .= $controller;
        }
        $this->logger->debug($message);
        
        try {
            $this->dispatcher->__invoke($this->request->params->get());
        } catch (Exception $e) {
            $this->logger->debug(__METHOD__ . " caught exception " . get_class($e));
            $this->dispatcher->__invoke(array(
                'controller' => 'aura.web_kernel.caught_exception',
                'exception' => $e,
            ));
        }
    }
}
