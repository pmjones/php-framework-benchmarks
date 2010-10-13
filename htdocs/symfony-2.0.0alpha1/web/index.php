<?php
session_id('foobar');

require_once __DIR__.'/../hello/HelloKernel.php';

$kernel = new HelloKernel('prod', false);
$kernel->run();

//print memory_get_peak_usage();
