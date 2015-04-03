<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');

//$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$folio_archive_per_page = array();

for ($i = 3; $i <= 21; $i++) {
	$folio_archive_per_page[$i] = $i;
}


$content = array(
	'block1' => array(
		'title' => __('Archive Page Layout', 'accio'),
		'type' => 'items_block',
		'items' => array(
			 'folio_page_onepage' => array(
                                'title' => __('Portfolio Page', 'accio'),
                                'type' => 'select',
                                'default_value' => '',
                                'values' => $list_pages_array,
                                'description' => __('Select which page to display as your Portfolio Page in One Page Template.'),
                                'custom_html' => '',
                                'show_title' => false,
                                'is_reset' => true	
                        ),
			'folio_archive_per_page' => array(
				'title' => __('Items per page', 'accio'),
				'type' => 'select',
				'default_value' => 10,
				'values' => $folio_archive_per_page,
				'description' => __('Please type here an amount of items to be displayed per portfolio page.', 'accio'),
				'show_title' => true,
				'custom_html' => ''
			),
			'folio_archive_sidebar' => array(
				'title' => __('Archive Page Sidebar', 'accio'),
				'type' => 'select',
				'default_value' => 'no_sidebar',
				'values' => array(
					'no_sidebar' => __('No sidebar', 'accio'),
					'sbl' => __('Left', 'accio'),
					'sbr' => __('Rigth', 'accio'),
				),
				'description' => __('Archive Page sidebar position for Portfolio', 'accio'),
				'show_title' => true,
				'custom_html' => ''
			),
		)
	),
	'block2' => array(
		'title' => __('Single Page Layout', 'accio'),
		'type' => 'items_block',
		'items' => array(
			'folio_show_related_works' => array(
				'title' => __('Show Related Projects on single page', 'accio'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show Related Works on single page', 'accio'),
				'custom_html' => ''
			),
			'single_folio_hide_date' => array(
				'title' => __('Hide Single Folio Date', 'accio'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_clients' => array(
				'title' => __('Hide Single Folio Clients', 'accio'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_skills' => array(
				'title' => __('Hide Single Folio Skills', 'accio'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_tags' => array(
				'title' => __('Hide Single Folio Tags', 'accio'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_tools' => array(
				'title' => __('Hide Single Folio Tools', 'accio'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			)
		)
	),
);

$sections = array(
	'name' => __('Portfolio', 'accio'),
	'css_class' => 'shortcut-portfolio',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-portfolio'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

