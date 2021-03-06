<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="slider">
	<p><?php _e("Slider type", 'accio') ?>:</p>
	<div class="sel">
		<select name="page_slider_type">
			<?php foreach ($slider_types as $key => $type) : ?>
				<option <?php echo ($page_slider_type == $key ? "selected" : "") ?> value="<?php echo $key ?>"><?php echo $type ?></option>
			<?php endforeach; ?>
		</select>
	</div><div class="sel">
		<?php
		$page_slider_widths = array(
			'wide' => __("wide", 'accio'),
			'fixed' => __("fixed", 'accio'),
		);
		if (!isset($page_slider_width)) {
			$page_slider_width = 'wide';
		}
		?>
		<select name="page_slider_width">
			<?php foreach ($page_slider_widths as $key => $type) : ?>
				<option <?php echo ($page_slider_width == $key ? "selected" : "") ?> value="<?php echo $key ?>"><?php echo $type ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<hr />

	<div class="native_sliders_groups" <?php if ($page_slider_type == 'layerslider' OR $page_slider_type == 'cuteslider'): ?>style="display: none;"<?php endif; ?>>
		<p><?php _e("Slider group", 'accio') ?>:</p>
		<?php if (!empty($slides)): ?>
			<div class="sel"><select name="page_slider">
					<option value=""><?php _e("Choose slider group", 'accio') ?></option>
					<?php foreach ($slides as $key => $name) : ?>

						<option <?php echo ($page_slider == $key ? "selected" : "") ?> value="<?php echo $key ?>"><?php echo $name ?></option>

					<?php endforeach; ?>
				</select></div>
		<?php else: ?>
			<p><?php _e("You still haven't created any slider group.", 'accio') ?><br><a href="<?php echo admin_url('post-new.php?post_type=' . TMM_Ext_Sliders::$slug) ?>"><?php _e("Click here", 'accio') ?></a> <?php _e("to create one.", 'accio') ?></p>
		<?php endif; ?>
	</div>

	<?php if (function_exists('layerslider_init')): ?>
		<div id="layerslider_slidegroups" <?php if ($page_slider_type != 'layerslider'): ?>style="display: none;"<?php endif; ?>>

			<?php
			global $wpdb;
			$table_name = $wpdb->prefix . "layerslider";
			// Get sliders
			$sliders = $wpdb->get_results("SELECT * FROM $table_name
											WHERE flag_hidden = '0' AND flag_deleted = '0'
											ORDER BY id ASC LIMIT 200");
			?>
			<p><?php _e("Layerslider's groups", 'accio') ?>:</p>
			<div class="sel">
				<select name="layerslider_slide_group">
					<option value=""><?php _e("Choose slider group", 'accio') ?></option>
					<?php if (!empty($sliders)) : ?>
						<?php foreach ($sliders as $item) : ?>
							<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
							<option <?php echo ($layerslider_slide_group == $item->id ? "selected" : "") ?> value="<?php echo $item->id ?>"><?php echo $name ?></option>
						<?php endforeach; ?>
					<?php else: ?>
						<?php _e("You still haven't created any slider group for your Layerslider.", 'accio') ?>
					<?php endif; ?>
				</select>
			</div>
		</div>
	<?php endif; ?>


	<?php if (function_exists('cuteslider_init')): ?>
		<div id="cutelider_slidegroups" <?php if ($page_slider_type != 'cuteslider'): ?>style="display: none;"<?php endif; ?>>

			<?php
			global $wpdb;
			$table_name = $wpdb->prefix . "cuteslider";
			// Get sliders
			$sliders = $wpdb->get_results("SELECT * FROM $table_name
											WHERE flag_hidden = '0' AND flag_deleted = '0'
											ORDER BY id ASC LIMIT 200");
			?>
			<p><?php _e("Cuteslider's groups", 'accio') ?>:</p>
			<div class="sel">
				<select name="cuteslider_slide_group">
					<option value=""><?php _e("Choose slider group", 'accio') ?></option>
					<?php if (!empty($sliders)) : ?>
						<?php foreach ($sliders as $item) : ?>
							<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
							<option <?php echo ($cuteslider_slide_group == $item->id ? "selected" : "") ?> value="<?php echo $item->id ?>"><?php echo $name ?></option>
						<?php endforeach; ?>
					<?php else: ?>
						<?php _e("You still haven't created any slider group for your Cuteslider.", 'accio') ?>
					<?php endif; ?>
				</select>
			</div>
		</div>
	<?php endif; ?>
	<div class="clear"></div>
</div>

<script type="text/javascript">
	jQuery(function() {
		jQuery("[name='page_slider_type']").change(function() {

			var value = jQuery(this).val();
			if (value == 'layerslider') {
				jQuery(".native_sliders_groups").hide();
				jQuery("#cutelider_slidegroups").hide();
				jQuery("#layerslider_slidegroups").show();
				return;
			}

			if (value == 'cuteslider') {
				jQuery(".native_sliders_groups").hide();
				jQuery("#layerslider_slidegroups").hide();
				jQuery("#cutelider_slidegroups").show();
				return;
			}

			jQuery(".native_sliders_groups").show();
			jQuery("#layerslider_slidegroups").hide();
			jQuery("#cutelider_slidegroups").hide();

		});
	});
</script>