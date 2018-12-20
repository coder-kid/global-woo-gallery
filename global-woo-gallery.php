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

if( ! class_exists('Global_Woo_Gallery') ) {

    final class Global_Woo_Gallery {

        /**
         * Version of this plugin
         * 
         * @var $version string
         */
        protected $version = '1.0.0';
        
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
            $this->includes();
        }

        /**
         * Defining constances
         * 
         * @access public
         */
        public function define_constants() {

            $this->define( 'GWS_PLUGIN_FILE', __FILE__ );
            $this->define( 'GWS_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
            $this->define( 'GWS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
            $this->define( 'GWS_VERSION', $this->version() );
            $this->define( 'GWS_PLUGIN_INCLUDE_PATH', trailingslashit( plugin_dir_path( __FILE__ ) . 'includes' ) );
            $this->define( 'GWS_PLUGIN_DIRNAME', dirname( plugin_basename( __FILE__ ) ) );
            $this->define( 'GWS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

        }

        public function define( $name, $value, $case_insensitive = false ) {
            if ( ! defined( $name ) ) {
                define( $name, $value, $case_insensitive );
            }
        }

        public function includes() {

            require_once $this->include_path('class-global-woo-products-gallery-shortcodes.php');

        }

        public function include_path( $file ) {
            $file = ltrim( $file, '/' );
            
            return GWS_PLUGIN_INCLUDE_PATH . $file;
        }

        public function version() {
            return esc_attr( $this->version );
        }

    }

    function run_global_woo_gallery() {
        return Global_Woo_Gallery::get_instance();
    }

    add_action( 'plugins_loaded', 'run_global_woo_gallery', 25 );

}