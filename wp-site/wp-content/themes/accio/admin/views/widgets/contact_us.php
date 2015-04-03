<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_contact_us">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo $instance['title']; ?></h3>
	<?php endif; ?>

	<ul class="contact-details">
		<?php if (!empty($instance['address'])): ?>
			<li class="contact-icon-address">
				<span>Address:</span> <?php echo $instance['address']; ?>
			</li>
		<?php endif; ?>

		<?php if (!empty($instance['phone'])): ?>
			<li class="contact-icon-phone">
				<span>Phone:</span> <?php echo $instance['phone']; ?>
			</li>
		<?php endif; ?>

		<?php if (!empty($instance['email'])): ?>
			<li class="contact-icon-email">
				<span>Email:</span> <a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
			</li>	
		<?php endif; ?>	
	</ul><!--/ .contact-details-->

</div><!--/ .widget-container-->