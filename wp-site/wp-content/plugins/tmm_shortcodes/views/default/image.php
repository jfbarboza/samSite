<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$image_url = $content;
$styles = "";
$html = "";
$css_class = '';

	// Margins
	if (!empty($margin_left))   { $styles .= 'margin-left: ' . (int) $margin_left . 'px; '; }
	if (!empty($margin_right))  { $styles .= 'margin-right: ' . (int) $margin_right . 'px; '; }
	if (!empty($margin_top))    { $styles .= 'margin-top: ' . (int) $margin_top . 'px; '; }
	if (!empty($margin_bottom)) { $styles .= 'margin-bottom: ' . (int) $margin_bottom . 'px; '; }
	
	// Styles
	if (!empty($styles)) { $styles = 'style="' . $styles . '"'; }
	
	// Link Start
	if ($action == "link") {
		$html .= '<a title="' . $link_title . '" class="single-image link-icon" href="' . $image_action_link . '" target="' . $target . '">';
	}
	
	if (!empty($align))     { $css_class .= $align . ' '; }
	if (!empty($animation)) { $css_class .= $animation;   }
	if (!empty($css_class)) { $css_class = 'class="' . $css_class . '"'; }

		$src = TMM_Helper::resize_image($image_url, $image_size_alias);
		$html.= '<img '. $css_class .' alt="' . $image_alt . '" '. $styles .' src="' . $src . '" />';
	
	// Link End
	if ($action == "link") { $html .= '</a>'; }

echo $html;