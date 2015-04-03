<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<script>
	(function ($) {
		$(function () {

			var $bg_type = $('#bg_type'),
				$quality = $('#video_quality'),
				$value = $bg_type.val();

			function hiddenVisible(val) {
				if (val == 'youtube') {
					$quality.css({
						visibility: 'visible'
					});
				} else {
					$quality.css({
						visibility: 'hidden'
					});
				}
			}

			hiddenVisible($value);

			if ($bg_type) {
				$bg_type.on('change', function () {
					var val = $(this).val();
						hiddenVisible(val);
				});
			}

		});
	})(jQuery);
</script>

<table class="form-table">
    <tbody>

        <tr>
            <th style="width: 25%">
                <label for="bg_video">
                    <strong><?php _e('Background Video', 'accio'); ?></strong>
                    <span style=" display: block; color: #999; margin: 5px 0 0 0; line-height: 18px;">(upload self-hosted mp4)</span>
                </label>
            </th>
			<td>
				<select id="bg_type" name="bg_type">
					<option <?php if ($bg_type == 'youtube'): ?>selected=""<?php endif; ?> value="youtube">Youtube</option>
					<option <?php if ($bg_type == 'vimeo'): ?>selected=""<?php endif; ?> value="vimeo">Vimeo</option>
					<option <?php if ($bg_type == 'selfhosted'): ?>selected=""<?php endif; ?> value="selfhosted">Self Hosted</option>
				</select>
			</td>
			<td>
				<select style="visibility: hidden;" id="video_quality" name="video_quality">
					<option <?php if ($video_quality == 'default'): ?> selected="" <?php endif; ?> value="default">Default</option>
					<option <?php if ($video_quality == 'small'): ?> selected="" <?php endif; ?> value="small">Small</option>
					<option <?php if ($video_quality == 'medium'): ?> selected="" <?php endif; ?> value="medium">Medium</option>
					<option <?php if ($video_quality == 'large'): ?> selected="" <?php endif; ?> value="large">Large</option>
					<option <?php if ($video_quality == 'hd720'): ?> selected="" <?php endif; ?> value="hd720">HD720</option>
					<option <?php if ($video_quality == 'hd1080'): ?> selected="" <?php endif; ?> value="hd1080">HD1080</option>
					<option <?php if ($video_quality == 'highres'): ?> selected="" <?php endif; ?> value="highres">Highres</option>
				</select>
			</td>
           <td>
                <input id="bg_video" type="text" style="width: 75%; margin-right: 20px; float: left;" size="30" value="<?php echo $bg_video ?>" name="bg_video">&nbsp;<a href="#" class="button button_upload"><?php _e('upload', 'accio'); ?></a>
            </td>
        </tr>

		<tr>
            <th style="width: 25%">
                <label for="page_menu">
                    <strong><?php _e('Page Menu', 'accio'); ?></strong>
                    <span style=" display: block; color: #999; margin: 5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
				<?php $menus = wp_get_nav_menus(); ?>
				<?php if (!empty($menus)): ?>
					<select name="page_menu">
						<?php foreach ($menus as $menu) : ?>
							<option <?php if ($page_menu == $menu->term_id): ?>selected=""<?php endif; ?> value="<?php echo $menu->term_id ?>"><?php echo $menu->name ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
            </td>
        </tr>

    </tbody>
</table>



