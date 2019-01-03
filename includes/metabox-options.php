<?php

$options      = []; // remove old options

$options[]    = array(
  'name'          => 'settings',
  'title'         => 'Settings',
  'section_title' => 'Product Settings',
  'fields'    => array(
	array(
		'id'      => 'gwpg_product_themes',
		'name'   => __( 'Select Theme', 'woo-product-slider' ),
		'type'    => 'select',
		'desc'    => __( 'Select which theme you want to display.', 'woo-product-slider' ),
		'options' => array(
			'theme_one'   => __( 'Theme One', 'woo-product-slider' ),
			'theme_two'   => __( 'Theme Two', 'woo-product-slider' ),
			'theme_three' => __( 'Theme Three', 'woo-product-slider' ),
		),
		'default' => 'theme_one'
	),
    array(
      'id'    => 'another_option_id',
      'type'  => 'text',
      'name' => 'Secondary Option',
    ),
  )
);

$options[]    = array(
	'name'          => 'gallery',
	'title'         => 'Gallery',
	'section_title' => 'Gallery Settings',
	'fields'    => array(
		array(
			'id'    => 'option_id',
			'type'  => 'text',
			'name' => 'First Option',
		),
		array(
			'id'    => 'another_option_id',
			'type'  => 'text',
			'name' => 'Secondary Option',
		),
	)
);

$options[]    = array(
	'name'          => 'style',
	'title'         => 'Style',
	'section_title' => 'Gallery Stylizations',
	'fields'        => array(
		array(
			'id'    => 'option_id',
			'type'  => 'text',
			'name' => 'First Option',
		),
		array(
			'id'    => 'another_option_id',
			'type'  => 'text',
			'name' => 'Secondary Option',
		),
	)
);

$options[]    = array(
	'name'          => 'typography',
	'title'         => 'Typography',
	'section_title' => 'Gallery Typography',
	'fields'    => array(
		array(
			'id'    => 'option_id',
			'type'  => 'text',
			'name' => 'First Option',
		),
		array(
			'id'    => 'another_option_id',
			'type'  => 'text',
			'name' => 'Secondary Option',
		),
	)
);

$options[]    = array(
	'name'      => 'gopro',
	'title'     => 'GoPro',
	'fields'    => array(
		array(
			'id'    => 'option_id',
			'type'  => 'text',
			'name' => 'First Option',
		),
		array(
			'id'    => 'another_option_id',
			'type'  => 'textarea',
			'name'  => 'Secondary Option',
			'value' => 'Default Value'
		),
	)
);

GWPG_Metabox_Framework::instance($options);