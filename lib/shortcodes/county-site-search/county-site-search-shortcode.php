<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle county_site_search_form shortcode
* @since 3.0.0
*/
class County_Site_Search_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array();


	public function __construct() {

		\add_action( 'init', array( $this, 'register_shortcode' ) );

		\add_filter( 'cpb_shortcodes', array( $this, 'register_cpb_shortcode' ) );

	} // End __construct


	/*
	* @desc Register section shortcode
	* @since 3.0.0
	*/
	public function register_shortcode() {

		\add_shortcode( 'county_site_search_form', array( $this, 'get_rendered_shortcode' ) );

	} // End register_shortcode


	/*
	* @desc Register Shortcode with Pagebuilder
	* @since 0.0.1
	*/
	public function register_cpb_shortcode( $shortcodes ) {

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'county_site_search_form' );

		$shortcodes['county_site_search_form'] = array(
			'form_callback'         => array( $this, 'get_shortcode_form' ),
			'label'                 => 'County Site Search', // Label of the item
			'render_callback'       => array( $this, 'get_rendered_shortcode' ), // Callback to render shortcode
			'default_atts'          => $default_atts,
			'in_column'             => true, // Allow in column
		);

		return $shortcodes;

	} // End register_cpb_shortcode


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

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, $atts, 'county_site_search_form' );

		// Check default settings
		$atts = \shortcode_atts( $default_atts, $atts, 'county_site_search_form' );

		ob_start();

		include __DIR__ . '/search-bar.php';

		$html .= ob_get_clean();

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
	public function get_shortcode_form( $id, $settings, $content, $cpb_form ) {

		$form_html = 'No Settings';

		return array(
			'Basic'    => $form_html,
		);

	} // End get_shortcode_form

} // End County_Programs

$cpb_shortcode_county_site_search_form = new County_Site_Search_Shortcode();
