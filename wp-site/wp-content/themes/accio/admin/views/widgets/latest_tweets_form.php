<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('username'); ?>"><?php _e('Username', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('username'); ?>" name="<?php echo $widget->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('postcount'); ?>"><?php _e('Number of tweets', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo @$widget->get_field_id('postcount'); ?>" name="<?php echo @$widget->get_field_name('postcount'); ?>" value="<?php echo @$instance['postcount']; ?>" />
</p>

