<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('form'); ?>"><?php _e('Form', 'accio') ?>:</label>
    <select id="<?php echo $widget->get_field_id('form'); ?>" name="<?php echo $widget->get_field_name('form'); ?>" class="widefat">
		<?php
		$contact_forms = TMM::get_option('contact_form');
		$current_form = $instance['form'];
		?>
		<?php if (!empty($contact_forms)) : ?>
			<?php foreach ($contact_forms as $contact_form) : ?>
				<option <?php echo($current_form == $contact_form['title'] ? "selected" : "") ?> value="<?php echo $contact_form['title'] ?>"><?php echo $contact_form['title'] ?></option>
			<?php endforeach; ?>
		<?php endif; ?>
    </select><br />
</p>

<p>
	<label for="<?php echo $widget->get_field_id('animation'); ?>"><?php _e('Animation', 'aciio') ?>:</label>
	<select name="<?php echo $widget->get_field_name('animation'); ?>" id="<?php echo $widget->get_field_id('animation'); ?>" class="widefat">
		<?php foreach ($widget->css_anim() as $key => $value): ?>
			<option <?php if ($instance['animation'] == $key): ?>selected<?php endif; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
		<?php endforeach; ?>
	</select><br />
</p>

<p>
	<small><?php _e("You can create a contact form from Theme Options->Contact Forms", 'accio') ?></small>
</p>
