<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $unique_id = uniqid() ?>
<li id="slide_item_<?php echo $unique_id ?>" class="gallery_item">
	<?php if (TMM_Helper::get_media_type($imgurl) == 'image'): ?>
		<img class="gallery_thumb" src="<?php echo TMM_Helper::resize_image($imgurl, "100*100") ?>" alt="" />
	<?php else: ?>
		<img class="gallery_thumb" src="<?php echo get_template_directory_uri() ?>/admin/images/folio_video_cover.jpg" alt="" />
	<?php endif; ?>

	<input type="hidden" name="tmm_portfolio[]" value="<?php echo $imgurl ?>" />
	<a href="#" class="delete_gallery_item" slide-id="<?php echo $unique_id ?>" title="<?php _e("Delete Item", 'accio') ?>"><?php _e("Delete Item", 'accio'); ?></a>
</li>