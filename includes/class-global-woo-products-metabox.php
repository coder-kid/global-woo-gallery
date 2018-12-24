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
        // $this->metaboxform = new GWPG_Controls_Manager();
    }

    /**
     * Renders the content of the metaboxes
     * 
     * @since 1.0.0
     */
    public function display_gwg_shortcode_metaboxes() {

        wp_nonce_field( 'gwg_shortcode_nonce_action', 'gwg_shortcode_nonce_action_name' );

        require_once GWPG_PLUGIN_PATH . '/admin/views/metabox.php';

    }


}

GWG_Metaboxes::instance();