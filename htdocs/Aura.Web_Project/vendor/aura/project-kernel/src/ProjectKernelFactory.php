<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Project_Kernel
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Project_Kernel;

use Aura\Di\Config;
use Aura\Di\Container;
use Aura\Di\Forge;
use Aura\Includer\Includer;

/**
 * 
 * Factory for project kernel objects.
 * 
 * @package Aura.Project_Kernel
 * 
 */
class ProjectKernelFactory
{
    /**
     * 
     * Returns a new project kernel instance.
     * 
     * @param string $base The project base directory.
     * 
     * @param string $mode The project config mode.
     * 
     * @param object $loader The Composer autoloader.
     * 
     * @return ProjectKernel
     * 
     */
    public function newInstance($base, $mode, $loader)
    {
        // objects for kernel instance
        $project  = new Project($base, $mode);
        $di       = new Container(new Forge(new Config));
        $includer = new Includer;
        
        // set project and loader into the container
        $di->set('project', $project);
        $di->set('loader', $loader);
        
        // return the new kernel instance
        return new ProjectKernel($project, $di, $includer);
    }
}
