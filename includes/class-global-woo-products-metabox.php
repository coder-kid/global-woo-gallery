<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * This file is responsible for create metaboxes for shortcode.
 * 
 * @package global-woo-gallery
 */
class GWG_Metaboxes {

    /**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 1.0.0
	 */
	private static $_instance = null;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 1.0.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
    }
    
    /**
	 * Register the class with the WordPress API
	 *
	 * @since 1.0.0
	 */
    public function __construct() {
        // $this->metaboxform = new GWG_Metabox_Form();
        add_action( 'add_meta_boxes', [$this, 'generate_metaboxes'] );
        add_action( 'save_post', [$this, 'save_gwg_metaboxes'] );
    }

    /**
     * This function is responsible for generating actual metabox.
     * 
     * @since 1.0.0
     */
    public function generate_metaboxes() {
        add_meta_box(
            'gwg_shortcode_options',
            __( 'Gallery Options', 'global-woo-gallery' ),
            [$this, 'display_gwg_shortcode_metaboxes'],
            'gwg_shortcodes',
            'normal',
            'default'
        );
    }

    /**
     * Renders the content of the metaboxes
     * 
     * @since 1.0.0
     */
    public function display_gwg_shortcode_metaboxes() {

        wp_nonce_field( 'gwg_shortcode_nonce_action', 'gwg_shortcode_nonce_action_name' );

        require_once GWG_PLUGIN_PATH . '/admin/views/settings.php';

    }

    /**
     * Save shortcodes metabox
     * 
     * @param $post_id
     */
    public function save_gwg_metaboxes( $post_id ) {

    }


}