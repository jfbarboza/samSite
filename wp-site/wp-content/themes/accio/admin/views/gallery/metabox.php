<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php wp_enqueue_style('tmm_theme_admin_gallery_css', TMM_THEME_URI . '/admin/css/gallery.css'); ?>
<?php wp_enqueue_script('tmm_theme_admin_gallery_js', TMM_THEME_URI . '/admin/js/gallery.js'); ?>
<div class="gallery-meta-container">
	<input type="hidden" value="1" name="tmm_meta_saving" />
	<div class="gallery_layout">
		<label for=""><?php _e('Gallery Layout:', 'accio'); ?></label>
		<div class="sel">
		<?php $layouts = array(2 => __('2 columns', 'accio'), __('3 columns', 'accio'), __('4 columns', 'accio'));
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => "layout",
			'type' => 'select',
			'default_value' => 2,
			'values' => $layouts,
			'value' => $layout,
			'description' => "",
			'css_class' => '',
			'hide_item_html' => 1
		));
		?>
		</div>
		<div class="clear"></div>
		<p><a href="#" class="js_inpost_gallery_add_slide button button-primary"><?php _e('Add images', 'accio'); ?></a></p>
	</div>
	<script type="text/javascript">
		jQuery(function(){
			jQuery("#gallery_categoriesdiv").remove();
		});
	</script>

	<ul id="gallery_item_list">
		<?php if (!empty($tmm_gallery)): ?>
			<?php foreach ($tmm_gallery as $value) : ?>
				<?php TMM_Gallery::render_gallery_item($value) ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>