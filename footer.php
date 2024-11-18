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
				<a><?php echo get_custom_logo(); ?></a>
			</div>
			<div class="footer-top d-sm-flex pb-4">
				<div class="footer-section sm-col-4 pe-5">
					<?php 
						if (is_active_sidebar('footer-widget-1')) :
							dynamic_sidebar('footer-widget-1'); 
						endif; 
					?>
				</div>
				<div class="col-8">
					<div class="row">
						<div class="footer-section col-sm-4 pe-5 text-uppercase">
							<?php 
								if (is_active_sidebar('footer-widget-2')) :
									dynamic_sidebar('footer-widget-2'); 
								endif; 
							?>
						</div>
						<div class="footer-section col-sm-4 pe-5 text-uppercase">
							<?php 
								if (is_active_sidebar('footer-widget-3')) :
									dynamic_sidebar('footer-widget-3'); 
								endif; 
							?>
						</div>
						<div class="footer-section col-sm-4 text-uppercase">
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
			<div class="d-flex justify-content-between py-4 container light-blue text-15 poppins-400 align-items-center">
				<div class="col d-flex"><p class="mb-0"><?php _e('Copyright © 2024', 'beton'); ?></p>&nbsp<a href="<?php echo site_url(); ?>" class="light-blue link-hover">Betonstorten.nl</a></div>
				<div class="col">
					<div class="d-flex width-219 float-end align-items-center">
						<p class="mb-0"><?php _e('Follow Us:', 'beton'); ?>&nbsp&nbsp</p>
						<div class="col text-center">
							<a href="#"><img class="width-30" src="<?php echo site_url(); ?>/wp-content/uploads/2024/11/Screenshot-2024-11-18-at-1.59.37-PM.png" alt=""></a>
						</div>
						<div class="col text-center">
							<a href="#"><img class="width-30" src="<?php echo site_url(); ?>/wp-content/uploads/2024/11/Screenshot-2024-11-18-at-1.59.37-PM.png" alt=""></a>
						</div>
						<div class="col text-center">
							<a href="#"><img class="width-30" src="<?php echo site_url(); ?>/wp-content/uploads/2024/11/Screenshot-2024-11-18-at-1.59.37-PM.png" alt=""></a>
						</div>
					</div>
				</div>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
