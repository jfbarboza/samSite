<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('username'); ?>"><?php _e('Flickr Username', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('username'); ?>" name="<?php echo $widget->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('imagescount'); ?>"><?php _e('Number of images', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo @$widget->get_field_id('imagescount'); ?>" name="<?php echo @$widget->get_field_name('imagescount'); ?>" value="<?php echo @$instance['imagescount']; ?>" />
</p>

