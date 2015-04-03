<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_social clearfix">

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php } ?>

    <ul class="social-icons <?php echo $instance['animation'] ?> clearfix">

		<?php if ($instance['twitter_links'] != '') { ?>
			<li class="twitter">
				<a title="<?php echo $instance['twitter_tooltip']; ?>" target="_blank" href="<?php echo $instance['twitter_links']; ?>"><i class="icon-twitter"></i><?php echo $instance['twitter_tooltip'] ?></a>
			</li>
		<?php } ?>

		<?php if ($instance['facebook_links'] != '') { ?>
			<li class="facebook">
				<a title="<?php echo $instance['facebook_tooltip']; ?>" target="_blank" href="<?php echo $instance['facebook_links']; ?>"><i class="icon-facebook"></i><?php echo $instance['facebook_tooltip'] ?></a>
			</li>
		<?php } ?>


		<?php if (@$instance['linkedin_links'] != '') { ?>
			<li class="linkedin">
				<a title="<?php echo $instance['linkedin_tooltip']; ?>" target="_blank" href="<?php echo $instance['linkedin_links']; ?>"><i class="icon-linkedin"></i><?php echo $instance['linkedin_tooltip'] ?></a>
			</li>
		<?php } ?>
			
		<?php if ($instance['dribbble_links'] != '') { ?>
			<li class="dribbble">
				<a title="<?php echo $instance['dribbble_tooltip']; ?>" target="_blank" href="<?php echo $instance['dribbble_links']; ?>"><i class="icon-dribbble"></i><?php echo $instance['dribbble_tooltip'] ?></a>
			</li>
		<?php } ?>

		<?php if ($instance['gplus_links'] != '') { ?>
			<li class="gplus">
				<a title="<?php echo $instance['gplus_tooltip']; ?>" target="_blank" href="<?php echo $instance['gplus_links']; ?>"><i class="icon-gplus"></i><?php echo $instance['gplus_tooltip'] ?></a>
			</li>
		<?php } ?>

		<?php if ($instance['instagram_links'] != '') { ?>
			<li class="instagram">
				<a title="<?php echo $instance['instagram_tooltip']; ?>" target="_blank" href="<?php echo $instance['instagram_links']; ?>"><i class="icon-instagramm"></i><?php echo $instance['instagram_tooltip'] ?></a>
			</li>
		<?php } ?>

		<?php if ($instance['vimeo_links'] != '') { ?>
			<li class="vimeo">
				<a title="<?php echo $instance['vimeo_tooltip']; ?>" target="_blank" href="<?php echo $instance['vimeo_links']; ?>"><i class="icon-vimeo"></i><?php echo $instance['vimeo_tooltip'] ?></a>
			</li>
		<?php } ?>

		<?php if ($instance['youtube_links'] != '') { ?>
			<li class="youtube">
				<a title="<?php echo $instance['youtube_tooltip']; ?>" target="_blank" href="<?php echo $instance['youtube_links']; ?>"><i class="icon-youtube"></i><?php echo $instance['youtube_tooltip'] ?></a>
			</li>
		<?php } ?>

		<?php if ($instance['show_rss_tooltip'] == 'true') { ?>
			<li class="rss">
				<a title="<?php echo $instance['rss_tooltip']; ?>" href="<?php
				if (TMM::get_option('feedburner')) {
					echo TMM::get_option('feedburner');
				} else {
					bloginfo('rss2_url');
				}
				?>"><i class="icon-rss"></i></a>
			</li>
		<?php } ?>

    </ul><!--/ .social-list-->		

</div><!--/ .widget_social-->

