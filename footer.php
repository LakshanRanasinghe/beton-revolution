<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beton
 */

?>

<footer id="colophon" class="site-footer darker-blue font-manrope" style="background: #222;">
	<div class="beton-footer-wrapper container text-white pt-5">
		<div class="footer-logo pb-3">
			<!-- <a><?php //echo get_custom_logo(); ?></a> -->
			<a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home" aria-current="page"><img
					width="360px" height="55"
					src="<?php echo get_template_directory_uri() ?>/images/mobielebetoncentrale-white.png"
					class="custom-logo" alt="Beton" decoding="async" style="padding-left: 5px;"></a>
		</div>

		<!-- Top Footer Section -->
		<div class="footer-top row pb-4">
			<div class="footer-section col-lg-4 col-md-12 mb-4 pe-lg-5">
				<?php
				if (is_active_sidebar('footer-widget-1')):
					dynamic_sidebar('footer-widget-1');
				endif;
				?>
			</div>

			<div class="col-lg-8 col-md-12">
				<div class="row">
					<div class="footer-section col-lg-4 col-md-4 col-sm-6 mb-4 pe-lg-5 text-uppercase">
						<?php
						if (is_active_sidebar('footer-widget-2')):
							dynamic_sidebar('footer-widget-2');
						endif;
						?>
					</div>
					<div class="footer-section col-lg-4 col-md-4 col-sm-6 mb-4 pe-lg-5 text-uppercase">
						<?php
						if (is_active_sidebar('footer-widget-3')):
							dynamic_sidebar('footer-widget-3');
						endif;
						?>
					</div>
					<div class="footer-section beton-footer-section-contact col-lg-4 col-md-4 col-sm-12 text-uppercase">
						<?php
						if (is_active_sidebar('footer-widget-4')):
							dynamic_sidebar('footer-widget-4');
						endif;
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="site-info border-top-gray">
			<div class="container py-4 text-center light-blue text-15 text-sm-14 manrope-400">
				<div class="row justify-content-center align-items-center">
					<div class="col-12 d-flex">
						<p class="mb-0 text-15 text-sm-14" style="color: #ECEEF2; font-weight: 100; opacity: 0.7;">
							<span><?php _e('© 2026 ', 'beton'); ?></span><a href="<?php echo site_url(); ?>"
								class="link-hover"
								style="color: #ECEEF2;">mobielebetoncentrale.</a><?php _e(' Alle rechten voorbehouden.', 'beton'); ?>
						</p>
						&nbsp;
					</div>
					<!-- <div class="col-12 col-sm-auto d-flex align-items-center justify-content-center justify-content-sm-end">
					<p class="mb-0 d-none d-sm-block manrope-400 text-15 text-sm-14">Volg ons: </p>
					<div class="d-flex align-items-center">
						<a href="#" class="mx-1">
							<img class="width-30" src="<?php //echo get_template_directory_uri() ?>/images/facebook.png"
								alt="">
						</a>
						<a href="#" class="mx-1">
							<img class="width-30" src="<?php //echo get_template_directory_uri() ?>/images/twitter.png"
								alt="">
						</a>
						<a href="#" class="mx-1">
							<img class="width-30" src="<?php //echo get_template_directory_uri() ?>/images/insta.png"
								alt="">
						</a>
					</div>
				</div> -->
				</div>
			</div>

		</div>


</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>