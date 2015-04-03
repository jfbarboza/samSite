<?php

wp_reset_query();

if (have_posts()):

$post_loop_count = 1;

while (have_posts()) : the_post();

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("entry"); ?>>
		
		<div class="entry-content">
			
			<div class="entry-meta">
				<span class="date"><a href="<?php echo home_url() ?>/<?php echo get_the_date('Y/m') ?>"><?php echo get_the_date() ?></a></span>

				<?php $categories_list = get_the_category_list(__(', ', 'accio')); ?>
				<?php if (!empty($categories_list)) : ?>
					<span><?php _e('in', 'accio'); ?> <?php echo $categories_list ?></span>
				<?php endif; ?>

				<span><?php _e('by', 'accio'); ?> <?php the_author_link() ?></span>
				<span><a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?></a> <?php _e('Comments', 'accio'); ?></span>
			</div><!--/ .entry-meta-->

			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h2><!--/ .entry-title-->

			<div class="entry-body">
				<p>
					<?php
					if (empty($post->post_excerpt)) {
						$txt = do_shortcode($post->post_content);
						$txt = strip_tags($txt);
						if (function_exists('mb_substr')) {
							echo do_shortcode(mb_substr($txt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						} else {
							echo do_shortcode(substr($txt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						}
					} else {
						if (function_exists('mb_substr')) {
							echo do_shortcode(mb_substr($post->post_excerpt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						} else {
							echo do_shortcode(substr($post->post_excerpt, 0, TMM::get_option("excerpt_symbols_count")) . " ...");
						}
					}
					?>
				</p>
			</div><!--/ .entry-body-->

			<?php $tags = get_the_tag_list('', ' '); ?>

			<?php if (!empty($tags)): ?>
				<span class="tags">
					<?php echo $tags ?>
				</span><!--/ .tags-->
			<?php endif; ?>		
			
		</div><!--/ .entry-content-->

	</article><!--/ .entry-->

<?php 
	$post_loop_count++;
	endwhile;
else:
?>
	<?php get_template_part('content', 'nothingfound') ?>
<?php endif; ?>

<?php wp_reset_query(); ?>