<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Metabox Framework
 * 
 * @since   1.0.0
 * @version 1.0.0
 */
class GWPG_Metabox_Framework {

    /**
     * option database/data name
     * 
     * @access public
     * @var string
     */
    public $unique = 'gwpg_';

    /**
     * settings
     * 
     * @access public
     * @var array
     */
    public $settings = [];

    /**
     * options sections
     * 
     * @access public
     * @var array
     */
    public $sections = [];

    /**
     * options tab
     * 
     * @access public
     * @var array
     */
    public $options = [];

    /**
     * options store
     * 
     * @access public
     */
    public $get_options = [];

    /**
     * Metabox fields holder
     * 
     * @access public
     * @var array
     */
    public $metaboxform;

    /**
	 *
	 * instance
	 * @access private
	 * @var class
	 *
	 */
    private static $instance = null;
    
    // instance
	public static function instance( $options = array() ) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $options );
		}
		return self::$instance;
    }
    
    // runs framework construct
    public function __construct( $options ) {
        
        $this->options = apply_filters('gwpg_metabox_framework', $options);

        if( ! empty($this->options) ) {
            add_action( 'add_meta_boxes', [$this, 'generate_metaboxes'] );
            $this->sections = $this->get_sections();
            $this->metaboxform = new GWPG_Controls_Manager();
            add_action( 'save_post', [$this, 'save_posts_data'] );
        }

    }

    /**
     * Get user inserted sections
     */
    public function get_sections() {

        $sections = [];

        foreach( $this->options as $key => $value ){

            if( isset($value['sections']) ) {
                foreach( $value['sections'] as $section ) {

                    if( isset($section['fields']) ) {
                        $sections[] = $section;
                    }

                }
            }else {
                if( isset( $value['fields'] ) ) {
                    $sections[] = $value;
                }
            }

        }

        return $sections;

    }

    public function generate_metaboxes() {
        add_meta_box(
            'gwg_shortcode_options',
            __( 'Gallery Options', 'global-woo-gallery' ),
            [$this, 'admin_page'],
            'gwg_shortcodes',
            'normal',
            'default'
        );
    }

    public function admin_page() {

        wp_nonce_field( 'gwpg_metabox_nonce_fields_action', 'gwpg_metabox_nonce_fields_name' );

        echo '<div class="gwpg-metabox-tabs-wrapper gwpg-layout wp-clearfix">';
        ob_start();
        ?>

            <div class="gwpg-row">

                <div class="gwpg-metabox-tabs-wrap">

                    <?php
                        $tab_number = 1;
                        echo '<ul class="gwpg-metabox-tabs" data-container=".gwpg-metabox-tabs-content">';
                        foreach($this->sections as $tab) {
                            $active_tab = ($tab_number === 1) ? ' active' : '';
                            ?>
                            <li class="gwpg-metabox-tab <?php echo $active_tab; ?>" data-tab="<?php echo $tab['name']; ?>">
                                <a href="#gwpg-metabox-tab-<?php echo $tab['name']; ?>" data-tab="<?php echo $tab['name']; ?>">
                                    <span class="gwpg-metabox-tab-number"><?php echo $tab_number; ?></span>
                                    <span class="gwpg-metabox-tab-title"><?php echo $tab['name']; ?></span>
                                </a>
                            </li>
                            <?php
                            $tab_number++;
                        }
                        echo '</ul>';

                    ?>

                </div>
            </div><!-- /.gwpg-row -->

            <div class="gwpg-row">

                <div class="gwpg-metabox-tabs-content">
                
                <?php
                    $section_count = 1;
                    foreach($this->sections as $section) :
                        $active_section = ($section_count === 1) ? ' active' : '';
                ?>
                    <div id="gwpg-metabox-tab-<?php echo $section['name']; ?>" class="gwpg-metabox-tab-content<?php echo $active_section; ?>">
                        <div id="gwpg-metabox-section-<?php echo $section['name']; ?>" class="gwpg-metabox-section">
                            <?php if(isset( $section['section_title'] )) : ?>
                            <h2 class="gwpg-metabox-section-title"><span><?php echo $section['section_title']; ?></span></h2>
                            <?php endif; ?>

                            <div class="gwpg-metabox-section-content">
                                <?php
                                    if( isset($section['fields']) ) {
                                        foreach($section['fields'] as $field) {
                                            $this->metaboxform->{$field['type']}($field);
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php $section_count++; endforeach; ?>

                <div class="gwpg-metabox-tabs-footer">
                    <div class="gwpg-metabox-tab-navigation">
                        <a href="javascript:void(0)" class="gwpg-metabox-next-tab" style="display: inline-block;"><?php echo _e('Next', 'global-woo-gallery'); ?><span class="dashicons dashicons-arrow-right-alt"></span></a>

                        <a href="javascript:void(0)" class="gwpg-metabox-save-config" data-saving="Saving..." style="display: none;"><?php _e('Save', 'global-woo-gallery'); ?></a>
                    </div>
                </div><!-- /.gwpg-metabox-tabs-footer -->

            </div><!-- /.gwpg-row -->

        <?php
        echo ob_get_clean();
        echo '</div>';
    }

    public function save_posts_data( $post_id ) {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
        }
        
        // Check if nonce is set
		if ( ! isset( $_POST['gwpg_metabox_nonce_fields_name'], $_POST['gwpg_meta_box'] ) ) {
			return;
        }
        
        if ( ! wp_verify_nonce( $_POST['gwpg_metabox_nonce_fields_name'], 'gwpg_metabox_nonce_fields_action' ) ) {
			return;
        }
        
        // Check if user has permissions to save data
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
        }
        
        foreach ( $_POST['gwpg_meta_box'] as $key => $meta_value ) {

			if ( is_array( $val ) ) {
				$val = implode( ',', $val );
			}

			update_post_meta( $post_id, $key, sanitize_text_field( $meta_value ) );
        }

    }


}