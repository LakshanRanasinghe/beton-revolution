<?php

/**
 * Beton functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beton
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beton_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Beton, use a find and replace
		* to change 'beton' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('beton', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'beton'),
			'footer-menu-01'  => esc_html__('Footer Menu 01', 'beton'),
			'footer-menu-02'  => esc_html__('Footer Menu 02', 'beton'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'beton_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'beton_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beton_content_width()
{
	$GLOBALS['content_width'] = apply_filters('beton_content_width', 640);
}
add_action('after_setup_theme', 'beton_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beton_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'beton'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'beton'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(array(
		'name'          => esc_html__('Footer Widget 1', 'beton'),
		'id'            => 'footer-widget-1',
		'description'   => esc_html__('Add widgets here for the first footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-1">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget 2', 'beton'),
		'id'            => 'footer-widget-2',
		'description'   => esc_html__('Add widgets here for the second footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget 3', 'beton'),
		'id'            => 'footer-widget-3',
		'description'   => esc_html__('Add widgets here for the third footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget 4', 'beton'),
		'id'            => 'footer-widget-4',
		'description'   => esc_html__('Add widgets here for the fourth footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-widget-title">',
		'after_title'   => '</h4>',
	));
}
add_action('widgets_init', 'beton_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function beton_scripts()
{
	wp_enqueue_style('beton-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('beton-style', 'rtl', 'replace');

	wp_enqueue_script('beton-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array('jquery'), '1.4.1', true);
	wp_enqueue_script('beton', get_stylesheet_directory_uri() . '/js/beton.js', array('jquery'), '1.2.0', true);

	global $wpdb;
	$table_name = $wpdb->prefix . 'postcodes';

	// Fetch all names
	$postcodes = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

	wp_localize_script('beton', 'betonData', [
		'postcodes' => $postcodes,
		'ajax_url' => admin_url('admin-ajax.php')
	]);


	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');
	wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3');
	wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true);
	wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/custom.css', array('bootstrap'), '1.0.0');
	wp_enqueue_style('g-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap', array(), '1.0.0');
	// wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/regular.min.css', array(), '6.6.0' );

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'beton_scripts');

/**
 * Implement the Bootstrap Nav Walker
 */
require get_template_directory() . '/inc/bootstrap-nav-walker.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom Database Migrations
 */
require get_template_directory() . '/inc/database/migration.php';

// Calculating the distance
add_action('wp_ajax_calculate_travel_distance', 'distance_calculator');
add_action('wp_ajax_nopriv_calculate_travel_distance', 'distance_calculator');
function distance_calculator()
{
	if (!isset($_POST['city']) && empty($_POST['city'])) {
		wp_send_json_error('You can\'t calculate distance without city name.');
	}

	$apiKey =  get_field('google_map_api_key', 'option'); //'AIzaSyDxa70NdYIOvdhAoiwzmJXMR3uPd8wK21g'; // change API key (Pieter's : AIzaSyAUblC2E3wGEvnhe9YzXegrcU_AAcFsMzg)
	$places = get_field('distance_calculation_locations', 'option');

	if (empty($places)) {
		$origin = "4651CJ|2807KE|Den+Bosch|Haarlem|Venlo";
	} else {
		$origin = $places;
	}

	// global $wpdb;
	// $destination = $wpdb->get_row("SELECT `city_name` FROM `{$wpdb->prefix}postcodes` WHERE `zip` LIKE '%$destination_postcode%'");
	$destination = sanitize_text_field($_POST['city']);

	$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?sensor=false&origins=' . $origin . '&destinations=' . urlencode($destination) . '+Nederland&key=' . $apiKey;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);

	$result = (array) json_decode($response);

	if ($result['error_message']) {
		wp_mail(explode(',', get_field('failsafe_email_notifier', 'option')), 'Google Distance error', $response);
	}
	if (empty($result) or empty($result['rows'][0]->elements[0]->distance->value)) {
		if (defined('DOING_AJAX') && DOING_AJAX) {
			setcookie('travelling_distance', floatval(0), time() + 31556926);
			wp_send_json_success(['distance' => 0, 'error' => 'Result given empty by the google map API.']);
			wp_die();
		} else {
			return false;
		}
	} else {
		$distances = array();
		foreach ($result['rows'] as $ele) {
			if (!empty($ele->elements[0]->distance->value)) {
				$distances[] = $ele->elements[0]->distance->value;
			}
		}
		$smallestdistance = round(min($distances), -3) / 1000;
		$smallestdistance = $smallestdistance * 2; //going and return trip
		setcookie('travelling_distance', floatval($smallestdistance), time() + 31556926);

		if (defined('DOING_AJAX') && DOING_AJAX) {
			wp_send_json_success(['distance' => floatval($smallestdistance)]);
		} else {
			return floatval($smallestdistance);
		}
	}
}

function getBetonDiscountPercentage($number, $discounts)
{
	foreach ($discounts as $discount) {
		if (floatval($number) > $discount['min_range'] && $number <= $discount['max_range']) {
			return $discount['discount_percentage'];
		}
	}
	return 0; // Return null if no matching range is found
}

function getDataByProperty($array, $filter_name, $filter_value)
{
	foreach ($array as $item) {
		if (sanitize_title($item[$filter_name]) === $filter_value) {
			return $item;
		}
	}
	return null; // Return null if not found
}

add_action('wp_ajax_beton_calculator', 'beton_calculator');
add_action('wp_ajax_nopriv_beton_calculator', 'beton_calculator');
function beton_calculator(): void
{
	// if (!wp_verify_nonce($_REQUEST['nonce'], "beton_calculator_nonce")) {
	// 	exit("No naughty business please");
	// }

	if (!isset($_POST['city']) || !isset($_POST['cubic_meters']) || !isset($_POST['area_code'])) {
		wp_send_json_error('No enough parameters to run the calculation.');
		return;
	}
	$city = sanitize_text_field($_POST['city']);
	$cubic_meters = sanitize_text_field($_POST['cubic_meters']);
	$area_code = sanitize_text_field($_POST['area_code']);
	$selected_application = sanitize_text_field($_POST['application']);
	$selected_compounds = rest_sanitize_array($_POST['compounds']);
	$selected_release_method = sanitize_text_field($_POST['release_method']);
	$selected_pump_type = sanitize_text_field($_POST['pump_type']);
	$selected_pumping_distance = sanitize_text_field($_POST['pumping_distance']);
	$selected_performance = sanitize_text_field($_POST['performance']);
	$selected_layer_thickness = sanitize_text_field($_POST['layer_thickness']);
	$selected_rooms = sanitize_text_field($_POST['rooms_count']);
	$selected_butterfly_floor = sanitize_text_field($_POST['butterfly_floor']);
	$selected_surface = sanitize_text_field($_POST['surface']);
	$selected_ground_floor = sanitize_text_field($_POST['selected_floor']);

	$seller_prices = get_field('beton_sellers', 'option');
	$beton_discounts = get_field('discounts', 'option');

	$sub_total = 0;
	$response_data_set = [];
	$response_data_set['cubic_meters_formatted'] = $cubic_meters;

	$price_index = array_search($area_code, array_column(json_decode(json_encode((array) $seller_prices), TRUE), 'area_code'));

	$seller_price_data = $seller_prices[$price_index];
	if ($cubic_meters < $seller_price_data['offset']) {
		$beton_price = ($seller_price_data['seller_price'] * $cubic_meters) + ($seller_price_data['offset'] - $cubic_meters) * $seller_price_data['price_underload'];
	} else {
		$beton_price = $seller_price_data['seller_price'] * $cubic_meters;
	}
	$discount_percentage = getBetonDiscountPercentage($cubic_meters, $beton_discounts);
	if ($discount_percentage > 0) {
		$beton_price = $beton_price - (($beton_price / 100) * $discount_percentage);
	}
	$response_data_set['beton_price'] = $beton_price;
	$response_data_set['beton_price_formatted'] = wc_price($beton_price);
	$sub_total += $beton_price;

	$pricingData = get_field('application', 'option');
	$application_data = getDataByProperty($pricingData['application_items'], 'product_name', $selected_application);
	$application_price = $application_data['price_excl_tax'] * $cubic_meters;

	$response_data_set['application_price'] = $application_price;
	$response_data_set['application_price_formatted'] = '<span>' . $application_data['product_name'] . '</span><span>' . wc_price($application_price) . '</span>';
	
	// Compounds
	$compound_total = 0;
	if(!empty($selected_compounds) && is_array($selected_compounds)){
		$pricingData = get_field('application', 'option');
		foreach($selected_compounds as $compound){
			$compound_data = getDataByProperty($pricingData['compound_items'], 'product_name', $compound);
			$compound_price = $compound_data['price_excl_tax'] * $cubic_meters;
			$response_data_set[$compound] = $compound_price;
			$compound_total += $compound_price;
			$response_data_set[$compound . '_formatted'] = '<span>' . $compound_data['product_name'] . '</span><span>' . wc_price($compound_price) . '</span>';
		}
	}

	$application_compound_total = $compound_total + $application_price;
	$response_data_set['application_compound_total'] = $application_compound_total;
	$response_data_set['application_compound_total_formatted'] = '<span>' . __('Total', 'beton') . '</span><span>' . wc_price($application_compound_total) . '</span>';
	$sub_total += $application_compound_total;

	$travel_distance = $_COOKIE['travelling_distance'];
	
	if($selected_release_method !== 'gutter'){
		if($selected_pump_type == 'mini'){
			$mini_pump_cost = get_field('mini_betonpomp_cost', 'option');
			$pump_callout_fee = get_field('mini_pump_call-out_fee', 'option');
			$pump_callout_min_distance_cost = get_field('call-out_min_distance', 'option');
			$pumping_cost = get_field('pumping_distance_cost_per_m', 'option');
			$pumping_extra_hose_cost = get_field('extra_pipeline_trolley_cost', 'option');
			$all_in_price = get_field('all-in_price', 'option');
			$ground_flooring_cost = get_field('ground_floor_cost', 'option');
			$travel_cost = $travel_distance * $pump_callout_fee;


			if($travel_cost < $pump_callout_min_distance_cost){
				$travel_cost = $pump_callout_min_distance_cost;
			}

			$response_data_set['pump_callout_cost'] = $travel_cost;
			$response_data_set['pump_callout_cost_formatted'] = wc_price($travel_cost);
			$sub_total += $travel_cost;

			$pumping_cost = $selected_pumping_distance * $pumping_cost;
			$response_data_set['pumping_cost'] = $pumping_cost;
			$response_data_set['pumping_cost_formatted'] = wc_price($pumping_cost);
			$sub_total += $pumping_cost;

			if($selected_pumping_distance > 100){
				$response_data_set['pumping_extra_hose_cost'] = $pumping_extra_hose_cost;
				$response_data_set['pumping_extra_hose_cost_formatted'] = wc_price($pumping_extra_hose_cost);
				$sub_total += $pumping_extra_hose_cost;
			}else{
				unset($response_data_set['pumping_extra_hose_cost']);
				unset($response_data_set['pumping_extra_hose_cost_formatted']);
				$sub_total -= $pumping_extra_hose_cost;
			}

			$pumping_hours = 2;
			$remaining = 0;
			if($cubic_meters > 12){
				$remaining = ($cubic_meters - 12) * 5;
			}
			if($selected_pumping_distance >= 70){
				$remaining += $selected_pumping_distance - 70;
			}

			$pumping_hours = $pumping_hours + ($remaining/60);

			$whole_hours = floor($pumping_hours);      // 1
			$fraction_hour = $pumping_hours - $whole_hours; // .25

			if($whole_hours >= 2 && !empty($fraction_hour)){
				$mini_pump_cost = $mini_pump_cost * $pumping_hours;
			}elseif($whole_hours >= 2){
				$mini_pump_cost = $mini_pump_cost * $whole_hours;
			}else{
				$mini_pump_cost = $mini_pump_cost * 2;
			}
			$response_data_set['pump_cost'] = $mini_pump_cost;
			$response_data_set['pump_cost_formatted'] = wc_price($mini_pump_cost);
			$sub_total += $mini_pump_cost;

			if($selected_performance == 'allIn'){
				$extra_price = 0;
				if($cubic_meters > 12){
					$all_in_price += ($cubic_meters - 12) * 5;
				}
				if($selected_pumping_distance > 40){
					$extra_price += ($selected_pumping_distance - 40);
				}

				$thickness_cost = 0;
				if($selected_layer_thickness == '5-10'){
					$thickness_cost = $all_in_price * 0.1;
					$all_in_price += $thickness_cost;			
				}elseif($selected_layer_thickness == '11-15'){
					$thickness_cost = $all_in_price * 0.05;
					$all_in_price += $thickness_cost;
				}
				if($thickness_cost > 0){
					$response_data_set['thickness_cost'] = $thickness_cost;
					$response_data_set['thickness_cost_formatted'] = wc_price($thickness_cost);
					$sub_total += $thickness_cost;
				}

				if($selected_rooms > 0){
					$room_cost = $selected_rooms * 15;
					$extra_price += $room_cost;
					$response_data_set['rooms_cost'] = $room_cost;
					$response_data_set['rooms_formatted'] = wc_price($room_cost);
					$sub_total += $room_cost;
				}

				if($travel_distance > 40){
					$extra_price += ($travel_distance * 0.35);
				}

				if(boolval($selected_butterfly_floor) !== false || intval($selected_butterfly_floor) !== 0){
					// $extra_price += 50;
					
					// $flooring_price = get_field('oppervlakte', 'option');
					// $butterfly_price = 0;
					// foreach($flooring_price as $floor_price){
					// wc_get_logger()->debug('surface: ' . ($selected_surface) . ' and loop ' . $floor_price['size']);

					// 	if($floor_price['size'] == $selected_surface){
					// 		$butterfly_price = $floor_price['cost'];
					// 		break;
					// 	}
					// }
					// if($selected_rooms > 0){
					// 	$butterfly_price += $selected_rooms * 25;
					// }
					$butterfly_price = butterfly_coster($selected_surface, $selected_rooms);
					$response_data_set['butterfly_floor_cost'] = $butterfly_price;
					$response_data_set['butterfly_floor_formatted'] = wc_price($butterfly_price);
					$sub_total += $butterfly_price;
				}

				if(boolval($selected_ground_floor) !== false || intval($selected_ground_floor) !== 0){
					$extra_price += floatval($ground_flooring_cost);
					// $response_data_set['ground_floor_cost'] = $ground_flooring_cost;
					// $response_data_set['ground_floor_formatted'] = wc_price($ground_flooring_cost);
					// wc_get_logger()->debug('ground floor selected so ground_flooring_cost there: ' . ($selected_ground_floor));
				}

				$all_in_price += $extra_price;

				$response_data_set['allIn_cost'] = $all_in_price;
				$response_data_set['allIn_formatted'] = wc_price($all_in_price);
				$sub_total += $all_in_price;
			}
		}elseif($selected_pump_type == 'boom'){
			if(empty($selected_pumping_distance) OR intval($selected_pumping_distance) < 20){
				$selected_pumping_distance = 20;
			}

			$boom_price = 0;

			switch ((int) $selected_pumping_distance) {
				case 20:
					if ($cubic_meters <= 7) {
						$boom_price = 300;
					} elseif ($cubic_meters < 51) {
						$boom_price = 275 + ($cubic_meters * 6.25);
					} elseif ($cubic_meters < 101) {
						$boom_price = 275 + ($cubic_meters * 5.50);
					} elseif ($cubic_meters < 151) {
						$boom_price = 275 + ($cubic_meters * 5.1);
					} elseif ($cubic_meters < 201) {
						$boom_price = 275 + ($cubic_meters * 4.9);
					} elseif ($cubic_meters < 301) {
						$boom_price = 275 + ($cubic_meters * 4.55);
					} elseif ($cubic_meters < 401) {
						$boom_price = 275 + ($cubic_meters * 4.40);
					} elseif ($cubic_meters < 501) {
						$boom_price = 275 + ($cubic_meters * 4.20);
					} elseif ($cubic_meters < 601) {
						$boom_price = 275 + ($cubic_meters * 4.05);
					} elseif ($cubic_meters >= 601) {
						$boom_price = 275 + ($cubic_meters * 3.95);
					}
					if ($cubic_meters > 7 && $boom_price < 375) {
						$boom_price = 375;
					}
					break;
				case 30:
					if ($cubic_meters < 51) {
						$boom_price = 285 + ($cubic_meters * 6.35);
					} elseif ($cubic_meters < 101) {
						$boom_price = 285 + ($cubic_meters * 5.60);
					} elseif ($cubic_meters < 151) {
						$boom_price = 285 + ($cubic_meters * 5.2);
					} elseif ($cubic_meters < 201) {
						$boom_price = 285 + ($cubic_meters * 5.0);
					} elseif ($cubic_meters < 301) {
						$boom_price = 285 + ($cubic_meters * 4.65);
					} elseif ($cubic_meters < 401) {
						$boom_price = 285 + ($cubic_meters * 4.50);
					} elseif ($cubic_meters < 501) {
						$boom_price = 285 + ($cubic_meters * 4.30);
					} elseif ($cubic_meters < 601) {
						$boom_price = 285 + ($cubic_meters * 4.15);
					} elseif ($cubic_meters >= 601) {
						$boom_price = 285 + ($cubic_meters * 4.05);
					}
					if ($boom_price < 385) {
						$boom_price = 385;
					}
					break;
				case 38:
					if ($cubic_meters < 101) {
						$boom_price = 415 + ($cubic_meters * 5.2);
					} elseif ($cubic_meters < 201) {
						$boom_price = 415 + ($cubic_meters * 4.70);
					} elseif ($cubic_meters < 301) {
						$boom_price = 415 + ($cubic_meters * 4.40);
					} elseif ($cubic_meters < 401) {
						$boom_price = 415 + ($cubic_meters * 4.15);
					} elseif ($cubic_meters < 501) {
						$boom_price = 415 + ($cubic_meters * 3.65);
					} elseif ($cubic_meters >= 501) {
						$boom_price = 415 + ($cubic_meters * 3.45);
					}
					if ($boom_price < 540) {
						$boom_price = 540;
					}
					break;
				case 48:
					if ($cubic_meters < 51) {
						$boom_price = 650 + ($cubic_meters * 5.7);
					} elseif ($cubic_meters < 1001) {
						$boom_price = 650 + ($cubic_meters * 5.4);
					}
					if ($boom_price < 1050) {
						$boom_price = 1050;
					}
					break;
				case 54:
					if ($cubic_meters < 51) {
						$boom_price = 790 + ($cubic_meters * 5.7);
					} elseif ($cubic_meters < 1001) {
						$boom_price = 790 + ($cubic_meters * 5.4);
					}
					if ($boom_price < 1250) {
						$boom_price = 1250;
					}
					break;
				case 59:
					if ($cubic_meters < 51) {
						$boom_price = 900 + ($cubic_meters * 5.7);
					} elseif ($cubic_meters < 1001) {
						$boom_price = 900 + ($cubic_meters * 5.4);
					}
					if ($boom_price < 1400) {
						$boom_price = 1400;
					}
					break;
			}

			$response_data_set['pump_cost'] = $boom_price;
			$response_data_set['pump_cost_formatted'] = wc_price($boom_price);
			$sub_total += $boom_price;

			if($selected_performance == 'allIn'){
				$all_in_price = get_field('all-in_price', 'option');
				$ground_flooring_cost = get_field('ground_floor_cost', 'option');

				$extra_price = 0;
				$remaining_concrete = 0;
				$remaining_pump_distance = 0;

				if($cubic_meters > 12){
					$remaining_concrete = $cubic_meters - 12;
					$all_in_price += ($remaining_concrete * 4);
				}
				if($selected_pumping_distance > 40){
					$remaining_pump_distance = $selected_pumping_distance - 40;
					$extra_price += ($remaining_pump_distance * 1);
				}


				if(isset($selected_layer_thickness)){
					$thickness_pricing = get_field('thickness_pricing', 'option');
					$thickness_prices = [];
					foreach($thickness_pricing as $thickness_price){
						$thickness_prices[$thickness_price['thickness']] = $thickness_price['cost'];
					}
					wc_get_logger()->debug(json_encode($thickness_prices));
					if($selected_layer_thickness == '5-10'){
						$all_in_price += ($all_in_price * $thickness_prices['5-10']);

					}elseif($selected_layer_thickness == '11-15'){
						$all_in_price += ($all_in_price * $thickness_prices['11-15']);
					}
				}

				if(isset($selected_rooms) && $selected_rooms >= 1){
					$extra_price += (intval($selected_rooms) * 35);
				}

				// if($travel_distance > 40){
				// 	$extra_price += ($travel_distance * 0.5);
				// 	wc_get_logger()->debug('travel_distance > 40 : travel_distance ' . $travel_distance);
				// }

				if(boolval($selected_ground_floor) !== false || intval($selected_ground_floor) !== 0){
					$extra_price += floatval($ground_flooring_cost);
				}
				
				$all_in_price += ($extra_price); 
				$all_in_price += 100; //extra man voor giekpomp

				$response_data_set['allIn_cost'] = $all_in_price;
				$response_data_set['allIn_formatted'] = wc_price($all_in_price);
				$sub_total += $all_in_price;

				if(boolval($selected_butterfly_floor) !== false || intval($selected_butterfly_floor) !== 0){
					$butterfly_price = butterfly_coster($selected_surface, $selected_rooms);
					$response_data_set['butterfly_floor_cost'] = $butterfly_price;
					$response_data_set['butterfly_floor_formatted'] = wc_price($butterfly_price);
					$sub_total += $butterfly_price;
				}
			}
		}
	}

	$response_data_set['sub_total'] = $sub_total;
	$response_data_set['btw'] = ($sub_total / 100) * 21;

	$response_data_set['sub_total_btw'] = $sub_total + $response_data_set['btw'];

	wc_get_logger()->debug(json_encode($response_data_set));

	wp_send_json_success([
		'dynamic_pricing' => $response_data_set
	]);
}

function butterfly_coster($selected_surface, $selected_rooms) : mixed {
	$flooring_price = get_field('oppervlakte', 'option');
	$butterfly_price = 0;
	foreach($flooring_price as $floor_price){
	// wc_get_logger()->debug('surface: ' . ($selected_surface) . ' and loop ' . $floor_price['size']);

		if($floor_price['size'] == $selected_surface){
			$butterfly_price = $floor_price['cost'];
			break;
		}
	}
	if($selected_rooms > 0){
		$butterfly_price += $selected_rooms * 25;
	}
	return $butterfly_price;
}