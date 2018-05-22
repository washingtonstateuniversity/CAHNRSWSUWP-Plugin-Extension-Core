<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

/*
* @desc Get plugin base path
* @since 0.0.1
*
* @param string $path Optional path to append
*
* @return string full path
*/
function ecore_get_plugin_path( $path = '' ) {

	$path = CAHNRSWSUWPEXTENSIONCOREPATH . $path;

	return $path;

} // End ecore_get_plugin_path


/*
* @desc Get plugin base URL
* @since 0.0.1
*
* @param string $path Optional path to append
*
* @return string full path
*/
function ecore_get_plugin_url( $path = '' ) {

	$path = CAHNRSWSUWPEXTENSIONCOREURL . $path;

	return $path;

} // End ecore_get_plugin_path


/*
* @desc Get plugin version
* @since 0.0.1
*
* @return string Plugin version
*/
function ecore_get_plugin_version() {

	return CAHNRSWSUWPEXTENSIONCOREVERSION;

} // End ecore_get_plugin_path
