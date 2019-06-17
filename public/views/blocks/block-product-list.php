<div class="gwpg-product-list row">
    <?php
        echo wp_kses_post(apply_filters('woocommerce_before_widget_product_list', '<ul class="gwpg_product_list_widget woocommerce">'));
        while ($products->have_posts()): $products->the_post();
            global $product;

    ?>
        <li <?php echo post_class( 'gwgp-product' ); ?>>
            <div class="gwpg-product-inner">
                <?php echo $this->render_gwpg_product_thumb($products, $product); ?>
                <div class="product-summary">
                    <h2 class="light-weight-product-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
                    <?php echo $this->gwpg_product_price($product); ?>
                    <?php echo $this->gwpg_product_rating($product); ?>
                    <?php echo $this->gwpg_add_cart(); ?>
                </div>
            </div>
        </li>

    <?php endwhile; wp_reset_postdata();?>
    <?php echo wp_kses_post(apply_filters('woocommerce_after_widget_product_list', '</ul>')); ?>
</div>