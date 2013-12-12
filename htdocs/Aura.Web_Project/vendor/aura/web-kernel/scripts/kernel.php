<?php
/**
 * 
 * This file is part of Aura for PHP. It is a bootstrap for Composer-oriented
 * web projects.
 * 
 * @package Aura.Web_Kernel
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Web_Kernel;

use Aura\Project_Kernel\ProjectKernelFactory;

// the project base directory, relative to
// {$project}/vendor/aura/web_kernel/scripts/kernel.php
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

// project config
$project_kernel_factory = new ProjectKernelFactory;
$project_kernel = $project_kernel_factory->newInstance($base, $mode, $loader);
$di = $project_kernel->__invoke();

// run the web kernel
$web_kernel = $di->get('web_kernel');
$web_kernel->__invoke();
