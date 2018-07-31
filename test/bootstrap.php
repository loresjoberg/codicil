<?php
/**
 * PHPUnit bootstrap file
 *
 * @package L4_Elements
 */

//ini_set("display_errors", "on");
//ini_set("error_reporting", E_ALL);

require (__DIR__ . '/../vendor/autoload.php');
//require('CodicilTestBase.php');
//require('CuratorTestBase.php');
include_once('mocks/WP_Post.php');
//include_once('mocks/WP_Term.php');
include_once('mocks/WP_User.php');

//foreach (glob(__DIR__ . '/mocks/*.php') as $filename)
//{
//    print "#### $filename";
//    include $filename;
//}