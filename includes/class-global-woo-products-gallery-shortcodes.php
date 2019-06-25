<?php
/**
 * This is to register the shortcode generator post type.
 * @package global-woo-gallery
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
		public static function instance() {
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
			add_filter('post_row_actions', [$this, 'manage_global_woo_gallery_posttype_actions'], 10, 2);
		}
	
		/**
		 * ShortCode generator post type.
		 */
		function register_post_type() {
	
			$labels = [
				'name'               => __( 'Product Gallery', 'global-woo-gallery' ),
				'singular_name'      => __( 'Product Gallery', 'global-woo-gallery' ),
				'menu_name'          => __( 'Product Gallery', 'global-woo-gallery' ),
				'all_items'          => __( 'All Product Gallery', 'global-woo-gallery' ),
				'add_new'            => __( 'Add New', 'global-woo-gallery' ),
				'add_new_item'       => __( 'Add New Gallery', 'global-woo-gallery' ),
				'edit'               => __( 'Edit', 'global-woo-gallery' ),
				'edit_item'          => __( 'Edit Gallery', 'global-woo-gallery' ),
				'new_item'           => __( 'Product Gallery', 'global-woo-gallery' ),
				'search_items'       => __( 'Search Product Gallery', 'global-woo-gallery' ),
				'not_found'          => __( 'No Product Gallery found', 'global-woo-gallery' ),
				'not_found_in_trash' => __( 'No Product Gallery in Trash', 'global-woo-gallery' ),
				'parent'             => __( 'Parent Product Gallery', 'global-woo-gallery' ),
			];
	
			$args = [
				'labels'          => $labels,
				'hierarchical'    => false,
				'description'     => __( 'WooCommerce Product Slider', 'global-woo-gallery' ),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				// 'menu_icon'       => GWS_PLUGIN_URI . '/admin/assets/images/icon.png',
				'query_var'       => false,
				'capability_type' => 'post',
				'supports'        => [ 'title' ]
			];
	
			register_post_type( 'gwg_shortcodes', $args );
		}

		public function manage_global_woo_gallery_posttype_actions($actions, $post) {
			if($post->post_type == 'gwg_shortcodes') {
				$actions['gwpg_quick_shortcode'] = '<input style="width: 230px;padding: 6px;" type="text" onclick="this.select();" readonly="readonly" value="[gwpg-gallery id=&quot;'.get_the_ID().'&quot;]">';
			}
			return $actions;
        }
	
	}
}