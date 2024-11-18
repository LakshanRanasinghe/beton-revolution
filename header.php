<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beton
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'beton'); ?></a>

		<header id="masthead" class="site-header">
			<div class="top-header container-fluid dark-blue">
				<div class="container-xl py-2">
					<div class="row align-items-center">
						<div class="col">
							<div class="row gx-3 row-cols-auto">
								<div class="col">
									<a href="#" class="btn-bg-opacity-10 px-3 py-1 text-yellow uppercase text-sm oswald-400"><i class="bi bi-lightning-charge-fill text-white"></i> <?php _e('Superfast Service', 'beton') ?>!</a>
								</div>
								<div class="col">
									<a href="#" class="btn-bg-opacity-10 px-3 py-1 text-yellow uppercase text-sm oswald-400"><i class="bi bi-lightning-charge-fill text-white"></i> <?php _e('Always Nearby', 'beton'); ?>!</a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-4 row-cols-auto">
								<div class="col">
									<a href="tel:00000000000" class="text-white uppercase text-sm oswald-400"><i class="bi bi-phone"></i> <?php _e('Call', 'beton'); ?>: 06-27016082</a>
								</div>
								<div class="col">
									<a href="mailto:info@betonstorten.nl" class="text-white uppercase text-sm oswald-400"><i class="bi bi-envelope"></i> <?php _e('E-mail', 'beton'); ?>: info@betonstorten.nl</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-xl py-3">
				<div class="row align-items-center">
					<div class="site-branding col-4">
						<?php
						the_custom_logo();
						$beton_description = get_bloginfo('description', 'display');
						if ($beton_description || is_customize_preview()) : ?>
							<p class="site-description"><?php echo $beton_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg bg-body-tertiary col-8">
						<div class="container-fluid">
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<?php
								wp_nav_menu(array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'container' => false,
									'menu_class' => '',
									'fallback_cb' => '__return_false',
									'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 justify-content-between w-full oswald-400 text-18 uppercase %2$s">%3$s</ul>',
									'depth' => 2,
									'walker' => new bootstrap_5_wp_nav_menu_walker()
								));
								?>
							</div>
						</div>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</header><!-- #masthead -->