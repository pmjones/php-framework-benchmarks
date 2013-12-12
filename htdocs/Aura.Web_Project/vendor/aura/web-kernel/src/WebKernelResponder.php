<?php
namespace Aura\Web_Kernel;

use Aura\Web\Response;
use Monolog\Logger;

class WebKernelResponder
{
    public function __construct(
        Response $response,
        Logger $logger
    ) {
        $this->response = $response;
        $this->logger = $logger;
    }
    
    /**
     * 
     * Send the response.
     * 
     * @return null
     * 
     */
    public function __invoke()
    {
        $this->logger->debug(__METHOD__);
        
        // send the response status line
        header(
            $this->response->status->get(),
            true,
            $this->response->status->getCode()
        );
        
        // send non-cookie headers
        foreach ($this->response->headers->get() as $label => $value) {
            // the header() function itself prevents header injection attacks
            header("$label: $value");
        }
        
        // send cookies
        foreach ($this->response->cookies->get() as $name => $cookie) {
            setcookie(
                $name,
                $cookie['value'],
                $cookie['expire'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }
        
        // send content, and done!
        echo $this->response->content->get();
    }
}
