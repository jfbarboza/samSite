<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">
	
	<div class="one-half">
		
		<?php 

			$categories_list = array('' => 'All');
			$portfolio_categories = get_terms( 'folio_category' );

			foreach ($portfolio_categories as $category) {
				$categories_list[$category->term_taxonomy_id] = $category->name;
			}
			
		 ?>

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'select',
			'title' => __('Categories', 'tmm_shortcodes'),
			'shortcode_field' => 'cat_id',
			'id' => '',
			'options' => $categories_list,
			'default_value' => TMM_Ext_Shortcodes::set_default_value('cat_id', ' '),
			'description' => ''
		));
		?>

	</div><!--/ .one-half-->
	
	<div class="one-half">

		<?php
		TMM_Ext_Shortcodes::draw_shortcode_option(array(
			'type' => 'text',
			'title' => __('Posts per page', 'tmm_shortcodes'),
			'shortcode_field' => 'posts_per_page',
			'id' => '',
			'default_value' => TMM_Ext_Shortcodes::set_default_value('posts_per_page', 10),
			'description' => __('Posts per page', 'tmm_shortcodes'),
		));
		?>

	</div><!--/ .one-half-->

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
