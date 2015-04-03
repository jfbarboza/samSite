<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="column opacity<?php if ($featured == 1) echo ' featured' ?>">

	<header class="header">
		<h5 class="title"><?php echo $title ?></h5>
	</header><!-- .header -->

	<div class="price">
		<h2 class="cost"><?php echo $price ?></h2>
		<span class="description"><?php echo $period ?></span>				
	</div><!--/ .price-->
	
	<?php $content = explode('^', $content); ?>
	
	<?php if (!empty($content)): ?>
	
		<ul class="features">
			<?php foreach ($content as $text): ?>
				<li><?php echo $text ?></li>
			<?php endforeach; ?>
		</ul><!-- .features -->
		
	<?php endif; ?>

	<footer class="footer">
		<a class="button default" href="<?php echo $button_link ?>"><?php echo $button_text ?></a>
	</footer><!-- .footer -->

</div><!-- .column -->

