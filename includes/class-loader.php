<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists('GWPG_Loader') ) {

    class GWPG_Loader {

        public function __construct() {
            require GWPG_PLUGIN_PATH . 'public/gwpg-render-views.php';
        }
    }

    new GWPG_Loader;

}