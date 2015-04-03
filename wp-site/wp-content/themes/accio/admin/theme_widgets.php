<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Widget_Text extends WP_Widget_Text {

	function __construct() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML.'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('text', __('Text'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$animation = apply_filters( 'widget_animation', empty( $instance['animation'] ) ? '' : $instance['animation'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="textwidget <?php echo $animation ?>"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['animation'] = strip_tags($new_instance['animation']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
	
	function css_anim() {
		return array(
			'' => 'None',
			'opacity' => 'Opacity',
			'scale' => 'Scale',
			'slideRight' => 'SlideRight',
			'slideLeft' => 'SlideLeft',
			'slideDown' => 'SlideDown',
			'slideUp' => 'SlideUp',
		);
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$animation = strip_tags($instance['animation']);
		$text = esc_textarea($instance['text']);
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Animation:'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>" id="">
				<?php foreach ($this->css_anim() as $key => $value): ?>
					<option <?php if (esc_attr($animation) == $key): ?>selected<?php endif; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
<?php
	}
}

class TMM_Testimonials_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Rotates testimonials in random order.', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Testimonials', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/testimonials', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['post_id'] = (int) $new_instance['post_id'];
		$instance['show'] = (int) $new_instance['show'];
		$instance['timeout'] = (int) $new_instance['timeout'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Testimonials',
			'post_id' => 0,
			'show' => 0,
			'timeout' => 3000,
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/testimonials_form', $args);
	}

}

class TMM_Latest_Tweets_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays latest tweets', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Latest Tweets', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/latest_tweets', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['postcount'] = (int) $new_instance['postcount'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Latest on Twitter',
			'username' => 'ThemeMakers',
			'postcount' => 2
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/latest_tweets_form', $args);
	}

}

class TMM_Social_Links_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays website social links', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Social Links', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/social_links', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['animation'] = $new_instance['animation'];
		$instance['twitter_links'] = $new_instance['twitter_links'];
		$instance['twitter_tooltip'] = $new_instance['twitter_tooltip'];
		$instance['facebook_links'] = $new_instance['facebook_links'];
		$instance['facebook_tooltip'] = $new_instance['facebook_tooltip'];
		$instance['linkedin_links'] = $new_instance['linkedin_links'];
		$instance['linkedin_tooltip'] = $new_instance['linkedin_tooltip'];
		$instance['dribbble_links'] = $new_instance['dribbble_links'];
		$instance['dribbble_tooltip'] = $new_instance['dribbble_tooltip'];
		$instance['gplus_links'] = $new_instance['gplus_links'];
		$instance['gplus_tooltip'] = $new_instance['gplus_tooltip'];
		$instance['instagram_links'] = $new_instance['instagram_links'];
		$instance['instagram_tooltip'] = $new_instance['instagram_tooltip'];
		$instance['vimeo_links'] = $new_instance['vimeo_links'];
		$instance['vimeo_tooltip'] = $new_instance['vimeo_tooltip'];
		$instance['youtube_links'] = $new_instance['youtube_links'];
		$instance['youtube_tooltip'] = $new_instance['youtube_tooltip'];
		$instance['rss_tooltip'] = $new_instance['rss_tooltip'];
		$instance['show_rss_tooltip'] = $new_instance['show_rss_tooltip'];
		return $instance;
	}
	
	function css_anim() {
		return array(
			'' => 'None',
			'opacity' => 'Opacity',
			'scale' => 'Scale',
			'slideRight' => 'SlideRight',
			'slideLeft' => 'SlideLeft',
			'slideDown' => 'SlideDown',
			'slideUp' => 'SlideUp',
		);
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Social Links',
			'animation' => '',
			'twitter_tooltip' => 'Twitter',
			'twitter_links' => 'https://twitter.com/ThemeMakers',	
			'facebook_tooltip' => 'Facebook',
			'facebook_links' => 'http://www.facebook.com/wpThemeMakers',
			'linkedin_tooltip' => 'Linkedin',
			'linkedin_links' => 'http://linkedin.com/',
			'dribbble_tooltip' => 'Dribbble',
			'dribbble_links' => 'http://dribbble.com/',
			'gplus_tooltip' => 'Google Plus',
			'gplus_links' => 'http://plus.google.com/',
			'instagram_tooltip' => 'Instagram',
			'instagram_links' => 'http://instagram.com',
			'vimeo_tooltip' => 'Vimeo',
			'vimeo_links' => 'https://vimeo.com/',
			'youtube_tooltip' => 'Youtube',
			'youtube_links' => 'https://youtube.com/',
			'rss_tooltip' => 'RSS',
			'show_rss_tooltip' => 'false',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/social_links_form', $args);
	}

}

class TMM_Recent_Posts_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Displays recent blog posts', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Recent Posts', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/recent_posts', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['category'] = $new_instance['category'];
		$instance['post_count'] = $new_instance['post_count'];
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		$instance['show_exerpt'] = $new_instance['show_exerpt'];
		$instance['exerpt_symbols_count'] = $new_instance['exerpt_symbols_count'];
		$instance['show_see_all_button'] = $new_instance['show_see_all_button'];
		return $instance;
	}
	
	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Recent Posts',
			'category' => '',
			'post_count' => 3,
			'show_thumbnail' => 'true',
			'show_exerpt' => 'true',
			'exerpt_symbols_count' => 60,
			'show_see_all_button' => 'false'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/recent_posts_form', $args);
	}

}

class TMM_Contact_Form_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('A widget that shows custom contact form.', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Contact Form', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/contact_form', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['form'] = $new_instance['form'];
		$instance['animation'] = $new_instance['animation'];
		$instance['labels'] = $new_instance['labels'];
		return $instance;
	}

	function css_anim() {
		return array(
			'' => 'None',
			'opacity' => 'Opacity',
			'scale' => 'Scale',
			'slideRight' => 'SlideRight',
			'slideLeft' => 'SlideLeft',
			'slideDown' => 'SlideDown',
			'slideUp' => 'SlideUp',
		);
	}
	
	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Contact Form',
			'form' => '',
			'animation' => '',
			'labels' => 'placeholder'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_form_form', $args);
	}

}

class TMM_Flickr_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Flickr feed widget', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Flickr feed widget', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/flickr', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['imagescount'] = (int) $new_instance['imagescount'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Flickr Feed',
			'username' => '54958895@N06',
			'imagescount' => '9',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/flickr_form', $args);
	}

}

class TMM_Recent_Projects_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('The most recent projects from portfolio.', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Recent Projects', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/recent_projects', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['post_number'] = $new_instance['post_number'];
		$instance['layout_style'] = $new_instance['layout_style'];
		$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
		$instance['show_exerpt'] = $new_instance['show_exerpt'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['exerpt_symbols_count'] = $new_instance['exerpt_symbols_count'];
		$instance['show_button'] = $new_instance['show_button'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Recent Projects',
			'post_number' => 5,
			'layout_style'=>1,
			'show_thumbnail' => 'true',
			'show_exerpt' => 'false',
			'exerpt_symbols_count' => 90,
			'show_button' => 'true',
			'show_title' => 'true'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/recent_projects_form', $args);
	}

}

class TMM_Google_Map_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Custom Google Map widget', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Google Map', 'accio'), $settings);
	}

	//Widget view
	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/google_map', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['mode'] = $new_instance['mode'];
		$instance['latitude'] = $new_instance['latitude'];
		$instance['longitude'] = $new_instance['longitude'];
		$instance['address'] = $new_instance['address'];
		$instance['location_mode'] = $new_instance['location_mode'];
		$instance['zoom'] = $new_instance['zoom'];
		$instance['scrollwheel'] = $new_instance['scrollwheel'];
		$instance['maptype'] = $new_instance['maptype'];
		$instance['marker'] = $new_instance['marker'];
		$instance['popup'] = $new_instance['popup'];
		$instance['popup_text'] = $new_instance['popup_text'];
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Our Location',
			'width' => '200',
			'height' => '200',
			'mode' => 'image',
			'latitude' => "40.714623",
			'longitude' => "-74.006605",
			'address' => 'New York',
			'location_mode' => 'address',
			'zoom' => 12,
			'maptype' => 'ROADMAP',
			'marker' => 'false',
			'scrollwheel' => 'false',
			'popup' => 'false',
			'popup_text' => ""
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/google_map_form', $args);
	}

}

class TMM_Facebook_LikeBox_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Facebook Like Box widget', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Facebook LikeBox', 'accio'), $settings);
	}

	//Widget view

	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/facebook', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['pageID'] = $new_instance['pageID'];
		$instance['connection'] = $new_instance['connection'];
		$instance['height'] = $new_instance['height'];
		$instance['header'] = $new_instance['header'];


		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Facebook Like Box',
			'pageID' => '273813622709585',
			'connection' => 9,
			'height' => '340',
			'header' => 'true'
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/facebook_form', $args);
	}

}

class TMM_Contact_Us_Widget extends WP_Widget {

	//Widget Setup
	function __construct() {
		//Basic settings
		$settings = array('classname' => __CLASS__, 'description' => __('Contact Us widget', 'accio'));

		//Creation
		$this->WP_Widget(__CLASS__, __('ThemeMakers Contact Us', 'accio'), $settings);
	}

	//Widget view

	function widget($args, $instance) {
		$args['instance'] = $instance;
		echo TMM::draw_html('widgets/contact_us', $args);
	}

	//Update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['email'] = $new_instance['email'];
		
		//***
		return $instance;
	}

	//Widget form
	function form($instance) {
		//Defaults
		$defaults = array(
			'title' => 'Contact Us',
			'address' => '',
			'phone' => '',
			'email' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$args = array();
		$args['instance'] = $instance;
		$args['widget'] = $this;
		echo TMM::draw_html('widgets/contact_us_form', $args);
	}

}

//*****************************************************

// unregister all default WP Widgets
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Text');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

register_widget('TMM_Widget_Text');

register_widget('TMM_Testimonials_Widget');
register_widget('TMM_Latest_Tweets_Widget');
register_widget('TMM_Social_Links_Widget');
register_widget('TMM_Recent_Posts_Widget');
register_widget('TMM_Contact_Form_Widget');
register_widget('TMM_Flickr_Widget');
register_widget('TMM_Recent_Projects_Widget');
register_widget('TMM_Google_Map_Widget');
register_widget('TMM_Facebook_LikeBox_Widget');
register_widget('TMM_Contact_Us_Widget');


