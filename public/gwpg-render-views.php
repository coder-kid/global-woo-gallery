<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists('GWPG_Shortcode') ) {

    class GWPG_Shortcode {

        protected $default_params = [
            'products_template'         => 'grid',
            'total_products'            => 6,
            'products_orderby'          => 'date',
            'products_order'            => 'ASC',
            'product_theme'             => 'theme_one',
            'products_column'           => 3,
            'products_column_on_tablet' => 1,
            'products_column_on_mobile' => 1,
            'products_from'             => '',
            'product_from_category'     => '',
            'product_from_tag'          => ''
        ];

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
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="gwpg-product-thumbnails">
                <?php
                    if( !has_post_thumbnail($products->post->ID) ) {
                        printf('<img id="place_holder_thm" src="%s" alt="Placeholder" />',wc_placeholder_img_src());
                    }
                    if(empty($this->blend_thumbnails($product))) {
                        the_post_thumbnail();
                    }else {
                        $this->gwpg_get_images($product);
                    }
                ?>
            </a>
            <?php
            return ob_get_clean();
        }

        public function gwpg_product_price($product) {
            ?>
            <h4><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h4>
            <?php if( class_exists('WooCommerce') && $price_html = $product->get_price_html() ) : ?>
            <div class="gwgp-product-price"><?php echo $price_html; ?></div>
            <?php endif; ?>
            <?php
        }

        public function gwpg_add_cart() {
            ?>
            <div class="gwgp-cart-button"><?php echo do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ); ?></div>
            <?php
        }

        public function gwpg_product_rating($product) {
                if(class_exists( 'WooCommerce' )) :
                    $average = $product->get_average_rating();
                    if( $average > 0 ) :
            ?>
                <div class="star-rating" title="<?php echo esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ); ?>"><span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>'%"><strong itemprop="ratingValue" class="rating"><?php echo $average; ?></strong><?php echo esc_html__( 'out of 5', 'woo-product-slider' ); ?></span></div>
            <?php endif; endif;
        }
        
        function gwpg_gallery_shortcodes($atts) {

            $post_id = ! empty($atts['id']) ? $atts['id'] : '';
            $products = new GWPG_Products;

            $products = $products->get_products(
                        shortcode_atts(array_merge(
                        $this->default_params,
                        $products->set_params($post_id)),
                    $atts));
            
            ob_start();
            ?>
            <div class="gwpg-products-wrapper">
                <?php
                    if($products->posts) {
                        include('views/blocks/block-product-list.php');
                    }
                ?>
            </div>
            <?php
            return ob_get_clean();
        }
    }

    new GWPG_Shortcode;
}