<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

	<?php

		global $post;

		$meta = get_post_custom($post->ID);

		if (!empty($meta["thememakers_portfolio"][0]) AND is_serialized($meta["thememakers_portfolio"][0])) {
			$pictures = unserialize($meta["thememakers_portfolio"][0]);
		}
	?>

	<section class="section">

		<div class="container">

			<div class="row">

				<div class="col-xs-12">
					
					<div class="project-page-header">

						<h1 class="project-title"><?php echo the_title() ?></h1>

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

						<ul class="project-nav clearfix">
							<?php if (!empty($prev_post_url)): ?>
								<li><a class="prev" href="<?php echo $prev_post_url ?>"><?php _e("Prev", 'accio') ?></a></li>
							<?php endif; ?>
							<li><a class="all-projects" href="<?php echo TMM_Helper::get_folio_onepage() ?>"><?php _e("All Projects", 'accio') ?></a></li>
							<?php if (!empty($next_post_url)): ?>
								<li><a class="next" href="<?php echo $next_post_url ?>"><?php _e("Next", 'accio') ?></a></li>
							<?php endif; ?>
						</ul><!--/ .project-nav-->

					</div><!--/ .project-page-header-->

				</div>

			</div><!--/ .row-->

		</div><!--/ .container-->

		<div class="project-single-entry">

			<div class="image-slider">

				<?php if (!empty($pictures)): ?>
					<ul data-timeout="<?php echo $meta["portfolio_timeout"][0] ?>">
						<?php if (is_array($pictures)): ?>
							<?php foreach ($pictures as $source_url) : ?>
								<li>
									<?php if (TMM_Helper::get_media_type($source_url) == 'image'): ?>
										<img src="<?php echo TMM_Helper::resize_image($source_url, '') ?>" alt="" />
									<?php else: ?>
										<?php
											if (!empty($source_url)) {

												$video_type = 'youtube';
												$allows_array = array('youtube', 'vimeo');

												foreach ($allows_array as $key => $needle) {
													$count = strpos($source_url, $needle);

													if ($count !== FALSE) {
														$video_type = $allows_array[$key];
													}
												}

												 ?>
											<?php 
												echo do_shortcode('[tmm_video type="' . $video_type . '" width="1130" height="600"]' . $source_url . '[/tmm_video]');
											}
										?>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</div><!--/ .image-slider-->

		</div><!--/ .project-single-entry-->
		
		<div class="container">
			
			<div class="row">

				<div class="col-sm-3">

					<ul class="project-meta">

						<?php if (!TMM::get_option("single_folio_hide_date") AND !empty($meta["portfolio_date"][0])): ?>
							<li>
								<span class="project-meta-title"><?php _e("Date", 'accio') ?></span>
								<div class="project-meta-date"><?php echo $meta["portfolio_date"][0] ?></div>
							</li>
						<?php endif; ?>

						<?php $clients = get_the_term_list($post->ID, 'clients', '', ', ', '') ?>
						<?php if (!TMM::get_option("single_folio_hide_clients") AND !empty($clients)): ?>
							<li>
								<span class="project-meta-title"><?php _e("Client", 'accio') ?></span>
								<div class="project-meta-date"><?php echo $clients; ?></div>
							</li>
						<?php endif; ?>

						<?php $skills = get_the_term_list($post->ID, 'skills', '', ', ', '') ?>
						<?php if (!TMM::get_option("single_folio_hide_skills") AND !empty($skills)): ?>
							<li>
								<span class="project-meta-title"><?php _e("Skills", 'accio') ?>:</span>
								<div class="project-meta-date"><?php echo $skills; ?></div>
							</li>
						<?php endif; ?>

						<?php $tags = get_the_tag_list('', ', '); ?>
						<?php if (!TMM::get_option('single_folio_hide_tags') AND !empty($tags)): ?>
							<li>
								<span class="project-meta-title"><?php _e("Tags", 'accio') ?>:</span>
								<div class="project-meta-date"><?php echo $tags; ?></div>
							</li>
						<?php endif; ?>

						<?php if (!TMM::get_option('single_folio_hide_tools') AND !empty($meta["portfolio_tools"][0])): ?>
							<li>
								<span class="project-meta-title"><?php _e("Tools", 'accio') ?>:</span>
								<div class="project-meta-date"><?php echo $meta["portfolio_tools"][0] ?></div>
							</li>
						<?php endif; ?>

					</ul><!--/ .project-meta-->

					<?php if (!empty($meta["portfolio_url"][0])): ?>
						<a target="_blank" href="<?php echo $meta["portfolio_url"][0] ?>" class="button default">
							<?php if (!empty($meta["portfolio_url"][0])): ?>
								<?php echo $meta["portfolio_url_title"][0] ?>
							<?php else: ?>
								<?php _e('View Project', 'accio'); ?>
							<?php endif; ?>
						</a>
					<?php endif; ?>

				</div>

				<div class="col-sm-9">
					<?php the_content() ?>
					<?php if (class_exists('TMM_Ext_LayoutConstructor')) TMM_Ext_LayoutConstructor::draw_front($post->ID); ?>
				</div>

			</div><!--/ .row-->	
			
			<div class="row">
				<div class="col-xs-12">
					<div class="divider"></div>
				</div>
			</div><!--/ .row-->
			
			<?php if (TMM::get_option('folio_show_related_works')): ?>

				<div class="row">

					<div class="col-xs-12">

						<h2 class="content-title"><?php _e("Related Projects", 'accio') ?></h2>

						<?php
						$tags = wp_get_post_tags($post->ID);
						$tag_ids = array();

						if ($tags) {
							foreach ($tags as $tag_item)
								$tag_ids[] = $tag_item->term_id;
						}

						$query = new WP_Query(array(
							'tag__in' => $tag_ids,
							'post_type' => TMM_Portfolio::$slug,
							'post__not_in' => array($post->ID),
							'showposts' => 5
						));
						?>

					</div>

				</div><!--/ .row-->

			<?php endif; ?>
			
		</div><!--/ .container-->

		<div class="project-similar full-width">
			<ul>
				<?php

				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
						?>
						<li>
							<div class="work-item">
								<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '511*375'); ?>" alt="" />
								<div class="image-extra">
									<div class="extra-content">
										<div class="inner-extra">
											<a href="<?php the_permalink(); ?>" class="single-image link-icon"></a>
											<a href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>" data-fancybox-group="related" class="single-image plus-icon"></a>	
										</div><!--/ .inner-extra-->	
									</div><!--/ .extra-content-->
								</div><!--/ .image-extra-->	
							</div><!--/ .work-item-->		
						</li>
						<?php
					endwhile;
				endif;
				?>
			</ul>
		</div><!--/ .project-similar-->

		<?php wp_reset_query(); ?>

	</section><!--/ .section-->

