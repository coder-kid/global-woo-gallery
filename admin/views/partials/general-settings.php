<?php
/**
 * Provides the 'Resources' view for the corresponding tab in the Shortcode Meta Box.
 *
 * @since 2.0
 *
 * @package    global-woo-gallery
 */
?>
<div class="sp-wps-mbf-tab-content">

	<?php        
        $this->metaboxform->select( array(
            'id'      => 'gwpg_product_themes',
            'name'    => __( 'Select Theme', 'global-woo-gallery' ),
            'desc'    => __( 'Select which theme you want to display.', 'global-woo-gallery' ),
            'options' => array(
                'theme_one'   => __( 'Theme One', 'global-woo-gallery' ),
                'theme_two'   => __( 'Theme Two', 'global-woo-gallery' ),
                'theme_three' => __( 'Theme Three', 'global-woo-gallery' ),
            ),
            'default' => 'theme_one'
        ));

        $this->metaboxform->select_products_from( array(
            'id'      => 'gwpg_products_from',
            'name'    => __( 'Product From', 'global-woo-gallery' ),
            'desc'    => __( 'Select an option to show the product from.', 'global-woo-gallery' ),
            'default' => 'latest'
        ));

        $this->metaboxform->number( array(
            'id'      => 'gwpg_number_of_column',
            'name'    => __( 'Number of Column', 'global-woo-gallery' ),
            'desc'    => __( 'Set number of column for the screen larger than 1100px.', 'global-woo-gallery' ),
            'default' => 4
        ));

        $this->metaboxform->number( array(
            'id'      => 'gwpg_number_of_column_desktop',
            'name'    => __( 'Number of Column on Desktop', 'global-woo-gallery' ),
            'desc'    => __( 'Set number of column on desktop for the screen smaller than 1100px.', 'global-woo-gallery' ),
            'default' => 3
        ));

        $this->metaboxform->number( array(
            'id'      => 'gwpg_number_of_column_tablet',
            'name'    => __( 'Number of Column on Tablet', 'global-woo-gallery' ),
            'desc'    => __( 'Set number of column on tablet for the screen smaller than 990px.', 'global-woo-gallery' ),
            'default' => 2
        ));

        $this->metaboxform->number( array(
            'id'      => 'gwpg_number_of_column_mobile',
            'name'    => __( 'Number of Column on Mobile', 'global-woo-gallery' ),
            'desc'    => __( 'Set number of column on mobile for the screen smaller than 650px.', 'global-woo-gallery' ),
            'default' => 1
        ));

        $this->metaboxform->number( array(
            'id'      => 'gwpg_number_of_total_products',
            'name'    => __( 'Total Products', 'global-woo-gallery' ),
            'desc'    => __( 'Number of Total products to show.', 'global-woo-gallery' ),
            'default' => 50
        ));

        $this->metaboxform->select( array(
            'id'      => 'gwpg_order_by',
            'name'    => __( 'Order By', 'global-woo-gallery' ),
            'desc'    => __( 'Select an order by option.', 'global-woo-gallery' ),
            'options' => array(
                'ID'       => __( 'ID', 'global-woo-gallery' ),
                'date'     => __( 'Date', 'global-woo-gallery' ),
                'title'    => __( 'Title', 'global-woo-gallery' ),
                'rand'     => __( 'Random', 'global-woo-gallery' ),
                'modified' => __( 'Modified', 'global-woo-gallery' ),
            ),
            'default' => 'date'
        ));

        $this->metaboxform->select( array(
            'id'      => 'gwpg_order',
            'name'    => __( 'Order', 'global-woo-gallery' ),
            'desc'    => __( 'Select an order option', 'global-woo-gallery' ),
            'options' => array(
                'ASC'  => __( 'Ascending', 'global-woo-gallery' ),
                'DESC' => __( 'Descending', 'global-woo-gallery' ),
            ),
            'default' => 'DESC'
        ));

	?>

</div>