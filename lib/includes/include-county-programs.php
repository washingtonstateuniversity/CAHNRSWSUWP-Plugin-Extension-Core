<?php namespace WSUWP\CAHNRSWSUWP_Plugin_Extension_Core;

if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

} // End if

/*
* @desc Start the plugin stuff, yeah
* @since 0.0.1
*/
class County_Programs {

	public $template = array(
		'templates/program.php' => 'Program',
	);

	public function __construct() {

		add_filter( 'theme_page_templates', array( $this, 'add_program_template' ) );

		add_filter( 'template_include', array( $this, 'get_program_template' ) );

		add_action( 'edit_form_after_title', array( $this, 'add_program_info_form' ), 2 );

		add_action( 'cahnrs_ignite_after_title', array( $this, 'add_page_contact' ), 10, 1 );

		add_action( 'save_post_page', array( $this, 'save_program' ), 10, 3 );

	} // End __construct


	/*
	* @desc Adds template to drop down
	* @since 0.0.1
	*
	* @param array $posts_templates Array of post templates
	*
	* @return array Post templates
	*/
	public function add_program_template( $posts_templates ) {

		$posts_templates = array_merge( $posts_templates, $this->template );

		return $posts_templates;

	} // End add_new_template


	/*
	* @desc Sets the program template
	* @since 0.0.1
	*
	* @param string $template Template path
	*
	* @return string Template path
	*/
	public function get_program_template( $template ) {

		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {

			return $template;

		} // End if

		$meta_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! empty( $meta_template ) && 'templates/program.php' === $meta_template ) {

			return get_stylesheet_directory() . '/page.php';

		} // End if

		return $template;

	} // End get_program_template


	/*
	 * @desc Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 *  @since 0.0.1
	 *
	 * @param array $atts
	 *
	 * @return $atts
	 */
	public function register_program_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();

		if ( empty( $templates ) ) {

			$templates = array();

		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key, 'themes' );

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->template );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	} // End register_program_templates


	/*
	* @desc Adds form to program page
	* @since 0.0.1
	*
	* @param instance WP_Post $post
	*/
	public function add_program_info_form( $post ) {

		$meta_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! empty( $meta_template ) && 'templates/program.php' === $meta_template ) {

			wp_nonce_field( 'cec_save_program', 'cec_nonce' );

			$program_icons = array(
				'4-H' => 'four-h',
				'Agriculture' => 'ag',
				'Community &amp; Economic Development' => 'ced',
				'Family &amp; Home' => 'family',
				'Food &amp; Nutrition' => 'food',
				'Gardening' => 'gardening',
				'Natural Resources' => 'natural-resources',
			);

			$program_contact_name = get_post_meta( $post->ID, '_cahnrswp_program_specialist', true );

			$program_contact_phone = get_post_meta( $post->ID, '_cahnrswp_program_phone', true );

			$program_contact_email = get_post_meta( $post->ID, '_cahnrswp_program_email', true );

			$program_icon = get_post_meta( $post->ID, '_cahnrswp_program_icon', true );

			include ecore_get_plugin_path( '/lib/displays/programs/editor.php' );

		} // End if

	} // End add_program_info_form


	public function add_page_contact( $context ) {

		if ( 'single-content' === $context && ! is_front_page() ) {

			global $post;

			if ( ! empty( $post ) ) {

				$program_contact = $this->get_program_contact_array( $post );

				if ( ! empty( $program_contact ) ) {

					include ecore_get_plugin_path( '/lib/displays/programs/contact.php' );

				} // End if
			} // End if
		} // end if

	} // End context


	/*
	* @desc Get program contact from given post
	* @since 0.0.1
	*
	* @param instance WP_Post
	*
	* @return array Program contact (empty if not set)
	*/
	protected function get_program_contact_array( $post ) {

		$program_contact = array();

		$program_id = false;

		$meta_template = get_post_meta( $post->ID, '_wp_page_template', true );

		$meta_template = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! empty( $meta_template ) && 'templates/program.php' === $meta_template ) {

			$program_id = $post->ID;

		} else {

			$parent_pages = get_post_ancestors( $post->ID );

			if ( $parent_pages ) {

				foreach ( $parent_pages as $parent_page ) {

					$parent_page_template = get_post_meta( $parent_page, '_wp_page_template', true );

					if ( 'templates/program.php' !== $parent_page_template ) {

						continue;

					} else {

						$program_id = $parent_page;

					} // End if
				} // End foreach
			} // End if
		} // End if

		if ( ! empty( $program_id ) ) {

			$program_contact['name'] = get_post_meta( $program_id, '_cahnrswp_program_specialist', true );

			$program_contact['phone'] = get_post_meta( $program_id, '_cahnrswp_program_phone', true );

			$program_contact['email'] = get_post_meta( $program_id, '_cahnrswp_program_email', true );

			$program_contact['icon'] = get_post_meta( $program_id, '_cahnrswp_program_icon', true );

		} // End if

		return $program_contact;

	} // End get_program_contact_array


	/**
	 * Save post action used for program templates
	 * @since 0.0.3
	 *
	 * @param int $post_id WP Post ID
	 * @param WP_Post
	 * @param bool Is update
	 */
	public function save_program( $post_id, $post, $update ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

			return;

		} // End if

		if ( ! $update ) {

			return;

		} // End if

		// Check the nonce
		if ( check_admin_referer( 'cec_save_program', 'cec_nonce' ) ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {

				return;

			} // End if

			$fields = array(
				'_cahnrswp_program_specialist',
				'_cahnrswp_program_phone',
				'_cahnrswp_program_email',
				'_cahnrswp_program_icon',
			);

			foreach ( $fields as $index => $field ) {

				if ( isset( $_POST[ $field ] ) ) {

					$value = sanitize_text_field( $_POST[ $field ] );

					update_post_meta( $post_id, $field, $value );

				} // End if
			} // End foreach
		} else {

			return;

		} // End if

	} // End save_program


} // End County_Programs

$county_programs = new County_Programs();
