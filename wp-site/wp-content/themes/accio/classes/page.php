<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Page {

	public static $post_pod_types = array();

	public static function init() {

		self::$post_pod_types = array(
			'default' => __("Default", 'accio'),
			'video' => __("Video", 'accio'),
			'quote' => __("Quote", 'accio'),
			'gallery' => __("Gallery", 'accio'),
		);

		//ajax
		add_action('wp_ajax_add_post_podtype_gallery_image', array(__CLASS__, 'add_post_podtype_gallery_image'));
		
		add_filter("manage_page_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_page_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
		
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND ($post->post_type == 'post' OR $post->post_type == 'page')) {
				update_post_meta($post->ID, "meta_title", @$_POST["meta_title"]);
				update_post_meta($post->ID, "meta_keywords", @$_POST["meta_keywords"]);
				update_post_meta($post->ID, "meta_description", @$_POST["meta_description"]);
			
				update_post_meta($post->ID, "post_pod_type", @$_POST["post_pod_type"]);
				update_post_meta($post->ID, "post_type_values", @$_POST["post_type_values"]);
				
				update_post_meta($post->ID, "another_page_title", @$_POST["another_page_title"]);
				update_post_meta($post->ID, "another_page_description", @$_POST["another_page_description"]);
				update_post_meta($post->ID, "show_page_title", @$_POST["show_page_title"]);
				
				update_post_meta($post->ID, "pagebg_type", @$_POST["pagebg_type"]);
				update_post_meta($post->ID, "pagebg_color", @$_POST["pagebg_color"]);
				update_post_meta($post->ID, "pagebg_image", @$_POST["pagebg_image"]);
				update_post_meta($post->ID, "pagebg_type_image_option", @$_POST["pagebg_type_image_option"]);
				update_post_meta($post->ID, "headerbg_type", @$_POST["headerbg_type"]);
				
				update_post_meta($post->ID, "page_sidebar_position", @$_POST["page_sidebar_position"]);
			}
		}
	}
	
	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "is_onepage":
				$is_onepage = get_post_meta($post->ID, 'onepage', true );
				if ($is_onepage) {
					echo '<span>yes</span>';
				}
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'accio'),
			"is_onepage" => __("Onepage", 'accio'),
			"date" => __("Date", 'accio'),
			"author" => __("Author", 'accio')
		);

		return $columns;
	}


	public static function init_meta_boxes() {
		add_meta_box("seo_options", __("Seo options", 'accio'), array(__CLASS__, 'page_seo_options'), "page", "normal", "low");
		add_meta_box("seo_options", __("Seo options", 'accio'), array(__CLASS__, 'page_seo_options'), "post", "normal", "low");

		add_meta_box("post_types", __("Post Type", 'accio'), array(__CLASS__, 'post_type_meta_box'), "post", "side", "low");
		add_meta_box("post_types_data", __("Post Type Data", 'accio'), array(__CLASS__, 'post_type_meta_panel'), "post", "normal");

		add_meta_box("tmm_page_bg", __("Custom Page Options", 'accio'), array(__CLASS__, 'page_background_options'), "post", "side", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'accio'), array(__CLASS__, 'page_background_options'), "page", "side", "low");
	}

	public static function page_background_options() {
		global $post;
		echo TMM::draw_html('page/background_options', self::get_page_settings($post->ID));
	}

	public static function get_page_settings($post_id) {
		
		$custom = get_post_custom($post_id);

		$data = array();
                
                if (!empty($custom["another_page_title"][0])){
                    $data['another_page_title'] = $custom["another_page_title"][0];
                }
                if (!empty($custom["another_page_description"][0])){
                    $data['another_page_description'] = $custom["another_page_description"][0];
                }
                if (!empty($custom["show_page_title"][0])){
                    $data['show_page_title'] = $custom["show_page_title"][0];		
                }
                if (!empty($custom["pagebg_type"][0])){
                    $data['pagebg_type'] = $custom["pagebg_type"][0];
                }
                if (!empty($custom["pagebg_color"][0])){
                    $data['pagebg_color'] = $custom["pagebg_color"][0];
                }
                if (!empty($custom["pagebg_image"][0])){
                    $data['pagebg_image'] = $custom["pagebg_image"][0];
                }
                if (!empty($custom["pagebg_type_image_option"][0])){
                    $data['pagebg_type_image_option'] = $custom["pagebg_type_image_option"][0];
                }
                if (!empty($custom["headerbg_type"][0])){
                    $data['headerbg_type'] = $custom["headerbg_type"][0];
                }
                if (!empty($custom["page_sidebar_position"][0])){
                    $data['page_sidebar_position'] = $custom["page_sidebar_position"][0];
                }
			
		return $data;
	}

	public static function page_seo_options() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['meta_title'] = @$custom["meta_title"][0];
		$data['meta_keywords'] = @$custom["meta_keywords"][0];
		$data['meta_description'] = @$custom["meta_description"][0];
		echo TMM::draw_html('page/seo_options', $data);
	}

	public static function post_type_meta_box() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = @$custom["post_pod_type"][0];
		if (!$data['current_post_pod_type']) {
			$data['current_post_pod_type'] = 'default';
		}
		echo TMM::draw_html('page/post_pod_type_box', $data);
	}

	public static function post_type_meta_panel() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = @$custom["post_pod_type"][0];
		if (!$data['current_post_pod_type']) {
			$data['current_post_pod_type'] = 'default';
		}

		$data['post_type_values'] = get_post_meta($post->ID, 'post_type_values', true);

		echo TMM::draw_html('page/post_pod_type_panel', $data);
	}

	//ajax
	public static function add_post_podtype_gallery_image() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		echo TMM::draw_html('page/draw_post_podtype_gallery_image', $data);
		exit;
	}

}
