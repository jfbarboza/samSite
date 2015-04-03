<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Testimonials {

	public static $slug = 'tmonials';

	public static function init() {

		$args = array(
			'labels' => array(
				'name' => __('Testimonials', 'accio'),
				'singular_name' => __('Testimonials', 'accio'),
				'add_new' => __('Add New', 'accio'),
				'add_new_item' => __('Add New Testimonial', 'accio'),
				'edit_item' => __('Edit Testimonial', 'accio'),
				'new_item' => __('New Testimonial', 'accio'),
				'view_item' => __('View Testimonial', 'accio'),
				'search_items' => __('Search Testimonials', 'accio'),
				'not_found' => __('No Testimonials found', 'accio'),
				'not_found_in_trash' => __('No Testimonials found in Trash', 'accio'),
				'parent_item_colon' => ''
			),
			'public' => false,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'menu_icon' => 'dashicons-edit'
		);
		register_post_type(self::$slug, $args);
		flush_rewrite_rules(false);
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "position", @$_POST["position"]);
			}
		}
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function init_meta_boxes() {
		add_meta_box("testimonials_credits_meta", __("Position", 'accio'), array(__CLASS__, 'testimonials_credits_meta'), self::$slug, "normal", "low");
	}

	public static function testimonials_credits_meta() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['position'] = @$custom["position"][0];
		echo TMM::draw_html('testimonials/credits_meta', $data);
	}

}
