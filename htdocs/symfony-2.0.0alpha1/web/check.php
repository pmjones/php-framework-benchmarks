<?php

function is_cli()
{
  return !isset($_SERVER['HTTP_HOST']);
}

/**
 * Checks a configuration.
 */
function check($boolean, $message, $help = '', $fatal = false)
{
  echo $boolean ? "  OK        " : sprintf("[[%s]] ", $fatal ? ' ERROR ' : 'WARNING');
  echo sprintf("$message%s\n", $boolean ? '' : ': FAILED');

  if (!$boolean)
  {
    echo "            *** $help ***\n";
    if ($fatal)
    {
      die("You must fix this problem before resuming the check.\n");
    }
  }
}

/**
 * Gets the php.ini path used by the current PHP interpretor.
 *
 * @return string the php.ini path
 */
function get_ini_path()
{
  if ($path = get_cfg_var('cfg_file_path'))
  {
    return $path;
  }

  return 'WARNING: not using a php.ini file';
}

if (!is_cli())
{
  echo '<html><body><pre>';
}

echo "**********************************\n";
echo "*                                *\n";
echo "*  Symfony 2 requirements check  *\n";
echo "*                                *\n";
echo "**********************************\n\n";

echo sprintf("php.ini used by PHP: %s\n\n", get_ini_path());

if (is_cli())
{
  echo "** WARNING **\n";
  echo "*  The PHP CLI can use a different php.ini file\n";
  echo "*  than the one used with your web server.\n";
  if ('\\' == DIRECTORY_SEPARATOR)
  {
    echo "*  (especially on the Windows platform)\n";
  }
  echo "*  If this is the case, please launch this\n";
  echo "*  utility from your web server.\n";
  echo "** WARNING **\n";
}

// mandatory
echo "\n** Mandatory requirements **\n\n";
check(version_compare(phpversion(), '5.3.1', '>='), sprintf('PHP version must be at least 5.3.1 (%s installed)', phpversion()), 'Current version is '.phpversion(), true);
check(is_writable(__DIR__.'/../hello/cache'), sprintf('The cache/ directory must be writable'), 'The hello/cache/ directory is not writable', true);
check(is_writable(__DIR__.'/../hello/logs'), sprintf('The logs/ directory must be writable'), 'The hello/logs/ directory is not writable', true);

// warnings
echo "\n** Optional checks **\n\n";
check(class_exists('DomDocument'), 'PHP-XML module is installed', 'Install the php-xml module', false);
check(function_exists('token_get_all'), 'The token_get_all() function is available', 'Install token_get_all() function (highly recommended)', false);
check(function_exists('mb_strlen'), 'The mb_strlen() function is available', 'Install mb_strlen() function', false);
check(function_exists('iconv'), 'The iconv() function is available', 'Install iconv() function', false);
check(function_exists('utf8_decode'), 'The utf8_decode() is available', 'Install utf8_decode() function', false);

$accelerator = 
  (function_exists('apc_store') && ini_get('apc.enabled'))
  ||
  function_exists('eaccelerator_put') && ini_get('eaccelerator.enable')
  ||
  function_exists('xcache_set')
;
check($accelerator, 'A PHP accelerator is installed', 'Install a PHP accelerator like APC (highly recommended)', false);

check(!ini_get('short_open_tag'), 'php.ini has short_open_tag set to off', 'Set it to off in php.ini', false);
check(!ini_get('magic_quotes_gpc'), 'php.ini has magic_quotes_gpc set to off', 'Set it to off in php.ini', false);
check(!ini_get('register_globals'), 'php.ini has register_globals set to off', 'Set it to off in php.ini', false);
check(!ini_get('session.auto_start'), 'php.ini has session.auto_start set to off', 'Set it to off in php.ini', false);

echo "\n** Optional checks (Propel/Doctrine) **\n\n";

check(class_exists('PDO'), 'PDO is installed', 'Install PDO (mandatory for Propel and Doctrine)', false);
if (class_exists('PDO'))
{
  $drivers = PDO::getAvailableDrivers();
  check(count($drivers), 'PDO has some drivers installed: '.implode(', ', $drivers), 'Install PDO drivers (mandatory for Propel and Doctrine)');
}
check(class_exists('XSLTProcessor'), 'XSL module is installed', 'Install the XSL module (recommended for Propel)', false);

if (!is_cli())
{
  echo '</pre></body></html>';
}
