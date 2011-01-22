<?php
$system = $config['Solar']['system'];

/**
 * ini_set values
 */
$config['Solar']['ini_set'] = array(
    'error_reporting'   => (E_ALL | E_STRICT),
    'display_errors'    => true,
    'html_errors'       => true,
    'session.save_path' => "$system/tmp/session/",
    'date.timezone'     => 'UTC',
);

/**
 * auto-register some default objects for common use. note that these are 
 * lazy-loaded and only get created when called for the first time.
 */
$config['Solar']['registry_set'] = array(
    'sql'              => 'Solar_Sql',
    'user'             => 'Solar_User',
    'model_catalog'    => 'Solar_Sql_Model_Catalog',
    'mail_transport'   => 'Solar_Mail_Transport',
    'controller_front' => 'Solar_Controller_Front',
);

/**
 * sql adapter to use
 */
$config['Solar_Sql'] = array(
    'adapter' => 'Solar_Sql_Adapter_Sqlite',
);

/**
 * mail transport adapter to use
 */
$config['Solar_Mail_Transport']['adapter'] = 'Solar_Mail_Transport_Adapter_File';

/**
 * mail transport to use for messages
 */
$config['Solar_Mail_Message']['transport'] = 'mail_transport';

/**
 * front controller
 */
$config['Solar_Controller_Front'] = array(
    'classes' => array('Solar_App'),
    'disable'  => array('base'),
    'default' => 'hello',
    'routing' => array(),
);
