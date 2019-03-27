<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists('GWPG_Shortcode') ) {

    class GWPG_Shortcode {

        protected $default_params = [
            'products_template'         => 'grid',
            'total_products'            => 6,
            'products_orderby'          => 'date',
            'products_order'            => 'ASC',
            'product_theme'             => 'theme_one',
            'products_column'           => 3,
            'products_column_on_tablet' => 1,
            'products_column_on_mobile' => 1,
            'products_from'             => '',
            'product_from_category'     => '',
            'product_from_tag'          => ''
        ];

        public function __construct() {
            add_shortcode( 'gwpg-gallery', [$this, 'gwpg_gallery_shortcodes'] );
            add_action( 'wp_enqueue_scripts', [$this, 'gwpg_front_script'] );
        }

        public function gwpg_front_script() {
            wp_enqueue_style(
                'gwpg-frontend',
                GWPG_PLUGIN_URI . 'public/assets/css/gwpg-front.min.css',[],
                GWPG_VERSION
            );
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
        
        function gwpg_gallery_shortcodes($atts) {

            $post_id = ! empty($atts['id']) ? $atts['id'] : '';
            $query_data = shortcode_atts(array_merge(
                $this->default_params,
                $this->set_params($post_id)),
            $atts);
            // extract($query_data); // extract will be stick with the shortcode_atts function
            
            ob_start();
            ?>
            <div class="gwpg-products-gallery-shortcode">
                <?php
                    $products = GWPG_Helper::get_products($query_data);

                    dump($products);


                    // if($product_data['template_mode'] == 'list')
                    //     include('blocks/block-product-list.php');
                    // else
                    //     include('blocks/block-product-grid.php');
                ?>

            </div>
            <?php
            return ob_get_clean();


        }
    }

    new GWPG_Shortcode;

}