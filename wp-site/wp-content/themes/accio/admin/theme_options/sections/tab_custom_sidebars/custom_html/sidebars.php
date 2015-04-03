<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div id="js_sidebar_panel">
	
	<div class="option option-add-form">
		
		<h4 class="option-title"><?php _e('Add Sidebar', 'accio'); ?></h4>
		
		<div class="controls">
			<input type="text" value="" id="sidebar_name" placeholder="<?php _e("type title here", 'accio') ?>">
			<div class="add-button add_sidebar"></div>
		</div><!--/ .controls-->
		<div class="explain"></div>
		
	</div><!--/ .option-->
	
	<div class="option">
		
		<h4 class="option-title"><?php _e("Custom Sidebars", 'accio'); ?></h4>

		<input type="hidden" name="sidebars[]" value="" />
		<ul class="groups custom_sidebars_list">		
			<?php if (!empty($sidebars) AND is_array($sidebars)): ?>
				<?php foreach ($sidebars as $sidebar_id => $sidebar) : ?>
					<li>
						<a data-id="sidebar_<?php echo $sidebar_id; ?>" class="js_edit_sidebar" href="#"><?php echo $sidebar['name']; ?></a>
						<input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][name]" value="<?php echo $sidebar['name']; ?>" />
						<a href="#" title="<?php _e('Delete', 'accio'); ?>" class="remove js_remove_sidebar" data-id="sidebar_<?php echo $sidebar_id ?>"></a>
						<a data-id="sidebar_<?php echo $sidebar_id; ?>" href="#" title="<?php _e('Edit', 'accio'); ?>" class="edit js_edit_sidebar"></a>
					</li>
				<?php endforeach; ?>
			<?php else: ?>
				<li class="js_no_one_item_else"><span><?php _e('You have not created any sidebar group yet. Please create one using the form above.', 'accio'); ?></span></li>
			<?php endif; ?>
		</ul>
		
	</div><!--/ .option-->

</div>


<ul id="sidebars_list">
	
	<?php if (!empty($sidebars) AND is_array($sidebars)): ?>
		<?php foreach ($sidebars as $sidebar_id => $sidebar) : ?>
			<li style="display: none;" id="sidebar_<?php echo $sidebar_id ?>">
				<?php echo TMM::draw_free_page($custom_html_pagepath . 'sidebar.php', array('sidebar' => $sidebar, 'sidebar_id' => $sidebar_id)); ?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
			
</ul>

