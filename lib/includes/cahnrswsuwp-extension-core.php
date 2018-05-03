<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

} // End if

/*
* @desc Start the plugin stuff, yeah
* @since 0.0.1
*/
class CAHNRSWSUWP_Extension_Core {


	public function __construct() {

		$this->init_plugin();

	} // End __construct


	protected function init_plugin() {

		// Set plugin path constant
		\define( 'CAHNRSWSUWPEXTENSIONCOREPATH', dirname( dirname( __DIR__ ) ) );

		// Set plugin url cinstant
		\define( 'CAHNRSWSUWPEXTENSIONCOREURL', \plugin_dir_url( dirname( dirname( __FILE__ ) ) ) );

		// Set plugin version
		\define( 'CAHNRSWSUWPEXTENSIONCOREVERSION', '0.0.1' );

		// Include plugin functions
		require CAHNRSWSUWPEXTENSIONCOREPATH . '/lib/functions/public.php';

		$this->add_post_types();

		$this->add_shortcodes();

		$this->add_theme_parts();

	} // End init_plugin


	/*
	* @desc Add post types to WordPress
	* @since 0.0.1
	*/
	protected function add_post_types() {

		// Abstract class used by post types
		//require_once core_get_plugin_path( '/lib/classes/class-post-type.php' );

	} // end add_post_types


	/*
	* @desc Add customizer to WordPress
	* @since 0.0.1
	*/
	protected function add_shortcodes() {

		// Adds Social media shortcode
		require_once ecore_get_plugin_path( '/lib/shortcodes/county-social-media-feed/county-social-media-shortcode.php' );

		// Adds County programs shortcode
		require_once ecore_get_plugin_path( '/lib/shortcodes/county-programs/county-programs-shortcode.php' );

		// Adds County Contact shortcode
		require_once ecore_get_plugin_path( '/lib/shortcodes/county-contact-info/county-contact-shortcode.php' );

		// Adds Site Search shortcode
		require_once ecore_get_plugin_path( '/lib/shortcodes/county-site-search/county-site-search-shortcode.php' );

		// Adds Site Search shortcode
		require_once ecore_get_plugin_path( '/lib/shortcodes/county-slideshow/county-slideshow-shortcode.php' );

	} // end add_post_types


	/*
	* @desc Add templates to WordPress
	* @since 0.0.1
	*/
	protected function add_theme_parts() {

		// Adds customizer settings
		require_once ecore_get_plugin_path( '/lib/includes/include-county-customizer.php' );

		// Adds programs settings
		require_once ecore_get_plugin_path( '/lib/includes/include-county-programs.php' );

		// Adds scripts
		require_once ecore_get_plugin_path( '/lib/includes/include-county-scripts.php' );

	} // end add_post_types

} // End init_plugin

$cahnrswsuwp_extension_core = new CAHNRSWSUWP_Extension_Core();
