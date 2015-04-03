<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>


<!-- - - - - - - - - - - - Pagination - - - - - - - - - - - - - - -->


<?php global $wp_query; ?>
<?php if ($wp_query->query_vars['posts_per_page'] < $wp_query->found_posts): ?>

	<div class="pagenavi">

		<?php
		if (true) {
			TMM_Helper::pagenavi();
		} else {
			wp_link_pages();
		}

		wp_reset_query();
		?>

	</div><!--/ .pagenavi -->
	
<?php endif; ?>
<!-- - - - - - - - - - - end Pagination - - - - - - - - - - - - - -->
