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

		<header id="masthead" class="site-header bg-white">
			<div class="top-header container-fluid dark-blue px-sm-0 px-4 ">
				<div class="container py-2 px-0 d-md-block d-none">
					<div class="row align-items-center">
						<div class="col">
							<div class="row gx-3 row-cols-auto">
								<div class="col">
									<a href="#" class="btn-bg-opacity-10 px-3 py-1 text-yellow uppercase text-sm oswald-400"><i class="bi bi-lightning-charge-fill text-white"></i> Supersnelle service!</a>
								</div>
								<div class="col">
									<a href="#" class="btn-bg-opacity-10 px-3 py-1 text-yellow uppercase text-sm oswald-400"><i class="bi bi-lightning-charge-fill text-white"></i> Altijd in de buurt!</a>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-4 row-cols-auto justify-content-end">
								<div class="col">
									<!-- <a href="tel:00000000000" class="text-white uppercase text-sm oswald-400"><i class="bi bi-phone"></i> <?php //_e('Call', 'beton'); ?>: 06-27016082</a> -->
									<a href="tel:00000000000" class="text-white uppercase oswald-600 text-sm-14 letter-spacing-four"><i class="bi bi-phone"></i> 06-27016082</a>
								</div>
								<div class="col">
									<!-- <a href="mailto:info@betonstorten.nl" class="text-white uppercase text-sm oswald-400"><i class="bi bi-envelope"></i> <?php //_e('E-mail', 'beton'); ?>: info@betonstorten.nl</a> -->
									<a href="mailto:info@betonstorten.nl" class="text-white uppercase text-sm-14 oswald-400 letter-spacing-four"><i class="bi bi-envelope"></i> info@betonstorten.nl</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container py-2 px-0 d-md-none d-block">
					<div class="row align-items-center">
						<div class="col">
							<div class="row gx-4 row-cols-auto">
								<div class="col-5">
									<!-- <a href="tel:00000000000" class="text-white uppercase oswald-600 text-sm-14">
										<i class="bi bi-phone"></i> <?php //_e('Call', 'beton'); ?>: 06-27016082
									</a> -->
									<a href="tel:00000000000" class="text-white uppercase oswald-600 text-sm-14 letter-spacing-four">
										<i class="bi bi-phone"></i> 06-27016082
									</a>
								</div>
								<div class="col-7 d-flex justify-content-end">
									<!-- <a href="mailto:info@betonstorten.nl" class="text-white uppercase text-sm-14 oswald-400">
										<i class="bi bi-envelope"></i> <?php //_e('E-mail', 'beton'); ?>: info@betonstorten.nl
									</a> -->
									<a href="mailto:info@betonstorten.nl" class="text-white uppercase text-sm-14 oswald-400 letter-spacing-four">
										<i class="bi bi-envelope"></i> info@betonstorten.nl
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container py-3 px-0">
				<div class="row align-items-center mx-sm-0 mx-4">
					<!-- Site Branding -->
					<div class="site-branding col-lg-4 col-8 px-0">
						<?php
						the_custom_logo();
						$beton_description = get_bloginfo('description', 'display');
						if ($beton_description || is_customize_preview()) : ?>
							<p class="site-description"><?php echo esc_html($beton_description); ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<!-- Navigation -->
					<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg col-lg-8 col-4 justify-content-end" style="padding-left: 10px;">
						<div class="d-lg-none">
							<!-- Offcanvas Toggle Button for Mobile/Tablet -->
							<button class="navbar-toggler bg-orange" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon" style="filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg);"></span>
							</button>
						</div>

						<!-- Inline Menu for Desktop -->
						<div class="beton-desktop-menu collapse navbar-collapse d-none d-lg-flex">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container' => false,
								'menu_class' => '',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="beton-navbar-desktop navbar-nav me-auto mb-2 mb-md-0 flex-wrap justify-content-between w-full oswald-400 text-18 uppercase %2$s">%3$s</ul>',
								'depth' => 2,
								'walker' => new bootstrap_5_wp_nav_menu_walker()
							));
							?>
						</div>

						<!-- Offcanvas Menu for Mobile/Tablet -->
						<div class="beton-mobile-drawer offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
							<div class="offcanvas-header px-4 border-b-custom-gray-5">

								<div id="offcanvasMenuLabel" class="offcanvas-title">
									<!-- Site Branding -->
									<div class="site-branding col-lg-4 col-8 px-0">
										<?php
										the_custom_logo();
										$beton_description = get_bloginfo('description', 'display');
										if ($beton_description || is_customize_preview()) : ?>
											<p class="site-description"><?php echo esc_html($beton_description); ?></p>
										<?php endif; ?>
									</div><!-- .site-branding -->
								</div>
								<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body px-4">
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