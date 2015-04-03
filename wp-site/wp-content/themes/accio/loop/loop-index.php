<?php
$show_post_metadata = TMM::get_option("blog_listing_show_all_metadata");
if (isset($_REQUEST['shortcode_show_metadata'])) {
	$show_post_metadata = $_REQUEST['shortcode_show_metadata'];
}
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("entry main-entry"); ?>>

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

				 ?>

				<div class="quote-inner">

					<a href="<?php the_permalink() ?>" class="whole-link"></a>

					<?php 
					   echo do_shortcode('[blockquote type="type-1" align=""]' . $post_type_values[$post_pod_type] . '[/blockquote]');
					?>

					<?php if ($show_post_metadata): ?>
						<div class="entry-meta">
							<?php if (TMM::get_option("blog_listing_show_date")) : ?>
								<span class="date"><a href="<?php echo home_url() ?>/<?php echo get_the_date('Y/m') ?>"><?php echo get_the_date() ?></a></span>
							<?php endif; ?>

							<?php if (TMM::get_option("blog_listing_show_category")) : ?>
								<?php $categories_list = get_the_category_list(__(', ', 'accio')); ?>
								<?php if (!empty($categories_list)) : ?>
									<span><?php _e('in', 'accio'); ?> <?php echo $categories_list ?></span>
								<?php endif; ?>
							<?php endif; ?>

							<?php if (TMM::get_option("blog_listing_show_author")) : ?>
								<span><?php _e('by', 'accio'); ?> <?php the_author_link() ?></span>
							<?php endif; ?>

							<?php if (TMM::get_option("blog_single_show_comments")) : ?>
								<span><a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?></a> <?php _e('Comments', 'accio'); ?></span>
							<?php endif; ?>
						</div><!--/ .entry-meta-->
					<?php endif; ?>	

				</div><!--/ .quote-inner-->


				<?php 

				break;

			case 'gallery':
				TMM_Functions::enqueue_script('cycle');
				$gall = $post_type_values[$post_pod_type];
				?>

				<?php if (!empty($gall)): ?>

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
													<a class="single-image link-icon" href="<?php the_permalink() ?>"></a>
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

							<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '740*470'); ?>" alt="<?php echo $post->post_title ?>" />

							<div class="image-extra">

								<div class="extra-content">

									<div class="inner-extra">
										<a class="single-image link-icon" href="<?php the_permalink() ?>"></a>
										<a class="single-image plus-icon" data-fancybox-group="blog" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, '') ?>"></a>
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

		<?php if ($post_pod_type != 'quote'): ?>

			<?php if ($show_post_metadata): ?>
				<div class="entry-meta">
					<?php if (TMM::get_option("blog_listing_show_date")) : ?>
						<span class="date"><a href="<?php echo home_url() ?>/<?php echo get_the_date('Y/m') ?>"><?php echo get_the_date() ?></a></span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_listing_show_category")) : ?>
						<?php $categories_list = get_the_category_list(__(', ', 'accio')); ?>
						<?php if (!empty($categories_list)) : ?>
							<span><?php _e('in', 'accio'); ?> <?php echo $categories_list ?></span>
						<?php endif; ?>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_listing_show_author")) : ?>
						<span><?php _e('by', 'accio'); ?> <?php the_author_link() ?></span>
					<?php endif; ?>

					<?php if (TMM::get_option("blog_single_show_comments")) : ?>
						<span><a href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?></a> <?php _e('Comments', 'accio'); ?></span>
					<?php endif; ?>
				</div><!--/ .entry-meta-->
			<?php endif; ?>

			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h2><!--/ .entry-title-->

			<div class="entry-body">
				<p>
					<?php
					if (TMM::get_option("excerpt_symbols_count")) {
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
					} else {
						echo do_shortcode($post->post_excerpt);
					}
					?>
				</p>
			</div><!--/ .entry-body-->

			<a href="<?php the_permalink() ?>" class="button default"><?php _e('Read More', 'accio'); ?></a>

			<?php $tags = get_the_tag_list('', ' '); ?>

			<?php if (TMM::get_option("blog_listing_show_tags") AND !empty($tags)) : ?>
				<span class="tags">
					<?php echo $tags ?>
				</span><!--/ .tags-->
			<?php endif; ?>						

		<?php endif; ?>

	</article><!--/ .entry-->

<?php endwhile;
else:
	get_template_part('content', 'nothingfound');
endif;
?>