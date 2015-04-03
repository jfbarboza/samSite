<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<li>
	<dl class="menu-item-bar">
		<dt class="menu-item-handle" style="width: 98%;">
		<span class="item-title"><span class="menu-item-title"><?php echo $page->post_title ?></span></span>
		<span class="item-controls">						
			<a href="#" title="" class="item-delete"><?php _e("Delete", 'tmm_layout_constructor') ?></a>
		</span>
		</dt>
	</dl>
	<input type="hidden" name="onepage[]" value="<?php echo $page_id ?>" />
</li>




