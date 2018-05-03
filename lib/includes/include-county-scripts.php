<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

} // End if

/*
* @desc Start the plugin stuff, yeah
* @since 0.0.1
*/
class County_Scripts {

	public function __construct() {

		$core_setting = get_theme_mod( 'extension_core_county_scripts', '' );

		if ( ! empty( $core_setting ) ) {

			add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ) );

		} // End if

	} // End __construct


	/*
	* @desc Add Scripts
	* @since 0.0.1
	*
	* @param instans of WP_Customize $wp_customize
	*/
	public function add_admin_scripts() {

		global $post;

		if ( isset( $post->ID ) ) {

			$meta_template = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( ! empty( $meta_template ) && 'templates/program.php' === $meta_template ) {

				wp_enqueue_style( 'program_admin_css', ecore_get_plugin_url( 'lib/css/admin-programs.css' ), array(), ecore_get_plugin_version() );

			} // End if
		} // End if

	} // End add_admin_scripts


	/*
	* @desc Add Scripts
	* @since 0.0.1
	*
	* @param instans of WP_Customize $wp_customize
	*/
	public function add_public_scripts() {

		wp_enqueue_style( 'program_public_css', ecore_get_plugin_url( 'lib/css/county.css' ), array(), ecore_get_plugin_version() );

	} // End add_public_scripts

} // End County_Programs

$county_scripts = new County_Scripts();
