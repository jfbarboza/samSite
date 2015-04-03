<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('post_id'); ?>"><?php _e('Select Testimonial', 'accio') ?>:</label>
    <select id="<?php echo $widget->get_field_id('post_id'); ?>" name="<?php echo $widget->get_field_name('post_id'); ?>" class="widefat">
		<?php $testimonials = get_posts(array('numberposts' => -1, 'post_type' => TMM_Testimonials::$slug)); ?>
		<?php foreach ($testimonials as $post) : ?>
			<option <?php echo($post->ID == $instance['post_id'] ? "selected" : "") ?> value="<?php echo $post->ID ?>"><?php echo $post->post_name ?></option>
		<?php endforeach; ?>
    </select>
</p>

