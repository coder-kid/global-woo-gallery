<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists( 'GWPG_Products' ) ) {
    
    class GWPG_Products {

        /**
         * The single instance of the class.
         *
         * @var self
         * @since 1.0.0
         */
        private static $_instance = null;

        /**
         * Allows for accessing single instance of class. Class should only be constructed once per call.
         *
         * @since 1.0.0
         * @static
         * @return self Main instance.
         */
        public static function instance() {
            if ( ! self::$_instance ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        public function __construct() {

        }

        public function set_params(int $id) {
            $meta_val = unserialize(get_post_meta($id, 'gwpg_meta_values', true));
            $result = [];
            if($meta_val) {
                foreach($meta_val as $key => $value) {
                    $key = str_replace('gwpg_', '', $key);
                    $result[$key] = $value;
                }
            }
            
            return $result;
        }

        /**
         * @param $number_of_products
         * @param $category
         * @param $show
         * @param $orderby
         * @param $order
         * @return WP_Query
         */
        public static function get_products($data) {

            if( ! class_exists('WooCommerce') ) return;
            extract($data);

            $query_args = [
                'posts_per_page' => $total_products,
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'no_found_rows'  => 1,
                'orderby'       => $products_orderby,
                'order'          => $products_order,
                'meta_query'     => [],
                'tax_query'      => ['relation' => 'AND']
            ];

            switch ($products_from) {
                case 'from_category':
                    if(absint($product_from_category) > 0) {
                        $query_args['tax_query'][] = [
                            'taxonomy' => 'product_cat',
                            'field'    => 'term_taxonomy_id',
                            'terms'    => $product_from_category
                        ];
                    }
                    break;

                case 'from_tag':
                    if(absint($product_from_tag) > 0) {
                        $query_args['tax_query'][] = [
                            'taxonomy' => 'product_tag',
                            'field'    => 'term_taxonomy_id',
                            'terms'    => $product_from_tag
                        ];
                    }
                    break;

                case 'featured' :
                    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                    $query_args['tax_query'][] = array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'term_taxonomy_id',
                        'terms'    => $product_visibility_term_ids['featured'],
                    );
                    break;
                case 'onsale' :
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $product_ids_on_sale[] = 0;
                    $query_args['post__in'] = $product_ids_on_sale;
                    break;
            }
            
            switch ($products_orderby) {
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

            return new WP_Query(apply_filters('gwpg_widget_query_args', $query_args));

        }
    }

}
