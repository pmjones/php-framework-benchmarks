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

use Aura\Di\ContainerInterface;
use Aura\Includer\Includer;

/**
 * 
 * A generic Aura project kernel; sets up the DI container and not much else.
 * 
 * @package Aura.Project_Kernel
 * 
 */
class ProjectKernel
{
    /**
     * 
     * A dependency injection container.
     * 
     * @var ContainerInterface
     * 
     */
    protected $di;
    
    /**
     * 
     * Information about the project.
     * 
     * @var Project
     * 
     */
    protected $project;
    
    /**
     * 
     * Aura-style packages identified via Composer's list of installed
     * packages, organized by Aura package type in loading order (libraries
     * first, then kernels, etc.).
     * 
     * @var array
     * 
     */
    protected $packages = array(
        'library' => array(),
        'kernel' => array(),
    );
    
    /**
     * 
     * The log of config activity; retained here because we don't have a
     * logger configured before configuration occurs.
     * 
     * @var array
     * 
     */
    protected $debug = array();
    
    /**
     * 
     * Constructor.
     * 
     * @param Project $project A project information object.
     * 
     * @param ClassLoader $loader An autoloader, typically the Composer
     * autoloader. This will be retained in the DI container as a service
     * named 'loader'.
     * 
     * @param ContainerInterface $di A dependency injection container.
     * 
     * @param string $base The base directory for the project.
     * 
     * @param string $mode The config mode.
     * 
     */
    public function __construct(
        Project $project,
        ContainerInterface $di,
        Includer $includer
    ) {
        $this->project = $project;
        $this->di = $di;
        $this->includer = $includer;
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
        // find the Aura-style packages
        $this->loadPackages();
        
        // 1st stage config: define params, setters, services
        $this->includeConfig('define');
        
        // lock the DI container
        $this->di->lock();
        
        // 2nd stage config: modify services programmatically
        $this->includeConfig('modify');
        
        // debug logging
        $logger = $this->di->get('logger');
        $logger->debug(__METHOD__);
        foreach ($this->debug as $messages) {
            foreach ($messages as $message) {
                $logger->debug(__METHOD__ . " {$message}");
            }
        }
        
        // done!
        return $this->di;
    }
    
    /**
     * 
     * Determines the installed Aura-style packages.
     * 
     * @return null
     * 
     */
    protected function loadPackages()
    {
        $file = $this->project->getVendorPath('composer/installed.json');
        $installed = json_decode(file_get_contents($file));
        foreach ($installed as $package) {
            if (! isset($package->extra->aura->type)) {
                continue;
            }
            $type = $package->extra->aura->type;
            $dir = $this->project->getVendorPath($package->name);
            $this->packages[$type][$package->name] = $dir;
        }
    }
    
    /**
     * 
     * Includes the config files for each of the Aura-style packages in a
     * limited scope, passing only the `$di` property.
     * 
     * @param string $stage The configuration stage: 'define' or 'modify'.
     * 
     * @return null
     * 
     */
    protected function includeConfig($stage)
    {
        // the project config mode
        $mode = $this->project->getMode();
        
        // pass DI container to the config files
        $this->includer->setVars(array('di' => $this->di));
        
        // always load the default configs
        $this->includer->setFiles(array(
            "config/default/{$stage}.php",
            "config/default/{$stage}/*.php",
        ));
        
        // load any non-default configs
        if ($mode != 'default') {
            $this->includer->addFiles(array(
                "config/{$mode}/{$stage}.php",
                "config/{$mode}/{$stage}/*.php",
            ));
        }
        
        // reset dirs, then load in this order:
        // library packages, kernel packages, project
        $this->includer->setDirs(array());
        $this->includer->addDirs($this->packages['library']);
        $this->includer->addDirs($this->packages['kernel']);
        $this->includer->addDir($this->project->getBasePath());
        
        // actually do the loading
        $this->includer->load();
        
        // retain the debug messages for logging
        $this->debug[] = $this->includer->getDebug();
    }
}
