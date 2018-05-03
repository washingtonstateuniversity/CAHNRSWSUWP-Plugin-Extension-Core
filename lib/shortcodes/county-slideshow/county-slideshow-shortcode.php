<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle County_Slideshow_Shortcode Shortcode
* @since 3.0.0
*/
class County_Slideshow_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array(
		'source'          => '',
		'post_type'       => '',
		'taxonomy'        => '',
		'terms'           => '',
		'posts_per_page'  => '',

	);


	public function __construct() {

		$core_setting = get_theme_mod( 'extension_core_county_slideshow', '' );

		if ( ! empty( $core_setting ) ) {

			\add_action( 'init', array( $this, 'register_shortcode' ) );

		} // End if

	} // End __construct


	/*
	* @desc Register section shortcode
	* @since 3.0.0
	*/
	public function register_shortcode() {

		\add_shortcode( 'county_slideshow', array( $this, 'get_rendered_shortcode' ) );

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

		foreach ( $atts as $key => $value ) {

			switch ( $key ) {

				case 'source':
					$shortcode_args[] = 'slide_type="feed"';
					break;
				case 'posts_per_page':
					$shortcode_args[] = 'count="' . $value . '"';
					break;
				default:
					$shortcode_args[] = $key . '="' . $value . '"';
					break;

			} // End switch
		} // End foreach

		$shortcode = '[slideshow][slide  ' . implode( ' ', $shortcode_args ) . ' ][/slideshow]';

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

} // End County_Slideshow_Shortcode

$cpb_shortcode_county_slideshow = new County_Slideshow_Shortcode();
