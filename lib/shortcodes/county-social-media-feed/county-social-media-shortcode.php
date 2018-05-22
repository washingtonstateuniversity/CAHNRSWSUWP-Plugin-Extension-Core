<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle County_Social_Media Shortcode
* @since 3.0.0
*/
class County_Social_Media_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array(
		'source'     => '',
		'url'        => '',
		'fb_height'  => '',
		'user'       => '',
		'widget_id'  => '',
		't_height'   => '',
	);


	public function __construct() {

		$core_setting = get_theme_mod( 'extension_core_county_social', '' );

		if ( ! empty( $core_setting ) ) {

			\add_action( 'init', array( $this, 'register_shortcode' ) );

		} // End if

	} // End __construct


	/*
	* @desc Register section shortcode
	* @since 3.0.0
	*/
	public function register_shortcode() {

		\add_shortcode( 'county_social_media_feed', array( $this, 'get_rendered_shortcode' ) );

		/*$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'section' );

		cpb_register_shortcode(
			'section',
			$args = array(
				'form_callback'         => array( $this, 'get_shortcode_form' ),
				'label'                 => 'County Social Media', // Label of the item
				'render_callback'       => array( $this, 'get_rendered_shortcode' ), // Callback to render shortcode
				'default_atts'          => $default_atts,
				'in_column'             => false, // Allow in column
			)
		);*/

	} // End register_shortcode


	/*
	* @desc Render the shortcode
	* @since 3.0.0
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode output
	*/
	public function get_rendered_shortcode( $atts, $content ) {

		$html = '';

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, $atts, 'section' );

		// Check default settings
		$atts = \shortcode_atts( $default_atts, $atts, 'section' );

		$shortcode_args = array();

		if ( 'facebook' === $atts['source'] ) {

			$shortcode_args[] = 'facebook="' . $atts['url'] . '"';

			$shortcode_args[] = 'height="' . $atts['fb_height'] . '"';

		} // End if

		$shortcode = '[social ' . implode( ' ', $shortcode_args ) . ' ]';

		$html .= do_shortcode( $shortcode );

		return $html;

	} // End get_rendered_shortcode


	/*
	* @desc Get HTML for shortcode form
	* @since 3.0.0
	*
	* @param array $atts Shortcode attributes
	* @param string $content Shortcode content
	*
	* @return string HTML shortcode form output
	*/
	public function get_shortcode_form( $id, $settings, $content ) {

		return array(
			'Basic'    => '',
		);

	} // End get_shortcode_form

} // End County_Social_Media

$cpb_shortcode_county_social_media = new County_Social_Media_Shortcode();
