<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$content = array(
	'skin_composer' => array(
		'title' => __('Skin Composer', 'accio'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'skin_composer.php')
	),
	'block0' => array(
		'title' => __('Elements', 'accio'),
		'type' => 'items_block',
		'items' => array(
			'general_elements' => array(
				'title' => __('Website Elements Color', 'accio'),
				'type' => 'color',
				'default_value' => '#00c2a9',
				'description' => __('General website elements color(Such elements like icons, some backgrounds etc.). Do not edit this field to use default theme styling.
									Notice: All the styles below may override this color if necessary. ', 'accio'),
				'custom_html' => '',
				'is_reset' => true
			),

		)
	),
	'block1' => array(
		'title' => __('Text', 'accio'),
		'type' => 'items_block',
		'items' => array(
			'general_font_family' => array(
				'title' => __('Website Font Family', 'accio'),
				'type' => 'google_font_select',
				'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
				'description' => '',
				'custom_html' => '',
				'is_reset' => true
			),
			'general_font_size' => array(
				'title' => __('Website Font Size', 'accio'),
				'type' => 'slider',
				'default_value' => 15,
				'min' => 14,
				'max' => 18,
				'description' => __('General website font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
				'custom_html' => '',
				'show_title' => true,
				'is_reset' => true
			),
			'general_text_color' => array(
				'title' => __('Website Text Color', 'accio'),
				'type' => 'color',
				'default_value' => '#777',
				'description' => __('General website text color. Do not edit this field to use default theme styling.', 'accio'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_normal_links_color' => array(
				'title' => __('Website Links Color', 'accio'),
				'type' => 'color',
				'default_value' => '#5b5e60',
				'description' => __('General website links color. Do not edit this field to use default theme styling.', 'accio'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_mouseover_links_color' => array(
				'title' => __('Website Mouseover Links Color', 'accio'),
				'type' => 'color',
				'default_value' => '#00c2a9',
				'description' => __('General website mouseover links color. Do not edit this field to use default theme styling.', 'accio'),
				'custom_html' => '',
				'is_reset' => true
			),
		)
	),
	'block2' => array(
		'title' => __('Backgrounds', 'accio'),
		'type' => 'items_block',
		'items' => array(
			'general_footer_bg_color' => array(
				'title' => __('Website Footer Background', 'accio'),
				'type' => 'color',
				'default_value' => '',
				'description' => __('General website footer background color (The bottom area where is copyright info located). Do not edit this field to use default theme styling.', 'accio'),
				'custom_html' => '',
				'is_reset' => true
			),
			'body_pattern_selected' => array(
				'title' => __('Website Background', 'accio'),
				'type' => 'select',
				'css_class' => 'showhide',
				'default_value' => 0,
				'values' => array(
					0 => __('Background Color', 'accio'),
					1 => __('Custom Background Image', 'accio'),
					2 => __('Patterns', 'accio'),
				),
				'description' => __('General website background. Do not edit this field to use default theme styling.', 'accio'),
				'custom_html' => TMM::draw_free_page($pagepath . 'body_pattern_selected.php'),
				'show_title' => true,
				'is_reset' => true
			),
		)
	),
	'custom_css' => array(
		'title' => __('Custom CSS Styles', 'accio'),
		'type' => 'textarea',
		'default_value' => '',
		'description' => '',
		'custom_html' => ''
	),
);

$child_sections['styling_headings'] = array(
	'name' => __('Headings', 'accio'),
	'sections' => array(
		'block1' => array(
			'title' => __('H1 Heading', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'h1_font_family' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_font_size' => array(
					'title' => __('Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 36,
					'min' => 34,
					'max' => 40,
					'description' => __('H1 heading font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'h1_font_color' => array(
					'title' => __('Font Color', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('H1 heading cont color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block2' => array(
			'title' => __('H2 Heading', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'h2_font_family' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_font_size' => array(
					'title' => __('Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 24,
					'min' => 22,
					'max' => 26,
					'description' => __('H2 heading font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'h2_font_color' => array(
					'title' => __('Font Color', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('H2 heading cont color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block3' => array(
			'title' => __('H3 Heading', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'h3_font_family' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_font_size' => array(
					'title' => __('Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 20,
					'min' => 18,
					'max' => 22,
					'description' => __('H3 heading font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'h3_font_color' => array(
					'title' => __('Font Color', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('H3 heading cont color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block4' => array(
			'title' => __('H4 Heading', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'h4_font_family' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_font_size' => array(
					'title' => __('Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 18,
					'min' => 16,
					'max' => 20,
					'description' => __('H4 heading font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'h4_font_color' => array(
					'title' => __('Font Color', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('H4 heading cont color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block5' => array(
			'title' => __('H5 Heading', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'h5_font_family' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_font_size' => array(
					'title' => __('Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 16,
					'min' => 14,
					'max' => 18,
					'description' => __('H5 heading font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'h5_font_color' => array(
					'title' => __('Font Color', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('H5 heading cont color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block6' => array(
			'title' => __('H6 Heading', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'h6_font_family' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_font_size' => array(
					'title' => __('Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 14,
					'min' => 12,
					'max' => 16,
					'description' => __('H6 heading font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'h6_font_color' => array(
					'title' => __('Font Color', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('H6 heading cont color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
	)
);

$child_sections['styling_main_navigation'] = array(
	'name' => __('Main Navigation', 'accio'),
	'sections' => array(
		'block1' => array(
			'title' => __('General', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_font' => array(
					'title' => __('Font Family', 'accio'),
					'type' => 'google_font_select',
					'default_value' => 'Roboto:100,300,300italic,regular,700&subset=vietnamese,latin-ext,greek-ext,cyrillic-ext,latin,cyrillic,greek',
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_first_level_font_size' => array(
					'title' => __('First Level\'s Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 14,
					'min' => 12,
					'max' => 16,
					'description' => __('Main navigation first level\'s font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
				'main_nav_second_level_font_size' => array(
					'title' => __('Second Level\'s Font Size', 'accio'),
					'type' => 'slider',
					'default_value' => 11,
					'min' => 10,
					'max' => 12,
					'description' => __('Main navigation seconds level\'s font size in pixels. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'show_title' => true,
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Links Color (First level)', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_def_text_color' => array(
					'title' => __('Normal', 'accio'),
					'type' => 'color',
					'default_value' => '#5b5e60',
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_curr_text_color' => array(
					'title' => __('Current', 'accio'),
					'type' => 'color',
					'default_value' => '#fff',
					'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_curr_text_color_sticky' => array(
					'title' => __('Current Sticky', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('Current menu item\'s link color for sticky main navigation. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_hover_text_color' => array(
					'title' => __('Mouseover', 'accio'),
					'type' => 'color',
					'default_value' => '#fff',
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block3' => array(
			'title' => __('Background Color (First level)', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_hover_bg_color' => array(
					'title' => __('Mouseover', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_current_bg_color' => array(
					'title' => __('Current', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_current_bg_color_sticky' => array(
					'title' => __('Current Sticky', 'accio'),
					'type' => 'color',
					'default_value' => '#fff',
					'description' => __('', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block4' => array(
			'title' => __('Links Color (Second level)', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_dd_def_text_color' => array(
					'title' => __('Normal', 'accio'),
					'type' => 'color',
					'default_value' => '#fff',
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_dd_curr_text_color' => array(
					'title' => __('Current / Mouseover', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('Current menu item\'s link color for main navigation. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block5' => array(
			'title' => __('Links Styles (for Touch Devices)', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_bg_touch_color' => array(
					'title' => __('Normal', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_touch_color_hover' => array(
					'title' => __('Current / Mouseover', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('Current menu item\'s link color for main navigation sub menu. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		)
	)
);

$child_sections['styling_buttons'] = array(
	'name' => __('Buttons', 'accio'),
	'sections' => array(
		'block1' => array(
			'title' => __('Normal Styles', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'buttons_text_color' => array(
					'title' => __('Text', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('A normal, visited and unvisited default button\'s text color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_border_color' => array(
					'title' => __('Border Color', 'accio'),
					'type' => 'color',
					'default_value' => '#cfcfcf',
					'description' => __('A normal, visited and unvisited default button\'s background color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Mouseover Styles', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'buttons_hover_text_color' => array(
					'title' => __('Text', 'accio'),
					'type' => 'color',
					'default_value' => '#fff',
					'description' => __('Default button\'s text color when the user mouses over it. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_hover_bg_color' => array(
					'title' => __('Background', 'accio'),
					'type' => 'color',
					'default_value' => '#00c2a9',
					'description' => __('Default button\'s background color when the user mouses over it. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);


$child_sections['styling_widgets'] = array(
	'name' => __('Widgets', 'accio'),
	'sections' => array(
		'block1' => array(
			'title' => __('Normal Color Styles', 'accio'),
			'type' => 'items_block',
			'items' => array(
				'widget_title_color' => array(
					'title' => __('Title Color', 'accio'),
					'type' => 'color',
					'default_value' => '#4b4c4d',
					'description' => __('Widget\'s title text color. Do not edit this field to use default theme styling.', 'accio'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		)
	)
);

$sections = array(
	'name' => __('Styling', 'accio'),
	'css_class' => 'shortcut-styling',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-welcome-write-blog'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;


