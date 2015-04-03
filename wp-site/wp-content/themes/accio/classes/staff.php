<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Staff {

	public static $slug = 'staff-page';

	public static function init() {
		
		$labels = array(
			'name' => __('Staff', 'accio'),
			'singular_name' => __('Staff', 'accio'),
			'add_new' => __('Add New', 'accio'),
			'add_new_item' => __('Add New Staff', 'accio'),
			'edit_item' => __('Edit Staff', 'accio'),
			'new_item' => __('New Staff', 'accio'),
			'view_item' => __('View Staff', 'accio'),
			'search_items' => __('Search In Staff', 'accio'),
			'not_found' => __('Nothing found', 'accio'),
			'not_found_in_trash' => __('Nothing found in Trash', 'accio'),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => false,
			'archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'thumbnail', 'excerpt'),
			'rewrite' => array('slug' => self::$slug),
			'show_in_admin_bar' => true,
			'taxonomies' => array('position'), // this is IMPORTANT
			'menu_icon' => 'dashicons-businessman'
		);

		register_taxonomy("position", array(self::$slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Position', 'accio'),
				'singular_name' => __('Position', 'accio'),
				'add_new' => __('Add New', 'accio'),
				'add_new_item' => __('Add New Position', 'accio'),
				'edit_item' => __('Edit Position', 'accio'),
				'new_item' => __('New Position', 'accio'),
				'view_item' => __('View Position', 'accio'),
				'search_items' => __('Search GPosition', 'accio'),
				'not_found' => __('No Position found', 'accio'),
				'not_found_in_trash' => __('No Position found in Trash', 'accio'),
				'parent_item_colon' => ''
			),
			"singular_label" => __("Position", 'accio'),
			"rewrite" => true,
			'show_in_nav_menus' => false,
		));
		//***	


		register_post_type(self::$slug, $args);
		flush_rewrite_rules(false);

		//***
		add_action("manage_" . self::$slug . "_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_" . self::$slug . "_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
		
	}
	
	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function get_meta_data($post_id) {
		$data = array();
		$custom = get_post_custom($post_id);
		$data['twitter'] = @$custom["twitter"][0];
		$data['facebook'] = @$custom["facebook"][0];
		$data['linkedin'] = @$custom["linkedin"][0];
		$data['dribbble'] = @$custom["dribbble"][0];
		$data['instagram'] = @$custom["instagram"][0];
		return $data;
	}

	public static function credits_meta() {
		global $post;
		$data = self::get_meta_data($post->ID);
		echo TMM::draw_html('staff/credits_meta', $data);
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "twitter", @$_POST["twitter"]);
				update_post_meta($post->ID, "facebook", @$_POST["facebook"]);
				update_post_meta($post->ID, "linkedin", @$_POST["linkedin"]);
				update_post_meta($post->ID, "dribbble", @$_POST["dribbble"]);
				update_post_meta($post->ID, "instagram", @$_POST["instagram"]);
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("credits_meta", __("Staff attributes", 'accio'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;
		
		switch ($column) {
			case "image":
				if (has_post_thumbnail($post->ID)) {
					echo '<img width="160" alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '160*160') . '"/>';
				} else {
					echo '<img width="160" alt="" src="' . TMM_THEME_URI . '/admin/images/no_staff.png" />';
				}
				break;
			case "twitter":
				echo get_post_meta($post->ID, 'twitter', true);
				break;
			case "facebook":
				echo get_post_meta($post->ID, 'facebook', true);
				break;
			case "linkedin":
				echo get_post_meta($post->ID, 'linkedin', true);
				break;
			case "dribbble":
				echo get_post_meta($post->ID, 'dribbble', true);
				break;
			case "instagram":
				echo get_post_meta($post->ID, 'instagram', true);
				break;
		}
	}

	public static function show_edit_columns() {
		$columns = array(
			'cb'    => '<input type="checkbox" />',
			"title" => __("Name", 'accio'),
			"image" => __("Photo", 'accio'),
			"twitter" => __("Twitter", 'accio'),
			"facebook" => __("Facebook", 'accio'),
			"linkedin" => __("LilkedIn", 'accio'),
			"dribbble" => __("Dribbble", 'accio'),
			"instagram" => __("Instagram", 'accio')
		);

		return $columns;
	}
	
}
