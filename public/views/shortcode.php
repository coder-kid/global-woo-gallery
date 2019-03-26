<?php

if( ! function_exists( 'gwpg_gallery_shortcodes' ) ) {

    function gwpg_gallery_shortcodes($atts) {

        $post_id = ! empty($atts['id']) ? $atts['id'] : '';
        $meta_data = unserialize(get_post_meta($post_id, 'gwpg_meta_values', true));

        $shortcode_args = array(
            'title'              => '',
            'template_mode'      => isset($meta_data['gwpg_products_template']) ? $meta_data['gwpg_products_template'] : 'grid',
            'number_of_products' => isset($meta_data['gwpg_total_products']) ? $meta_data['gwpg_total_products'] : 6,
            'orderby'            => isset($meta_data['gwpg_products_orderby']) ? $meta_data['gwpg_products_orderby'] : 'date',
            'order'              => isset($meta_data['gwpg_products_order']) ? strtoupper($meta_data['gwpg_products_order']) : 'ASC',
            'theme'              => isset($meta_data['gwpg_product_theme']) ? $meta_data['gwpg_product_theme'] : 'theme_one',
            'column'             => isset($meta_data['gwpg_products_column']) ? $meta_data['gwpg_products_column'] : 3,
            'column_on_tablet'   => isset($meta_data['gwpg_products_column_on_tablet']) ? $meta_data['gwpg_products_column_on_tablet'] : 1,
            'column_on_mobile'   => isset($meta_data['gwpg_products_column_on_mobile']) ? $meta_data['gwpg_products_column_on_mobile'] : 1,
            'post__in_cats' => ''
        );

        if( isset($meta_data['gwpg_products_from']) && $meta_data['gwpg_products_from'] == 'from_category' ) {
            $shortcode_args['post__in_cats'] = $meta_data['gwpg_product_from_category'];
        }

        if( isset($meta_data['gwpg_products_from']) && $meta_data['gwpg_products_from'] == 'from_tag' ) {
            $shortcode_args['tag__in'] = $meta_data['gwpg_product_from_tag'];
        }

        if($meta_data['gwpg_products_from'] == 'featured') {
            $shortcode_args['show'] = 'featured';
        }elseif($meta_data['gwpg_products_from'] == 'onsale') {
            $shortcode_args['show'] = 'onsale';
        }
        
        $product_data = shortcode_atts($shortcode_args, $atts);
        
        ob_start();
        ?>
        <div class="gwpg-products-gallery-shortcode">
            <?php
                // dump($product_data);
                $products = GWPG_Helper::get_products($product_data);
                dump($products->posts);


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