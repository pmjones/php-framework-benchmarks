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

// the project base directory, relative to
// {$project}/vendor/aura/project-kernel/scripts/kernel.php
$base = dirname(dirname(dirname(dirname(__DIR__))));

// the project config mode
$file = str_replace("/", DIRECTORY_SEPARATOR, "{$base}/config/_mode");
$mode = trim(file_get_contents($file));
if (! $mode) {
    $mode = "default";
}

// composer autoloader, add project src/ directory
$loader = require "{$base}/vendor/autoload.php";
$loader->add('', "{$base}/src");

// create project kernel, and done
$project_kernel_factory = new ProjectKernelFactory;
$project_kernel = $project_kernel_factory->newInstance($base, $mode, $loader);
