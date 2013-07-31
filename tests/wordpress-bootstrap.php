<?php

// HTTP_HOST is not set (as it's not Apache)
// if (!file_exists(__DIR__ . '/tests/host')) {
// 	echo "Error: Host file requred in '" . __DIR__ . "/host' with contents of \$_SERVER['HTTP_HOST']. Aborting";
//         die(1);
// }

// Make WP think it's running under Apache
$_SERVER["REQUEST_METHOD"] = 'GET';
$_SERVER["SERVER_PROTOCOL"] = 'HTTP/1.0';
$_SERVER["SERVER_PORT"] = '80';
$_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
$_SERVER["REMOTE_ADDR"] = 'localhost';
$_SERVER["REMOTE_PORT"] = '80';

// Random WP things that need to be done
global $PHP_SELF;
global $wp_embed;
global $wpdb;
global $wp_version;
define( 'DOING_AJAX', true );
$GLOBALS[ '_wp_deprecated_widgets_callbacks' ] = array();

require_once(dirname(__FILE__).'/../wp-load.php');

function cli_die($message) {
	debug_print_backtrace();
	die('DIE: ' . $message);
}
add_filter('wp_die_handler', 'cli_die');

ini_set('memory_limit', -1);

while (ob_get_level()) {
	// Who knows what some WP plugins are up to?
	ob_end_flush();
}


if (!defined('HIDE_BANNER')) {
	echo "--------------------------------------\n";
	echo "-- WordPress Command Line Interface --\n";
	echo "-- " . get_option('siteurl') . " --\n";
	echo "-- " . DB_USER . "@" . DB_HOST . "/" . DB_NAME . " --\n";
	echo "--------------------------------------\n";
	echo "\n";
}
