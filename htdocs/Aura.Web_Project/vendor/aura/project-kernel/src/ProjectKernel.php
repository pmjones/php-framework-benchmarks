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
     * Has $packages been loaded from Composer?
     * 
     * @var bool
     * 
     */
    protected $packages_loaded = false;
    
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
        $this->loadConfig('define');
        $this->di->lock();
        $this->loadConfig('modify');
        return $this->di;
    }
    
    /**
     * 
     * Reads all the config files for a stage in the current mode, then caches
     * them as a single file.
     * 
     * @param string $stage The configuration stage: 'define' or 'modify'.
     * 
     * @return null
     * 
     */
    public function cacheConfig($stage)
    {
        $file = $this->getCacheFile($stage);
        if (file_exists($file)) {
            $this->addDebug("Cache config: unlink $file");
            unlink($file);
        } else {
            $this->addDebug("Cache config: no file $file");
        }
        
        $dir = dirname($file);
        if (! is_dir($dir)) {
            $this->addDebug("Cache config: mkdir $dir");
            mkdir($dir, 0755, true);
        }
        
        $this->addDebug("Cache config: read config files");
        $code = $this->readConfig($stage);
        $this->addDebug("Cache config: write $file");
        file_put_contents($file, $code);
    }
    
    /**
     * 
     * Returns the collected debug messages.
     * 
     * @return array
     * 
     */
    public function getDebug()
    {
        return $this->debug;
    }
    
    /**
     * 
     * Adds to the debug messages.
     * 
     * @param array|string $debug The additional debug messages.
     * 
     * @return null
     * 
     */
    protected function addDebug($debug)
    {
        $this->debug = array_merge($this->debug, (array) $debug);
    }
    
    /**
     * 
     * Returns a cloned includer for the config mode and stage.
     * 
     * @param string $stage The configuration stage: 'define' or 'modify'.
     * 
     * @return Includer
     * 
     */
    protected function getIncluder($stage)
    {
        // load $packages from composer if needed
        if (! $this->packages_loaded) {
            $this->loadPackages();
        }
        
        // the project config mode
        $mode = $this->project->getMode();
        
        // a copy of the includer
        $includer = clone $this->includer;
        
        // pass DI container to the config files
        $includer->setVars(array('di' => $this->di));
        
        // always load the default configs
        $includer->setFiles(array(
            "config/default/{$stage}.php",
            "config/default/{$stage}/*.php",
        ));
        
        // load any non-default configs
        if ($mode != 'default') {
            $includer->addFiles(array(
                "config/{$mode}/{$stage}.php",
                "config/{$mode}/{$stage}/*.php",
            ));
        }
        
        // load in this order: library packages, kernel packages, project
        $includer->addDirs($this->packages['library']);
        $includer->addDirs($this->packages['kernel']);
        $includer->addDir($this->project->getBasePath());
        
        // where should the cache file be?
        $file = $this->getCacheFile($stage);
        $includer->setCacheFile($file);
        
        // done!
        return $includer;
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
        $this->packages_loaded = true;
    }
    
    /**
     * 
     * Loads the config files for each of the Aura-style packages.
     * 
     * @param string $stage The configuration stage: 'define' or 'modify'.
     * 
     * @return null
     * 
     */
    protected function loadConfig($stage)
    {
        $includer = $this->getIncluder($stage);
        $includer->load();
        $this->addDebug($includer->getDebug());
    }
    
    /**
     * 
     * Reads the config files for each of the Aura-style packages.
     * 
     * @param string $stage The configuration stage: 'define' or 'modify'.
     * 
     * @return string The concatenated config files.
     * 
     */
    protected function readConfig($stage)
    {
        $includer = $this->getIncluder($stage);
        $code = '<?php /** '
              . date('Y-m-d H:i:s')
              . ' */' . PHP_EOL . PHP_EOL
              . $includer->read();
        $this->addDebug($includer->getDebug());
        return $code;
    }
    
    /**
     * 
     * Returns the config cache file path for the mode and stage.
     * 
     * @param string $stage The configuration stage: 'define' or 'modify'.
     * 
     * @return string The cache file path.
     * 
     */
    protected function getCacheFile($stage)
    {
        $mode = $this->project->getMode();
        return $this->project->getTmpPath("cache/config/{$mode}/{$stage}.php");
    }
}
