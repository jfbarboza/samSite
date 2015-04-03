<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***

$content = array(
	'footer_bg_image' => array(
		'title' => __('Footer Background Image', 'accio'),
		'type' => 'upload',
		'default_value' => '',
		'description' => __('Upload your background image here. Recommended image types: png, gif, jpg.', 'accio'),
		'custom_html' => '',
		'is_reset' => true
	),
	'copyright_text' => array(
		'title' => __('Copyrights', 'accio'),
		'type' => 'textarea',
		'default_value' => sprintf(__('Copyright &copy; %d. ThemeMakers. All rights reserved', 'accio'), date('Y')),
		'description' => '',
		'custom_html' => ''
	),
	'hide_footer' => array(
		'title' => __('Disable Footer Widget Area', 'accio'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('If checked, all the footer widgets will not be appeared in the bottom of each page.', 'accio'),
		'custom_html' => ''
	),
	'hide_logo_in_footer' => array(
		'title' => __('Disable Logo in Footer', 'accio'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('If checked, footer logo will not be appeared in the bottom of each page.', 'accio'),
		'custom_html' => ''	
	)
);


$sections = array(
	'name' => __("Footer", 'accio'),
	'css_class' => 'shortcut-footer',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-editor-kitchensink'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

