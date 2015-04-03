<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$list_pages = get_posts(array(
	'post_type' => 'page',
	'numberposts'     => -1
));

$list_pages_array = array('' => 'Select Page');

if (!empty($list_pages)) {
	foreach($list_pages as $id => $page) {
		$list_pages_array[$page->ID] = $page->post_title;
	}
}

$content = array(
	'frontpage' => array(
		'title' => __('Frontpage Settings', 'accio'),
		'type' => 'select',
		'default_value' => '',
		'values' => $list_pages_array,
		'description' => __('Select which page to display on your Frontpage.'),
		'custom_html' => '',
		'show_title' => false,
		'is_reset' => true	
	),
	'blogpage' => array(
		'title' => __('Blog Page', 'accio'),
		'type' => 'select',
		'default_value' => '',
		'values' => $list_pages_array,
		'description' => __('Select which page to display as your Blog Page.'),
		'custom_html' => '',
		'show_title' => false,
		'is_reset' => true	
	),
	'favicon_img' => array(
		'title' => __('Website Favicon', 'accio'),
		'type' => 'upload',
		'default_value' => TMM_THEME_URI . '/images/favicon.png',
		'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 32x32. Recommended image types: png', 'accio'),
		'custom_html' => TMM::draw_free_page($pagepath . 'favicon_img.php')
	),
	'apple_touch_icon' => array(
		'title' => __('Apple Touch Icon', 'accio'),
		'type' => 'upload',
		'default_value' => TMM_THEME_URI . '/images/apple-touch-icon.png',
		'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 57x57. Recommended image types: png', 'accio'),
		'custom_html' => ''
	),
	'apple_touch_icon_72x72' => array(
		'title' => __('Apple Touch Icon (72x72)', 'accio'),
		'type' => 'upload',
		'default_value' => TMM_THEME_URI . '/images/apple-touch-icon-72x72.png',
		'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 72x72. Recommended image types: png', 'accio'),
		'custom_html' => ''
	),
	'apple_touch_icon_114x114' => array(
		'title' => __('Apple Touch Icon (114x114)', 'accio'),
		'type' => 'upload',
		'default_value' => TMM_THEME_URI . '/images/apple-touch-icon-114x114.png',
		'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 114x114. Recommended image types: png', 'accio'),
		'custom_html' => ''
	),
	'logo' => array(
		'title' => __('Website Logo', 'accio'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'logo.php')
	),
	'sidebar_position' => array(
		'title' => __('Default Sidebar Position', 'accio'),
		'type' => 'custom',
		'default_value' => 'no_sidebar',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'sidebar_position.php')
	),
	'blog_sidebar_position' => array(
		'title' => __('Sidebar on Blog Page', 'accio'),
		'type' => 'select',
		'default_value' => 'sbr',
		'values' => array(
			'sbl' => 'Left Sidebar',
			'sbr' => 'Right Sidebar'
		),
		'description' => __(''),
		'custom_html' => '',
		'show_title' => false,
		'is_reset' => true	
	),
	'use_wptexturize' => array(
		'title' => __('Use wptexturize', 'accio'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => '',
		'custom_html' => ''
	),
	'type_menu' => array(
		'title'=> __('Use Transparent Navigation', 'accio'),
		'type' => 'checkbox',
		'default_value' => 1,
		'description' => 'Only for onepage',
		'custom_html' => ''
	),
	'tracking_code' => array(
		'title' => __('Tracking Code', 'accio'),
		'type' => 'textarea',
		'default_value' => '',
		'description' => __('Place here your Google Analytics (or other) tracking code. It will be inserted before closing body tag in your theme.', 'accio'),
		'custom_html' => ''
	)
);

$sections = array(
	'name' => __("General", 'accio'),
	'css_class' => 'shortcut-options',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-admin-settings'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

