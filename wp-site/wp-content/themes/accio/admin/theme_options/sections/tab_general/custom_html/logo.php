<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//$google_fonts = TMM_HelperFonts::get_google_fonts_list();
//$fonts = $google_fonts;
//$fonts = array_merge(array("" => ""), $fonts);
?>

<div class="option option-radio">
	
	<div class="controls">
		<input id="logotext" type="radio" class="showhide" data-show-hide="logo_text" name="logo_type" value="1" <?php echo(!TMM::get_option('logo_type') ? "checked" : "") ?> />
		<label for="logotext"><span></span><?php _e('Text', 'accio'); ?></label>
		<input id="logoimage" type="radio" class="showhide" data-show-hide="logo_img" name="logo_type" value="0" <?php echo(TMM::get_option('logo_type') ? "checked" : "") ?> />
		<label for="logoimage"><span></span><?php _e('Image', 'accio'); ?></label>&nbsp; &nbsp;
	</div><!--/ .controls-->
	
	<div class="explain"></div>
	
</div><!--/ .option-->	

<ul class="show-hide-items">

	<li class="logo_img" <?php echo (TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_img',
			'type' => 'upload',
			'default_value' => '',
			'description' => __('Upload your logo image here. Recommended dimensions: width <= 300px, height = any. Recommended image types: png, gif, jpg.', 'accio'),
			'id' => '',
		));
		?>

		<?php $logo_img = TMM::get_option('logo_img') ?>
		<div class="optional">
			<img id="logo_preview_image" style="display: <?php if ($logo_img): ?>inline<?php else: ?>none<?php endif; ?>; max-width:300px;" src="<?php echo $logo_img ?>" alt="logo" />
		</div>
		
	</li>
	<li class="logo_text" <?php echo(!TMM::get_option('logo_type') ? "" : 'style="display:none;"') ?>>
		
		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text',
			'title'=>__('Logo Name', 'accio'),
			'type' => 'text',
			'description' => __('Type your website name here, it will appear instead of your Logo in text format.', 'accio'),
			'default_value' => __('Accio', 'accio'),
			'css_class' => '',
		));
		?>
		
		<?php
		$logo_font_size = array();
		for ($i = 40; $i < 61; $i++) {
			$logo_font_size[$i] = $i;
		}
		
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font_size',
			'type' => 'select',
			'title'=> __('Logo Font Size', 'accio'),
			'description' => '',
			'values' => $logo_font_size,
			'default_value' => 44,
			'css_class' => '',
			'show_title' => true,
			'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_font',
			'title' => __('Logo Font Family', 'accio'),
			'type' => 'google_font_select',
			'description' => '',
			'default_value' => 'Julius+Sans+One:regular&subset=latin-ext,latin',
			'is_reset' => true
		));
		?>

		<?php
		TMM_OptionsHelper::draw_theme_option(array(
			'name' => 'logo_text_color',
			'title'=>__('Logo Text Color', 'accio'),
			'type' => 'color',
			'default_value' => '#232323',
			'description' => __('Can be applied for text logo only. Can not be used on One-Page page types', 'accio'),
			'css_class' => '',
			'is_reset' => true
		));
		?>
		
	</li>
</ul>
