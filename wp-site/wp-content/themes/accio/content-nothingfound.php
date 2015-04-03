<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<article class="not-found">

	<header class="entry-header">
		<h2 class="entry-title"><?php __('Nothing Found', 'accio'); ?></h2>
	</header><!-- .entry-header -->

	<p>
		<?php __('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'accio'); ?>
	</p>
	
	<?php get_search_form(); ?>
	
</article><!--/ .not-found-->
