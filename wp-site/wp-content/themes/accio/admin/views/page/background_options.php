<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />

<div class="custom-page-options">

	<p>
		<strong><?php _e('Another page title', 'accio'); ?></strong>
	</p>

	<p>
		<input type="text" name="another_page_title" value="<?php if (isset($another_page_title)) echo $another_page_title ?>" />
	</p>

	<p>
		<strong><?php _e('Another page description', 'accio'); ?></strong>
	</p>

	<p>
		<textarea name="another_page_description"><?php if (isset($another_page_description)) echo $another_page_description ?></textarea>
	</p>
	
	<p>
		<strong><?php _e('Show Page Title', 'accio'); ?></strong>
	</p>
	
	<p>
		<select name="show_page_title">
			<option <?php if ($show_page_title == 1): ?> selected <?php endif; ?> value="1">Yes</option>
			<option <?php if ($show_page_title == 0): ?> selected <?php endif; ?> value="0">No</option>
		</select>
	</p>

</div>


<div class="custom-page-options" style="display: none;">
	
	<h4><?php _e('Page Background', 'accio'); ?></h4>
	
	<div class="bg-type-option">
		<div class="sel">
			<select name="pagebg_type" class="pagebg_type">
				<?php
				$types = array(
					"default" => __("Default", 'accio'),
					"color" => __("Color", 'accio'),
					"image" => __("Image", 'accio'),
				);

				if (!$pagebg_type) {
					$pagebg_type = "color";
				}
				?>
				<?php foreach ($types as $key => $type) : ?>
					<option <?php echo($key == $pagebg_type ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<ul id="pagebg_type_options">

		<li id="pagebg_type_image" style="display: none;">
			<p>
				<input type="text" value="<?php echo $pagebg_image; ?>" name="pagebg_image" class="pagebg_image" />&nbsp;
				<a href="#" class="button_upload body_pattern button" title=""><?php _e('Upload', 'accio'); ?></a>
			</p>

			<div class="clear"></div>

			<label><?php _e('Set options', 'accio'); ?>:</label>
			<div class="sel right">
				<select name="pagebg_type_image_option" class="pagebg_type_image_option">
					<?php
					$options = array(
						"no-repeat" => "No Repeat",
						"repeat" => "Repeat",
						"repeat-x" => "Repeat-X",
						"fixed" => "Fixed",
					);

					if (!$pagebg_type_image_option) {
						$pagebg_type_image_option = "repeat";
					}
					?>
					<?php foreach ($options as $key => $option) : ?>
						<option <?php echo($key == $pagebg_type_image_option ? "selected" : "") ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</li>

		<li id="pagebg_type_color" style="display: none;">
			<p><input type="text" class="colorpicker_input pagebg_color" value="<?php echo $pagebg_color; ?>" name="pagebg_color" placeholder="#ffffff" /></p>
		</li>
	</ul>

	<div class="clear"></div>

	<p><a style="float: right" href="#" class="body_pattern button button_reset" title=""><?php _e('Reset', 'accio'); ?></a></p>

	<div class="clear"></div>
</div>


<div id="page-sidebar-position" class="clearfix">
	
	<hr>

	<h4><?php _e('Page Sidebar Position', 'accio'); ?></h4>
	<input type="hidden" value="<?php echo (!$page_sidebar_position ? "sbr" : $page_sidebar_position) ?>" name="page_sidebar_position" />

	<ul class="admin-page-choice-sidebar clearfix">
		<li class="lside <?php echo ($page_sidebar_position == "sbl" ? "current-item" : "") ?>"><a href="sbl" data-val="sbl"><?php _e('Left Sidebar', 'accio'); ?></a></li>
		<li class="wside <?php echo ($page_sidebar_position == "no_sidebar" ? "current-item" : "") ?>"><a href="no_sidebar" data-val="no_sidebar"><?php _e('Without Sidebar', 'accio'); ?></a></li>
		<li class="rside <?php echo ($page_sidebar_position == "sbr" ? "current-item" : "") ?>"><a href="sbr" data-val="sbr"><?php _e('Right Sidebar', 'accio'); ?></a></li>
	</ul>	
	
</div><!--/ #page-sidebar-position-->


<script type="text/javascript">
	
	jQuery(document).ready(function() {

//		jQuery("#pagebg_type_<?php echo $pagebg_type; ?>").show();
//
//		jQuery("[name=pagebg_type]").change(function () {
//			jQuery("#pagebg_type_options li").hide(200);
//			jQuery("#pagebg_type_" + jQuery(this).val()).show(400);
//		});
//
//		jQuery('.button_reset').life('click', function () {
//			jQuery("#pagebg_type_options input").val("");
//			jQuery("#pagebg_type_options select").val(0);
//			return false;
//		});
//
//		jQuery('.headerbg_button_reset').life('click', function () {
//			jQuery("#headerbg_type_options input").val("");
//			jQuery("#headerbg_type_options select").val(0);
//			return false;
//		});
		
		
		(function ($) {
			
			var select = $('[name=onepage]'),
				value = $('[name=onepage] :selected').val(),
				pageSidebar = $('#page-sidebar-position');
			
			function actionChange(value) {
				
				if (value !== 0) {
					if (pageSidebar.is(':visible')) {
						pageSidebar.slideUp(200);
					}
				}

				if (value == 0) {
					pageSidebar.slideDown(200);
				}	
			};
			
			actionChange(value);
			
			select.on('change', function () {
				var $this = $(this), 
					changeValue = $this.val();
				actionChange(changeValue);
			});
			
		})(jQuery);
		

	});
</script>