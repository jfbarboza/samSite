<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
echo do_shortcode('[portfolio posts_per_page="' . TMM::get_option('folio_archive_per_page') . '"][/portfolio]');

