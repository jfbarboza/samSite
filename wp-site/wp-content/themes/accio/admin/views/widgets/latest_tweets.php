<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php wp_enqueue_script('jquery.tweet', TMM_THEME_URI . '/helper/twitter/jquery.tweet.js'); ?>
<?php $uniqid = uniqid(); ?>

<div class="widget widget_latest_tweets">
	
	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo $instance['title'] ?></h3>
	<?php endif; ?>

	<div id="<?php echo $uniqid ?>" class="sidebar-tweet"></div>

	<script type="text/javascript">

		jQuery(function () {

			var $tweet = jQuery('#<?php echo $uniqid; ?>');
			
			$tweet.tweet({
				username: "<?php echo $instance['username'] ?>", // Username Twitter
				count: <?php echo $instance['postcount'] ?>,
				page: 1,
				unique_id: "<?php echo $uniqid ?>",
				loading_text: '<?php _e('loading', 'tmm_shortcodes') ?> ...'
			});

		});

	</script>

</div><!--/ .widget-->

