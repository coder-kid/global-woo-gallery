<?php
if (absint($number_of_products) > 0):
    $products = GWPG_Helper::get_products($number_of_products, $category, $show, $orderby, $order);
    var_dump('From list layout');
    ?>
    <div class="gwpg-product-list row">
        <?php echo wp_kses_post(apply_filters('woocommerce_before_widget_product_list', '<ul class="gwpg_product_list_widget woocommerce">'));


        while ($products->have_posts()):
            $products->the_post();

            ?>
            <li <?php post_class('col-sm-6'); ?> >
                <div class="product-wrap-pl clearfix" data-mh="gwpg-product-list">
                    <span class="gwpg-product-list-left col-sm-4 col-xs-4">
                        <span class="gwpg-product-list-thumb">
                            <?php GWPG_Helper::get_block('product-thumb', true, false); ?>
                        </span>
                        </span>
                        <span class="gwpg-product-list-right col-sm-8 col-xs-8">
                        <span class="gwpg-product-list-desc">
                            <?php GWPG_Helper::get_block('product-add-to-cart', true, false); ?>
                        </span>
                    </span>
                </div>        
            </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

        <?php echo wp_kses_post(apply_filters('woocommerce_after_widget_product_list', '</ul>')); ?>
    </div>
<?php endif; ?>