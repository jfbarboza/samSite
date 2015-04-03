<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<link rel="stylesheet" href="<?php echo TMM_THEME_URI; ?>/css/font-awesome.css" type="text/css" media="all" />
<div id="tmm_shortcode_template" class="tmm_shortcode_template clearfix">

	<div class="fullwidth">

		<?php
		$type_array = array(
			'icon-paper-plane-2' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-paper-plane-2',
			'icon-pencil-7' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-pencil-7',
			'icon-cog-6' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-cog-6',
			'icon-beaker-1' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-beaker-1',
			'icon-megaphone-3' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-megaphone-3',
			'icon-search' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-search',
			'icon-comment-6' => __('Icon', 'tmm_shortcodes') . ': ' . 'icon-comment-6'
		);
		?>

		<h4 class="label"><?php _e('Blocks', 'tmm_shortcodes'); ?></h4>
		
		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add item', 'tmm_shortcodes'); ?></a><br />
		
		<ul id="list_items" class="list-items">
			
			<?php
			$content_edit_data = array('');
			$links_edit_data = array('#');
			$titles_edit_data = array('');
			$icons_edit_data = array(key($type_array));
			$list_item_color = array('');
			
			if (isset($_REQUEST["shortcode_mode_edit"])) {
				$content_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['content']);
				$links_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['links']);
				$titles_edit_data = explode('^', $_REQUEST["shortcode_mode_edit"]['titles']);
				$icons_edit_data = explode(',', $_REQUEST["shortcode_mode_edit"]['icons']);
				$list_item_color = explode(',', $_REQUEST["shortcode_mode_edit"]['colors']);
			}
			?>
                   
			<?php foreach ($content_edit_data as $key => $content_edit_text) : ?>
                                                    
				<li class="list_item">
					<ul class="list-table">
						<li>
							<ul>
								<li>
									<h4 class="label"><?php _e('Icon View', 'tmm_shortcodes'); ?></h4>
									<i class="<?php echo $icons_edit_data[$key] ?>"></i>
								</li>
								<li>
									<?php
									TMM_Ext_Shortcodes::draw_shortcode_option(array(
										'type' => 'select',
										'title' => 'Select Icon',
										'shortcode_field' => 'list_item_icon',
										'id' => '',
										'options' => $type_array,
										'default_value' => $icons_edit_data[$key],
										'description' => '',
										'css_classes' => 'list_item_icon'
									));
									?>
								</li>
								<li>
									<h4 class="label"><?php _e('Title', 'tmm_shortcodes'); ?></h4>
									<input type="text" value="<?php echo $titles_edit_data[$key] ?>" class="list_item_title js_shortcode_template_changer data-input" />			
								</li>
								<li>
									<h4 class="label"><?php _e('Delete Block', 'tmm_shortcodes'); ?></h4>
									<a class="button button-secondary js_delete_list_item js_shortcode_template_changer" href="#">&nbsp&nbsp&nbsp&nbsp<?php _e('Remove', 'tmm_shortcodes'); ?>&nbsp&nbsp&nbsp&nbsp</a>
								</li>
							</ul>
						</li>
						<li>
							<ul>
								<li>
									<h4 class="label"><?php _e('Content', 'tmm_shortcodes'); ?></h4>
									<textarea class="list_item_content js_shortcode_template_changer data-area"><?php echo $content_edit_text ?></textarea>										
								</li>
								<li>
									<div class="row-mover"></div>
								</li>
							</ul>
						</li>
					</ul>
				</li>

			<?php endforeach; ?>

		</ul><!--/ #list_items-->
		
		<a class="button button-secondary js_add_list_item" href="#"><?php _e('Add item', 'tmm_shortcodes'); ?></a><br />

	</div><!--/ .fullwidth-->
	
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

</div>


<!-- --------------------------  PROCESSOR  --------------------------- -->

<script type="text/javascript">
	
	var shortcode_name = "<?php echo basename(__FILE__, '.php'); ?>";
       
	jQuery(function () {
		
		colorizator();
		selectwrap();
		
		jQuery("#list_items").sortable({
			stop: function(event, ui) {
				tmm_ext_shortcodes.services_changer(shortcode_name);
			}
		});                
                
		tmm_ext_shortcodes.services_changer(shortcode_name);
		jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('click change', function () {                       
			tmm_ext_shortcodes.services_changer(shortcode_name);
		});

		jQuery(".js_add_list_item").click(function() { 
			var clone = jQuery(".list_item:last").clone(false);
			var last_row = jQuery(".list_item:last");
			jQuery(clone).insertAfter(last_row, clone);
                        tmm_ext_shortcodes.services_changer(shortcode_name);
			jQuery(".list_item:last").find('input[type=text]').val("");
			jQuery(".list_item:last").find('textarea').val("");
			tmm_ext_shortcodes.services_changer(shortcode_name);   
                        jQuery("#tmm_shortcode_template .js_shortcode_template_changer").on('click change', function () {                       
                            tmm_ext_shortcodes.services_changer(shortcode_name);
                        });
			colorizator();
			return false;
		});
                
		jQuery(".js_delete_list_item").life('click', function () {
                                               
			if (jQuery(".list_item").length > 1) {                            
				jQuery(this).parents('li').hide(200, function () {
					jQuery(this).remove();
				});                             
			}
                        
                        setTimeout(function() { tmm_ext_shortcodes.services_changer(shortcode_name); }, 500);
			
			return false;
		});
                
		jQuery(".list_item_icon").life('change', function () {
			jQuery(this).parents('li').find('i').removeAttr('class').addClass(jQuery(this).val());
			tmm_ext_shortcodes.services_changer(shortcode_name);
		});
		
	});
	
</script>
