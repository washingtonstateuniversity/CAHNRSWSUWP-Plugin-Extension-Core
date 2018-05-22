<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle County_Programs Shortcode
* @since 3.0.0
*/
class County_Programs_Shortcode {

	protected $prefix = '';

	// @var array $default_settings Array of default settings
	protected $default_settings = array(
		'title'     => 'County Programs',
		'pages'     => '',
		'page_1'    => '',
		'page_2'    => '',
		'page_3'    => '',
		'page_4'    => '',
		'page_5'    => '',
		'page_6'    => '',
		'page_7'    => '',
		'page_8'    => '',
	);


	public function __construct() {

		$core_setting = get_theme_mod( 'extension_core_county_programs', '' );

		if ( ! empty( $core_setting ) ) {

			\add_action( 'init', array( $this, 'register_shortcode' ) );

			\add_filter( 'cpb_shortcodes', array( $this, 'register_cpb_shortcode' ) );

		} // End if

	} // End __construct


	/*
	* @desc Register section shortcode
	* @since 3.0.0
	*/
	public function register_shortcode() {

		\add_shortcode( 'county_programs', array( $this, 'get_rendered_shortcode' ) );

	} // End register_shortcode


	/*
	* @desc Register Shortcode with Pagebuilder
	* @since 0.0.1
	*/
	public function register_cpb_shortcode( $shortcodes ) {

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, array(), 'county_programs' );

		$shortcodes['county_programs'] = array(
			'form_callback'         => array( $this, 'get_shortcode_form' ),
			'label'                 => 'County Programs listing', // Label of the item
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

		$default_atts = apply_filters( 'cpb_shortcode_default_atts', $this->default_settings, $atts, 'county_programs' );

		// Check default settings
		$atts = \shortcode_atts( $default_atts, $atts, 'subtitle' );

		$legacy_pages = explode( ',', $atts['pages'] );

		$html .= '<h3 class="county-programs-title">' . esc_html( $atts['title'] ) . '</h3><ul class="county-programs">';

		for ( $i = 1; $i < 9; $i++ ) {

			$index = $i - 1;

			if ( ! empty( $legacy_pages[ $index ] ) ) {

				$page_id = $legacy_pages[ $index ];

			} elseif ( ! empty( $atts[ 'page_' . $i ] ) ) {

				$page_id = $atts[ 'page_' . $i ];

			} else {

				$page_id = false;

			}// End if

			if ( ! empty( $page_id ) ) {

				$class = get_post_meta( $page_id, '_cahnrswp_program_icon', true );

				$href = get_the_permalink( $page_id );

				$title = get_the_title( $page_id );

				ob_start();

				include __DIR__ . '/program-icon.php';

				$html .= ob_get_clean();

			} // End if
		} // End for

		$html .= '</ul>';

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

		$query_args = array(
			'post_type'       => 'page',
			'post_status'     => 'publish',
			'posts_per_page'  => -1,
		);

		$pages = get_posts( $query_args );

		$pages_select = array(
			'' => 'Select',
		);

		foreach ( $pages as $page ) {

			$pages_select[ $page->ID ] = $page->post_title;

		} // End foreach

		if ( ! empty( $settings['pages'] ) ) {

			$legacy_pages = explode( ',', $settings['pages'] );

			if ( is_array( $legacy_pages ) ) {

				foreach ( $legacy_pages as $index => $page_id ) {

					if ( ! empty( $page_id ) ) {

						$page_i = $index + 1;

						$settings[ 'page_' . $page_i ] = $page_id;

					} // End if
				} // End forecah
			} // End if
		} // End if

		$form_html = '';

		for ( $i = 1; $i < 9; $i++ ) {

			$form_html .= $cpb_form->select_field( \CAHNRSWP\Plugin\Pagebuilder\cpb_get_input_name( $id, true, 'page_' . $i ), $settings[ 'page_' . $i ], $pages_select, 'Page ' . $i );

		} // End for

		return array(
			'Basic'    => $form_html,
		);

	} // End get_shortcode_form

} // End County_Programs

$cpb_shortcode_county_programs = new County_Programs_Shortcode();
