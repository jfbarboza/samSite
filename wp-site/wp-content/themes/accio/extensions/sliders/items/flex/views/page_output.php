<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php

wp_enqueue_script('tmm_flexslider', TMM_Ext_Sliders::get_application_uri() . '/items/flex/js/jquery.flexslider-min.js');
//wp_enqueue_style("tmm_flexslider_css", TMM_Ext_Sliders::get_application_uri() . '/items/flex/css/styles.css');
?>
<!-- I cant call it by wp_enqueue_style because its going after header but must be there -->
<link rel="stylesheet" href="<?php echo TMM_Ext_Sliders::get_application_uri() ?>/items/flex/css/styles.css" />

<script>
	
	jQuery(function() {
		
		(function() {

			var $flex = jQuery('.flexslider');

			if ( $flex.length ) {

				jQuery(window).load(function() {
					$flex.flexslider({
						animation: "<?php echo $options['animation'] ?>",
						slideshow: <?php echo ($options['slideshow'] ? 'true' : 'false') ?>,
						controlNav: <?php echo ($options['controlnav'] ? 'true' : 'false') ?>,
						slideshowSpeed: <?php echo $options['slideshow_speed'] ?>,
						animationSpeed: <?php echo $options['animation_speed'] ?>,
						initDelay: <?php echo $options['init_delay'] ?>,
						directionNav: <?php echo $options['directionNav'] ?>,
						direction: '<?php echo $options['direction'] ?>'
					});
				});

			}

		})();
		 
	});
	
</script>


<?php if (!empty($slides)): ?>

	<div class="slider">
		
		<div class="sixteen columns">
			
			<div class="flexslider">

				<ul class="slides">

					<?php foreach ($slides as $slide_num => $slide) : ?>

						<?php
						if (!isset($alias) OR empty($alias)) {
							$alias = "940*520";
						}
						//***
						$slide_url = TMM_Helper::get_image($slide['imgurl'], $alias);
						$slide_description_font_family = $slide['flex']['field_values']['description']['font_family'];
						$slide_description_font_size = $slide['flex']['field_values']['description']['font_size'];
						$slide_description_font_color = $slide['flex']['field_values']['description']['font_color'];

						$style = "";
						if (!empty($slide_description_font_family)) {
							$style.='font-family:' . $slide_description_font_family . ';';
						}

						if (!empty($slide_description_font_size)) {
							$style.='font-size:' . $slide_description_font_size . 'px;';
						}

						if (!empty($slide_description_font_color)) {
							$style.='color:' . $slide_description_font_color . ';';
						}
						?>

						<li>
							<img src="<?php echo $slide_url ?>" alt="" />

							<?php if (!empty($slide['flex']['description'])): ?>
								<div class="flex-caption">
									<?php if (!empty($slide['flex']['url'])): ?>
										<a href="<?php echo $slide['flex']['url'] ?>"><h4 <?php if (!empty($style)): ?>style="<?php echo $style ?>"<?php endif; ?>><?php echo $slide['flex']['description'] ?></h4></a>
									<?php else: ?>
										<h4 <?php if (!empty($style)): ?>style="<?php echo $style ?>"<?php endif; ?>><?php echo $slide['flex']['description'] ?></h4>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</li>

					<?php endforeach; ?>

				</ul><!--/ .slides-->

			</div><!--/ .flexslider-->
			
		</div>

	</div><!--/ .slider-->

<?php endif; ?>
