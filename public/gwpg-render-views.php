<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists('GWPG_Shortcode') ) {

    class GWPG_Shortcode {

        public function __construct() {
            add_shortcode( 'gwpg-gallery', [$this, 'gwpg_gallery_shortcodes'] );
        }

        protected function blend_thumbnails($product) {
            $attachments = [];
            if($product->get_gallery_image_ids()) {
                $attachments['ids'] = array_filter(array_merge([get_post_thumbnail_id(get_the_ID())], $product->get_gallery_image_ids()), 'strlen');
            }
            if(isset($attachments['ids'])) {
                foreach($attachments['ids'] as $id) {
                    $attachments['urls'][] = wp_get_attachment_image_src($id, apply_filters( 'gwpg_product_image_size', 'medium' ));
                }
            }
            return $attachments;
        }

        protected function gwpg_get_images($product) {
            if($this->blend_thumbnails($product)) {
                foreach($this->blend_thumbnails($product)['urls'] as $url) {
                    printf('<img src="%s" alt="%s" />', $url[0], esc_attr(get_the_title()));
                }
            }
        }



        protected function render_gwpg_product_thumb($products, $product) {
            ob_start();
            ?>
            <div class="product-thumbnail product-thumbnails--hover">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="gwpg-product-thumbnails">
                    <?php
                        the_post_thumbnail();
                        
                        // if( !has_post_thumbnail($products->post->ID) ) {
                        //     printf('<img id="place_holder_thm" src="%s" alt="Placeholder" />',wc_placeholder_img_src());
                        // }
                        // if(empty($this->blend_thumbnails($product))) {
                        //     the_post_thumbnail();
                        // }else {
                        //     $this->gwpg_get_images($product);
                        // }
                    ?>
                </a>
            </div>
            <?php
            return ob_get_clean();
        }

        public function gwpg_product_price($product) {
            if( class_exists('WooCommerce') && $price_html = $product->get_price_html() ) : ?>
            <span class="gwgp-product-price"><?php echo $price_html; ?></span>
            <?php endif;
        }

        public function gwpg_add_cart() {
            ?>
            <div class="gwgp-product-buttons">
                <?php echo do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ); ?>
                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist label=" " product_id="'.get_the_ID().'" icon="fa fa-heart-o" product_added_text=" " already_in_wishslist_text=" " wishlist_url browse_wishlist_text=\'<i class="fa fa-heart"></i>\' ]' ); ?>
            </div>
            <?php
        }

        public function gwpg_product_rating($product) {
                if(class_exists( 'WooCommerce' )) :
                    $average = $product->get_average_rating();
                    if( $average > 0 ) :
            ?>
                <div class="star-rating" title="<?php echo esc_html__( 'Rated', 'global-woo-gallery' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'global-woo-gallery' ); ?>"><span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>'%"><strong itemprop="ratingValue" class="rating"><?php echo $average; ?></strong><?php echo esc_html__( 'out of 5', 'global-woo-gallery' ); ?></span></div>
            <?php endif; endif;
        }
        
        function gwpg_gallery_shortcodes($atts) {

            $post_id  = ! empty($atts['id']) ? $atts['id'] : '';
            $products = new GWPG_Products($post_id);
            $options = $products->product_options();
            $products = $products->get_products();

            ob_start();
            ?>
            <div class="gwpg-products-wrapper<?php echo ' gwpg-products-template-'.$options['products_template']; ?><?php echo ' gwpg-products-theme-'.$options['product_theme']; ?><?php echo ' gwpg-products-column-'.$options['products_column']; ?><?php echo ' gwpg-products-column-tablet-'.$options['products_column_on_tablet']; ?><?php echo ' gwpg-products-column-mobile-'.$options['products_column_on_mobile']; ?>">
                <?php
                    if($products && $products->posts) {
                        include('views/blocks/block-product-grid.php');
                    }else {
                        echo _e( 'No products found, please add or import products.', 'global-woo-gallery' );
                    }
                ?>
            </div>
            <?php
            return ob_get_clean();
        }
    }

    new GWPG_Shortcode;
}