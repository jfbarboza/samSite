<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Title Text', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', ''),
			'description' => ''
		));
		?>

	</div>
	
	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Title Heading', 'tmm_shortcodes'),
			'shortcode_field' => 'type',
			'id' => 'type',
			'options' => array(
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6',
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('type', 'H1'),
			'description' => ''
		));
		?>
	</div>

	<div class="one-half">
		<?php
		$font_size = array('default' => __('Default', 'tmm_shortcodes'));
		for ($i = 8; $i <= 80; $i++) {
			$font_size[$i] = $i;
		}
		//***
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Font Size', 'tmm_shortcodes'),
			'shortcode_field' => 'font_size',
			'id' => 'font_size',
			'options' => $font_size,
			'default_value' => TMM_Ext_Shortcodes::set_default_value('font_size', 'default'),
			'description' => ''
		));
		?>

	</div>

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Font Weight', 'tmm_shortcodes'),
			'shortcode_field' => 'font_weight',
			'id' => 'font_weight',
			'options' => array(
				'normal' => __('Normal', 'tmm_shortcodes'),
				'100' => 100,
				'200' => 200,
				'300' => 300,
				'400' => 400,
				'600' => 600,
				'700' => 700
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('font_weight', '300'),
			'description' => ''
		));
		?>
	</div>

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Align', 'tmm_shortcodes'),
			'shortcode_field' => 'align',
			'id' => 'align',
			'options' => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center',
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('align', 'left'),
			'description' => ''
		));
		?>

	</div>

	<div class="one-half">
		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'title' => __('Color', 'tmm_shortcodes'),
			'shortcode_field' => 'color',
			'type' => 'color',
			'description' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('color', ''),
			'id' => '',
			'display' => 1
		));
		?>

	</div>

	<div class="one-half">
		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Margin Bottom (px)', 'tmm_shortcodes'),
			'shortcode_field' => 'bottom_indent',
			'id' => 'bottom_indent',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('bottom_indent', ''),
			'description' => ''
		));
		?>

	</div>
	
	<div class="one-half">
		
		<?php
		
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'checkbox',
			'title' => __('Use Website General Color', 'tmm_shortcodes'),
			'shortcode_field' => 'use_general_color',
			'id' => 'use_general_color',
			'is_checked' => TMM_Ext_Shortcodes::set_default_value('use_general_color', 0),
			'description' => ''
		));
		
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'checkbox',
			'title' => __('Use Border', 'tmm_shortcodes'),
			'shortcode_field' => 'use_border',
			'id' => 'use_border',
			'is_checked' => TMM_Ext_Shortcodes::set_default_value('use_border', 0),
			'description' => 'Add short border bottom'
		));
		
		?>		
		
	</div>
	
	<div class="one-half">
		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Animation', 'tmm_shortcodes'),
			'shortcode_field' => 'animation',
			'id' => '',
			'options' => TMM_Ext_Shortcodes::css_animation_array(),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('animation', ''),
			'description' => 'Waypoints is a jQuery plugin that makes it easy to execute a function whenever you scroll to an element.'
		));
		?>	 
		
	</div>

</div>


<!-- --------------------------  PROCESSOR  --------------------------- -->


<script type="text/javascript">
	
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";
	jQuery(function () {
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('click change', function () {
			tmm_ext_shortcodes.changer(shortcode_name);
			colorizator();
		});
		colorizator();
		selectwrap();
	});
	
</script>

