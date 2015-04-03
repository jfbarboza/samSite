<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php if (!empty($onepage) AND is_array($onepage)): ?>	
	<?php foreach ($onepage as $page_id) : ?>
		<section class="page" id="<?php echo TMM_Helper::parseUrl(get_permalink($page_id)); ?>">
			<?php TMM_Ext_LayoutConstructor::draw_front($page_id, TRUE); ?>
		</section>
	<?php endforeach; ?>
<?php endif;


