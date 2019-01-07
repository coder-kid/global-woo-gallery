<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * woocommerce_before_shop_loop_item hook.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
do_action('gwpg_woocommerce_template_loop_product_link_open');

?>
    <span class="gwpg-product-list-title">

        <?php

        /**
         * woocommerce_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action('gwpg_woocommerce_shop_loop_item_title');


                                    ?>


    </span>
    <span class="gwpg-product-list-rating">
        <?php
          /**
            * woocommerce_after_shop_loop_item_title hook
           *
           * @hooked woocommerce_template_loop_rating - 5
           * @hooked woocommerce_template_loop_price - 10
           */
          do_action('gwpg_woocommerce_after_shop_loop_item_title');
        ?>


    </span>

<?php

/**
 * woocommerce_before_shop_loop_item hook.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
do_action('gwpg_woocommerce_template_loop_product_link_close'); ?>
    <span class="gwpg-product-list-add-to-cart">
<?php

/**
 * woocommerce_after_shop_loop_item hook.
 *
 * @hooked woocommerce_template_loop_add_to_cart - 10
 */
do_action('gwpg_woocommerce_template_loop_add_to_cart');
