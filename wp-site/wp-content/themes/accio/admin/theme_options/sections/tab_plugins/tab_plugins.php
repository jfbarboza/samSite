
<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***


$content = array(
	'plugin_page' => array(
		'title' => __('DB Migrate options', 'accio'),
		'type' => 'tmm_db_migrate',		
                'custom_html' => TMM::draw_free_page($pagepath . 'option_page.php')
	));


$sections = array(
	'name' => __("TM DB Migrate", 'accio'),
	'css_class' => 'shortcut-plugins',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-admin-tools'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

