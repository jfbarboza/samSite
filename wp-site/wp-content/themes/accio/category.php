<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

	<div class="template-category">
		
		<?php
		
			get_template_part( 'loop/loop', 'category' );
			get_template_part( 'content', 'pagenavi' ); 
		
		?>
		
	</div><!--/ .template-category-->

<?php get_footer(); ?>
