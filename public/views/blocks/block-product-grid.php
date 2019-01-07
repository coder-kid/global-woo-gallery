<?php

if( $number_of_products > 0 ) {


    $products = GWPG_Helper::get_products($number_of_products, $category, $show, $orderby, $order);

    ?>
    <div class="gwpg-product-grid">
        <?php echo wp_kses_post(apply_filters('woocommerce_before_widget_product_list', '<ul class="gwpg_product_grid_widget woocommerce row">'));


        while ($products->have_posts()):
            $products->the_post();
            ?>
            <li <?php post_class('col-sm-4'); ?> >
                <div class="product-wrap-pl" data-mh="gwpg-product-grid">
                    <span class="gwpg-product-grid-left">
                        <span class="gwpg-product-grid-thumb">
                            <?php GWPG_Helper::get_block('product-thumb', true, false); ?>
                        </span>
                    </span>

                    <span class="gwpg-product-grid-right">
                        <span class="gwpg-product-grid-desc">
                            <?php GWPG_Helper::get_block('product-add-to-cart', true, false); ?>
                        </span>
                    </span>
                </div>            
            </li>
            <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

        <?php echo wp_kses_post(apply_filters('woocommerce_after_widget_product_list', '</ul>')); ?>
    </div>
    <?php
}