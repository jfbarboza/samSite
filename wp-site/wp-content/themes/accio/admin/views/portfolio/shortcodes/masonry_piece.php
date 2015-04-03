<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$folioposts_array = explode('^', $folioposts);

if(!isset($folioposts_array[$foliopost_key])){
	return;
}

if (!empty($folioposts_array)) {
	$foliopost = $folioposts_array[$foliopost_key];
} else {
	return "";
}
//***
$images = get_post_meta($foliopost, 'thememakers_portfolio', true);
if (!empty($images)) {
	foreach ($images as $k => $img) {
		if (!TMM_Helper::is_file_url_exists($img)) {
			unset($images[$k]);
		}
	}
}
//***
$current_col_algoritm_arr = explode(',', $current_col_algoritm);
$current_col_algoritm_arr = array_reverse($current_col_algoritm_arr);

//***
if ($columns == 3) {
	$columns_img_sizes = array('col1' => '300*190', 'col2' => '300*250', 'col3' => '300*310');
}

if ($columns == 4) {
	$columns_img_sizes = array('col1' => '228*170', 'col2' => '228*250', 'col3' => '228*340');
}
//***

$counter = 0;
?>

<?php if (!empty($images)): ?>
	<?php foreach ($images as $image): ?>
		<?php
		$col = $current_col_algoritm_arr[$counter];
		$counter++;
		if ($counter >= count($current_col_algoritm_arr))
			$counter = 0;
		?>
		<article class="box <?php echo $col ?> masonry_piece_<?php echo $foliopost_key ?>" style="opacity: 0">
			<div class="work-item">
				<img src="<?php echo TMM_Helper::resize_image($image, $columns_img_sizes[$col]) ?>" alt="" />

				<div class="image-extra">

					<div class="extra-content">
						
						<div class="inner-extra">
					
							<a class="single-image link-icon" href="<?php echo get_permalink($foliopost) ?>">Permalink</a>
							<a class="single-image plus-icon" data-fancybox-group="masonry" href="<?php echo $image ?>">Image</a>		

						</div>
	
					</div><!--/ .extra-content-->	

				</div><!--/ .image-extra-->
			</div>
		</article><!--/ .box-->
	<?php endforeach; ?>	
<?php endif; ?>
<?php if (!empty($folioposts_array) AND isset($folioposts_array[$foliopost_key + 1])): ?>
	<?php $current_col_algoritm = implode(',', $current_col_algoritm_arr); ?>
	<div id="masonryjaxloader" data-next-post-key="<?php echo($foliopost_key + 1) ?>" data-posts="<?php echo $folioposts ?>" data-col-algoritm="<?php echo $current_col_algoritm ?>"></div>
<?php endif; ?>
