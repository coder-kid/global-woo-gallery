<?php
/**
 * This is to register the shortcode generator post type.
 * @package woo-product-slider
 */

defined( 'ABSPATH' ) or die( 'Keep Quit' );

if( ! class_exists('Global_Woo_Products_Gallery_Shortcode') ) {
	class Global_Woo_Products_Gallery_Shortcode {

		/**
		 * Instance of this class
		 * 
		 * @var $_instance
		 */
		private static $_instance;
	
		/**
		 * @return Global_Woo_Products_Gallery_Shortcode
		 */
		public static function get_instance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	
		/**
		 * SP_WPS_ShortCodes constructor.
		 */
		public function __construct() {
			add_filter( 'init', [$this, 'register_post_type'] );
		}
	
		/**
		 * ShortCode generator post type.
		 */
		function register_post_type() {
	
			$labels = [
				'name'               => __( 'Product Gallery', 'woo-product-slider' ),
				'singular_name'      => __( 'Product Gallery', 'woo-product-slider' ),
				'menu_name'          => __( 'Product Gallery', 'woo-product-slider' ),
				'all_items'          => __( 'All Product Gallery', 'woo-product-slider' ),
				'add_new'            => __( 'Add New', 'woo-product-slider' ),
				'add_new_item'       => __( 'Add New Gallery', 'woo-product-slider' ),
				'edit'               => __( 'Edit', 'woo-product-slider' ),
				'edit_item'          => __( 'Edit Gallery', 'woo-product-slider' ),
				'new_item'           => __( 'Product Gallery', 'woo-product-slider' ),
				'search_items'       => __( 'Search Product Gallery', 'woo-product-slider' ),
				'not_found'          => __( 'No Product Gallery found', 'woo-product-slider' ),
				'not_found_in_trash' => __( 'No Product Gallery in Trash', 'woo-product-slider' ),
				'parent'             => __( 'Parent Product Gallery', 'woo-product-slider' ),
			];
	
			$args = [
				'labels'          => $labels,
				'hierarchical'    => false,
				'description'     => __( 'WooCommerce Product Slider', 'woo-product-slider' ),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				// 'menu_icon'       => GWS_PLUGIN_URI . '/admin/assets/images/icon.png',
				'query_var'       => false,
				'capability_type' => 'post',
				'supports'        => [ 'title' ]
			];
	
			register_post_type( 'mr_wpg_shortcodes', $args );
		}
	
	}
	
	new Global_Woo_Products_Gallery_Shortcode;
}