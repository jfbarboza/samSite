<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$active_extencions = array(
	'sliders',
	'demo'
);
foreach ($active_extencions as $value) {
	include_once TMM_EXT_PATH . '/' . $value . '/index.php';
}

