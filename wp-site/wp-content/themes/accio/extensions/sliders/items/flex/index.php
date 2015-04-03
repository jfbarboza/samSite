<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Ext_Slider_Flex extends TMM_Ext_Sliders {

	public static $slider_options = array();
	public static $slider_js_options = array();

	public static function init() {
		parent::$sliders_classes_array[] = __CLASS__;
		//***
		self::$slider_options = array(
			'key' => "flex",
			'name' => "Flexslider",
			'fields' => array(
				'description' => array(
					'name' => __('Slide Description', 'accio'),
					'type' => 'textarea',
					'field_options' => array(
						'font_family' => __('Font family', 'accio'),
						'font_size' => __('Font size', 'accio'),
						'font_color' => __('Font color', 'accio')
					),
					'field_options_defaults' => array(
						'font_family' => '',
						'font_size' => '',
						'font_color' => ''
					)
				),
				'url' => array(
					'name' => __('Slide URL', 'accio'),
					'type' => 'textinput',
					'field_options' => array()
				),
			),
		);
		parent::$slider_options[self::$slider_options['key']] = self::$slider_options;
		//***
		self::$slider_js_options = array(
//			'slide_image_alias' => array(
//				'title' => __('Slide size', 'accio'),
//				'type' => 'text',
//				'description' => __('Slide size. width*height, for example 500*300. Empty field means full size!', 'accio'),
//				'default' => '',
//			),
			'enable_caption' => array(
				'title' => __('Enable caption', 'accio'),
				'type' => 'checkbox',
				'description' => "",
				'default' => 1,
			),
			'slideshow' => array(
				'title' => __('Slideshow', 'accio'),
				'type' => 'checkbox',
				'description' => __("Animate slider automatically", 'accio'),
				'default' => 1,
			),
			'init_delay' => array(
				'title' => __('initDelay', 'accio'),
				'type' => 'slider',
				'description' => __("Integer: Set an initialization delay, in milliseconds", 'accio'),
				'default' => 0,
				'max' => 500
			),
			'animation_speed' => array(
				'title' => __('Animation Speed', 'accio'),
				'type' => 'slider',
				'description' => __("Set the speed of animations, in milliseconds", 'accio'),
				'default' => 600,
				'max' => 2000
			),
			'slideshow_speed' => array(
				'title' => __('Slideshow Speed', 'accio'),
				'type' => 'slider',
				'description' => __("Set the speed of the slideshow cycling, in milliseconds", 'accio'),
				'default' => 7000,
				'max' => 20000
			),
			'animation' => array(
				'title' => __('Animation', 'accio'),
				'type' => 'select',
				'values' => array(
					'fade' => __('Fade', 'accio'),
					'slide' => __('Slide', 'accio'),
				),
				'description' => __('Select your animation type, "fade" or "slide"', 'accio'),
				'default' => 'slide',
			),
			'directionNav' => array(
				'title' => __('Direction Nav', 'accio'),
				'type' => 'checkbox',
				'description' => __("Direction Navigation", 'accio'),
				'default' => 1,
			),
			'controlnav' => array(
				'title' => __('Control Navigation', 'accio'),
				'type' => 'checkbox',
				'description' => __("Control Navigation", 'accio'),
				'default' => 1,
			),
			'direction' => array(
				'title' => __('Direction', 'accio'),
				'type' => 'select',
				'values' => array(
					'horizontal' => __('Horizontal', 'accio'),
					'vertical' => __('Vertical', 'accio'),
				),
				'description' => "",
				'default' => 'horizontal',
			)
		);
		parent::$slider_js_options[self::$slider_options['key']] = self::$slider_js_options;
	}

}
