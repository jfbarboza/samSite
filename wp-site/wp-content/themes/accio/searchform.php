<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<p>
		<input type="text" name="s" value="<?php echo(isset($_GET['s']) ? $_GET['s'] : ''); ?>" />
		<button type="submit" class="submit-search"><?php _e('Search', 'accio') ?></button>	
	</p>
</form>

