<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'GWPG_MCE_Shortcode_list' ) ) {
	class GWPG_MCE_Shortcode_list {

		/**
		 * Instance of this class
		 * 
		 * @var $_instance
		 */
		private static $_instance;
	
		/**
		 * @return GWPG_MCE_Shortcode_list
		 */
		public static function instance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp_ajax_gwpg_cpt_list', array( $this, 'wcs_list_ajax' ) );
			add_action( 'admin_footer', array( $this, 'gwpg_cpt_list' ) );
			add_action( 'admin_head', array( $this, 'wcs_mce_button' ) );
		}

		// Hooks your functions into the correct filters.
		function wcs_mce_button() {
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
				return;
			}
			// check if WYSIWYG is enabled.
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_mce_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_mce_button' ) );
			}
		}

		// Script for our mce button.
		function add_mce_plugin( $plugin_array ) {
			$plugin_array['gwpg_mce_button'] = GWPG_PLUGIN_URI . 'admin/assets/js/mce-button.js';
			return $plugin_array;
		}

		// Register our button in the editor.
		function register_mce_button( $buttons ) {
			array_push( $buttons, 'gwpg_mce_button' );
			return $buttons;
		}

		/**
		 * Function to fetch cpt posts list
		 * 
		 * 
		 * @return string
		 */
		public function posts( $post_type ) {
			global $wpdb;
			$cpt_type = $post_type;
			$cpt_post_status = 'publish';
			$cpt = $wpdb->get_results( $wpdb->prepare(
				"SELECT ID, post_title
				FROM $wpdb->posts 
				WHERE $wpdb->posts.post_type = %s
				AND $wpdb->posts.post_status = %s
				ORDER BY ID DESC",
				$cpt_type,
				$cpt_post_status
			));

			$list = array();

			foreach ( $cpt as $post ) {
				$selected = '';
				$post_id = $post->ID;
				$post_name = $post->post_title;
				$list[] = array(
					'text' => $post_name,
					'value' => $post_id
				);
			}

			wp_send_json( $list );
		}

		/**
		 * Fetch buttons
		 * 
		 * 
		 * @return string
		 */
		public function wcs_list_ajax() {
			check_ajax_referer( 'gwpg-mce-nonce', 'security' );
			$posts = $this->posts( 'gwg_shortcodes' ); // change 'post' if you need posts list.
			return $posts;
		}

		/**
		 * Function to output button list ajax script
		 * 
		 * 
		 * @return string
		 */
		public function gwpg_cpt_list() {
			// create nonce.
			global $current_screen;
			$current_screen->post_type;
			if ( $current_screen == 'post' || 'page') {
				$nonce = wp_create_nonce( 'gwpg-mce-nonce' );
				?>
				<script type="text/javascript">
					jQuery( document ).ready( function( $ ) {
						var data = {
							'action' : 'gwpg_cpt_list', // wp ajax action.
							'security' : '<?php echo $nonce; ?>' // nonce value created earlier.
						};
						// fire ajax
						  jQuery.post( ajaxurl, data, function( response ) {
							  if( response === '-1' ){
								  // do nothing
								  console.log('error');
							  } else {
								  if (typeof(tinyMCE) != 'undefined') {
									  if (tinyMCE.activeEditor != null) {
										tinyMCE.activeEditor.settings.GWPGShortcodeList = response;
									}
								}
							  }
						  });
					});
				</script>
				<?php
			}
		}

	} // Mce Class
}
