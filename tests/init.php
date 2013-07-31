<?php
// bootstrap your system
// based on https://gist.github.com/dave1010/966439

error_reporting(E_ALL | E_STRICT);

if (empty($_SERVER["argc"])) {
	echo "Error: This script must be run from the command line";
	die(1);
}

if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300) {
	echo "Error: This script must be run from PHP >= 5.3.0";
	die(1);
}

// $_SERVER['HTTP_HOST'] = trim(file_get_contents(__DIR__ . '/host'));

define('CLI', true);

require_once(dirname(__FILE__).'/../vendor/simplehtmldom/simple_html_dom.php');

require_once(dirname(__FILE__).'/wordpress-bootstrap.php');

// or 

// function __autoload($class) { include $class . '.php'; }
