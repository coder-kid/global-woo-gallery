<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists('GWPG_Render_Views') ) {

    class GWPG_Render_Views {

        public function __construct() {
            $this->include();
            add_shortcode( 'gwpg-gallery', 'gwpg_gallery_shortcodes' );
            add_action( 'wp_enqueue_scripts', [$this, 'gwpg_front_script'] );
        }

        public function gwpg_front_script() {
            wp_enqueue_style(
                'gwpg-frontend',
                GWPG_PLUGIN_URI . 'public/assets/css/gwpg-front.min.css',[],
                GWPG_VERSION
            );
        }
        
        public function include() {
            require GWPG_PLUGIN_PATH . 'public/views/shortcode.php';
        }
    }

    new GWPG_Render_Views;

}