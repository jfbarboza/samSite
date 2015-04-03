<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_general/tab_general.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_styling/tab_styling.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_sliders/tab_sliders.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_blog/tab_blog.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_portfolio/tab_portfolio.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_contact_forms/tab_contact_forms.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_custom_sidebars/tab_custom_sidebars.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_seo/tab_seo.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_footer/tab_footer.php';

if (is_plugin_active('tmm_db_migrate/index.php')) {                
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_plugins/tab_plugins.php';
}

?>
<script type="text/javascript">var tmm_options_reset_array = [];</script>

<form id="theme_options" name="theme_options" method="post" style="display: none;">
	<section class="admin-container clearfix">

		<header id="title-bar" class="clearfix">

			<a href="#" class="admin-logo">
				<img src="<?php echo TMM_THEME_URI ?>/admin/theme_options/images/admin-logo.png" alt="" />
			</a>
			<span class="fw-version">framework v.<?php echo TMM_FRAMEWORK_VERSION ?></span>

		</header><!--/ #title-bar-->

		<section class="set-holder clearfix">

			<ul class="support-links">
				<li><a class="support-docs" href="<?php echo TMM_THEME_LINK ?>" target="_blank"><?php _e('View Theme Docs', 'accio'); ?></a></li>
				<li><a class="support-forum" href="<?php echo TMM_THEME_FORUM_LINK ?>" target="_blank"><?php _e('Visit Forum', 'accio'); ?></a></li>
			</ul><!--/ .support-links-->

			<div class="button-options">
				<a href="#" class="admin-button button-yellow button-options button_reset_options"><?php _e('Reset All Options', 'accio'); ?></a>
				<a href="#" class="admin-button button-yellow button-options button_save_options"><?php _e('Save All Changes', 'accio'); ?></a>
			</div><!--/ .button-options-->

		</section><!--/ .set-holder-->

		<div class="framework-container clearfix">

			<aside id="admin-aside">

				<ul class="admin-nav">
					
					<?php foreach (TMM_OptionsHelper::$sections as $section_key => $section) : ?>

						<?php if (!empty($section['child_sections'])): ?>
					
							<li>
								<?php if ($section['show_general_page']): ?>
									<a class="<?php echo $section['css_class'] ?>" href="#<?php echo $section_key ?>">
										<i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
										<?php echo $section['name'] ?>
									</a>
								<?php else: ?>
								
									<?php
									reset($section['child_sections']);
									$first_child_section_key = key($section['child_sections']);
									?>
									<a class="<?php echo $section['css_class'] ?>" href="#<?php echo $first_child_section_key ?>">
										<i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
										<?php echo $section['name'] ?>
									</a>
									
								<?php endif; ?>

									<ul>
										<?php if ($section['show_general_page']): ?>
											<li><a href="#<?php echo $section_key ?>"><?php _e('General', 'accio'); ?></a></li>
										<?php endif; ?>

										<?php foreach ($section['child_sections'] as $child_section_key => $child_section) : ?>
											<li><a href="#<?php echo $child_section_key ?>"><?php echo $child_section['name'] ?></a></li>
										<?php endforeach; ?>
									</ul>
									
							</li>
							
						<?php else: ?>
							
							<li>
								<a class="<?php echo $section['css_class'] ?>" href="#<?php echo $section_key ?>">
									<i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
									<?php echo $section['name'] ?>
								</a>
							</li>
							
						<?php endif; ?>

					<?php endforeach; ?>

				</ul><!--/ .admin-nav-->

			</aside><!--/ #admin-aside-->

			<section id="options-framework" class="clearfix">

				<?php foreach (TMM_OptionsHelper::$sections as $section_key => $section) : ?>
					<?php if ($section['show_general_page']): ?>
						<div id="<?php echo $section_key ?>" class="section-tab">
							<h1 class="section-tab-title"><?php echo $section['name'] ?></h1>

							<?php foreach ($section['content'] as $item_key => $item) : ?>

								<div class="section">

									<?php if ($item['type'] != 'checkbox'): ?>
										<h2 class="section-title"><?php echo $item['title']; ?></h2>
									<?php endif; ?>

									<?php
									if (($item['type'] == 'items_block')) {
										foreach ($item['items'] as $block_item_key => $block_item) {
											tmm_print_options_item($block_item_key, $block_item);
										}
									} else {
										tmm_print_options_item($item_key, $item);
									}
									?>

								</div><!--/ .section-->

							<?php endforeach; ?>

						</div><!--/ .section-tab-->
					<?php endif; ?>

					<?php if (!empty($section['child_sections'])): ?>
						<?php foreach ($section['child_sections'] as $child_section_key => $child_section) : ?>
							<div id="<?php echo $child_section_key ?>" class="section-tab">

								<h1 class="section-tab-title"><?php echo $child_section['name'] ?></h1>

								<?php foreach ($child_section['sections'] as $item_key => $item) : ?>

									<div class="section">

										<?php if ($item['type'] != 'checkbox'): ?>
											<h2 class="section-title"><?php echo $item['title']; ?></h2>
										<?php endif; ?>
											
										<?php
										if (($item['type'] == 'items_block')) {
											foreach ($item['items'] as $block_item_key => $block_item) {
												tmm_print_options_item($block_item_key, $block_item);
											}
										} else {
											tmm_print_options_item($item_key, $item);
										}
										?>

									</div><!--/ .section-->

								<?php endforeach; ?>

							</div>
						<?php endforeach; ?>
					<?php endif; ?>

				<?php endforeach; ?>

				<div class="admin-group-button clearfix">
					<a class="admin-button button-yellow align-left button_reset_options" href="#"><?php _e('Reset All Options', 'accio'); ?></a>
					<a class="admin-button button-yellow align-right button_save_options" href="#"><?php _e('Save All Changes', 'accio'); ?></a>
				</div>

			</section><!--/ #admin-content-->

		</div>

	</section><!--/ .admin-container-->
</form>

<?php

function tmm_print_options_item($item_key, $item) {
	switch ($item['type']) {
		case 'textarea':
		case 'text':
		case 'google_font_select':
		case 'color':
		case 'upload':
		case 'checkbox':
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => $item_key,
				'title' => $item['title'],
				'type' => $item['type'],
				'default_value' => $item['default_value'],
				'description' => $item['description'],
				'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
				'css_class' => (isset($item['css_class']) ? $item['css_class'] : '')
			));
			break;
		case 'select':
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => $item_key,
				'title' => $item['title'],
				'type' => 'select',
				'default_value' => $item['default_value'],
				'values' => $item['values'],
				'description' => $item['description'],
				'show_title' => (isset($item['show_title']) ? $item['show_title'] : false),
				'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
				'css_class' => (isset($item['css_class']) ? $item['css_class'] : '')
			));
			break;
		case 'slider':
			TMM_OptionsHelper::draw_theme_option(array(
				'name' => $item_key,
				'title' => $item['title'],
				'type' => 'slider',
				'default_value' => $item['default_value'],
				'description' => $item['description'],
				'min' => $item['min'],
				'max' => $item['max'],
				'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
				'show_title' => (isset($item['show_title']) ? $item['show_title'] : false),
				'css_class' => (isset($item['css_class']) ? $item['css_class'] : '')
			));
			break;
                case 'tmm_db_migrate':
                   // echo $item['html'];
                    break;
		default:
			break;
	}

	echo $item['custom_html'];
}
