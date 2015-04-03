<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

	<div class="template-taxonomy-skills">
		
		<?php
		
			get_template_part( 'loop/loop', 'taxonomy-skills' );
			get_template_part( 'content', 'pagenavi' ); 
		
		?>
		
	</div><!--/ .template-archive-->

<?php get_footer(); ?>