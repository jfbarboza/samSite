<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
wp_enqueue_script('tmm_superslides', TMM_Ext_Sliders::get_application_uri() . '/items/superslides/js/jquery.superslides.min.js');
?>

<script type="text/javascript">

	jQuery(function() {

		if (jQuery('#slides').length) {
			jQuery('#slides').superslides({
				play: <?php echo $options['play'] ?>, // Milliseconds before progressing to next slide automatically. Use a falsey value to disable.
				animation: '<?php echo $options['animation'] ?>', // Choose between slide or fade
				animation_speed: <?php echo $options['animation_speed'] ?>, // Animation speed.
				animation_easing: 'easeInOutQuint'
			});
		}
	});

</script>

<?php if (!empty($slides)): ?>

	<div id="slides">
		<ul class="slides-container">
			<?php foreach ($slides as $slide_num => $slide) : ?>
				<?php
				
				if (!isset($alias) OR empty($alias)) {
					$alias = "2045*950";
				}
				
				$slide_url = TMM_Helper::get_image($slide['imgurl'], $alias);
				
				?>
				<li>
					<div style="background-image: url('<?php echo $slide_url ?>');" class="fullscreen-image">
						<div class="parallax-overlay"></div>
						<?php if (!empty($slide['superslides']['description'])): ?>
							<div class="header-text-entry">
								<div class="header-text">
									<h1><?php echo $slide['superslides']['description'] ?></h1>
								</div>	
							</div><!--/ .header-text-entry-->
						<?php endif; ?>
					</div><!--/ .fullscreen-image-->
				</li>
			<?php endforeach; ?>
		</ul>

		<nav class="slides-navigation">
			<a href="#" class="prev">1</a>
			<a href="#" class="next">2</a>
		</nav>

	</div><!--/ #slides-->

<?php endif; ?>
