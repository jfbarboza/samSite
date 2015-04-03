<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$staff = explode('^', $staff);
?>

<div class="team-member">

	<div class="team-contents clearfix">

		<?php foreach ($staff as $post_id) : ?><?php $custom = TMM_Staff::get_meta_data($post_id); ?>

			<article class="<?php if ($animation) echo $animation ?>">

				<div class="contents clearfix">

					<div class="team-info">

						<div class="team-image">
							<a class="single-image team-plus-icon" href="#"><img src="<?php echo TMM_Helper::get_post_featured_image($post_id, '252*270') ?>" alt="" /></a>
						</div>

						<hgroup class="team-group">
							<h2 class="team-title"><?php echo get_the_title($post_id); ?></h2>
							<h5 class="team-position"><?php
								$post_categories = wp_get_post_terms($post_id, 'position', array("fields" => "names"));
								if (!empty($post_categories)) {
									foreach ($post_categories as $key => $value) {
										if ($key > 0) {
											echo ' / ';
										}
										echo $value;
									}
								}
								?>
							</h5>
						</hgroup>

					</div><!--/ .team-info-->

					<div class="team-content">
						<div class="team-entry">

							<p><?php echo substr(get_post($post_id)->post_excerpt, 0, 468); ?></p>	

							<ul class="social-icons">
								<?php if (!empty($custom["twitter"])): ?>
									<li class="twitter"><a target="_blank" href="<?php echo $custom["twitter"] ?>"><i class="icon-twitter"></i>Twitter</a></li>
								<?php endif; ?>
								<?php if (!empty($custom["facebook"])): ?>
									<li class="facebook"><a target="_blank" href="<?php echo $custom["facebook"] ?>"><i class="icon-facebook"></i>Facebook</a></li>
								<?php endif; ?>
								<?php if (!empty($custom["linkedin"])): ?>
									<li class="linkedin"><a target="_blank" href="<?php echo $custom["linkedin"] ?>"><i class="icon-linkedin"></i>LinkedIn</a></li>
								<?php endif; ?>
								<?php if (!empty($custom["dribbble"])): ?>
									<li class="dribbble"><a target="_blank" href="<?php echo $custom["dribbble"] ?>"><i class="icon-dribbble"></i>Dribbble</a></li>
								<?php endif; ?>
								<?php if (!empty($custom["instagram"])): ?>
									<li class="instagram"><a target="_blank" href="<?php echo $custom["instagram"] ?>"><i class="icon-instagram"></i>Instagram</a></li>
								<?php endif; ?>
							</ul><!--/ .social-icons-->

						</div><!--/ .team-entry-->
					</div><!--/ .team-content-->				

				</div><!--/ .contents-->

			</article>

		<?php endforeach; ?>

	</div><!--/ .team-contents-->
	
</div><!--/ .team-member-->


