<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

} // End if

/*
* @desc Start the plugin stuff, yeah
* @since 0.0.1
*/
class County_Customizer {

	public function __construct() {

		add_action( 'customize_register', array( $this, 'add_customizer' ) );

	} // End __construct


	/*
	* @desc Add customizer options to control Extension Core features
	* @since 0.0.1
	*
	* @param instans of WP_Customize $wp_customize
	*/
	public function add_customizer( $wp_customize ) {

		$settings = array(
			'county_contact'    => 'County Contact',
			'county_programs'   => 'County Programs',
			'county_search'     => 'County Search',
			'county_social'     => 'County Social',
			'county_scripts'    => 'County Scripts',
			'county_slideshow'  => 'County Slideshow',
		);

		$wp_customize->add_section(
			'extension_core',
			array(
				'title' => 'Extension Core',
			)
		);

		foreach ( $settings as $key => $label ) {

			$wp_customize->add_setting(
				'extension_core_' . $key,
				array(
					'default'   => '',
					'transport' => 'refresh',
				)
			);

			$wp_customize->add_control(
				'extension_core_' . $key . '_control',
				array(
					'settings' => 'extension_core_' . $key,
					'label'    => $label,
					'section'  => 'extension_core',
					'type'     => 'checkbox',
				)
			);

		} // End foreach

	} // End add_customizer

} // End County_Programs

$county_customizer = new County_Customizer();
