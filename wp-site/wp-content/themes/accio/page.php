<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>


<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php if (!isset($_REQUEST['is_onepage'])): ?>

		<?php
			$show_page_title = get_post_meta($post->ID, 'show_page_title', true);
		?>

		<section class="section <?php if (!$show_page_title): ?> padding-off<?php else: ?> padding-bottom-off<?php endif; ?><?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'): ?> padding-top-off<?php endif; ?>">
			
			<div class="container">

				<?php if ($_REQUEST['sidebar_position'] == 'no_sidebar'): ?>
				
					<?php if ($show_page_title): ?>
						<?php echo TMM_Helper::page_title($post); ?>
					<?php endif; ?>
				
				<?php endif; ?>

				<div class="row">

					<div class="col-md-12">
						<?php the_content(); ?>
					</div>

				</div><!--/ .row-->

			</div><!--/ .container-->
		
		</section><!--/ .section-->

	<?php endif; ?>
		
	<?php
	
	if (class_exists('TMM_Ext_LayoutConstructor')) {
		if (isset($_REQUEST['is_onepage'])) {
			TMM_Onepage::draw_onepage($_REQUEST['is_onepage']);
		} else {
			TMM_Ext_LayoutConstructor::draw_front(get_the_ID());
		}
	}
	
endwhile;
endif;

?>

		
<!-- - - - - - - - - - - - end Entry - - - - - - - - - - - - - - -->


<?php get_footer(); ?>
