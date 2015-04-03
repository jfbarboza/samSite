<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

	<?php 
	
		if (isset($_GET['s']) && empty($_GET['s'])) {

			echo "<h4>" . __('New Search', 'accio') . "</h4>";
			echo "<p>" . __('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'accio') . "</p>";
			
			get_search_form();

		} else {
			get_template_part( 'loop/loop', 'index' );
			get_template_part( 'content', 'pagenavi' );
			
		}
		wp_reset_query();
	?>

<?php get_footer(); ?>