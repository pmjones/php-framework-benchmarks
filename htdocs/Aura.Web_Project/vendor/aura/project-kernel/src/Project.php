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

/**
 * 
 * Project information.
 * 
 * @package Aura.Project_Kernel
 * 
 */
class Project
{
    /**
     * 
     * The base directory.
     * 
     * @var string
     * 
     */
    protected $base;

    /**
     * 
     * The config mode.
     * 
     * @var string
     * 
     */
    protected $mode;

    /**
     * 
     * Constructor.
     * 
     * @param string $base The base directory.
     * 
     * @param string $mode The config mode.
     * 
     */
    public function __construct($base, $mode = 'default')
    {
        $this->base = rtrim($base, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->mode = $mode;
    }

    /**
     * 
     * Gets the path for any directory, along with an optional subdirectory
     * path.
     * 
     * @param string $dir The directory name to get the path for.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    protected function getSubPath($dir, $sub = null)
    {
        $path = $this->base . $dir;
        if ($sub) {
            $sub = ltrim($sub, DIRECTORY_SEPARATOR);
            $path .= str_replace('/', DIRECTORY_SEPARATOR, $sub);
        }
        return $path;
    }

    /**
     * 
     * Gets the config mode.
     * 
     * @return string The operational mode.
     * 
     */
    public function getMode()
    {
        return $this->mode;
    }
    
    /**
     * 
     * Gets the base path, along with an optional subdirectory path.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    public function getBasePath($sub = null)
    {
        return $this->getSubPath('', $sub);
    }

    /**
     * 
     * Gets the tmp path, along with an optional subdirectory path.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    public function getTmpPath($sub = null)
    {
        return $this->getSubPath('tmp' . DIRECTORY_SEPARATOR, $sub);
    }

    /**
     * 
     * Gets the config path, along with an optional subdirectory path.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    public function getConfigPath($sub = null)
    {
        return $this->getSubPath('config' . DIRECTORY_SEPARATOR, $sub);
    }

    /**
     * 
     * Gets the source path, along with an optional subdirectory path.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    public function getSrcPath($sub = null)
    {
        return $this->getSubPath('src' . DIRECTORY_SEPARATOR, $sub);
    }

    /**
     * 
     * Gets the vendor path, along with an optional subdirectory path.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    public function getVendorPath($sub = null)
    {
        return $this->getSubPath('vendor' . DIRECTORY_SEPARATOR, $sub);
    }

    /**
     * 
     * Gets the web path, along with an optional subdirectory path.
     * 
     * @param string $sub An optional subdirectory path.
     * 
     * @return The full directory path, with proper directory separators.
     * 
     */
    public function getWebPath($sub = null)
    {
        return $this->getSubPath('web' . DIRECTORY_SEPARATOR, $sub);
    }
}
