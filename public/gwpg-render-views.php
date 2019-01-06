<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists('GWPG_Render_Views') ) {

    class GWPG_Render_Views {

        public function __construct() {
            $this->include();
            add_shortcode( 'gwpg-gallery', 'gwpg_gallery_shortcodes' );
        }
        
        public function include() {
            require GWPG_PLUGIN_PATH . 'public/views/shortcode.php';
        }
    }

    new GWPG_Render_Views;

}