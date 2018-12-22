<?php

/**
 * This file is responsible for displaying meta box tab.
 * 
 * @package global-woo-gallery
 */
$current_screen = get_current_screen();

if( 'gwg_shortcodes' === $current_screen->post_type ) : ?>


<div class="gwpg-metabox-tabs-wrapper gwpg-layout wp-clearfix">

	<div class="gwpg-row">

		<div class="gwpg-metabox-tabs-wrap">

			<ul class="gwpg-metabox-tabs" data-container=".gwpg-metabox-tabs-content">
		
				<li class="gwpg-metabox-tab active" data-tab="configuration">
					<a href="#gwpg-metabox-tab-configuration" data-tab="configuration">
						<span class="gwpg-metabox-tab-number">1</span>
						<span class="gwpg-metabox-tab-title">Source</span>
					</a>
				</li>

				<li class="gwpg-metabox-tab" data-tab="content">
					<a href="#gwpg-metabox-tab-content" data-tab="content">
						<span class="gwpg-metabox-tab-number">2</span>
						<span class="gwpg">Content</span>
					</a>
				</li>

				<li class="gwpg-metabox-tab" data-tab="display">
					<a href="#gwpg-metabox-tab-display" data-tab="display">
						<span class="gwpg-metabox-tab-number">3</span>
						<span class="gwpg-metabox-tab-title">Display</span>
					</a>
				</li>
				
				<li class="gwpg-metabox-tab" data-tab="customize">
					<a href="#gwpg-metabox-tab-customize" data-tab="customize">
						<span class="gwpg-metabox-tab-number">4</span>
						<span class="gwpg-metabox-tab-title">Customize</span>
					</a>
				</li>

			</ul>

		</div>
	</div><!-- /.gwpg-row -->

	<div class="gwpg-row">

		<div class="gwpg-metabox-tabs-content">
		
			<div id="gwpg-metabox-tab-configuration" class="gwpg-metabox-tab-content active">
				<div id="gwpg-metabox-section-config" class="gwpg-metabox-section">
					<h2 class="gwpg-metabox-section-title"><span>Select Source</span></h2>
					
					<div class="gwpg-metabox-section-content">
						<table class="gwpg-metabox-form-table form-table">

						</table>
					</div>
				</div>
			</div>

			<div id="gwpg-metabox-tab-content" class="gwpg-metabox-tab-content">
				<div id="gwpg-metabox-section-content_section" class="gwpg-metabox-section">
					<h2 class="gwpg-metabox-section-title"><span>Content</span></h2>

					<div class="gwpg-metabox-section-content">
						<table class="gwpg-metabox-form-table form-table">

						</table>
					</div>
				</div>
			</div>

			<div id="gwpg-metabox-tab-display" class="gwpg-metabox-tab-content">
				<div id="gwpg-metabox-section-image_option" class="gwpg-metabox-section" style="display: block;">
					<h2 class="gwpg-metabox-section-title"><span>Image</span><span class="gwpg-metabox-tooltip-btn">?</span></h2>

					<div class="gwpg-metabox-section-content">
						<p class="gwpg-metabox-section-description">By default the notification will display the custom avatar from the email address, below settings will override this.</p>
						<table class="gwpg-metabox-form-table form-table">

						</table>
					</div>
				</div>
			</div>

			<div id="gwpg-metabox-tab-customize" class="gwpg-metabox-tab-content">
				<div id="gwpg-metabox-section-appearance" class="gwpg-metabox-section">
					<h2 class="gwpg-metabox-section-title"><span>Appearance</span></h2>

					<div class="gwpg-metabox-section-content">
						<table class="gwpg-metabox-form-table form-table">

						</table>
					</div>
				</div>
			</div>

		</div><!-- /.gwpg-metabox-tabs-content -->

		<div class="gwpg-metabox-tabs-footer">
			<div class="gwpg-metabox-tab-navigation">
				<a href="javascript:void(0)" class="gwpg-metabox-next-tab" style="display: inline-block;">Next<span class="dashicons dashicons-arrow-right-alt"></span></a>

				<a href="javascript:void(0)" class="gwpg-metabox-save-config" data-saving="Saving..." style="display: none;">Save</a>
			</div>
		</div><!-- /.gwpg-metabox-tabs-footer -->

	</div><!-- /.gwpg-row -->


</div><!-- /.gwpg-metabox-tabs-wrapper.gwpg-layout wp-clearfix -->





<?php
endif; // end of 'gwg_shortcodes' === $current_screen->post_type