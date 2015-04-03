<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $uniqid = uniqid(); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('post_number'); ?>"><?php _e('Post Number', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('post_number'); ?>" name="<?php echo $widget->get_field_name('post_number'); ?>" value="<?php echo $instance['post_number']; ?>" />
</p>


<p>
    <label for="<?php echo $widget->get_field_id('layout_style'); ?>"><?php _e('Layout Style', 'accio') ?>:</label>
    <select id="<?php echo $widget->get_field_id('layout_style'); ?>" name="<?php echo $widget->get_field_name('layout_style'); ?>" class="widefat">
		<?php $layout_styles = array(1 => __('Layout Style 1', 'accio'), 2 => __('Layout Style 2', 'accio')); ?>
		<?php foreach ($layout_styles as $style_key => $style_name) : ?>
			<option <?php echo($style_key == $instance['layout_style'] ? "selected" : "") ?> value="<?php echo $style_key ?>"><?php echo $style_name ?></option>
		<?php endforeach; ?>
    </select>
</p>



<p class="style1_options_<?php echo $uniqid ?>" <?php if ($instance['layout_style'] == 1): ?>style="display: none;"<?php endif; ?>>
	<?php
	$checked = "";
	if ($instance['show_thumbnail'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_thumbnail'); ?>" name="<?php echo $widget->get_field_name('show_thumbnail'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_thumbnail'); ?>"><?php _e('Show thumbnail', 'accio') ?></label>
</p>

<p class="style1_options_<?php echo $uniqid ?>" <?php if ($instance['layout_style'] == 1): ?>style="display: none;"<?php endif; ?>>
	<?php
	$checked = "";
	if ($instance['show_exerpt'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_exerpt'); ?>" name="<?php echo $widget->get_field_name('show_exerpt'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_exerpt'); ?>"><?php _e('Show Exerpt', 'accio') ?></label>
</p>

<p class="style1_options_<?php echo $uniqid ?>" <?php if ($instance['layout_style'] == 1): ?>style="display: none;"<?php endif; ?>>
	<?php
	$checked = "";
	if ($instance['show_title'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_title'); ?>" name="<?php echo $widget->get_field_name('show_title'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_title'); ?>"><?php _e('Display Title', 'accio') ?></label>
</p>

<p class="style1_options_<?php echo $uniqid ?>" <?php if ($instance['layout_style'] == 1): ?>style="display: none;"<?php endif; ?>>
    <label for="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>"><?php _e('Exerpt Symbols Count', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('exerpt_symbols_count'); ?>" name="<?php echo $widget->get_field_name('exerpt_symbols_count'); ?>" value="<?php echo $instance['exerpt_symbols_count']; ?>" />
</p>

<p class="style1_options_<?php echo $uniqid ?>" <?php if ($instance['layout_style'] == 1): ?>style="display: none;"<?php endif; ?>>
	<?php
	$checked = "";
	if ($instance['show_button'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_button'); ?>" name="<?php echo $widget->get_field_name('show_button'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_button'); ?>"><?php _e('Show button', 'accio') ?></label>
</p>
<script type="text/javascript">
	jQuery(function() {
		jQuery('#<?php echo $widget->get_field_id('layout_style'); ?>').life('change',function() {
			if(parseInt(jQuery(this).val()) == 2){
				jQuery('.style1_options_<?php echo $uniqid ?>').show(150);
			}else{
				jQuery('.style1_options_<?php echo $uniqid ?>').hide(150);
			}
			
		});
	});
</script>