<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">


	<div class="one-half">		
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Category', 'tmm_shortcodes'),
			'shortcode_field' => 'category',
			'id' => 'category',
			'options' => TMM_Helper::get_post_categories(),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('category', ''),
			'description' => ''
		));
		?>

	</div><!--/ .ona-half-->

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Order By', 'tmm_shortcodes'),
			'shortcode_field' => 'orderby',
			'id' => 'orderby',
			'options' => TMM_Helper::get_post_sort_array(),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('orderby', ''),
			'description' => ''
		));
		?>

	</div><!--/ .ona-half-->

	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'checkbox',
			'title' => __('Meta Data', 'tmm_shortcodes'),
			'shortcode_field' => 'show_metadata',
			'id' => 'show_metadata',
			'is_checked' => TMM_Ext_Shortcodes::set_default_value('show_metadata', 1),
			'description' => __('Show/Hide Meta Info', 'tmm_shortcodes')
		));
		?>

	</div>

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Order', 'tmm_shortcodes'),
			'shortcode_field' => 'order',
			'id' => 'order',
			'options' => array(
				'DESC' => __('DESC', 'tmm_shortcodes'),
				'ASC' => __('ASC', 'tmm_shortcodes'),
			),
			'default_value' => TMM_Ext_Shortcodes::set_default_value('order', 'DESC'),
			'description' => ''
		));
		?>
	</div><!--/ .ona-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Posts Count', 'tmm_shortcodes'),
			'shortcode_field' => 'posts_per_page',
			'id' => 'posts_per_page',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('posts_per_page', 5),
			'description' => ''
		));
		?>

	</div><!--/ .ona-half-->

	<div class="one-half">
		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Posts', 'tmm_shortcodes'),
			'shortcode_field' => 'posts',
			'id' => 'posts',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('posts', ''),
			'description' => __('Example: 56,73,119. It has the most hight priority!', 'tmm_shortcodes')
		));
		?>

	</div><!--/ .ona-half-->
	

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



