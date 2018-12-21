<?php

/**
 * This file is responsible for displaying meta box tab.
 * 
 * @package global-woo-gallery
 */
$current_screen = get_current_screen();

if( 'gwg_shortcodes' === $current_screen->post_type ) : ?>


    <div class="gwpg-metabox-framework">
		<div class="gwpg-banner">
			<!-- <div class="gwpg-meatbox-head-logo"><img src="" alt="Global WooCommerce Product Gallery"></div> -->
			<div class="gwpg-short-links">
				<a href="#" target="_blank">Docs</a>
				<a href="#" target="_blank">Support</a>
			</div>
		</div>
		<div class="gwpg-mbf text-center">

			<div class="gwpg-col-lg-3">
				<div class="gwpg-mbf-shortcode">
					<h2 class="gwpg-mbf-shortcode-title"><?php __( 'Shortcode', 'global-woo-gallery'); ?></h2>
					
                    <p><?php _e( 'Copy and paste this shortcode into your posts or pages:', 'global-woo-gallery' );
						global $post;
						?></p>
                    <div class="gwpg-code-mode selectable">[global_woo_product_gallery <?php
	                    echo 'id="' . $post->ID . '"'; ?>]</div>
				</div>
			</div><!-- /.end of column 1 -->

            <div class="gwpg-col-lg-3">
				<div class="gwpg-mbf-shortcode">
					<h2 class="gwpg-mbf-shortcode-title"><?php _e( 'Template Include', 'global-woo-gallery' ); ?> </h2>

					<p><?php _e( 'Paste the PHP code into your template file:', 'global-woo-gallery' ); ?></p>

                    <div class="gwpg-code-mode selectable">
                        &lt;?php
                        <!-- woo_product_slider_id('<?php //echo $post->ID  ; ?>'); -->
                        ?&gt;</div>
				</div>
			</div><!-- /.end of column 2 -->

			<div class="gwpg-col-lg-3">
				<div class="gwpg-mbf-shortcode">
					<h2 class="gwpg-mbf-shortcode-title"><?php _e( 'Post or Page editor', 'global-woo-gallery' ); ?> </h2>

					<p><?php _e( 'Insert it into an existing post or page with the icon:', 'global-woo-gallery' ); ?></p>
					<img class="back-image" src="<?php echo 'admin/assets/images/wps-editor-button.png' ?>" alt="">
				</div>
			</div>

		</div>
		<div class="gwpg-shortcode-divider"></div>

		<div class="gwpg-mbf-nav nav-tab-wrapper current">
			<a class="nav-tab nav-tab-active" data-tab="gwpg-tab-1">General Settings</a>
			<a class="nav-tab" data-tab="gwpg-mbf-tab-2"></i>Slider Settings</a>
			<a class="nav-tab" data-tab="gwpg-mbf-tab-3">Stylization</a>
			<a class="nav-tab" data-tab="gwpg-mbf-tab-4">Typography</a>
			<!-- <a class="nav-tab sp-wps-upgrade-to-pro" data-tab="gwpg-mbf-tab-5"><i class="sp-wps-font-icon icon-rocket"></i>Upgrade to Pro</a> -->
		</div>

		<?php
		// include_once 'partials/general-settings.php';
		// include_once 'partials/slider-settings.php';
		// include_once 'partials/stylization.php';
		// include_once 'partials/typography.php';
		// include_once 'partials/upgrade-to-pro.php';
		?>
	</div>

<?php
endif; // end of 'gwg_shortcodes' === $current_screen->post_type