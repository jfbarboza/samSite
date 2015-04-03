<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php wp_dropdown_pages(array('id' => 'onepage_selector')); ?>&nbsp;<a href="#" id="onepage_add_page" class="button"><?php _e("Add Page", 'tmm_layout_constructor') ?></a>

<h2><?php _e("Pages", 'tmm_layout_constructor') ?></h2>

<ul id="onepage_pages_list">
	
	<?php
	if (!empty($onepage)) {
		foreach ($onepage as $page_id) {
			echo TMM_Onepage::draw_onepage_item_to_list($page_id);
		}
	}
	?>

</ul>


<script type="text/javascript">
	
	jQuery(function() {
		
		jQuery("#onepage_pages_list").sortable();
	
		jQuery('#onepage_add_page').click(function() {
			
			var data = {
				action: "add_onepage_item_to_list",
				page_id: jQuery('#onepage_selector').val()
			};
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('#onepage_pages_list').append(response);
			});
			
			return false;

		});

		jQuery('#onepage_pages_list .item-delete').life('click', function() {
			jQuery(this).parents('li').remove();
		});
		
	});
	
</script>


