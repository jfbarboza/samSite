
<?php if (have_posts()): 
	
	echo '<ul class="portfolio-items">';
	
	while (have_posts()): the_post(); ?>

		<li class="mix_all">

			<div class="work-item">

				<img src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '511*375'); ?>" alt="" />

				<div class="image-extra">

					<div class="extra-content">

						<div class="inner-extra">

							<h2 class="extra-title"><?php the_title(); ?></h2>

							<h6 class="extra-category">
								<?php
								$cats = wp_get_post_terms($post->ID, 'folio_category');
								foreach ($cats as $key => $value) {
									if ($key > 0) {
										echo ' / ';
									}
									echo $value->name;
								}
								?>
							</h6>

							<a class="single-image link-icon" href="<?php the_permalink(); ?>">Permalink</a>
							<a class="single-image plus-icon" data-fancybox-group="folio" href="<?php echo TMM_Helper::get_post_featured_image($post->ID, ''); ?>">Image</a>							

						</div><!--/ .inner-extra-->

					</div><!--/ .extra-content-->

				</div><!--/ .image-extra-->

			</div><!--/ .work-item-->

		</li><!--/ .mix-->

<?php endwhile;

	echo '</ul>';

endif; ?>
