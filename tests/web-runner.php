<?php header("Content-Type: text/plain");

// require_once(dirname(__FILE__).'/../vendor/autoload.php'); // composer autoloader
require_once(dirname(__FILE__).'/../vendor/simplehtmldom/simple_html_dom.php');
require_once(dirname(__FILE__).'/../vendor/phpunit/phpunit/PHPUnit/Autoload.php');
require_once(dirname(__FILE__).'/../wp-load.php');

# error reporting
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

# sample test class
// class ExampleTest extends PHPUnit_Framework_TestCase
// {
//     public function testOne()
//     {
//         $this->assertTrue(FALSE);
//     }
// }

require_once 'ApplicationTest.php';

# run the test
# $suite = new PHPUnit_Framework_TestSuite('ExampleTest');
$suite = new PHPUnit_Framework_TestSuite('ApplicationTest');
PHPUnit_TextUI_TestRunner::run($suite);
