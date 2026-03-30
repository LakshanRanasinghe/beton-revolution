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

	<footer id="colophon" class="site-footer darker-blue">
		<div class="beton-footer-wrapper container text-white pt-5">
			<div class="footer-logo pb-5">
				<!-- <a><?php //echo get_custom_logo(); ?></a> -->
				<a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home" aria-current="page"><img width="278" height="55" src="<?php echo site_url(); ?>/wp-content/uploads/2025/03/betonstorten-logo-optimized-footer.png" class="custom-logo" alt="Beton" decoding="async"></a>
			</div>
			
			<!-- Top Footer Section -->
			<div class="footer-top row pb-4">
				<div class="footer-section col-lg-4 col-md-12 mb-4 pe-lg-5">
					<?php 
						if (is_active_sidebar('footer-widget-1')) :
							dynamic_sidebar('footer-widget-1'); 
						endif; 
					?>
				</div>

				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="footer-section col-lg-4 col-md-4 col-sm-6 mb-4 pe-lg-5 text-uppercase">
							<?php 
								if (is_active_sidebar('footer-widget-2')) :
									dynamic_sidebar('footer-widget-2'); 
								endif; 
							?>
						</div>
						<div class="footer-section col-lg-4 col-md-4 col-sm-6 mb-4 pe-lg-5 text-uppercase">
							<?php 
								if (is_active_sidebar('footer-widget-3')) :
									dynamic_sidebar('footer-widget-3'); 
								endif; 
							?>
						</div>
						<div class="footer-section beton-footer-section-contact col-lg-4 col-md-4 col-sm-12 text-uppercase">
							<?php 
								if (is_active_sidebar('footer-widget-4')) :
									dynamic_sidebar('footer-widget-4'); 
								endif; 
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="site-info border-top-gray">
			<div class="container py-4 text-center text-sm-start light-blue text-15 text-sm-14 poppins-400">
				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-sm d-flex justify-content-center justify-content-sm-start align-items-center mb-2 mb-sm-0">
						<p class="mb-0 poppins-400 text-15 text-sm-14"><?php _e('Copyright © 2024', 'beton'); ?></p>
						&nbsp;
						<a href="<?php echo site_url(); ?>" class="light-blue link-hover">Betonstorten.nl</a>
					</div>
					<div class="col-12 col-sm-auto d-flex align-items-center justify-content-center justify-content-sm-end">
						<p class="mb-0 d-none d-sm-block poppins-400 text-15 text-sm-14">Volg ons: </p>
						<div class="d-flex align-items-center">
							<a href="#" class="mx-1">
								<img class="width-30" src="<?php echo get_template_directory_uri() ?>/images/facebook.png" alt="">
							</a>
							<a href="#" class="mx-1">
								<img class="width-30" src="<?php echo get_template_directory_uri() ?>/images/twitter.png" alt="">
							</a>
							<a href="#" class="mx-1">
								<img class="width-30" src="<?php echo get_template_directory_uri() ?>/images/insta.png" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
			<!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
