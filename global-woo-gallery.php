<?php
/**
 * Plugin Name: Global WooCommerce Products Gallery
 * Plugin URI: https://wordpress.org/plugins/global-woo-gallery/
 * Description: Amazing WooCommerce products gallery with colors and buttons.
 * Author: Mahfuz Rahman
 * Version: 1.0.0
 * Domain Path: /languages
 * Text Domain: global-woo-gallery
 * Author URI: https://github.com/coder-kid
 */

defined( 'ABSPATH' ) or die( 'Keep Silent' );

if( ! function_exists('is_plugin_active_for_network') ) {
    require_once ABSPATH . '/wp-admin/includes/plugin.php';
}

if ( ! function_exists( 'get_plugins' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if( ! class_exists('Global_Woo_Gallery') ) {

    final class Global_Woo_Gallery {

        /**
         * Version of this plugin
         * 
         * @var $version string
         */
        protected $version = '1.0.0';

        /**
         * @var GWG_Metaboxes | $meta_box
         */
        public $metabox;
        
        /**
         * Instance of this class
         * 
         * @access protected
         */
        protected static $_instance = null;

        /**
         * Get instance of this class
         * 
         * @return Global_Woo_Gallery
         */
        public static function get_instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            
            return self::$_instance;
        }

        /**
         * Constract of this class
         */
        public function __construct() {
            $this->define_constants();
            $this->hooks();
            $this->includes();
            $this->instantiate();
        }

        /**
         * Defining constances
         * 
         * @access public
         */
        public function define_constants() {
            $this->define( 'GWPG_PLUGIN_FILE', __FILE__ );
            $this->define( 'GWPG_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
            $this->define( 'GWPG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
            $this->define( 'GWPG_VERSION', $this->version() );
            $this->define( 'GWPG_PLUGIN_INCLUDE_PATH', trailingslashit( plugin_dir_path( __FILE__ ) . 'includes' ) );
            $this->define( 'GWPG_PLUGIN_DIRNAME', dirname( plugin_basename( __FILE__ ) ) );
            $this->define( 'GWPG_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
        }

        public function define( $name, $value, $case_insensitive = false ) {
            if ( ! defined( $name ) ) {
                define( $name, $value, $case_insensitive );
            }
        }

        public function includes() {
            require_once $this->include_path('class-global-woo-products-gallery-shortcodes.php');
            require_once $this->include_path('class-global-woo-products-metabox.php');
            require_once $this->include_path('class-enqueue-scripts.php');
            require_once $this->include_path('class-controls-manager.php');
            require_once $this->include_path('class-gwpg-metabox-framework.php');
            require_once $this->include_path('class-gwpg-helpers.php');
            require_once $this->include_path('class-gwpg-products.php');
            require_once $this->include_path('metabox-options.php');
            require_once $this->include_path('class-loader.php');
            require_once $this->include_path('class-gwpg-mce-button.php');
        }

        public function include_path( $file ) {
            $file = ltrim( $file, '/' );
            
            return GWPG_PLUGIN_INCLUDE_PATH . $file;
        }

        public function version() {
            return esc_attr( $this->version );
        }

        public function instantiate() {
            $this->metabox   = GWG_Metaboxes::instance();
            Global_Woo_Products_Gallery_Shortcode::instance();
            GWPG_MCE_Shortcode_list::instance();
        }

        public function hooks() {
            add_action( 'admin_notices', array( $this, 'php_requirement_notice' ) );
            add_action( 'admin_notices', array( $this, 'wc_requirement_notice' ) );
            add_action( 'admin_notices', array( $this, 'wc_version_requirement_notice' ) );
        }

        public function is_required_php_version() {
            return version_compare( PHP_VERSION, '5.6.0', '>=' );
        }

        public function php_requirement_notice() {
            if ( ! $this->is_required_php_version() ) {
                $class   = 'notice notice-error';
                $text    = esc_html__( 'Please check PHP version requirement.', 'global-woo-gallery' );
                $link    = esc_url( 'https://docs.woocommerce.com/document/server-requirements/' );
                $message = wp_kses( __( "It's required to use latest version of PHP to use <strong>Global WooCommerce Product Gallery</strong>.", 'global-woo-gallery' ), array( 'strong' => array() ) );
                
                printf( '<div class="%1$s"><p>%2$s <a target="_blank" href="%3$s">%4$s</a></p></div>', $class, $message, $link, $text );
            }
        }

        public function wc_requirement_notice() {
				
            if ( ! $this->is_wc_active() ) {
                
                $class = 'notice notice-error';
                
                $text    = esc_html__( 'Install & Active', 'global-woo-gallery' );
                $link    = esc_url( add_query_arg([
                    'tab'       => 'plugin-information',
                    'plugin'    => 'woocommerce',
                    'TB_iframe' => 'true',
                    'width'     => '640',
                    'height'    => '500',
                ], admin_url( 'plugin-install.php' ) ) );
                $message = wp_kses( __( "Please install & activivate <strong>WooCommerce</strong> in order to use <strong>Global WooCommerce Product Gallery</strong> Plugin", 'global-woo-gallery' ), array( 'strong' => array() ) );
                
                printf( '<div class="%1$s"><p>%2$s <a class="thickbox open-plugin-details-modal" href="%3$s"><strong>%4$s</strong></a></p></div>', $class, $message, $link, $text );
            }
        }
        
        public function is_required_wc_version() {
            return version_compare( WC_VERSION, '3.2', '>' );
        }
        
        public function wc_version_requirement_notice() {
            if ( $this->is_wc_active() && ! $this->is_required_wc_version() ) {
                $class   = 'notice notice-error';
                $message = sprintf( esc_html__( "Currently, you are using older version of WooCommerce. It's recommended to use latest version of WooCommerce to work with %s.", 'global-woo-gallery' ), esc_html__( 'Global WooCommerce Product Gallery', 'global-woo-gallery' ) );
                printf( '<div class="%1$s"><p><strong>%2$s</strong></p></div>', $class, $message );
            }
        }

        public function is_wc_active() {
            return class_exists( 'WooCommerce' );
        }

    }

    function run_global_woo_gallery() {
        return Global_Woo_Gallery::get_instance();
    }
    add_action( 'plugins_loaded', 'run_global_woo_gallery', 25 );

}