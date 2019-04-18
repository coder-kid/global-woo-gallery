<div class="gwpg-product-list row">
    <?php
        echo wp_kses_post(apply_filters('woocommerce_before_widget_product_list', '<div class="gwpg_product_list_widget woocommerce"><div class="gwpg-gallery-items">'));
        while ($products->have_posts()): $products->the_post();
            global $product;

    ?>
        <div class="gwpg-single-product">
            <?php echo $this->render_gwpg_product_thumb($products, $product); ?>
            <div class="cd-item-info">
                <b><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></b>
                <em>$9.99</em>
            </div> <!-- cd-item-info -->

            <a class="cd-3d-trigger cd-img-replace" title="Show Gallery" href="#0">Open</a>
        </div>

    <?php endwhile; wp_reset_postdata();?>
    <?php echo wp_kses_post(apply_filters('woocommerce_after_widget_product_list', '</div></div>')); ?>
</div>