<?php

if( ! function_exists( 'gwpg_gallery_shortcodes' ) ) {

    function gwpg_gallery_shortcodes($atts) {

        extract(shortcode_atts(array(
            'title'              => '',
            'mode'               => 'grid',
            'number_of_products' => 15,
            'product_cat'        => 0,
            'show'               => '',
            'orderby'            => 'date',
            'order'              => 'desc',
        ), $atts));

        $title              = isset($title) ? esc_html($title) : '';
        $mode               = !empty($mode) ? esc_attr($mode) : 'grid';
        $number_of_products = !empty($number_of_products) ? absint($number_of_products) : 6;
        $category           = !empty($product_cat) ? absint($product_cat) : 0;
        $show               = !empty($show) ? esc_attr($show) : '';
        $orderby            = !empty($orderby) ? esc_attr($orderby) : 'date';
        $order              = !empty($order) ? esc_attr($order) : 'desc';

        ob_start();
        ?>
        <div class="gwpg-products-gallery-shortcode">
            <?php if (!empty($title)): ?>
                <h2 class="widget-title gwpg-section-title">
                    <span><?php echo $title; ?></span>
                </h2>
            <?php endif; ?>

            <?php
                // if($mode == 'list'):
                    // include GWPG_PLUGIN_PATH . '/includes/blocks/block-product-list.php';
                // elseif ($mode == 'express-grid'):
                    // include GWPG_PLUGIN_PATH . '/includes/blocks/block-product-express-grid.php';
                // else:
                    include('blocks/block-product-grid.php');
                // endif;
            ?>

        </div>
        <?php
        return ob_get_clean();


    }


}