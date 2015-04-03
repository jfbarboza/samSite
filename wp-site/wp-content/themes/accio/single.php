<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class("entry main-entry single"); ?>>

			<?php
			$post_pod_type = get_post_meta($post->ID, 'post_pod_type', true);
			$post_type_values = get_post_meta($post->ID, 'post_type_values', true);

			switch ($post_pod_type) {
				case 'audio':
					echo do_shortcode('[tmm_audio]' . $post_type_values[$post_pod_type] . '[/tmm_audio]');
					break;
				case 'video':
					
					$video_width = 740;
					$video_height = 470;

					$source_url = $post_type_values[$post_pod_type];
					if (!empty($source_url)) {

						$video_type = 'youtube';
						$allows_array = array('youtube', 'vimeo');

						foreach ($allows_array as $key => $needle) {
							$count = strpos($source_url, $needle);
							if ($count !== FALSE) {
								$video_type = $allows_array[$key];
							}
						}

						switch ($video_type) {
							case $allows_array[0]:
								echo '<div class="entry-image">';
								echo do_shortcode('[tmm_video type="youtube" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
								echo '</div>';
								break;
							case $allows_array[1]:
								echo '<div class="entry-image">';
								echo do_shortcode('[tmm_video type="vimeo" width="' . $video_width . '" height="' . $video_height . '"]' . $source_url . '[/tmm_video]');
								echo '</div>';
								break;
							default:
								break;
						}
					}
					?>
					<?php
					break;

				case 'quote':
					echo do_shortcode('[blockquote type="type-1" align=""]' . $post_type_values[$post_pod_type] . '[/blockquote]');
					break;

				case 'gallery':
					TMM_Functions::enqueue_script('cycle');
					$gall = $post_type_values[$post_pod_type];
					?>

					<?php if (!empty($gall)) : ?>

						<div class="entry-image">
							<div class="image-slider">
								<ul>
									<?php foreach ($gall as $key => $source_url): ?>
										<li>

											<div class="work-item">

												<img src="<?php echo TMM_Helper::resize_image($source_url, '740*470') ?>" alt="<?php echo $post->post_title ?>" />

												<div class="image-extra">

													<div class="extra-content">

														<div class="inner-extra">
															<a class="single-image plus-icon" data-fancybox-group="blog" href="<?php echo TMM_Helper::resize_image($source_url, '') ?>"></a>	
														</div><!--/ .inner-extra-->	

													</div><!--/ .extra-content-->

												</div><!--/ .image-extra-->	

											</div><!--/ .work-item-->

										</li>
									<?php endforeach; ?>
								</ul>
							</div><!--/ .image-slider-->
						</div><!--/ .entry-image-->

					<?php endif; ?>
					<?php
					break;

				default:
					?>
					<?php if (has_post_thumbnail()) : ?>

						<div class="entry-image">
							
							<div class="work-item">

								<?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'): ?>
									<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '740*470'); ?>" alt="<?php echo $post->post_title; ?>" />
								<?php else: ?>
									<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '940*680'); ?>" alt="<?php echo $post->post_title; ?>" />
								<?php endif; ?>	

								<div class="image-extra">

									<div class="extra-content">

										<div class="inner-extra">
											<a class="single-image plus-icon" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>"></a>	
										</div><!--/ .inner-extra-->	

									</div><!--/ .extra-content-->

								</div><!--/ .image-extra-->	

							</div><!--/ .work-item-->
						
						</div><!--/ .entry-image-->

					<?php endif; ?>
					<?php
					break;
			}
			?>

			<?php if (TMM::get_option("blog_single_show_all_metadata")) : ?>
				<div class="entry-meta">
					<?php if (TMM::get_option("blog_single_show_date")) : ?>
						<span class="date"><a href="<?php echo home_url() ?>/<?php echo get_the_date('Y/m') ?>"><?php echo get_the_date() ?></a></span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_single_show_category")) : ?>
						<?php $categories_list = get_the_category_list(__(', ', 'accio')); ?>
						<?php if (!empty($categories_list)) : ?>
							<span><?php _e('in', 'accio'); ?> <?php echo $categories_list ?></span>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_single_show_author")) : ?>
						<span><?php _e('by', 'accio'); ?> <?php the_author_link() ?></span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_single_show_comments")) : ?>
						<span><a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?></a> <?php _e('Comments', 'accio'); ?></span>
					<?php endif; ?>
				</div><!--/ .entry-meta-->
			<?php endif; ?>

			<h2 class="entry-title">
				<?php the_title(); ?>
			</h2><!--/ .entry-title-->

			<div class="entry-body">
				
				<?php the_content() ?>
				<?php
				if (class_exists('TMM_Ext_LayoutConstructor')) {
					TMM_Ext_LayoutConstructor::draw_front($post->ID);
				}
				?>
				
			</div><!--/ .entry-body-->

			<?php $tags = get_the_tag_list('', ' '); ?>
			<?php if (TMM::get_option("blog_single_show_tags") AND !empty($tags)) : ?>
				<span class="tags">
					<?php echo $tags ?>
				</span><!--/ .tags-->
			<?php endif; ?>

		</article><!--/ .entry-->

		<?php
		wp_link_pages(array(
			'before' => '<div class="single-post-nav clearfix">',
			'after' => '</div>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'next_or_number' => 'next_and_number', # activate parameter overloading
			'nextpagelink' => __('Next', 'accio'),
			'previouspagelink' => __('Previous', 'accio'),
			'pagelink' => '%',
			'echo' => 1)
		);
		?>

		<?php
		$next_post = get_next_post();
		$prev_post = get_previous_post();

		$next_post_url = "";
		$prev_post_url = "";

		if (is_object($next_post)) {
			$next_post_url = get_permalink($next_post->ID);
		}

		if (is_object($prev_post)) {
			$prev_post_url = get_permalink($prev_post->ID);
		}
		?>
		
		<?php if (!empty($prev_post_url) OR !empty($next_post_url)): ?>

			<div class="single-post-nav clearfix">

				<?php if (!empty($next_post_url)): ?>
					<a href="<?php echo $next_post_url ?>" class="prev" title="<?php _e("Previous post", 'accio') ?>"><?php _e("Prev", 'accio') ?></a>
				<?php endif; ?>

				<?php if (!empty($prev_post_url)): ?>
					<a href="<?php echo $prev_post_url ?>" class="next" title="<?php _e("Next post", 'accio') ?>"><?php _e("Next", 'accio') ?></a>
				<?php endif; ?>				

			</div><!--/ .single-post-nav-->
		
		<?php endif; ?>


		<?php if (TMM::get_option("blog_single_show_comments")): ?>
			<?php comments_template(); ?>
		<?php endif; ?>

		
		<?php if (TMM::get_option("blog_single_show_fb_comments")) : ?>   

			<div class="separator"></div>	
			<div class="fb-comments" data-href="<?php the_permalink() ?>" data-width=""></div>

		<?php endif; ?>

		<?php
	endwhile;
else:
	get_template_part('content', 'nothingfound');
endif;
?>

<?php get_footer(); ?>