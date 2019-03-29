<div class="gwpg-product-list row">
    <?php
        echo wp_kses_post(apply_filters('woocommerce_before_widget_product_list', '<ul class="gwpg_product_list_widget woocommerce">'));
        while ($products->have_posts()): $products->the_post();
            global $product;

    ?>
        <div <?php echo post_class( 'gwgp-product' ); ?>>
            <?php echo $this->render_gwpg_product_thumb($products, $product); ?>
            <?php echo $this->gwpg_product_price($product); ?>
            <?php echo $this->gwpg_product_rating($product); ?>
            <?php echo $this->gwpg_add_cart(); ?>
        </div>

    <?php endwhile; wp_reset_postdata();?>
    <?php echo wp_kses_post(apply_filters('woocommerce_after_widget_product_list', '</ul>')); ?>
</div>