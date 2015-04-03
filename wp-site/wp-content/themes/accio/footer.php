<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php if (!isset($_REQUEST['is_onepage'])): ?>

				<?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'):  ?>

						</section><!--/ #main-->

						<aside id="sidebar" class="col-md-4"><?php TMM_Custom_Sidebars::show_custom_sidebars(); ?></aside><!--/ #sidebar-->	

					</div><!--/ .row-->	

				</div><!--/ .container-->

				<?php elseif ($_REQUEST['sidebar_position'] == 'no_sidebar'): ?>

			<?php endif; ?>	

		</div><!--/ #content-->

	</section><!--/ .page-->

<?php endif; ?>
	
	<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

	<?php $footer_bg_image = TMM::get_option("footer_bg_image"); ?>

	<footer id="footer">
		
		 <?php if (!is_single()): ?> 
		
			<section class="section <?php if ($footer_bg_image): ?>parallax <?php endif; ?>">

				<?php if ($footer_bg_image): ?>
					<div class="full-bg-image" style="background-image: url(<?php echo $footer_bg_image ?>)"></div>
				<?php endif; ?>

				<?php if ((bool) !TMM::get_option("hide_footer")) : ?>

				<div class="container">

					<div class="row">

						<div class="col-md-6">
							<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('Thememakers Footer Sidebar 1')); ?>
						</div>

						<div class="col-md-6">
							<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('Thememakers Footer Sidebar 2')); ?>
						</div>

					</div><!--/ .row-->

				</div><!--/ .container-->

				<?php endif; ?>

			</section><!--/ .section-->	

			<?php if ((bool) !TMM::get_option('hide_logo_in_footer')): ?>

			<div class="logo-in-footer">

				<div class="container">

					<div class="row">
						<div class="col-xs-12">
							<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
						</div>
					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .logo-in-footer-->

			<?php endif; ?>
		
		<?php endif; ?>

		<div class="bottom-footer clearfix">

			<div class="container">

				<div class="row">

					<div class="col-sm-6">
						<div class="copyright"><?php echo TMM::get_option("copyright_text") ?></div><!--/ .copyright-->
					</div>

					<!--<div class="col-sm-3 col-sm-offset-3">
						<div class="developed"><?php _e('Developed by', 'accio'); ?> <a target="_blank" href="http://webtemplatemasters.com">ThemeMakers</a></div><!--/ .developed-->
					<!--</div><!--No-->

				</div><!--/ .row-->

			</div><!--/ .container-->

		</div><!--/ .bottom-footer-->	

	</footer><!--/ #footer-->


	<!-- - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - -->


</div><!--/ #wrapper-->

<?php wp_footer(); ?>

</body>
</html>
