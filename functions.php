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
	wp_enqueue_script('beton-checkout', get_stylesheet_directory_uri() . '/js/beton-woocommerce.js', array('jquery'), '1.2.0', true);

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
	// wp_enqueue_style('g-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), '1.0.0');
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
function beton_calculator($data = null)
{
	if($data !== null && is_array($data) && count($data) > 0){
		$_POST = $data;
	}
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
	// $sub_total += $application_price;
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

	$travel_distance = isset($_COOKIE['travelling_distance']) ? $_COOKIE['travelling_distance'] : 0;
	
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
				// unset($response_data_set['pumping_extra_hose_cost']);
				// unset($response_data_set['pumping_extra_hose_cost_formatted']);
				// $sub_total -= $pumping_extra_hose_cost;
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
					// $sub_total += $thickness_cost;
				}

				if($selected_rooms > 0){
					$room_cost = $selected_rooms * 15;
					$extra_price += $room_cost;
					$response_data_set['rooms_cost'] = $room_cost;
					$response_data_set['rooms_formatted'] = wc_price($room_cost);
					// $sub_total += $room_cost;
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
	$response_data_set['sub_total_formatted'] = wc_price($sub_total);
	$response_data_set['btw'] = ($sub_total / 100) * 21;
	$response_data_set['btw_formatted'] = wc_price($response_data_set['btw']);

	$response_data_set['sub_total_btw'] = $sub_total + $response_data_set['btw'];
	$response_data_set['total_formatted'] = wc_price($response_data_set['sub_total_btw']);

	wc_get_logger()->debug(json_encode($response_data_set));

	if($data !== null && is_array($data) && count($data) > 0){
		return $response_data_set;
	}
	else{
		wp_send_json_success([
			'dynamic_pricing' => $response_data_set
		]);
	}
}

function butterfly_coster($selected_surface, $selected_rooms) : mixed {
	$flooring_price = get_field('oppervlakte', 'option');
	$butterfly_price = 0;
	foreach($flooring_price as $floor_price){
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

function theme_wc_setup() {
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );
}
add_action( 'after_setup_theme', 'theme_wc_setup' );

add_action('wp_ajax_save_quotation', 'save_quotation');
add_action('wp_ajax_nopriv_save_quotation', 'save_quotation');
function save_quotation() : void {
	$data = $_POST;
	unset($data['action']);

	wc_get_logger()->debug(json_encode($data));

	$data['city'] = $data['postalcode'];
	$calc_data = $data;
	$calc_data['application'] = $_POST['application_product'];
	$calc_data['compounds'] = $_POST['composition'];
	$calc_data['release_method'] = $_POST['unloading'];
	$calc_data['pumping_distance'] = (isset($_POST['pump_type']) && $_POST['pump_type'] == 'mini' ? $_POST['pumping_distance'] : $_POST['boom_pumping_distance']);
	$calc_data['performance'] = $_POST['uitvoering'];
	$calc_data['layer_thickness'] = $_POST['layer-thickness'];
	$calc_data['rooms_count'] = $_POST['nos_rooms'];
	$calc_data['butterfly_floor'] = $_POST['butterfly-floor'];
	$calc_data['surface'] = $_POST['surace-sqm'];
	$calc_data['selected_floor'] = $_POST['flooring'];

	$calcuated_data = beton_calculator($calc_data);
	wc_get_logger()->debug('Data to save quotation');
	wc_get_logger()->debug(json_encode($calcuated_data));

	$quote = array(
		'post_title'    => 'New Price Quotation',
		'post_status'   => 'publish',
		'post_type' => 'concrete_quotation'
	);
	$quote_id = wp_insert_post($quote);

	$data['beton_samenstelling_cubic_meters'] = $data['cubic_meters'];
	$data['beton_samenstelling_postalcode'] = $data['postalcode'];
	$data['beton_cost'] = $calcuated_data['beton_price'];

	$data['additional_butterfly-floor'] = $data['butterfly-floor'];
	$data['additional_flooring'] = $data['flooring'];
	$data['additional_nos_rooms'] = $data['nos_rooms'];
	$data['additional_layer-thickness'] = $data['layer-thickness'];
	$data['additional_surace-sqm'] = $data['surace-sqm'];
	$data['travelling_distance'] = $_COOKIE['travelling_distance'];

	foreach ($data as $key => $value) {
		// update_field($key, $value, $quote_id);
		update_post_meta($quote_id, $key, $value);
	}

	$quote_update = array(
		'ID'         => $quote_id,
		'post_title' => 'Offerte #' . $quote_id
	);
	wp_update_post($quote_update);

	$totals = array(
		'totals_aantal_cost' => $calcuated_data['sub_total_btw'],
		'totals_toepassing_cost' => $calcuated_data['application_price'],
		'totals_hoog_vloeibaar_cost' => $calcuated_data['hoog-vloeibaar'],
		'totals_snelhardend_cost' => $calcuated_data['snelhardend'],
		'totals_fijn_grind_cost' => $calcuated_data['fijn-grind'],
		'totals_extra_hoge_sterkte_cost' => $calcuated_data['extra-hoge-sterkte'],
		'totals_top_totals' => $calcuated_data['application_compound_total'],
		'totals_pump_cost' => $calcuated_data['pump_cost'],
		'totals_voorrijkosten_cost' => $calcuated_data['pump_callout_cost'],
		'totals_pumping_distance_cost' => $calcuated_data['pumping_cost'],
		'totals_toeslag_extra_leidingwagen_cost' => $calcuated_data['pumping_extra_hose_cost'],
		'totals_all-in_uitvoering_cost' => $calcuated_data['allIn_cost'],
		'totals_vlindervloer_cost' => $calcuated_data['butterfly_floor_cost'],
		'totals_subtotal' => $calcuated_data['sub_total'],
		'totals_btw' => $calcuated_data['btw'],
		'totals_grand_total' => $calcuated_data['sub_total_btw'],
	);
	foreach($totals as $key => $value){
		// update_field($key, $value, $quote_id);
		update_post_meta($quote_id, $key, $value);
	}

	do_action('acf/save_post', $quote_id);

	$pdf_data = quotation_html($quote_id);
	send_quotation_email($pdf_data, $data['user_email'], $quote_id);

	wp_send_json_success([
		'status' => 'mail-sent'
	]);
}

function quotation_html($quote_id)
{
	global $wpdb;
	$post = get_post($quote_id);
	$city = get_post_meta($quote_id, 'beton_samenstelling_postalcode', true);
	ob_start();

	//=========   HTML CODE BEGINS HERE AFTER PHP END TAG ====================
	$cubic_m = get_post_meta($quote_id, 'beton_samenstelling_cubic_meters', true);
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Betonbestellen</title>
		<style>
			body {
				font-family: 'Montserrat', sans-serif;
				font-size: 12px;
				letter-spacing: -0.3px;
			}

			.invoice-wrapper {
				width: 700px;
				margin: auto;
			}

			.nav-sidebar .nav-header:not(:first-of-type) {
				padding: 1.7rem 0rem .5rem;
			}

			.logo {
				font-size: 20px;
			}

			.sidebar-collapse .brand-link .brand-image {
				margin-top: -33px;
			}

			.content-wrapper {
				margin: auto !important;
			}

			.billing-company-image {
				width: 50px;
			}

			.billing_name {
				text-transform: uppercase;
			}

			.billing_address {
				text-transform: capitalize;
			}

			.table {
				width: 100%;
				border-collapse: collapse;
			}

			th {
				text-align: left;
				padding: 5px;
			}

			td {
				padding: 5px;
				vertical-align: top;
			}

			.row {
				display: block;
				clear: both;
			}

			.text-right {
				text-align: right;
			}

			.table thead tr {
				background: #f6453d;
				color: #fff;
			}

			.table-hover tbody tr:nth-child(even) {
				background: #eaeaea;
				display: table-row;
			}

			.table-hover tbody tr:nth-child(odd) {
				background: #fff;
			}

			address {
				font-style: normal;
			}

			.space-left {
				padding-left: 25px;
			}
		</style>
	</head>

	<body>
		<div class="row invoice-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<tr>
								<td>
									<address>
										<strong>BetonBestellen.nl BV</strong><br>
										Ondernemersweg 4<br>
										4691 SL Tholen<br>
										Telefoon: 0166-604035
									</address>
									<br>
									<div>
										Bank: NL67 ABNA 0548 7707 43<br>
										Btw-nummer: NL8565.25.352.B01<br>
										KvK-nummer: 66382386
									</div>
									<br>
									<div>
										E-mail:info@betonbestellen.nl
									</div>
								</td>
								<td colspan="2">
									<?php echo wp_get_attachment_image(26, 'large') ?>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="text-left">
									<div style="margin-top: 25px;">
										Offertenummer: <?php echo '#' . $quote_id; ?><br>
										Offertedatum: <?php echo get_the_date('d-m-Y', $quote_id) ?><br>
										Vervaldatum: <?php echo date("d-m-Y", strtotime("+1 month", strtotime(get_the_date('d-m-Y', $quote_id)))); ?><br>
										E-mail aanvrager: <?php echo get_post_meta($quote_id , 'user_email', true); ?>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<br><br>
				<div class="row">
					<div class="col-md-12 table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>Omschrijving</th>
									<th>Aantal</th>
									<th>Prijs</th>
									<th class="text-right">Totaal</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>Beton:</strong></td>
									<td></td>
									<td></td>
									<td class="text-right"></td>
								</tr>
								<tr>
									<td class="space-left"><span id="concrete_cubic_size"><?php echo $cubic_m; ?></span> m³ beton <?php echo $city ? 'te ' . $city . ':' : '' ?></td>
									<td><?php echo $cubic_m; ?> m³</td>
									<td>
										<?php echo wc_price(get_post_meta($quote_id , 'totals_aantal_cost', true) / $cubic_m); ?>
									</td>
									<td class="text-right"><?php echo wc_price(get_post_meta($quote_id , 'totals_aantal_cost', true)); ?></td>
								</tr>
								<tr>
									<td class="space-left">Toepassing - <span class="gray-out"><?php echo get_post_meta($quote_id , 'application_product', true) ?></span></td>
									<td><?php echo $cubic_m; ?></td>
									<td><?php echo wc_price(floatval(get_post_meta($quote_id , 'totals_toepassing_cost', true)) / $cubic_m) ?></td>
									<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_toepassing_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_toepassing_cost', true)) : ''; ?></td>
								</tr>
								<?php if (!empty(get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true))) { ?>
									<tr>
										<td class="space-left">Hoog vloeibaar</td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo wc_price(floatval(get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_snelhardend_cost', true))) { ?>
									<tr>
										<td class="space-left">Snelhardend</td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo wc_price(floatval(get_post_meta($quote_id , 'totals_snelhardend_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_snelhardend_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_snelhardend_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_fijn_grind_cost', true))) { ?>
									<tr>
										<td class="space-left">Fijn grind</td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo wc_price(floatval(get_post_meta($quote_id , 'totals_fijn_grind_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_fijn_grind_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_fijn_grind_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true))) { ?>
									<tr>
										<td class="space-left">Extra hoge sterkte</td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo wc_price(floatval(get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<tr>
									<td><strong>Los methode</strong></td>
									<td></td>
									<td></td>
									<td class="text-right"></td>
								</tr>
								<?php if (get_post_meta($quote_id , 'unloading', true)) { ?>
									<tr>
										<td class="space-left"><span class="gray-out"><?php echo get_post_meta($quote_id , 'unloading', true) ;  ?></span></td>
										<td></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php }
								if (get_post_meta($quote_id , 'totals_pump_cost', true) > 0) { ?>
									<tr>
										<td class="space-left"><?php echo get_post_meta($quote_id , 'pump_type', true) == 'mini' ? "Mini betonpomp" : "Giekpomp" ?> per uur</td>
										<td></td>
										<td></td>
										<td class="text-right"><?php echo wc_price(get_post_meta($quote_id , 'totals_pump_cost', true)); ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_voorrijkosten_cost', true))) { ?>
									<tr>
										<td class="space-left">Voorrijkosten</td>
										<td>1</td>
										<td>
											<?php echo get_post_meta($quote_id , 'totals_voorrijkosten_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_voorrijkosten_cost', true)) : ''; ?>
										</td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_voorrijkosten_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_voorrijkosten_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true))) { ?>
									<tr>
										<td class="space-left">Toeslag extra leidingwagen</td>
										<td></td>
										<td></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'pumping_distance', true))) {

									$pumping_distance_price = floatval(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true)) + floatval(get_post_meta($quote_id , 'totals_pumping_distance_cost', true));
								?>
									<tr>
										<td class="space-left">Pompafstand:</td>
										<td><span class="pumping_distance"><?php echo get_post_meta($quote_id , 'pumping_distance', true); ?>m</span></td>
										<td>
											<?php echo wc_price($pumping_distance_price / get_post_meta($quote_id , 'pumping_distance', true)); ?>
										</td>
										<td class="text-right">
											<?php echo (get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true) > 0 or get_post_meta($quote_id , 'totals_pumping_distance_cost', true) > 0) ? wc_price($pumping_distance_price) : ''; ?>
											<?php //echo get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true)) : ''; 
											?>
										</td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left">All-in uitvoering</td>
										<td>1</td>
										<td><?php echo get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true)) : ''; ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_vlindervloer_cost', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left">Vlindervloer</td>
										<td></td>
										<td></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_vlindervloer_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_vlindervloer_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>

								<?php if (!empty(get_post_meta($quote_id , 'additional_surace-sqm', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left">Oppervlakte</td>
										<td><?php echo get_post_meta($quote_id , 'additional_surace-sqm', true) ? (get_post_meta($quote_id , 'additional_surace-sqm', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'additional_layer-thickness', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left">Laagdikte</td>
										<td><?php echo get_post_meta($quote_id , 'additional_layer-thickness', true) ? (get_post_meta($quote_id , 'additional_layer-thickness', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'additional_flooring', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left">Verdiepingsvloer</td>
										<td><?php echo get_post_meta($quote_id , 'additional_flooring', true) ? (get_post_meta($quote_id , 'additional_flooring', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'additional_nos_rooms', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left">Aantal vertrekken</td>
										<td><?php echo get_post_meta($quote_id , 'additional_nos_rooms', true) ? (get_post_meta($quote_id , 'additional_nos_rooms', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>

								<tr>
									<td></td>
									<td class="text-right">Subtotaal</td>
									<td></td>
									<td class="text-right"><strong><?php echo wc_price(get_post_meta($quote_id , 'totals_subtotal', true)); ?></strong></td>
								</tr>
								<tr>
									<td></td>
									<td class="text-right">BTW 21%</td>
									<td></td>
									<td class="text-right"><strong><?php echo wc_price(get_post_meta($quote_id , 'totals_btw', true)); ?></strong></td>
								</tr>
								<tr>
									<td></td>
									<td class="text-right">Totaal</td>
									<td></td>
									<td class="text-right"><strong><?php echo wc_price(get_post_meta($quote_id , 'totals_grand_total', true)); ?></strong></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- /.col -->
				</div>
				<br>
				<small><small>Op al onze leveringen en werkzaamheden zijn de Algemene Verkoopwaarden van BetonBestellen.nl van toepassing.</small></small>
				<div>
					<small><small>DISCLAIMER: deze automatisch door het systeem gegenereerde offerte van fouten bevatten en is onder voorbehoud.</small></small>
				</div>
			</div>
		</div>
	</body>

	</html>
<?php
	//=========   HTML CODE BEGINS ENDS BEFORE THE BEGINING PHP TAG ====================

	global $html;
	$html = ob_get_contents(); // get all html in buffer to the $html global variable
	ob_end_clean(); // clean the buffer 
	return ['html' => $html, 'id' => $quote_id , 'title' => get_the_title($quote_id )]; // return html
}

// function test_pdf()
// {
// 	if (empty($_GET['download_pdf'])) {
// 		return;
// 	}

// 	// echo $data['html'];
// 	$quote_id = 160;
// 	$data = quotation_html(160);

// 	send_quotation_email($data, 'harshana@dayzsolutions.com', $quote_id);

// 	// stream_pdf_file($data['html'], $data['id'], $data['title'], true);
// }
// add_action('init', 'test_pdf');

function stream_pdf_file($contents, $id, $title, $is_stream = false)
{
	// Include autoloader 
	require_once 'inc/dompdf/autoload.inc.php';

	// Instantiate and use the dompdf class   
	$dompdf = new Dompdf\Dompdf();
	$dompdf->set_option('enable_html5_parser', TRUE);
	$dompdf->loadHtml($contents);
	// (Optional) Setup the paper size and orientation 
	$dompdf->setPaper('A4', 'Portrait');
	$dompdf->set_option('isRemoteEnabled', true);
	// Render the HTML as PDF 
	$dompdf->render();

	ob_end_clean();

	if ($is_stream) {
		$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
		return;
	} else {
		$pdf = $dompdf->output();
		$upload = wp_upload_bits($title . '.pdf', null, $pdf);
		$attach_id = wp_insert_attachment($pdf, $upload['file'], $id);
		return $attach_id;
	}
	exit(0);
}

function send_quotation_email($data, $email, $quote_id) {
		$pdf_id = stream_pdf_file($data['html'], $data['id'], $data['title']);

		$to = $email;
		$headers = array();
		$attachments = [get_attached_file($pdf_id), 'https://www.betonbestellen.nl/wp-content/uploads/2022/06/aandachtspunten.pdf', 'https://betonbestellen.nl/Algemene_voorwaarden.pdf'];

		$mail_attachment = array(get_attached_file($pdf_id), WP_CONTENT_DIR . '/uploads/2022/06/aandachtspunten.pdf', WP_CONTENT_DIR . '/uploads/2022/06/alv.pdf');

		$unloading_method = get_post_meta($quote_id , 'unloading', true);
		$butterfly_floor = get_post_meta($quote_id, 'additional_butterfly-floor', true);
		$performance = get_post_meta($quote_id, 'uitvoering', true);
		$cubic_m = get_post_meta($quote_id, 'cubic_meters', true);
		$city = get_post_meta($quote_id, 'postalcode', true);

		if ($performance == 'allIn') {
			$dynamic_p = 'U heeft er voor gekozen zelf de beton te storten.';
		} else {
			$dynamic_p = 'U heeft er voor gekozen het beton op all-in basis te laten storten.';
		}

		if ($performance != 'allIn' and $unloading_method != 'pump') {
			$dynamic_mail_txt = get_field('method_one', 'option');
		} elseif ($performance !== 'allIn' and $unloading_method == 'pump') {
			$dynamic_mail_txt = get_field('method_two', 'option');
		} elseif ($performance == 'allIn' and $unloading_method == 'pump' and $butterfly_floor == 0) {
			$dynamic_mail_txt = get_field('method_three', 'option');
		} elseif ($performance == 'allIn' and $unloading_method == 'pump' and $butterfly_floor) {
			$dynamic_mail_txt = get_field('method_four', 'option');
		}

		if (!isset($dynamic_mail_txt) or empty($dynamic_mail_txt)) {
			$dynamic_mail_txt = '<p class="">' . $dynamic_p . '</p>
			<p class="">Het is belangrijk met de volgende aandachtspunten rekening te houden:<br class="" /><br class="" /></p>
			<ul class="">
			<li class="">Verzorg voldoende manschappen. Er is een maximale lostijd van toepassing bij een afname t/m 7 kuub van 45 min en bij 15 kuub van 75 minuten;</li>
			<li class="">Maak voldoende opstel plaats vrij voor de betonmixer. De afmetingen van de vrachtwagen is afhankelijk van de hoeveelheid beton maar minimaal vergelijkbaar met een vuilniswagen;</li>
			<li class="">In de binnenstad is soms ontheffing of een vergunning benodigd. Verzorg deze optijd;</li>
			<li class="">Op al onze leveringen zijn de algemene voorwaarden van toepassing, zie: <a class="" title="https://betonbestellen.nl/alv.pdf" href="https://betonbestellen.nl/alv.pdf">https://betonbestellen.nl/alv.pdf</a></li>
			</ul>';
		}

		$html = '<div class="">
		<p class="">Geachte heer / mevrouw,</p>
		<p class="">Hierbij ons voorstel voor het pompen en eventueel storten van ca ' . $cubic_m . ' m3 beton te ' . $city . ' (zie PDF bijlage)</p>
		' . $dynamic_mail_txt . '
		Wij vertrouwen erop u hiermee een passende aanbieding te doen.
		<div class=""> </div>
		<p class="">Dit is een automatisch gegenereerde offerte, mocht u akkoord gaan met onze offerte dan kunt u per e-mail of telefoon contact met ons opnemen om een afspraak in te plannen. U kunt de offerte ook direct via iDeal afrekenen. <a href="' . wc_get_checkout_url() . '?pay-url=' . $quote_id . '">Klik hier</a></p>
		<p class=""><a class="" title="https://g.page/r/CcvazzN6aWu0EAI/review" href="https://g.page/r/CcvazzN6aWu0EAI/review">Klik hier om een review te schrijven over uw ervaringen met Betonstorten.nl</a>.</p>
		<p class="">Met vriendelijke groet,</p>
		<p class="">De medewerkers van <a class="" title="http://BetonBestellen.nl" href="http://betonbestellen.nl/">BetonBestellen.nl</a> BV</p>
		<p class=""><b class="">E</b> <a class="" title="mailto:info@betonstorten.nl" href="mailto:info@betonstorten.nl">info@betonstorten.nl</a><br class="" /><b class="">T</b> (0166) 606001<br class="" /><b class="">M</b> 06 27016082</p>
		</div>';

		$content_type = function () {
			return 'text/html';
		};
		add_filter('wp_mail_content_type', $content_type);
		// $headers[] = 'Cc: info@betonbestellen.nl';
		wp_mail($to, 'Offerte van BetonBestellen.nl', $html, $headers, $mail_attachment);
		remove_filter('wp_mail_content_type', $content_type);
		$url_r = get_permalink(get_page_by_path('offerte-aanvraag'));
		$url_r = add_query_arg('quotation', 'sent', $url_r);
		wp_delete_attachment($pdf_id); //DELETE PDF
		return ['redirect_url' => $url_r];
}

add_action('wp_ajax_concrete_add_to_cart', 'concrete_add_to_cart');
add_action('wp_ajax_nopriv_concrete_add_to_cart', 'concrete_add_to_cart');
function concrete_add_to_cart() {
	$data = $_POST;
	unset($data['action']);
	WC()->cart->empty_cart(); // Empty the cart before add newly
	$cart_item_key = WC()->cart->add_to_cart( get_field('beton_product', 'option') );

	if ($cart_item_key) {
		WC()->session->set('billing_email', $_POST['user_email']);
        wp_send_json_success([
            'message' => 'Product added to cart successfully!',
            'cart_item_key' => $cart_item_key,
			'redirect' => wc_get_checkout_url()
        ]);
    } else {
        wp_send_json_error(['message' => 'Failed to add product to cart.']);
    }

    wp_die(); // Terminate to ensure no extra output
}

function override_checkout_email_field( $fields ) {
    $billing_email = WC()->session->get('billing_email');
    if(!is_null($billing_email)) {
      $fields['billing']['billing_email']['default'] = $billing_email;
    }
    return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'override_checkout_email_field' );

//Add custom cart item data
function beton_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if( isset( $_POST['action'] ) && $_POST['action'] == 'concrete_add_to_cart' ) {
		$data = $_POST;
		unset($data['action']);

		$data['city'] = $data['postalcode'];
		$calc_data = $data;
		$calc_data['application'] = $_POST['application_product'];
		$calc_data['compounds'] = $_POST['composition'];
		$calc_data['release_method'] = $_POST['unloading'];
		$calc_data['pumping_distance'] = (isset($_POST['pump_type']) && $_POST['pump_type'] == 'mini' ? $_POST['pumping_distance'] : $_POST['boom_pumping_distance']);
		$calc_data['performance'] = $_POST['uitvoering'];
		$calc_data['layer_thickness'] = $_POST['layer-thickness'];
		$calc_data['rooms_count'] = $_POST['nos_rooms'];
		$calc_data['butterfly_floor'] = $_POST['butterfly-floor'];
		$calc_data['surface'] = $_POST['surace-sqm'];
		$calc_data['selected_floor'] = $_POST['flooring'];

		$calcuated_data = beton_calculator($calc_data);

		wc_get_logger()->debug('Adding to cart (cacl data): ' . json_encode($calcuated_data));

		if($calcuated_data['beton_price'] && $calcuated_data['cubic_meters_formatted']){
			$cart_item_data['concrete_value'] = $calcuated_data['beton_price'];
			$cubic_meters = number_format($calcuated_data['cubic_meters_formatted'], 2);
			$cart_item_data['concrete_label'] = "Beton: {$cubic_meters}m³";

			$cart_item_data['hidden_concrete_qty_value'] = $cubic_meters;
			$cart_item_data['hidden_concrete_qty_label'] = 'Concrete Cubic meters';
		}

		if(isset($calcuated_data['application_price'])){
			$cart_item_data['application_label'] = "Toepassing";
			$cart_item_data['application_value'] = $calcuated_data['application_price'];
		}

		if($data['composition']){
			$cart_item_data['compositions_label'] = ucwords(str_replace('-', ' ', implode(', ', $data['composition'])));
			$cart_item_data['compositions_value'] = $calcuated_data['application_compound_total'] - $calcuated_data['application_price'];

			foreach($data['composition'] as $composition){
				if(isset($calcuated_data[$composition])){
					$cart_item_data['hidden_' . $composition . '_label'] =  ucwords(str_replace('-', ' ', $composition));
					$cart_item_data['hidden_' . $composition . '_value'] = $calcuated_data[$composition];
				}
			}
		}

		if(isset($data['unloading'])){
			$cart_item_data['unloading_label'] = "Loswijze";
			$cart_item_data['unloading_value'] = $data['unloading'] == 'pump' ? 'Pomp' : "Gutter";
		}

		if(isset($calcuated_data['pump_cost'])){
			$cart_item_data['pump_label'] = ($data['pump_type'] == 'mini' ? 'Mini betonpomp' : 'Giekpomp');
			$cart_item_data['pump_value'] = $calcuated_data['pump_cost'];
		}

		if(isset($calcuated_data['pump_callout_cost'])){
			$cart_item_data['callout_label'] = "Voorrijkosten";
			$cart_item_data['callout_value'] = $calcuated_data['pump_callout_cost'];
		}

		if(isset($calcuated_data['pumping_cost'])){
			$cart_item_data['pumping_label'] = "Pompafstand - {$data['pumping_distance']}m";
			$cart_item_data['pumping_value'] = $calcuated_data['pumping_cost'];
		}

		if(isset($data['pumping_distance'])){
			$cart_item_data['hidden_pumping_distance_label'] = "Pumping Distance";
			$cart_item_data['hidden_pumping_distance_value'] = $data['pumping_distance'];
		}

		if(isset($calcuated_data['pumping_extra_hose_cost'])){
			$cart_item_data['pumping_value'] = $calcuated_data['pumping_cost'] + $calcuated_data['pumping_extra_hose_cost'];
		}

		if(isset($calcuated_data['allIn_cost'])){
			$cart_item_data['allin_label'] = "All-in";
			$cart_item_data['allin_value'] = $calcuated_data['allIn_cost'];
		}

		if(isset($calcuated_data['butterfly_floor_cost'])){
			$cart_item_data['butterfly_floor_label'] = "Vlindervloer";
			$cart_item_data['butterfly_floor_value'] = $calcuated_data['butterfly_floor_cost'];
		}

		$cart_item_data['sub_total'] = $calcuated_data['sub_total'];

		wc_get_logger()->debug('Adding to cart: ' . json_encode($cart_item_data));
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'beton_cart_item_data', 10, 3 );

//Display custom item data in the cart
function beton_get_item_data( $item_data, $cart_item_data ) {
	// echo '<pre>';
	// print_r($cart_item_data);
	// echo '</pre>';

	foreach($cart_item_data as $label => $cart_item){
		if(str_ends_with($label, 'label') && !str_starts_with($label, 'hidden_')){
			$value = $cart_item_data[str_replace('label', 'value', $label)];
			$item_data[] = array(
				'key' => $cart_item_data[$label],
				'value' => is_numeric($value) ? wc_price($value) : wc_clean($value)
			);
		}
	}

    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'beton_get_item_data', 10, 2 );

//Add custom meta to order
function beton_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
	wc_get_logger()->debug('Adding to order: ' . json_encode($values));
	foreach($values as $label => $cart_item){
		if(str_ends_with($label, 'label') || str_starts_with($label, 'hidden')){
			$value = $values[str_replace('label', 'value', $label)];
			$item->add_meta_data($values[$label], is_numeric($value) ? wc_price($value) : wc_clean($value), true);
			$item->add_meta_data('raw_' . str_replace('label', 'value', $label), $value, true);
			$item->add_meta_data('raw_' . $label, $values[$label], true);
		}
		// if(str_starts_with($label, 'hidden')){
		// 	$item->add_meta_data('raw_' . str_replace('label', 'value', $label), $value, true);
		// 	$item->add_meta_data('raw_' . $label, $values[$label], true);
		// }
	}

	// if($values[''])
}
add_action( 'woocommerce_checkout_create_order_line_item', 'beton_checkout_create_order_line_item', 10, 4 );

add_action('woocommerce_before_calculate_totals', function($cart_object){
	foreach ($cart_object->get_cart() as $cart_item_key => $cart_item) {
		$product = $cart_item['data'];
		$sub_total = isset($cart_item['sub_total']) ? floatval($cart_item['sub_total']) : '';

		if (!empty($sub_total)) {
			$cart_item['data']->set_price($sub_total);
		}
	}
});