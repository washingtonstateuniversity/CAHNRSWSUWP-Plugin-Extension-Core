<?php
/*
Plugin Name: CAHNRS WSUWP Plugin Extension Core
Version: 0.0.1
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

	add_action( 'admin_notices', create_function( '', // phpcs:ignore WordPress.PHP.RestrictedPHPFunctions.create_function_create_function
	"echo '<div class=\"error\"><p>" . __( 'CAHNRS WSUWP Plugin Extension Core requires PHP 5.3 to function properly. Please upgrade PHP or deactivate the plugin.', 'cahnrswsuwp-plugin-extension-core' ) . "</p></div>';" ) );
	return;

} else {

	include_once __DIR__ . '/lib/includes/cahnrswsuwp-extension-core.php';

} // End if
