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
         * @param $number_of_products
         * @param $category
         * @param $show
         * @param $orderby
         * @param $order
         * @return WP_Query
         */
        public static function get_products($number_of_products, $category, $show, $orderby, $order) {

            if( ! class_exists('WooCommerce') ) return;

            $product_visibility_term_ids = wc_get_product_visibility_term_ids();

            $query_args = [
                'posts_per_page' => $number_of_products,
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'no_found_rows'  => 1,
                'order'          => $order,
                'meta_query'     => [],
                'tax_query'      => [
                    'relation' => 'AND'
                ]
            ];

            if (absint($category) > 0) {
                $query_args['tax_query'][] = [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $category
                ];
    
            }

            switch ($show) {
                case 'featured' :
                    $query_args['tax_query'][] = [
                        'taxonomy' => 'product_visibility',
                        'field'    => 'term_taxonomy_id',
                        'terms'    => $product_visibility_term_ids['featured'],
                    ];
                    break;
                case 'onsale' :
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $product_ids_on_sale[] = 0;
                    $query_args['post__in'] = $product_ids_on_sale;
                    break;
            }

            switch ($orderby) {
                case 'price' :
                    $query_args['meta_key'] = '_price';
                    $query_args['orderby'] = 'meta_value_num';
                    break;
                case 'rand' :
                    $query_args['orderby'] = 'rand';
                    break;
                case 'sales' :
                    $query_args['meta_key'] = 'total_sales';
                    $query_args['orderby'] = 'meta_value_num';
                    break;
                default :
                    $query_args['orderby'] = 'date';
            }

            return new WP_Query(apply_filters('aftwpl_widget_query_args', $query_args));

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

    new GWPG_Helper;
}