<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

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

    <div class="fullwidth">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'textarea',
			'title' => __('Enter Text', 'tmm_shortcodes'),
			'shortcode_field' => 'content',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('content', ''),
			'description' => ''
		));
		?>

    </div><!--/ .fullwidth-->

</div><!--/ .tmm_shortcode_template->
		  
	  
<!-- --------------------------  PROCESSOR  --------------------------- -->

<script type="text/javascript">
	
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";

	jQuery(function() {
		tmm_ext_shortcodes.changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('keyup change', function() {
			tmm_ext_shortcodes.changer(shortcode_name);
		});

	});
	
</script>
