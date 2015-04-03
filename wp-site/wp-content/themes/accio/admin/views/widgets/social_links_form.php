<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
	<label for="<?php echo $widget->get_field_id('animation'); ?>"><?php _e('Animation', 'aciio') ?>:</label>
	<select name="<?php echo $widget->get_field_name('animation'); ?>" id="<?php echo $widget->get_field_id('animation'); ?>" class="widefat">
		<?php foreach ($widget->css_anim() as $key => $value): ?>
			<option <?php if ($instance['animation'] == $key): ?>selected<?php endif; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
		<?php endforeach; ?>
	</select> 
</p>

<p>
    <label for="<?php echo $widget->get_field_id('twitter_links'); ?>"><?php _e('Twitter Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('twitter_links'); ?>" name="<?php echo $widget->get_field_name('twitter_links'); ?>" value="<?php echo $instance['twitter_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('twitter_tooltip'); ?>"><?php _e('Twitter Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('twitter_tooltip'); ?>" name="<?php echo $widget->get_field_name('twitter_tooltip'); ?>" value="<?php echo $instance['twitter_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('facebook_links'); ?>"><?php _e('Facebook Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('facebook_links'); ?>" name="<?php echo $widget->get_field_name('facebook_links'); ?>" value="<?php echo $instance['facebook_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('facebook_tooltip'); ?>"><?php _e('Facebook Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('facebook_tooltip'); ?>" name="<?php echo $widget->get_field_name('facebook_tooltip'); ?>" value="<?php echo $instance['facebook_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('linkedin_links'); ?>"><?php _e('Linkedin Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('linkedin_links'); ?>" name="<?php echo $widget->get_field_name('linkedin_links'); ?>" value="<?php echo $instance['linkedin_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('linkedin_tooltip'); ?>"><?php _e('Linkedin Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('linkedin_tooltip'); ?>" name="<?php echo $widget->get_field_name('linkedin_tooltip'); ?>" value="<?php echo $instance['linkedin_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('dribbble_links'); ?>"><?php _e('Dribbble Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('dribbble_links'); ?>" name="<?php echo $widget->get_field_name('dribbble_links'); ?>" value="<?php echo $instance['dribbble_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('dribbble_tooltip'); ?>"><?php _e('Dribbble Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('dribbble_tooltip'); ?>" name="<?php echo $widget->get_field_name('dribbble_tooltip'); ?>" value="<?php echo $instance['dribbble_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('gplus_links'); ?>"><?php _e('Google Plus Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('gplus_links'); ?>" name="<?php echo $widget->get_field_name('gplus_links'); ?>" value="<?php echo $instance['gplus_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('gplus_tooltip'); ?>"><?php _e('Google Plus Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('gplus_tooltip'); ?>" name="<?php echo $widget->get_field_name('gplus_tooltip'); ?>" value="<?php echo $instance['gplus_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('instagram_links'); ?>"><?php _e('Instagram Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('instagram_links'); ?>" name="<?php echo $widget->get_field_name('instagram_links'); ?>" value="<?php echo $instance['instagram_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('instagram_tooltip'); ?>"><?php _e('Instagram Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('instagram_tooltip'); ?>" name="<?php echo $widget->get_field_name('instagram_tooltip'); ?>" value="<?php echo $instance['instagram_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('vimeo_links'); ?>"><?php _e('Vimeo Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('vimeo_links'); ?>" name="<?php echo $widget->get_field_name('vimeo_links'); ?>" value="<?php echo $instance['vimeo_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('vimeo_tooltip'); ?>"><?php _e('Vimeo Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('vimeo_tooltip'); ?>" name="<?php echo $widget->get_field_name('vimeo_tooltip'); ?>" value="<?php echo $instance['vimeo_tooltip']; ?>" />
</p>


<p>
    <label for="<?php echo $widget->get_field_id('youtube_links'); ?>"><?php _e('Youtube Link', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('youtube_links'); ?>" name="<?php echo $widget->get_field_name('youtube_links'); ?>" value="<?php echo $instance['youtube_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('youtube_tooltip'); ?>"><?php _e('Youtube Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('youtube_tooltip'); ?>" name="<?php echo $widget->get_field_name('youtube_tooltip'); ?>" value="<?php echo $instance['youtube_tooltip']; ?>" />
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_rss_tooltip'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_rss_tooltip'); ?>" name="<?php echo $widget->get_field_name('show_rss_tooltip'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_rss_tooltip'); ?>"><?php _e('Show RSS Link', 'accio') ?></label>
</p>


<p>
    <label for="<?php echo $widget->get_field_id('rss_tooltip'); ?>"><?php _e('RSS Tooltip', 'accio') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('rss_tooltip'); ?>" name="<?php echo $widget->get_field_name('rss_tooltip'); ?>" value="<?php echo $instance['rss_tooltip']; ?>" />
</p>



