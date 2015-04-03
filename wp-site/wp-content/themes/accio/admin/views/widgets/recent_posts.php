<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_custom_recent_entries">

	<?php
	$query = new WP_Query(array(
		'post_type' => 'post',
		'showposts' => $instance['post_count'],
		'cat' => $instance['category']
	));

	global $post;
	?>

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php } ?>

    <section class="section-entry clearfix">

		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

				<article class="entry">

					<?php if ($instance['show_thumbnail'] == 'true'): ?>
						<div class="entry-image">
							<a class="single-image" href="<?php the_permalink(); ?>">
								<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '90*80'); ?>" alt="<?php the_title(); ?>">
							</a>						
						</div>
					<?php endif; ?>
					
					<div class="post-holder">
						
						<div class="entry-meta">
							<span class="date"><?php echo get_the_date('d.m.Y') ?></span>
							<span><a href="<?php the_permalink(); ?>#comments"><?php echo get_comments_number(); ?> <?php _e('Comments', 'accio'); ?></a></span>
						</div>
						
						<h6 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h6>
						
						<p>
							<?php if ($instance['show_exerpt']) : ?>

								<?php $exerpt = get_the_excerpt(); ?>
								<?php if (!empty($exerpt)): ?>
									<?php
									if ((int) $instance['exerpt_symbols_count'] > 0) {
										echo substr(strip_tags($exerpt), 0, (int) $instance['exerpt_symbols_count']) . " ...";
									} else {
										the_excerpt();
									}
									?>
								<?php else : ?>
									<?php echo substr(strip_tags(get_the_content($post->ID)), 0, (int) $instance['exerpt_symbols_count']) . " ..."; ?>
								<?php endif; ?>

							<?php endif; ?>
						</p>	
						
					</div><!--/ .post-holder-->

				</article><!--/ .entry-->

				<?php
			endwhile;
		endif;
		?>

    </section>
		
	<?php if ($instance['show_see_all_button'] == "true"): ?>
		<?php if ($instance['category'] > 0): ?>
			<a class="button default small" href="<?php echo get_category_link((int) $instance['category']); ?>"><?php _e('See all posts', 'accio'); ?></a>
		<?php else: ?>
			<a class="button default small" href="<?php echo home_url() . '/' . date('Y') ?>"><?php _e('See all posts', 'accio'); ?></a>
		<?php endif; ?>
	<?php endif; ?>

</div><!--/ .widget-container-->

