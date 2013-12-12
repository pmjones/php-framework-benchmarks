<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Web_Kernel
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Web_Kernel;


/**
 * 
 * A kernel for Aura web projects.
 * 
 * @package Aura.Web_Kernel
 * 
 */
class WebKernel
{
    public function __construct($router, $dispatcher, $responder)
    {
        $this->router     = $router;
        $this->dispatcher = $dispatcher;
        $this->responder  = $responder;
    }
    
    /**
     * 
     * Invokes the kernel (i.e., runs it).
     * 
     * @return null
     * 
     */
    public function __invoke()
    {
        $this->router->__invoke();
        $this->dispatcher->__invoke();
        $this->responder->__invoke();
    }
}
