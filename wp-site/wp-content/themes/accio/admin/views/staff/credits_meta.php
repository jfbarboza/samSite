<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<table class="form-table">
    <tbody>
		
		<tr>
            <th>
                <label for="twitter">
                    <strong><?php _e('Twitter', 'accio'); ?></strong>
                    <span style="display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" class="widefat"  value="<?php echo $twitter ?>" id="twitter" name="twitter">
            </td>
        </tr>


        <tr>
            <th>
                <label for="facebook">
                    <strong><?php _e('Facebook', 'accio'); ?></strong>
                    <span style="display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" class="widefat" value="<?php echo $facebook ?>" id="facebook" name="facebook">
            </td>
        </tr>

		<tr>
            <th>
                <label for="linkedin">
                    <strong><?php _e('LinkedIn', 'accio'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" class="widefat" value="<?php echo $linkedin ?>" id="linkedin" name="linkedin">
            </td>
        </tr>

		<tr>
            <th>
                <label for="dribbble">
                    <strong><?php _e('Dribbble', 'accio'); ?></strong>
                    <span style="display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" class="widefat" value="<?php echo $dribbble ?>" id="dribbble" name="dribbble">
            </td>
        </tr>

		<tr>
            <th>
                <label for="instagram">
                    <strong><?php _e('Instagram', 'accio'); ?></strong>
                    <span style="display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" class="widefat" value="<?php echo $instagram ?>" id="instagram" name="instagram">
            </td>
        </tr>


    </tbody>
</table>
