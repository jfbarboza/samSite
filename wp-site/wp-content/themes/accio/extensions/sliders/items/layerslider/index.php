<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Ext_Slider_Layerslider extends TMM_Ext_Sliders {

	public static $slider_options = array();
	public static $slider_js_options = array();

	public static function init() {
		parent::$sliders_classes_array[] = __CLASS__;
		
		self::$slider_options = array(
			'key' => "layerslider",
			'name' => "Layerslider",
			'fields' => array(),
		);
		parent::$slider_options[self::$slider_options['key']] = self::$slider_options;
		
		self::$slider_js_options = array();
		parent::$slider_js_options[self::$slider_options['key']] = self::$slider_js_options;
	}

}

