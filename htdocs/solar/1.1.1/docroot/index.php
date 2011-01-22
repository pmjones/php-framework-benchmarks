<?php
// Solar system directory
$system = dirname(dirname(__FILE__));

// set the include-path
set_include_path("$system/include");

// load Solar
require_once 'Solar.php';

// start Solar with system config file
$config = "$system/config.php";
Solar::start($config);

// instantiate and run the front controller
$front = Solar_Registry::get('controller_front');
$front->display();

// Done!
Solar::stop();
