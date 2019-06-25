<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

if( ! class_exists('GWPG_Helper') ) {
    class GWPG_Helper {

        public function __construct() {
            add_action('wp_loaded', [$this, 'gwpg_woocommerce_template_loop_hooks']);
        }

        /**
         * Return all WC categories
         *
         * @since 3.0.0
         *
         * @param $args
         *
         * @return array|int|\WP_Error
         */
        public static function gwpg_get_wc_categories( $args = [] ) {
            global $wp_version;

            $default = [
                'number'     => '20',
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false,
                'include'    => [],
                'exclude'    => [],
                'child_of'   => 0,
            ];

            if ( version_compare( $wp_version, '4.5.0', '<' ) ) {
                $args  = wp_parse_args( $args, $default );
                $terms = get_terms( 'product_cat', $args );
            } else {
                $args       = wp_parse_args( $args, $default );
                $args['taxonomy'] = 'product_cat';
                $terms      = get_terms( $args );
            }

            $categories = [];
            if(is_array($terms)) {
                foreach($terms as $cat) {
                    $categories[$cat->term_id] = $cat->name;
                }
            }

            return $categories;
        }

        public static function get_all_tags() {
            $term_args = array(
                'taxonomy'               => 'product_tag',
                'hide_empty'             => false,
                'fields'                 => 'all',
                'count'                  => true,
            );
            $all_terms = array();
            $term_query = new WP_Term_Query( $term_args );
            if( isset($term_query->terms) &&  count($term_query->terms) > 0 ) {
                foreach($term_query->terms as $term) {
                    $all_terms[$term->term_id] = ucfirst($term->name);
                }
            }
            return $all_terms;
        }

        public static function get_block($template_name, $load = false, $include_once = true) {
            // No file found yet
            $located = false;


            // Continue if template is empty
            if (empty($template_name))
                return;

            // Trim off any slashes from the template name
            $template_name = ltrim($template_name, '/');
            $template_name = $template_name.'.php';


            if(file_exists(trailingslashit(GWPG_PLUGIN_PATH) . 'public/views/blocks/' . $template_name)) {
                include trailingslashit(GWPG_PLUGIN_PATH) . 'public/views/blocks/' . $template_name;
            }

            if ((true == $load) && !empty($located)){
                if ( $include_once ) {
                    include_once  $located;
                } else {
                    include $located;
                }
            }
        }

        public function gwpg_woocommerce_template_loop_hooks() {
            add_action('gwpg_woocommerce_template_loop_product_link_open', 'woocommerce_template_loop_product_link_open');
            add_action('gwpg_woocommerce_template_loop_product_link_close', 'woocommerce_template_loop_product_link_close');
            add_action('gwpg_woocommerce_show_product_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash');
            add_action('gwpg_woocommerce_template_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail');
            add_action('gwpg_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
            add_action('gwpg_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
            add_action('gwpg_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
            add_action('gwpg_woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart');
        }
        
    }
}