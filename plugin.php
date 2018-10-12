<?php
/*
Plugin Name: CAHNRS WSUWP Plugin Extension Core
Version: 0.0.5
Description: Core feature set for Extension sites.
Author: washingtonstateuniversity, Danial Bleile
Author URI: http://cahnrs.wsu.edu/communications/
Plugin URI: https://github.com/washingtonstateuniversity/CAHNRSWSUWP-Plugin-Extension-Core
Text Domain: cahnrswsuwp-plugin-extension-core
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {

	return;

} else {

	include_once __DIR__ . '/lib/includes/cahnrswsuwp-extension-core.php';

} // End if
