<?php
/**
 * 
 * This bootstrap file is intended only for first-time users who have dumped
 * the system directly into their document root.  We make some special 
 * allowances for that in this file, even though it is **not secure at all**.
 * 
 * When you're ready to really get going, point your web server document root 
 * to `system/docroot/` and turn on mod_rewrite.
 * 
 */

// Solar system directory
$system = dirname(__FILE__);

// set the include-path
set_include_path("$system/include");

// load Solar
require_once 'Solar.php';

// get the system config array
$config = require "$system/config.php";

// force the Action and Public URI path configs, overwriting anything from
// the original config
$path = $_SERVER['REQUEST_URI'];
$pos = strpos($path, "/index.php");
if ($pos !== false) {
    // strip "/index.php" and everything after it
    $path = substr($path, 0, $pos);
}
$path = rtrim($path, '/');
$config['Solar_Uri_Action']['path'] = "$path/index.php";
$config['Solar_Uri_Public']['path'] = "$path/docroot/public";

// start Solar with the modified config values
Solar::start($config);

// instantiate and run the front controller
$front = Solar_Registry::get('controller_front');
$front->display();

// Done!
Solar::stop();
