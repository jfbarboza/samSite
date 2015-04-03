<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_testimonials">

	<?php
	
		TMM_Functions::enqueue_script('cycle');

		$args = array(
			'post_type' => TMM_Testimonials::$slug,
			'p' => $instance['post_id'],
		);

		$query = new WP_Query($args);

	?>

	<?php if ($instance['title'] != '') : ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>

	<div class="quotes">

		<?php
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
				?>

				<li>
					<blockquote class="quote-text"><?php the_content(); ?></blockquote><!--/ .quote-text-->
					<div class="quote-author"><?php the_title(); ?>, <?php echo get_post_meta(get_the_ID(), 'position', true) ?></div>
				</li>

				<?php
			endwhile;
		endif;
		wp_reset_query();
		?>

	</div><!--/ .quotes-->

</div><!--/ .widget-testimonials-->



