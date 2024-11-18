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
									<a href="#" class="btn-bg-opacity-10 px-3 py-1 text-yellow uppercase text-sm"><i class="bi bi-lightning-charge-fill text-white"></i> Superfast Service!</a>
								</div>
								<div class="col">
									<a href="#" class="btn-bg-opacity-10 px-3 py-1 text-yellow uppercase text-sm"><i class="bi bi-lightning-charge-fill text-white"></i> Always Nearby!</a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-4 row-cols-auto">
								<div class="col">
									<a href="tel:00000000000" class="text-white uppercase text-sm"><i class="bi bi-phone"></i> Call: 06-27016082</a>
								</div>
								<div class="col">
									<a href="mailto:info@betonstorten.nl" class="text-white uppercase text-sm"><i class="bi bi-envelope"></i> E-mail: info@betonstorten.nl</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-xl">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if (is_front_page() && is_home()) :
					?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
					else :
					?>
						<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
					endif;
					$beton_description = get_bloginfo('description', 'display');
					if ($beton_description || is_customize_preview()) :
					?>
						<p class="site-description"><?php echo $beton_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
													?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'beton'); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->