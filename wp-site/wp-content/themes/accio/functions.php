<?php if (!defined('ABSPATH')) die('No direct access allowed');

/* ---------------------------------------------------------------------- */
/* 	Basic Theme Settings
/* ---------------------------------------------------------------------- */

define('TMM_THEME_URI', get_template_directory_uri());
define('TMM_THEME_PATH', get_template_directory());
define('TMM_THEME_PREFIX', 'thememakers_');
define('TMM_EXT_URI', TMM_THEME_URI . '/extensions');
define('TMM_EXT_PATH', TMM_THEME_PATH . '/extensions');

define('TMM_THEME_NAME', 'Accio');
define('TMM_THEME_TEXTDOMAIN', 'accio');
define('TMM_FRAMEWORK_VERSION', '2.1.1');
define('TMM_THEME_LINK', 'http://' . TMM_THEME_TEXTDOMAIN . '.webtemplatemasters.com/help/');
define('TMM_THEME_FORUM_LINK', 'http://forums.webtemplatemasters.com/');

/* ---------------------------------------------------------------------- */
/* 	Load Parts
/* ---------------------------------------------------------------------- */

include_once TMM_THEME_PATH . '/helper/aq_resizer.php';
include_once TMM_THEME_PATH . '/admin/theme_widgets.php';
include_once TMM_THEME_PATH . '/admin/theme_options/helper.php';
include_once TMM_THEME_PATH . '/helper/helper.php';
include_once TMM_THEME_PATH . '/helper/helper_fonts.php';

include_once TMM_THEME_PATH . '/classes/thememakers.php';

include_once TMM_THEME_PATH . '/classes/portfolio.php';
include_once TMM_THEME_PATH . '/classes/staff.php';
include_once TMM_THEME_PATH . '/classes/testimonials.php';
include_once TMM_THEME_PATH . '/classes/onepage.php';
include_once TMM_THEME_PATH . '/classes/page.php';
include_once TMM_THEME_PATH . '/classes/contact_form.php';
include_once TMM_THEME_PATH . '/classes/custom_sidebars.php';
include_once TMM_THEME_PATH . '/classes/seo_group.php';
include_once TMM_THEME_PATH . '/classes/walker.php';


// extensions INCLUDING----------------------------------------------

include_once TMM_EXT_PATH . '/includer.php';

//17-02-2014
class TMM_Functions {
	
	/*
	 * Theme custom post types classes (cpt)
	 */

	public static $theme_cpt_classes = array(
		'TMM_Portfolio',
		'TMM_Staff',
		'TMM_Testimonials',
		'TMM_Page',
		'TMM_Onepage'
	);
	
	public static function setup() {
		
		// Post thumbnails
		add_theme_support('post-thumbnails');
		
		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');	
		
		// Make theme available for translation
		load_theme_textdomain(TMM_THEME_TEXTDOMAIN, TMM_THEME_PATH . '/languages');
		
		$locale = get_locale();
		$locale_file = TMM_THEME_PATH . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu('primary', 'Primary Menu');
		
		self::theme_first_activation();
		
	} 

	public static function init() {

		add_filter('widget_text', 'do_shortcode');

		TMM::init();
		
		self::register_styles();
		self::init_sidebars();		
		
		add_filter('mce_buttons', array(__CLASS__, "mce_buttons"));
		
		if (!TMM::get_option('use_wptexturize')) {
			remove_filter('the_content', 'wptexturize');
		}	

		//ADMIN
		add_action('admin_bar_menu', array(__CLASS__, 'admin_bar_menu'), 80);
		add_action('admin_menu', array(__CLASS__, 'admin_menu'));                
		add_action('admin_footer', array(__CLASS__, 'admin_footer'));
		add_action('admin_notices', array(__CLASS__, 'admin_notices'));
		
		//INIT CUSTOM POST TYPES
		foreach (TMM_Functions::$theme_cpt_classes as $class) {
			add_action('init', array("{$class}", 'init'));
			add_action('admin_init', array("{$class}", 'admin_init'));
			add_action('save_post', array("{$class}", "save_post"));
		}
		
		//AJAX callbacks------------------------------------------------------------

		add_action('wp_ajax_change_options', array('TMM', 'change_options'));

		add_action('wp_ajax_add_sidebar', array('TMM_Custom_Sidebars', 'add_sidebar'));
		add_action('wp_ajax_add_sidebar_page', array('TMM_Custom_Sidebars', 'add_sidebar_page'));
		add_action('wp_ajax_add_sidebar_category', array('TMM_Custom_Sidebars', 'add_sidebar_category'));

		add_action('wp_ajax_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));

		add_action('wp_ajax_add_comment', array('TMM_Helper', 'add_comment'));
		add_action('wp_ajax_get_resized_image_url', array('TMM_Helper', 'get_resized_image_url'));
		add_action('wp_ajax_regeneratethumbnail', array('TMM_Helper', 'regeneratethumbnail'));
		add_action('wp_ajax_update_allowed_alias', array('TMM_Helper', 'update_allowed_alias'));

		add_action('wp_ajax_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
		add_action('wp_ajax_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
		add_action('wp_ajax_save_google_fonts', array('TMM_HelperFonts', 'save_google_fonts'));

		add_action('wp_ajax_add_seo_group', array('TMM_SEO_Group', 'add_seo_group'));
		add_action('wp_ajax_add_seo_group_category', array('TMM_SEO_Group', 'add_seo_group_category'));

		add_action('wp_ajax_nopriv_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));
		add_action('wp_ajax_nopriv_add_comment', array('TMM_Helper', 'add_comment'));
		add_action('wp_ajax_nopriv_get_google_fonts', array('TMM_HelperFonts', 'get_google_fonts_ajax'));
		add_action('wp_ajax_nopriv_get_new_google_fonts', array('TMM_HelperFonts', 'get_new_google_fonts'));
	}

	public static function theme_first_activation() {

		global $pagenow;
		
		if (is_admin() AND 'themes.php' == $pagenow AND isset($_GET['activated'])) {
				header( 'Location: ' . admin_url() . 'themes.php?page=tmm_theme_options' );
		}
	}

	/* ---------------------------------------------------------------------- */
	/* 	Theme scripts Header
	/* ---------------------------------------------------------------------- */

	public static function wp_front_head() {
		self::register_scripts();
		wp_enqueue_script('jquery');
		
		self::enqueue_script('modernizr');
		?>

		<script type="text/javascript">                       
		
			<?php if (is_single() OR is_page()) : ?>
				is_single_page = true;
			<?php endif; ?>

		</script>		
		<?php
	}

	/* ---------------------------------------------------------------------- */
	/* 	Theme scripts Footer
	/* ---------------------------------------------------------------------- */

	public static function wp_front_footer() {
		
		// For Internet Explorer
		global $is_IE;
		if ($is_IE) {
			TMM_Functions::enqueue_script('respond');
		}
			TMM_Functions::enqueue_script('queryloader2');
			TMM_Functions::enqueue_script('waypoints');
			TMM_Functions::enqueue_script('easing');
			TMM_Functions::enqueue_script('cycle');
			TMM_Functions::enqueue_script('touchswipe');
			TMM_Functions::enqueue_script('ytplayer');
			TMM_Functions::enqueue_script('flexslider');
			TMM_Functions::enqueue_script('fancybox');
			TMM_Functions::enqueue_script('smoothscroll');
			TMM_Functions::enqueue_script('video_js');
			TMM_Functions::enqueue_script('theme');          
                        
		?>

		<script type="text/javascript">
			var site_url = "<?php echo home_url() ?>";
			var capcha_image_url = "<?php echo TMM_THEME_URI ?>/helper/capcha/image.php/";
			var template_directory = "<?php echo TMM_THEME_URI; ?>/";
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			//translations
			var lang_enter_correctly = "<?php _e('Please enter correct', 'accio'); ?>";
			var lang_sended_succsessfully = "<?php _e('Your message has been sent successfully!', 'accio'); ?>";
			var lang_server_failed = "<?php _e('Server failed. Send later', 'accio'); ?>";
			var lang_any = "<?php _e('Any', 'accio'); ?>";
			var lang_home = "<?php _e('Home', 'accio'); ?>";
		</script>

		<?php
	}

	//register front scripts
	public static function register_scripts() {
        wp_register_script('tmm_mixitup', TMM_THEME_URI . '/js/jquery.mixitup.js', array('jquery'), false, true);
		wp_register_script('tmm_modernizr', TMM_THEME_URI . '/js/jquery.modernizr.js', array('jquery'));
		wp_register_script('tmm_easing', TMM_THEME_URI . '/js/jquery.easing.1.3.min.js', array('jquery'), false, true);
		wp_register_script('tmm_cycle', TMM_THEME_URI . '/js/jquery.cycle.all.min.js', array('jquery'), false, true);
		wp_register_script('tmm_queryloader2', TMM_THEME_URI . '/js/jquery.queryloader2.js', array('jquery'), false, true);
		wp_register_script('tmm_waypoints', TMM_THEME_URI . '/js/waypoints.min.js', array('jquery'), false, true);		
		wp_register_script('tmm_flexslider', TMM_THEME_URI . '/js/flexslider/jquery.flexslider.js', array('jquery'), false, true);
		wp_register_script('tmm_touchswipe', TMM_THEME_URI . '/js/jquery.touchswipe.min.js', array('jquery'), false, true);
		wp_register_script('tmm_video_js', TMM_THEME_URI . '/js/video-js/video.js', array('jquery'), false, true);
		wp_register_script('tmm_smoothscroll', TMM_THEME_URI . '/js/jquery.smoothscroll.js', array('jquery'), false, true);
		wp_register_script('tmm_ytplayer', TMM_THEME_URI . '/js/jquery.mb.YTPlayer.js', array('jquery'), false, true);
		wp_register_script('tmm_fancybox', TMM_THEME_URI . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), false, true);
		wp_register_script('tmm_respond', TMM_THEME_URI . '/js/respond.min.js', array('jquery'));		
		wp_register_script('tmm_theme', TMM_THEME_URI . '/js/theme.js', array('jquery'), false, true);
               
	}

	public static function register_styles() {
		
		if ( TMM::get_option('logo_font') ) {
			wp_register_style( 'logo_font', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('logo_font'), null, false );
		}
		
		if ( TMM::get_option('general_font_family') ) {
			wp_register_style( 'general_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('general_font_family'), null, false );
		}
		
		if ( TMM::get_option('h1_font_family') ) {
			wp_register_style( 'h1_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('h1_font_family'), null, false );
		}
		
		if ( TMM::get_option('h2_font_family') ) {
			wp_register_style( 'h2_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('h2_font_family'), null, false );
		}
		
		if ( TMM::get_option('h3_font_family') ) {
			wp_register_style( 'h3_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('h3_font_family'), null, false );
		}
		
		if ( TMM::get_option('h4_font_family') ) {
			wp_register_style( 'h4_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('h4_font_family'), null, false );
		}
		
		if ( TMM::get_option('h5_font_family') ) {
			wp_register_style( 'h5_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('h5_font_family'), null, false );
		}
		
		if ( TMM::get_option('h6_font_family') ) {
			wp_register_style( 'h6_font_family', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('h6_font_family'), null, false );
		}
		
		if ( TMM::get_option('main_nav_font') ) {
			wp_register_style( 'main_nav_font', 'http://fonts.googleapis.com/css?family=' . TMM::get_option('main_nav_font'), null, false );
		}
			
		wp_register_style('tmm_style', TMM_THEME_URI . '/style.css', null, false);
		wp_register_style('tmm_fontello', TMM_THEME_URI . '/css/fontello.css', null, false);
		wp_register_style('tmm_grid', TMM_THEME_URI . '/css/grid.css', null, false);
		wp_register_style('tmm_layout', TMM_THEME_URI . '/css/layout.css', null, false);
		wp_register_style('tmm_tooltipster', TMM_THEME_URI . '/css/tooltipster.css', null, false);
		wp_register_style('tmm_animation', TMM_THEME_URI . '/css/animation.css', null, false);
		wp_register_style('tmm_flexslider', TMM_THEME_URI . '/js/flexslider/flexslider.css', null, false);
		wp_register_style('tmm_fancybox', TMM_THEME_URI . '/js/fancybox/jquery.fancybox.css', null, false);
		wp_register_style('tmm_video_js', TMM_THEME_URI . '/js/video-js/video-js.css', null, false);
		wp_register_style('tmm_custom1', TMM_THEME_URI . '/css/custom1.css', null, false);
		wp_register_style('tmm_custom2', TMM_THEME_URI . '/css/custom2.css', null, false);
	}

	public static function wp_front_styles() {
		
		if ( TMM::get_option('logo_font') ) {
			wp_enqueue_style( 'logo_font');
		}
		
		if ( TMM::get_option('general_font_family') ) {
			wp_enqueue_style( 'general_font_family');
		}
		
		if ( TMM::get_option('h1_font_family') ) {
			wp_enqueue_style( 'h1_font_family');
		}
		
		if ( TMM::get_option('h2_font_family') ) {
			wp_enqueue_style( 'h2_font_family');
		}
		
		if ( TMM::get_option('h3_font_family') ) {
			wp_enqueue_style( 'h3_font_family');
		}
		
		if ( TMM::get_option('h4_font_family') ) {
			wp_enqueue_style( 'h4_font_family');
		}
		
		if ( TMM::get_option('h5_font_family') ) {
			wp_enqueue_style( 'h5_font_family');
		}
		
		if ( TMM::get_option('h6_font_family') ) {
			wp_enqueue_style( 'h6_font_family');
		}
		
		if ( TMM::get_option('main_nav_font') ) {
			wp_enqueue_style( 'main_nav_font');
		}
		
		self::enqueue_style('style');
		self::enqueue_style('grid');
		self::enqueue_style('layout');
		self::enqueue_style('fontello');
		self::enqueue_style('animation');
		self::enqueue_style('tooltipster');
		self::enqueue_style('flexslider');
		self::enqueue_style('fancybox');
		self::enqueue_style('video_js');
		self::enqueue_style('custom1');
		self::enqueue_style('custom2');
	}

	public static function enqueue_script($key) {
		wp_enqueue_script('tmm_' . $key);
	}

	public static function enqueue_style($key) {
		wp_enqueue_style('tmm_' . $key);
	}

	public static function mce_buttons($mce_buttons) {
		$pos = array_search('wp_more', $mce_buttons, true);
		if ($pos !== false) {
			$tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
			$tmp_buttons[] = 'wp_page';
			$mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
		}
		return $mce_buttons;
	}

	//admin functions
	public static function admin_bar_menu() {
		global $wp_admin_bar;
		if (!is_super_admin() || !is_admin_bar_showing())
			return;
		$wp_admin_bar->add_menu(array(
			'id' => 'tmm_theme_options_page',
			'title' => __("Theme Options", 'accio'),
			'href' => admin_url('themes.php?page=tmm_theme_options'),
		));
	}

	public static function admin_menu() {
		add_theme_page(__("Theme Options", 'accio'), __("Theme Options", 'accio'), 'manage_options', 'tmm_theme_options', array(__CLASS__, 'theme_options_page'));
	}

	public static function theme_options_page() {
		echo TMM::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/theme_options.php');
	}

	public static function admin_notices() {
		$notices = "";

		if (!is_writable(TMM_THEME_PATH . "/css/custom1.css")) {
			$notices.=sprintf(__('<div class="error"><p>To make your theme work correctly you need to set the permissions 777 for <b>%s/css/custom1.css</b> folder. Follow <a href="http://webtemplatemasters.com/tutorials/permissions/" target="_blank">the link</a> to read the instructions how to do it properly.</p></div>', 'accio'), TMM_THEME_PATH);
		}

		if (!is_writable(TMM_THEME_PATH . "/css/custom2.css")) {
			$notices.=sprintf(__('<div class="error"><p>To make your theme work correctly you need to set the permissions 777 for <b>%s/css/custom2.css</b> folder. Follow <a href="http://webtemplatemasters.com/tutorials/permissions/" target="_blank">the link</a> to read the instructions how to do it properly.</p></div>', 'accio'), TMM_THEME_PATH);
		}

		if (!class_exists('TMM_Ext_Shortcodes')) {
			$notices.=__('<div class="error"><p>To make your theme work correctly you need to install ThemeMakers Shortcodes Plugin. Check in your theme bundle.</p></div>', 'accio');
		}

		if (!class_exists('TMM_Ext_LayoutConstructor')) {
			$notices.=__('<div class="error"><p>To make your theme work correctly you need to install ThemeMakers Layout Constructor. Check in your theme bundle.</p></div>', 'accio');
		}
		echo $notices;
	}

	public static function admin_head() {
		wp_enqueue_script('jquery');                               
                
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-sortable');

		wp_enqueue_script('media-upload');
		wp_enqueue_script('tmm_theme_admin', TMM_THEME_URI . '/admin/js/general.js', array('jquery'));

		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');

		wp_enqueue_style("tmm_theme_colorpicker", TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.css');
		wp_enqueue_script('tmm_theme_colorpicker', TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.js', array('jquery'));
		?>
		<!--[if IE]>
			<script>
				document.createElement('header');
				document.createElement('footer');
				document.createElement('section');
				document.createElement('aside');
				document.createElement('nav');
				document.createElement('article');
			</script>
		<![endif]-->
		<script type="text/javascript">		
		
			var site_url = "<?php echo home_url(); ?>/";
			var template_directory = "<?php echo TMM_THEME_URI; ?>/";
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			//translations
			var lang_edit = "<?php _e('Edit', 'accio'); ?>";
			var lang_delete = "<?php _e('Delete', 'accio'); ?>";
			var lang_cancel = "<?php _e('Cancel', 'accio'); ?>";
			var lang_one_moment = "<?php _e("One moment", 'accio') ?>";
			var lang_loading = "<?php _e("Loading", 'accio') ?> ...";
			var lang_sure = "<?php _e("Sure?", 'accio') ?> ...";
			var tmm_theme_options_url = "<?php echo admin_url('themes.php?page=tmm_theme_options&tmm_action=save_options'); ?>";
			var is_IE =<?php
		global $is_IE;
		echo (int) $is_IE;
		?>;
		</script>

		<?php

		wp_enqueue_style("tmm_admin_styles_css", TMM_THEME_URI . '/admin/css/styles.css');
		
		$is_tmm_theme_options = FALSE;
		if (isset($_GET['page'])) {
			if ($_GET['page'] == 'tmm_theme_options') {
				$is_tmm_theme_options = TRUE;
			}
		}

		if ($is_tmm_theme_options === TRUE) {
			wp_enqueue_style('tmm_theme_options', TMM_THEME_URI . '/admin/theme_options/css/styles.css');
			wp_enqueue_script('tmm_theme_options', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery'), false, true);
			wp_enqueue_style('tmm_theme_popup', TMM_THEME_URI . '/admin/js/tmm_popup/styles.css');
			wp_enqueue_script('tmm_theme_popup', TMM_THEME_URI . '/admin/js/tmm_popup/tmm_advanced_wp_popup.js', array('jquery'), false, true);
			wp_enqueue_script('tmm_theme_custom_sidebars', TMM_THEME_URI . '/admin/theme_options/js/custom_sidebars.js', array('jquery'), false, true);
			wp_enqueue_script('tmm_theme_seo_groups', TMM_THEME_URI . '/admin/theme_options/js/seo_groups.js', array('jquery'), false, true);
			wp_enqueue_script('tmm_theme_form_constructor', TMM_THEME_URI . '/admin/theme_options/js/form_constructor.js', array('jquery'), false, true);
			wp_enqueue_script('tmm_theme_selectivizr', TMM_THEME_URI . '/admin/theme_options/js/selectivizr-and-extra-selectors.min.js', array('jquery'), false, true);			
		}
	}

	public static function admin_footer() {
		?>
		<div style="display: none;">

			<div id="google_font_set" style="width: 800px; height: 600px;">
				<ul id="google_font_set_list"></ul><br />
			</div>

			<div id="ui_slider_item">

				<div class="clearfix ui-slider-item" id="__UI_SLIDER_NAME__">
					<input type="text" class="range-amount-value" value="__UI_SLIDER_VALUE__" />
					<input type="hidden" value="__UI_SLIDER_VALUE__" name="__UI_SLIDER_NAME__" class="range-amount-value-hidden" />
					<div class="slider-range __UI_SLIDER_NAME__"></div>
				</div>

			</div>

		</div>
		<?php
	}

	//end of admin functions

	public static function init_sidebars() {
		global $before_widget, $after_widget, $before_title, $after_title;

		$before_widget = '<div id="%1$s" class="widget %2$s">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';

		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['action'] == 'add_sidebar') {
				$_REQUEST = TMM_Helper::db_quotes_shield($_REQUEST);
			}
		}

		register_sidebar(array(
			'name' => __('Thememakers Default Sidebar', 'accio'),
			'id' => 'tmm_default_sidebar',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => __('Thememakers Footer Sidebar 1', 'accio'),
			'id' => 'tmm_footer_sidebar_1',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => __('Thememakers Footer Sidebar 2', 'accio'),
			'id' => 'tmm_footer_sidebar_2',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		//custom widget sidebars
		TMM_Custom_Sidebars::register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title);
		
	}
        
}

add_action('after_setup_theme', array('TMM_Functions', 'setup'), 1);
add_action('init', array('TMM_Functions', 'init'), 1);

// Enqueue front-end styles and scripts 
add_action('wp_enqueue_scripts', array('TMM_Functions', 'wp_front_head'), 1);                
add_action('wp_enqueue_scripts', array('TMM_Functions', 'wp_front_footer'), 1);
add_action('wp_enqueue_scripts', array('TMM_Functions', "wp_front_styles"));

// Enqueue admin styles and scripts 
add_action('admin_enqueue_scripts', array('TMM_Functions', 'admin_head'));

if (!function_exists('tag_archive_page')) {
	function tag_archive_page($query) {
		
	    $post_types = get_post_types();
		
	    if ( is_category() || is_tag() ) {
			if ( !is_admin() && $query->is_main_query() ) {
				
		        $post_type = get_query_var(get_post_type());
				
		        if ($post_type) {
		            $post_type = $post_type;
		        } else {
		            $post_type = $post_types;
		        }
		        $query->set('post_type', $post_type);
			}
	    }
	    return $query;
	}
	add_filter('pre_get_posts', 'tag_archive_page');
}

/* ---------------------------------------------------------------------- */
/*	Columns Shortcode
/* ---------------------------------------------------------------------- */

	/* -------------------------------------------------- */
	/*	Row
	/* -------------------------------------------------- */

	function shortcode_row( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type' => ''
		), $atts ) );	

		return '<div class="row">' . do_shortcode( $content ) . '</div>';

	}

	add_shortcode('row', 'shortcode_row');

	/* -------------------------------------------------- */
	/*	Column
	/* -------------------------------------------------- */

	function shortcode_column( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type' => ''
		), $atts ) );	
		
		switch ($type) {
			case '1/2':
				$type = 'col-md-6 col-sm-6';
			break;
			case '1/3':
				$type = 'col-md-4 col-sm-4';
			break;
			case '1/4':
				$type = 'col-md-3 col-sm-3';
			break;
			default:
		}

		return '<div class="' . esc_attr($type) . '">' . do_shortcode( $content ) . '</div>';

	}

	add_shortcode('column', 'shortcode_column');

/* ---------------------------------------------------------------------- */
/*	Show main navigation
/* ---------------------------------------------------------------------- */

if( !function_exists('framework_main_navigation')) {

	function framework_main_navigation() {
		
		global $post, $wp_query;

		$defaults = array(
			'container'      => '',
			'theme_location' => 'primary'
		);
		
		if ( has_nav_menu( 'primary' ) ) { 
			wp_nav_menu( $defaults );
		} else {	
			echo '<ul>';
				wp_list_pages('title_li=');
			echo '</ul>';
		}

	}

}

/* ---------------------------------------------------------------------- */
/*	Show main navigation onepage
/* ---------------------------------------------------------------------- */

if( !function_exists('custom_framework_main_navigation')) {

	function custom_framework_main_navigation($onepage_id) {
		
		$Walker = '';
		$pageMenu = '';
		$onepage_pages_array = array();
		
		if (!empty($onepage_id)) {
		
			$pages = get_post_meta($onepage_id, 'onepage', true);
			
			if (!empty($pages)) {
				foreach( $pages as $key => $post_id ) {
					$onepage_pages_array[] = TMM_Helper::parseUrl(get_permalink($post_id)); 
				}
			}
			
			if (!empty($onepage_pages_array)) {
				$Walker = new framework_walker($onepage_pages_array);	
			}
			
			$pageMenu = get_post_meta($onepage_id, 'page_menu', true);
					
		} else {
			
			$frontpage_id = TMM::get_option("frontpage");
			
			if (!empty($frontpage_id)) {
				
				$onepage_id = get_post_meta($frontpage_id, 'onepage', true);
				
				if (!empty($onepage_id)) {
					
					$pages = get_post_meta($onepage_id, 'onepage', true);

					if (!empty($pages)) {
						foreach( $pages as $key => $post_id ) {
							$onepage_pages_array[] = TMM_Helper::parseUrl(get_permalink($post_id)); 
						}
					}

					if (!empty($onepage_pages_array)) {
						$Walker = new framework_walker($onepage_pages_array, true);
					}	

					$pageMenu = get_post_meta($onepage_id, 'page_menu', true);
					
				}

			}
			
		}
		
		global $post, $wp_query;
		
		$defaults = array(
			'container'      => false,
			'container_class' => false,
			'theme_location' => 'primary',
			'walker'         => $Walker,
			'menu' => $pageMenu
		);
		
		wp_nav_menu( $defaults );

	}

}

/* ---------------------------------------------------------------------- */
/* 	Filter Hooks for Modify Front
/* ---------------------------------------------------------------------- */

if (!function_exists('modify_front')) {
	
	function modify_front($wp_query) {
		if (!is_admin()) {
			if (TMM::get_option('frontpage')) {
				add_filter('pre_option_show_on_front', 'show_on_front_filter');
				add_filter('pre_option_page_on_front', 'page_on_front_filter');

				if (TMM::get_option('blogpage')) {
					add_filter('pre_option_page_for_posts', 'page_for_posts_filter');
				}
			}
		}
	}

	function show_on_front_filter  ($val) { return 'page'; }
	function page_on_front_filter  ($val) { return TMM::get_option('frontpage'); }
	function page_for_posts_filter ($val) { return TMM::get_option('blogpage');  }
	
	add_action('init', 'modify_front');
	
}

/* ---------------------------------------------------------------------- */
/* 	Filter Hooks for Form
/* ---------------------------------------------------------------------- */

// Modity comments form fields
function tmk_comments_form_defaults($defaults) {

	$commenter = wp_get_current_commenter();

	$req = get_option('require_name_email');

	$aria_req = ( $req ? " required" : '' );

	$defaults['fields']['author'] = '<p class="input-block">' .
										'<input id="author" name="author" type="text" placeholder="Name ' .( $req ? '*' : ''). '" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />
									</p>';
	$defaults['fields']['email'] = '<p class="input-block">' .
										'<input id="email" name="email" type="email" placeholder="Email ' .( $req ? '*' : ''). '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />
									</p>';
	$defaults['fields']['url'] =   '<p class="input-block">' .
										'<input id="url" name="url" type="url" placeholder="Website" value="' . esc_attr($commenter['comment_author_url']) . '" />
								   </p>';
	$defaults['comment_field'] =   '<p class="input-block">' .
										'<textarea required="" id="comment" placeholder="Comment *" name="comment"></textarea>
								   </p>';

	$defaults['comment_notes_before'] = '';
	$defaults['comment_notes_after'] = '';

	$defaults['cancel_reply_link'] = ' - ' . __('Cancel reply', 'accio');
	$defaults['title_reply'] = __('Leave a Comment', 'accio');
	$defaults['label_submit'] = __('Submit Comment', 'accio');

	return $defaults;
}

add_filter('comment_form_defaults', 'tmk_comments_form_defaults');

/* ---------------------------------------------------------------------- */
/* 	Comments
/* ---------------------------------------------------------------------- */

function tmm_comments($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment;
	
	?>

	<li class="comment" id="comment-<?php echo comment_ID() ?>" comment-id="<?php echo comment_ID() ?>">

		<article>
			<div class="gravatar">
				<?php echo get_avatar($comment, $size = '50', TMM_THEME_URI . '/admin/images/gravatar.jpg'); ?>
			</div><!--/ .gravatar-->
			<div class="comment-body">
				<?php if (!$comment->comment_approved) { ?>
					<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'acio'); ?></p>
				<?php } else { ?>
					<div class="comment-meta clearfix">
						<div class="comment-author"><h6><?php echo get_comment_author_link(); ?></h6></div>
						<div class="comment-date"><?php comment_date('d.m.Y'); ?> <?php _e('at', 'accio'); ?> <?php comment_date('g:i a'); ?></div>
						<?php // comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						<?php echo get_comment_reply_link(array_merge(array('reply_text' => __('Reply', 'accio')), array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div><!--/ .comment-meta -->

					<p><?php comment_text(); ?></p>
				<?php } ?>
			</div><!--/ .comment-body-->
		</article>

	<?php
	
}

/**
 * Add prev and next links to a numbered link list
 */
function wp_link_pages_args_prevnext_add($args) {
	global $page, $numpages, $more, $pagenow;

	if (!$args['next_or_number'] == 'next_and_number')
		return $args;# exit early

	$args['next_or_number'] = 'number'; # keep numbering for the main part
	if (!$more)
		return $args;# exit early

	if ($page - 1) # there is a previous page
		$args['before'] .= _wp_link_page($page - 1)
				. $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';

	if ($page < $numpages) # there is a next page
		$args['after'] = _wp_link_page($page + 1)
				. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
				. $args['after'];

	return $args;
}

add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');

add_filter( 'upload_size_limit', 'b5f_increase_upload' );

function b5f_increase_upload( $bytes )
{
    return 93554432; // 32 megabytes
}
