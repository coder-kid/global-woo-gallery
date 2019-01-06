<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * This file responsible for define fields of metabox.
 * 
 * @package global-woo-gallery
 */
class GWPG_Controls_Manager {

    /**
     * text field
     * 
     * @param   array $args
     */
    public function text( array $args ) {
        if( ! isset($args['id'], $args['name'])) return;

        list( $name, $value, $after ) = $this->field_common( $args );
        echo $this->field_before( $args );
        echo sprintf( '<input type="text" class="gwpg-metabox-input-text" value="%1$s" id="%2$s" name="%3$s">%4$s', $value, $args['id'], $name, $after );
		echo $this->field_after();
	}
	
    /**
     * textarea field
     * 
     * @param   array $args
     */
    public function textarea( array $args ) {
		if( ! isset($args['id'], $args['name'])) return;

        list( $name, $value, $after ) = $this->field_common( $args );
        echo $this->field_before( $args );
        echo sprintf( '<textarea class="gwpg-metabox-textarea" id="%2$s" name="%3$s">%1$s</textarea>%4$s', $value, $args['id'], $name, $after );
		echo $this->field_after();
	}
	
	/**
	 * slider
	 * 
	 * @param array $args
	 */
	public function slider(array $args) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value, $after ) = $this->field_common( $args );
		$min = $step = $max = '';
		if( isset($args['atts']) && isset($args['atts']['min']) ) {
			$min = "min='{$args['atts']['min']}'";
		}
		if( isset($args['atts']) && isset($args['atts']['step']) ) {
			$step = "step='{$args['atts']['step']}'";
		}
		if( isset($args['atts']) && isset($args['atts']['max']) ) {
			$max = "max='{$args['atts']['max']}'";
		}

		if( isset($args['atts']) && isset($args['atts']['suffix']) ) {
			$suffix = "suffix='{$args['atts']['suffix']}'";
		}else {
			$suffix = '';
		}

		echo $this->field_before($args);
		ob_start();
		?>
		<div class="range-slider">
			<span>
				<?php
					echo sprintf('<input class="range-slider__range" %s %s %s %s name="%s" type="range" value="%s" />%s', $min, $max, $step, $suffix, $name, $value, $after);
				?>
				<span class="range-slider__value">0</span>
			</span>
		</div>
		<?php
		echo ob_get_clean(), $this->field_after();
	}

    /**
	 * text
	 *
	 * @param array $args
	 */
	public function url_disabled( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value, $after ) = $this->field_common( $args );

		echo $this->field_before( $args );
		echo sprintf( '<input type="text" class="gwpg-metabox-input-text" value="%1$s" id="%2$s" name="%3$s" disabled>%4$s', $value, $args['id'], $name, $after );
		echo $this->field_after();

    }
    
    /**
	 * color
	 *
	 * @param array $args
	 */
	public function color( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value ) = $this->field_common( $args );
		$default_value = isset( $args['default'] ) ? $args['default'] : '';

		echo $this->field_before( $args );
		echo sprintf( '<input type="text" class="gwpg-metabox-color-picker" value="%1$s" id="%2$s" name="%3$s" data-default-color="%4$s">', $value, $args['id'], $name, $default_value );
		echo $this->field_after();
    }
    
    /**
	 * checkbox
	 *
	 * @param array $args
	 */
	public function checkbox( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value, $after ) = $this->field_common( $args );
		$checked = ( $value == 'on' ) ? ' checked' : '';

		echo $this->field_before( $args );
		echo sprintf( '<input type="hidden" name="%1$s" value="off">', $name );
		echo sprintf( '<label for="%2$s"><input type="checkbox" %4$s value="on" id="%2$s" name="%1$s">%3$s</label>', $name, $args['id'], $after, $checked );
		echo $this->field_after();
    }
    
    /**
	 * select
	 *
	 * @param array $args
	 */
	public function select( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value ) = $this->field_common( $args );
		$multiple = isset( $args['multiple'] ) ? 'multiple' : '';

		echo $this->field_before( $args );
		echo sprintf( '<select name="%1$s" id="%2$s" class="gwpg-metabox-select" %3$s style="width:200px">', $name, $args['id'],
            $multiple );
		foreach ( $args['options'] as $key => $option ) {
			$selected = ( $value == $key ) ? ' selected="selected"' : '';
			echo sprintf( '<option value="%1$s" %3$s>%2$s</option>', $key, $option, $selected );
		}
		echo '</select>';
		echo $this->field_after();
    }

    /**
	 * number
	 *
	 * @param array $args
	 */
	public function number( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value, $after ) = $this->field_common( $args );
		$min = $step = $max = '';
		if( isset($args['atts']) && isset($args['atts']['min']) ) {
			$min = "min='{$args['atts']['min']}'";
		}
		if( isset($args['atts']) && isset($args['atts']['step']) ) {
			$step = "step='{$args['atts']['step']}'";
		}
		if( isset($args['atts']) && isset($args['atts']['max']) ) {
			$max = "max='{$args['atts']['max']}'";
		}

		echo $this->field_before( $args );
		echo sprintf( '<input type="number" class="gwpg-metabox-input-number" %5$s %6$s %7$s value="%1$s" id="%2$s" name="%3$s">%4$s', $value, $args['id'], $name, $after, $min, $step, $max );
		echo $this->field_after();
	}
    
    /**
	 * Select slider type for pro ad.
	 *
	 * @param array $args
	 */
	public function select_slider_type( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value ) = $this->field_common( $args );
		$multiple = isset( $args['multiple'] ) ? 'multiple' : '';

		echo $this->field_before( $args );
		echo sprintf( '<select name="%1$s" id="%2$s" class="gwpg-metabox-input-text sp-wps-select" %3$s>', $name, $args['id'],
            $multiple ); ?>
		<option value="product_slider">Product Slider</option>
		<option value="category_slider" disabled>Category Slider (Pro)</option>
		<?php
		echo '</select>';
		echo $this->field_after();
    }
    
    /**
	 * Select products from for pro ad.
	 *
	 * @param array $args
	 */
	public function select_products_from( array $args ) {
		if ( ! isset( $args['id'], $args['name'] ) ) {
			return;
		}

		list( $name, $value ) = $this->field_common( $args );
		$multiple = isset( $args['multiple'] ) ? 'multiple' : '';

		echo $this->field_before( $args );
		echo sprintf( '<select name="%1$s" id="%2$s" class="gwpg-metabox-input-text gwpg-metabox-select gwpg-metabox_products_from" %3$s>', $name, $args['id'],
            $multiple ); ?>
		<option value="latest">Recent Products</option>
		<option value="featured">Featured Products</option>
		<option value="best_selling">Best Selling Products</option>
		<option value="sale_products">Sale Products</option>
		<option value="top_rated_products">Top Rated Products</option>
		<?php
		echo '</select>';
		echo $this->field_after();
	}

    /**
     * Field common
     * 
     * @param $args
     * @return array
     */
    private function field_common( array $args ) {
        global $post;

        // Meta name
        $group    = isset($args['group']) ? $args['group'] : 'gwpg_meta_box';
        $multiple = isset($args['multiple']) ? '[]' : '';
        $name     = sprintf( '%s[%s]%s', $group, $args['id'], $multiple );
        $after    = isset( $args['after'] ) ? '<span class="gwpg-metabox-after">' . $args['after'] . '</span> ' : '';

        // Meta value
        $default = isset($args['default']) ? $args['default'] : '';
        $meta    = get_post_meta( $post->ID, $args['id'], true );
        $value   = ! empty($meta) ? $meta : $default;
        if( $value == 'zero' ) $value = 0;

        return [$name, $value, $after];
    }

    /**
     * Field before
     * 
     * @param array $args
     * @return html
     */
    private function field_before( array $args ) {
        $table = '';
		$table .= sprintf( '<div class="gwpg-metabox-element gwpg-metabox-input-group" id="field-%s">', $args['id'] );
		$table .= sprintf( '<div class="gwpg-metabox-input-label">' );
		$table .= sprintf( '<label for="%1$s">%2$s</label>', $args['id'], $args['name'] );
		if ( ! empty( $args['desc'] ) ) {
			$table .= sprintf( '<p class="gwpg-metabox-input-desc">%s</p>', $args['desc'] );
		}
		$table .= '</div>';
		$table .= sprintf( '<div class="gwpg-metabox-input-field">' );

		return $table;
    }

    /**
     * Field after
     * 
     * @return html
     */
    private function field_after() {
        return '</div></div>';
    }


}