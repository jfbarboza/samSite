<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php

		global $post;

		$single_page_layout = get_post_meta($post->ID, 'single_page_layout', TRUE);
		if (empty($single_page_layout)) {
			$single_page_layout = 1;
		}

		switch ($single_page_layout): 
			case 1:
				get_template_part('single-folio', 'default');
			break;
			case 2:
				get_template_part('single-folio', 'fullwidth');
			break;
			case 3:
				get_template_part('single-folio', 'alt');
			break;
			default: 1;
			break;
		endswitch;

	endwhile;
endif;
?>
<?php get_footer(); ?>