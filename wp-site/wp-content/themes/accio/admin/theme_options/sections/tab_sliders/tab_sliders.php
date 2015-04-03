<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
//$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************

$content = array(
	'' => array(
		'title' => '',
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => 'empty'
	),
);

foreach (TMM_Ext_Sliders::$slider_js_options as $slider_key => $slider) {
	if ($slider_key == 'layerslider') {
		continue;
	}

	$slider_data = array();
	$slider_data['name'] = TMM_Ext_Sliders::$slider_options[$slider_key]['name'];
	
	$slider_data['sections'] = array();
	foreach ($slider as $option => $options_array) {
		$slider_data['sections']["slider_" . $slider_key . "_" . $option] = array(
			'title' => $options_array['title'],
			'type' => $options_array['type'],
			'default_value' => $options_array['default'],
			'values' => @$options_array['values'],
			'min' => 0,
			'max' => @$options_array['max'],
			'description' => $options_array['description'],
			'custom_html' => ''
		);
	}
	
	$child_sections[$slider_key] = $slider_data;
}

$sections = array(
	'name' => __('Sliders Settings', 'accio'),
	'css_class' => 'shortcut-slider',
	'show_general_page' => false,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-images-alt2'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

