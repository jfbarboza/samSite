<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $unique_id = uniqid() ?>
<li id="slide_item_<?php echo $unique_id ?>" class="gallery_item">
	<img class="gallery_thumb" src="<?php echo TMM_Helper::resize_image($imgurl, "100*100") ?>" alt="<?php _e('media item', 'accio'); ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][imgurl]" value="<?php echo $imgurl ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][title]" value="<?php echo $title ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][description]" value="<?php echo $description ?>" />
	<a href="#TB_inline?height=380&amp;width=300&amp;inlineId=gallery_item_popup_<?php echo $unique_id ?>" class="thickbox update_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Edit item title and description", 'accio') ?>"><?php _e('Edit item title and description', 'accio'); ?></a>
	<a href="#" class="delete_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Delete Item", 'accio') ?>"><?php _e("Delete Item", 'accio'); ?></a>

	<?php
	$gallery_categories_terms = get_terms('gallery_categories', array('hide_empty' => false));
	$gallery_categories = array();
	if (!empty($gallery_categories_terms)) {
		foreach ($gallery_categories_terms as $value) {
			$gallery_categories[$value->term_id] = $value->name;
		}
	}
	?>

	<?php if (!empty($gallery_categories)) : ?>
		<div class="sel gallery_item_category_wrap">
			<?php
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => "tmm_gallery[{$unique_id}][category]",
				'type' => 'select',
				'default_value' => '',
				'values' => $gallery_categories,
				'value' => @$category,
				'description' => "",
				'css_class' => "",
				'hide_item_html' => 1
			));
			?>
		</div>
	<?php endif; ?>


	<div id="gallery_item_popup_<?php echo $unique_id ?>" style="display:none;">
		<h4><?php _e("Title", 'accio') ?></h4>
		<p><input type="text" class="js_edit_gallery_item_title" value="<?php echo $title ?>" /></p>
		<h4><?php _e("Description", 'accio') ?></h4>
		<p><textarea class="js_edit_gallery_item_description"><?php echo $description ?></textarea></p>
		<a href="#" class="button js_edit_gallery_item" style="float: left;" data-unique-id="<?php echo $unique_id ?>"><?php _e("Apply Changes", 'accio') ?></a> <a style="float: right;" href="javascript:tb_remove();void(0);" class="button"><?php _e("Cancel", 'accio') ?></a>
		<div class="clear"></div>
	</div>
</li>