<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

	<div class="template-search">
		
		<?php
		
			if (!empty($_GET['s'])) {
				get_template_part( 'loop/loop', 'search' );
				get_template_part( 'content', 'pagenavi' ); 
			}
		
		?>
		
	</div><!--/ .template-search-->

<?php get_footer(); ?>