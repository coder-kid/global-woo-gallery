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


/**
 * woocommerce_before_shop_loop_item_title hook
 *
 * @hooked woocommerce_show_product_loop_sale_flash - 10
 * @hooked woocommerce_template_loop_product_thumbnail - 10
 */

?>
    <span class="gwpg-onsale">
        <?php do_action('gwpg_woocommerce_show_product_loop_sale_flash'); ?>
    </span>


<?php
do_action('gwpg_woocommerce_template_loop_product_thumbnail');

/**
 * gwpg_woocommerce_template_loop_product_link_close hook.
 *
 * @hooked woocommerce_template_loop_product_link_close - 10
 */
do_action('gwpg_woocommerce_template_loop_product_link_close');
