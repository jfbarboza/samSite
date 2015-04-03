<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!DOCTYPE html>
<!--[if lte IE 8]>              <html class="ie8 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>					<html class="ie9 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if !(IE)]><!-->			<html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>

	<!-- Google Web Fonts
	================================================== -->
	<?php echo TMM_HelperFonts::get_google_fonts_link() ?>
	
	<!-- Basic Page Needs
	================================================== -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<?php get_template_part('header', 'seocode'); ?>	

	<!-- Favicons
	================================================== -->
	<?php 
		$favicon = TMM::get_option("favicon_img");
		$apple_touch_icon = TMM::get_option("apple_touch_icon");
		$apple_touch_icon_72x72 = TMM::get_option("apple_touch_icon_72x72");
		$apple_touch_icon_114x114 = TMM::get_option("apple_touch_icon_114x114");
	?>

	<?php if ($favicon): ?> 
		<link rel="shortcut icon" href="<?php echo $favicon; ?>">
	<?php endif; ?>
		
	<?php if ($apple_touch_icon): ?>
		<link rel="apple-touch-icon" href="<?php echo $apple_touch_icon ?>">
	<?php endif; ?>
		
	<?php if ($apple_touch_icon_72x72): ?>
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $apple_touch_icon_72x72 ?>">
	<?php endif; ?>

	<?php if ($apple_touch_icon_114x114): ?>
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $apple_touch_icon_114x114 ?>">
	<?php endif; ?>
		
	<!-- Mobile Specific Metas
	 ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<style type="text/css" media="print">#wpadminbar { display: none; }</style>
	
	<?php if (!isset($content_width)) $content_width = 1170; ?>
		
	<?php echo TMM::get_option("tracking_code"); ?>
        
        <?php wp_head(); ?>
</head>

	<?php
		$page_id = 0;
		$onepage_id = 0;
		$onepage_options = array();

		if (is_single() OR is_page() OR is_front_page()) {
			global $post;
			$page_id = $post->ID;
		}

		if (is_page() OR is_front_page()) {
			$onepage_id = (int) get_post_meta($post->ID, 'onepage', true);
			
			if ($onepage_id) {
				$_REQUEST['sidebar_position'] = 'no_sidebar';
				$_REQUEST['is_onepage'] = $onepage_id;
				$onepage_options['bg_video'] = get_post_meta($onepage_id, 'bg_video', true);
				$onepage_options['video_quality'] = get_post_meta($onepage_id, 'video_quality', true);
				$onepage_options['bg_type'] = get_post_meta($onepage_id, 'bg_type', true);
			}
		}
	
	?>
	
	<body <?php body_class(''); ?> data-spy="scroll" data-target="#navigation" <?php if ($page_id > 0): ?>style="<?php echo TMM_Helper::get_page_backround($page_id) ?>"<?php endif; ?>>
		
		<div class="loader"></div>
		
			<?php echo TMM_Helper::display_onepage_video($onepage_id, $onepage_options); ?>
		
		<div id="fb-root"></div>
		
		
		<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->
		
		
		<header id="header" <?php if (TMM::get_option('type_menu') && $onepage_id !== 0): ?> class="transparent" <?php endif; ?>>
			

			<div class="header-in">
				
				
				<!-- - - - - - - - - - - - Logo - - - - - - - - - - - - - -->

				
				<?php
					$logo_type = TMM::get_option("logo_type");
					$logo_text = TMM::get_option("logo_text");
					$logo_img = TMM::get_option("logo_img");
				?>
				
				<?php if ($logo_type): ?>
				
					<?php if ($logo_text): ?>
						<h1 id="logo">
							<a title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
								<?php echo $logo_text; ?>
							</a>			
						</h1>
					<?php endif; ?>
				
				<?php else: ?>
				
					<?php if ($logo_img): ?>
						<a id="logo" title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo_img; ?>" alt="<?php bloginfo('description'); ?>" />
						</a>
					<?php else: ?>
						<h1 id="logo">
							<a title="<?php bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
						</h1>
					<?php endif; ?>
				
				<?php endif; ?>

				
				<!-- - - - - - - - - - - end Logo - - - - - - - - - - - - -->

				
				<a id="responsive-nav-button" class="responsive-nav-button" href="#"></a>

				
				<?php if ($onepage_id OR TMM::get_option("frontpage")): ?>
				
					<nav id="navigation" class="navigation">
						<?php echo custom_framework_main_navigation($onepage_id); ?>
					</nav>
					
				<?php else: ?>
					
					<nav id="navigation" class="navigation">
						<?php echo framework_main_navigation(); ?>
					</nav>
					
				<?php endif; ?>

			</div><!--/ .header-in-->

		</header><!--/ #header-->
		
		
		<!-- - - - - - - - - - - - - - end Header - - - - - - - - - - - - - - - - -->
		

		<?php
		$sidebar_position = "sbr";

		$_REQUEST['sidebar_position'] = $sidebar_position;

		if (is_single() AND $post->post_type == TMM_Portfolio::$slug) {
			
			$_REQUEST['sidebar_position'] = 'no_sidebar';
			$sidebar_position = 'no_sidebar';

		} else {

			$page_sidebar_position = "default";
			
			if (!is_404()) {
				
				if (is_single() OR is_page()) {
					$page_sidebar_position = get_post_meta(get_the_ID(), 'page_sidebar_position', TRUE);
				}

				if (!empty($page_sidebar_position) AND $page_sidebar_position != 'default') {
					$sidebar_position = $page_sidebar_position;
				} else {
					$sidebar_position = TMM::get_option("sidebar_position");
				}
				
				if (!$sidebar_position) {
					$sidebar_position = "sbr";
				}

			} else {
				$sidebar_position = 'no_sidebar';
			}
		}

		if (is_archive()) {
			if (is_post_type_archive(TMM_Portfolio::$slug)) {
				$sidebar_position = TMM::get_option('folio_archive_sidebar');
				if (empty($sidebar_position)) {
					$sidebar_position = 'no_sidebar';
				}
			}
		}
		
		if (is_home() AND TMM::get_option('blog_sidebar_position')) {
			$sidebar_position = TMM::get_option('blog_sidebar_position');
		}

		$_REQUEST['sidebar_position'] = $sidebar_position;
		
		?>
		

		<!-- - - - - - - - - - - - - - Wrapper - - - - - - - - - - - - - - - - -->

		
		<div id="wrapper" class="<?php echo $sidebar_position; ?>">

			<?php if (!$onepage_id): ?>
			
				<section class="page">

					<div id="content">
						
						<?php if ($sidebar_position != 'no_sidebar'): ?>
						
							<div class="container">
								
								<div class="section padding-bottom-off">
									
									<?php echo TMM_Helper::page_title($post); ?>
									
								</div><!--/ .section-->
								
								<div class="row">

									<section id="main" class="col-md-8">	
								
						<?php endif; ?>
						
			<?php endif; ?>
