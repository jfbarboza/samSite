<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

    <div class="one-half">
		<?php
		//username
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Username', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', 'ThemeMakers'),
			'description' => ''
		));
		?>

    </div><!--/ .one-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Number of tweets', 'tmm_shortcodes'),
			'shortcode_field' => 'count',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('count', 2),
			'description' => ''
		));
		?>

    </div><!--/ .one-half-->
	
	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Timeout', 'tmm_shortcodes'),
			'shortcode_field' => 'timeout',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('timeout', 6000),
			'description' => ''
		));
		?>

    </div><!--/ .one-half-->
		
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

    <div class="clear"></div>

</div>


<!-- --------------------------  PROCESSOR  --------------------------- -->

<script type="text/javascript">
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";

	jQuery(function() {

		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
		});
		selectwrap();

	});
</script>

