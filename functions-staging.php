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
	define('_S_VERSION', '1.0.2');
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
			'menu-2' => esc_html__('Mobile', 'beton'),
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
	wp_enqueue_script('beton', get_stylesheet_directory_uri() . '/js/beton.js', array('jquery'), '1.2.25', true);
	wp_enqueue_script('beton-checkout', get_stylesheet_directory_uri() . '/js/beton-woocommerce.js', array('jquery'), '1.2.6', true);

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
	wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/custom.css', array('bootstrap'), '1.0.13');
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

	wc_get_logger()->debug( json_encode($result) );

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
			if (!empty($ele->elements[0]->distance->text)) {
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
		$beton_price = floatval($seller_price_data['seller_price']) * floatval($cubic_meters);
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
	
	$response_data_set['application_price_formatted'] = '<span>' . $pricingData['application_items_title'] . '<span class="text-15 text-light-gray"> : ' . $application_data['product_name'] . '</span></span><span class="' . ($application_price <= 0 ? 'beton-price-zero-entry' : '') . '">' . wc_price($application_price) . '</span>';

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
	$response_data_set['application_compound_total_formatted'] = '<span>' . __('Totaal', 'beton') . '</span><span>' . wc_price($application_compound_total) . '</span>';
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
				//$response_data_set['pumping_extra_hose_cost_formatted'] = wc_price(0);
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
				$allInConcreteThreshold = get_field('all_in_concrete_threshold', 'option');
				$allInConcreteThresholdOverPrice = get_field('overlimit_price_per_cubic_m', 'option');

				wc_get_logger()->debug( 'All in price1: ' . $all_in_price);

				if($cubic_meters > floatval($allInConcreteThreshold)){
					$all_in_price += (floatval($cubic_meters) - floatval($allInConcreteThreshold)) * 5;
			
					$all_in_price += (floatval($cubic_meters) - floatval($allInConcreteThreshold)) * floatval($allInConcreteThresholdOverPrice);
				}

				wc_get_logger()->debug( 'All in price2: ' . $all_in_price);
				wc_get_logger()->debug( 'All in concrete threshold: ' . $allInConcreteThreshold);
				wc_get_logger()->debug( 'All in concrete threshold over price: ' . $allInConcreteThresholdOverPrice);
				wc_get_logger()->debug( 'Cubic meters: ' . $cubic_meters);
				wc_get_logger()->debug( 'Calc amount: ' . (floatval($cubic_meters) - floatval($allInConcreteThreshold)) * floatval($allInConcreteThresholdOverPrice));

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

function butterfly_coster($selected_surface, $selected_rooms) : float {
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
		'status' => 'mail-sent',
		'redirect' => get_field('thank_you_page', 'option')
	]);
}

function custom_wc_price($price, $args = array()){
    $original_price = $price;
    $price = (float) $price;

	$unformatted_price = $price;
	$negative          = $price < 0;
	$price = apply_filters( 'raw_woocommerce_price', $negative ? $price * -1 : $price, $original_price );
	$price = apply_filters( 'formatted_woocommerce_price', number_format( $price, 2, ',', $args['thousand_separator'] ), $price, 2, ',', '.', $original_price );

	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $args['decimals'] > 0 ) {
		$price = wc_trim_zeros( $price );
	}
	$return = get_woocommerce_currency_symbol() . ' ' . $price;

	return $return; //apply_filters( 'wc_price', $return, $price, $args, $unformatted_price, $original_price );
}

function findReplaceValue(string $seekValue): ?string
{
    $data = get_field('replacer', 'option');
    foreach ($data as $item) {
        if (strtolower($item['seek']) === strtolower($seekValue)) {
            return $item['replace'];
        }
    }

    return $seekValue; // return false if not found
}

function test_pdf()
{
	if (empty($_GET['download_pdf'])) {
		return;
	}

	// echo $data['html'];
	$quote_id = $_GET['download_pdf'];
	$data = quotation_html($quote_id);

// 	send_quotation_email($data, 'harshana@dayzsolutions.com', $quote_id);

	stream_pdf_file($data['html'], $data['id'], $data['title'], true);
}
add_action('init', 'test_pdf');

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
				background: #db0900;
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
										<strong>BetonBestellen B.V</strong><br>
										Ondernemersweg 4<br>
										4691 SL Tholen<br>
										Telefoon: 0166-604035<br>
									</address>
									<br>
									<div>
										Bank: NL67 ABNA 0548 7707 43<br>
										Btw-nummer: NL8565.25.352.B01<br>
										KvK-nummer: 66382386
									</div>
									<br>
									<div>
										E-mail: info@mobielebetoncentrale.nl
									</div>
								</td>
								<td colspan="2" style="text-align: right;">
									<?php echo wp_get_attachment_image(get_theme_mod( 'custom_logo' ), 'large') ?>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="text-left">
									<div style="margin-top: 25px;">
										Offertenummer: <strong><?php echo '#' . $quote_id; ?></strong><br>
										Offertedatum: <strong><?php echo get_the_date('d-m-Y', $quote_id) ?></strong><br>
										Vervaldatum: <strong><?php echo date("d-m-Y", strtotime("+1 month", strtotime(get_the_date('d-m-Y', $quote_id)))); ?></strong><br>
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
										<?php echo custom_wc_price(get_post_meta($quote_id , 'beton_cost', true) / $cubic_m); ?>
									</td>
									<td class="text-right"><?php echo custom_wc_price(get_post_meta($quote_id , 'beton_cost', true)); ?></td>
								</tr>
								<tr>
									<td class="space-left"><?php echo findReplaceValue('Toepassing'); ?> - <span class="gray-out"><?php echo get_post_meta($quote_id , 'application_product', true) ?></span></td>
									<td><?php echo $cubic_m; ?></td>
									<td><?php echo custom_wc_price(floatval(get_post_meta($quote_id , 'totals_toepassing_cost', true)) / $cubic_m) ?></td>
									<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_toepassing_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_toepassing_cost', true)) : ''; ?></td>
								</tr>
								<?php if (!empty(get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Hoog vloeibaar'); ?></td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo custom_wc_price(floatval(get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_hoog_vloeibaar_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_snelhardend_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Snelhardend'); ?></td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo custom_wc_price(floatval(get_post_meta($quote_id , 'totals_snelhardend_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_snelhardend_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_snelhardend_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_fijn_grind_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Fijn grind'); ?></td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo custom_wc_price(floatval(get_post_meta($quote_id , 'totals_fijn_grind_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_fijn_grind_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_fijn_grind_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Extra hoge sterkte'); ?></td>
										<td><?php echo $cubic_m; ?></td>
										<td><?php echo custom_wc_price(floatval(get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true)) / $cubic_m); ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_extra_hoge_sterkte_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<tr>
									<td style="padding-top: 25px;"><strong><?php echo findReplaceValue('Los methode'); ?></strong></td>
									<td style="padding-top: 25px;"></td>
									<td style="padding-top: 25px;"></td>
									<td style="padding-top: 25px;" class="text-right"></td>
								</tr>
								<?php if (get_post_meta($quote_id , 'unloading', true)) { 
								    $unloadingMethod = get_post_meta($quote_id , 'unloading', true);
								?>
									<tr>
										<td class="space-left"><span class="gray-out"><?php echo $unloadingMethod == 'pump' ? 'Pomp' : ($unloadingMethod == 'gutter' ? 'Uit de goot / kruiwagen' : $unloadingMethod);  ?></span></td>
										<td></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php }
								if (get_post_meta($quote_id , 'totals_pump_cost', true) > 0) { ?>
									<tr>
										<td class="space-left">
											<?php
											$pumpType = get_post_meta($quote_id, 'pump_type', true);
    										$boomPumpingDistance = get_post_meta($quote_id, 'boom_pumping_distance', true);
											echo ($pumpType == 'mini') ? "Mini betonpomp" : "Giekpomp" . ($pumpType != 'mini' ? ": {$boomPumpingDistance}m" : "");
										 	?>
										</td>
										<td></td>
										<td></td>
										<td class="text-right"><?php echo custom_wc_price(get_post_meta($quote_id , 'totals_pump_cost', true)); ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_voorrijkosten_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Voorrijkosten'); ?></td>
										<td>1</td>
										<td>
											<?php echo get_post_meta($quote_id , 'totals_voorrijkosten_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_voorrijkosten_cost', true)) : ''; ?>
										</td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_voorrijkosten_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_voorrijkosten_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Toeslag extra leidingwagen'); ?></td>
										<td></td>
										<td></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php $pompType = get_post_meta($quote_id , 'pump_type', true); ?>
								<?php if (!empty(get_post_meta($quote_id , 'pumping_distance', true)) && ($unloadingMethod != 'gutter') && ($pompType == 'mini')) {

									$pumping_distance_price = floatval(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true)) + floatval(get_post_meta($quote_id , 'totals_pumping_distance_cost', true));
								?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Pompafstand'); ?>:</td>
										<td><span class="pumping_distance"><?php echo get_post_meta($quote_id , 'pumping_distance', true); ?>m</span></td>
										<td>
											<?php echo custom_wc_price($pumping_distance_price / get_post_meta($quote_id , 'pumping_distance', true)); ?>
										</td>
										<td class="text-right">
											<?php echo (get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true) > 0 or get_post_meta($quote_id , 'totals_pumping_distance_cost', true) > 0) ? custom_wc_price($pumping_distance_price) : ''; ?>
											<?php //echo get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true) > 0 ? wc_price(get_post_meta($quote_id , 'totals_toeslag_extra_leidingwagen_cost', true)) : ''; 
											?>
										</td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('All-in uitvoering'); ?></td>
										<td>1</td>
										<td><?php echo get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true)) : ''; ?></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'totals_vlindervloer_cost', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Vlindervloer'); ?></td>
										<td></td>
										<td></td>
										<td class="text-right"><?php echo get_post_meta($quote_id , 'totals_vlindervloer_cost', true) > 0 ? custom_wc_price(get_post_meta($quote_id , 'totals_vlindervloer_cost', true)) : ''; ?></td>
									</tr>
								<?php } ?>

								<?php if (!empty(get_post_meta($quote_id , 'additional_surace-sqm', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Oppervlakte'); ?></td>
										<td><?php echo get_post_meta($quote_id , 'additional_surace-sqm', true) ? (get_post_meta($quote_id , 'additional_surace-sqm', true)  . ' m²') : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'additional_layer-thickness', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Laagdikte'); ?></td>
										<td><?php echo get_post_meta($quote_id , 'additional_layer-thickness', true) ? (get_post_meta($quote_id , 'additional_layer-thickness', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'additional_flooring', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Verdiepingsvloer'); ?></td>
										<td><?php echo get_post_meta($quote_id , 'additional_flooring', true) ? (get_post_meta($quote_id , 'additional_flooring', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>
								<?php if (!empty(get_post_meta($quote_id , 'additional_nos_rooms', true)) and !empty(get_post_meta($quote_id , 'totals_all-in_uitvoering_cost', true))) { ?>
									<tr>
										<td class="space-left"><?php echo findReplaceValue('Aantal vertrekken'); ?></td>
										<td><?php echo get_post_meta($quote_id , 'additional_nos_rooms', true) ? (get_post_meta($quote_id , 'additional_nos_rooms', true)) : ''; ?></td>
										<td></td>
										<td class="text-right"></td>
									</tr>
								<?php } ?>

								<tr>
									<td></td>
									<td class="text-right">Subtotaal</td>
									<td></td>
									<td class="text-right"><strong><?php echo custom_wc_price(get_post_meta($quote_id , 'totals_subtotal', true)); ?></strong></td>
								</tr>
								<tr>
									<td></td>
									<td class="text-right">BTW 21%</td>
									<td></td>
									<td class="text-right"><strong><?php echo custom_wc_price(get_post_meta($quote_id , 'totals_btw', true)); ?></strong></td>
								</tr>
								<tr>
									<td></td>
									<td class="text-right">Totaal</td>
									<td></td>
									<td class="text-right"><strong><?php echo custom_wc_price(get_post_meta($quote_id , 'totals_grand_total', true)); ?></strong></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- /.col -->
				</div>
				<br>
				<p style="text-align: center; width: 100%;"><small style="text-align: center; width: 100%;">Op al onze leveringen en werkzaamheden zijn van toepassing de Algemene Verkoopvoorwaarden van den Vereniging van
Ondernemingen van Betonmortelfabrikanten in Nederland voor het verpompen van betonmortel conform laatstelijk
gedeponeerde versie te griffie van de Arrondissementsrechtbank te 's-Gravenhage</small></p>
				<!--<div>-->
				<!--	<small><small>DISCLAIMER: deze automatisch door het systeem gegenereerde offerte van fouten bevatten en is onder voorbehoud.</small></small>-->
				<!--</div>-->
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
		<p class="">Dit is een automatisch gegenereerde offerte, mocht u akkoord gaan met onze offerte dan kunt u per e-mail of telefoon contact met ons opnemen om een afspraak in te plannen. U kunt de offerte ook direct via iDeal afrekenen. <a href="' . wc_get_checkout_url() . '?pay-url=' . encrypt_code($quote_id) . '">Klik hier</a></p>
		<p class=""><a class="" title="https://g.page/r/CcvazzN6aWu0EAI/review" href="https://g.page/r/CcvazzN6aWu0EAI/review">Klik hier om een review te schrijven over uw ervaringen met Mobielebetoncentrale.nl</a>.</p>
		<p class="">Met vriendelijke groet,</p>
		<p class="">De medewerkers van <a class="" title="http://BetonBestellen.nl" href="http://betonbestellen.nl/">BetonBestellen.nl</a> BV</p>
		<p class=""><b class="">E</b> <a class="" title="mailto:info@mobielebetoncentrale.nl" href="mailto:info@mobielebetoncentrale.nl">info@mobielebetoncentrale.nl</a><br class="" /><b class="">T</b> (0166) 606001<br class="" /><b class="">M</b> 06 27016082</p>
		</div>';

		$content_type = function () {
			return 'text/html';
		};
		add_filter('wp_mail_content_type', $content_type);
		// $headers[] = 'Cc: info@mobielebetoncentrale.nl';
		wp_mail($to, 'Offerte van mobielebetoncentrale.nl', $html, $headers, $mail_attachment);
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

	$fields['shipping']['shipping_email'] = array(
		'label'     => __('Email Address', 'woocommerce'),
		'placeholder'   => _x('Email', 'placeholder', 'woocommerce'),
		'required'  => true,
		'class'     => array('form-row-wide'),
		'clear'     => true
		 );
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
			$cart_item_data['unloading_value'] = $data['unloading'] == 'pump' ? 'Pomp' : "Uit de goot";
		}

		if(isset($calcuated_data['pump_cost'])){
			if($data['pump_type'] == 'mini'){
				$custom_pump_label = 'Mini betonpomp';
			}else{
				$custom_pump_label = 'Giekpomp - ' . $_POST['boom_pumping_distance'] . 'm';
			}
			$cart_item_data['pump_label'] = $custom_pump_label;
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

		// if(isset($data['pumping_distance'])){
		// 	$cart_item_data['hidden_pumping_distance_label'] = "Pumping Distance";
		// 	$cart_item_data['hidden_pumping_distance_value'] = $calc_data['pumping_distance'];
		// }

		if(isset($data['pumping_distance'])){
			$cart_item_data['hidden_pumping_distance_value_extra'] = $calc_data['pumping_distance'];
		}

		if(isset($calcuated_data['pumping_extra_hose_cost'])){
			$cart_item_data['pumping_value'] = $calcuated_data['pumping_cost'] + $calcuated_data['pumping_extra_hose_cost'];
		}

		if(isset($calcuated_data['allIn_cost'])){
			$cart_item_data['allin_label'] = "All-in";
			$cart_item_data['allin_value'] = $calcuated_data['allIn_cost'];

			if(isset($_POST['surace-sqm'])){
				$cart_item_data['surface_label'] = "Oppervlak";
				$cart_item_data['surface_value'] = $_POST['surace-sqm'];
			}

			if(isset($_POST['nos_rooms'])){
				$cart_item_data['number_of_rooms_label'] = "Aantal Kamers";
				$cart_item_data['number_of_rooms_value'] = $_POST['nos_rooms'];
			}

			if(isset($_POST['layer-thickness'])){
				$cart_item_data['hidden_layer_thickness_extra'] = $_POST['layer-thickness'];
			}

			if(isset($calc_data['selected_floor'])){
				if($calc_data['selected_floor'] == 1){
					$cart_item_data['hidden_selected_floor_extra'] = true;
				}else{
					$cart_item_data['hidden_selected_floor_extra'] = false;
				}
			}
		}

		if(isset($calcuated_data['butterfly_floor_cost'])){
			$cart_item_data['butterfly_floor_label'] = "Vlindervloer";
			$cart_item_data['butterfly_floor_value'] = $calcuated_data['butterfly_floor_cost'];
		}

		//Attach data that webhook needed
		if(!empty($_POST['composition']) && is_array($_POST['composition'])){
			foreach($_POST['composition'] as $compound){
				if($compound == 'hoge-sterkte'){
					$cart_item_data['hidden_sterkte_extra'] = "C30/37";
				}

				if($compound == 'hoog-vloeibaar'){
					$cart_item_data['hidden_consitstentie_extra'] = "F4";
				}

				if($compound == 'vlinderbeton'){
					$cart_item_data['hidden_milleuklasse_extra'] = "XC4";
				}

				if($compound == 'fijn-grind'){
					$cart_item_data['hidden_grind_extra'] = "16";
				}

				if($compound == 'snelhardend') {
					$cart_item_data['hidden_portlandc_extra'] = "25";			
				}
			}

			if(empty($cart_item_data['hidden_sterkte_extra'])){
				$cart_item_data['hidden_sterkte_extra'] = "C20/25";
			}

			if(empty($cart_item_data['hidden_consitstentie_extra'])){
				$cart_item_data['hidden_consitstentie_extra'] = "S3";
			}

			if(empty($cart_item_data['hidden_milleuklasse_extra'])){
				if($_POST['application_product'] == 'funderingsbalk'){
					$cart_item_data['hidden_milleuklasse_extra'] = "XC3";
				}else{
					$cart_item_data['hidden_milleuklasse_extra'] = "XC2";
				}
			}

			if(empty($cart_item_data['hidden_grind_extra'])){
				$cart_item_data['hidden_grind_extra'] = "32";
			}

			if(empty($cart_item_data['hidden_portlandc_extra'])){
				$cart_item_data['hidden_portlandc_extra'] = "none";
			}
			
		} else {
			$cart_item_data['hidden_sterkte_extra'] = "C20/25";
			$cart_item_data['hidden_consitstentie_extra'] = "S3";

			if($_POST['application_product'] == 'funderingsbalk'){
				$cart_item_data['hidden_milleuklasse_extra'] = "XC3";
			}else{
				$cart_item_data['hidden_milleuklasse_extra'] = "XC2";
			}

			$cart_item_data['hidden_grind_extra'] = "32mm";
			$cart_item_data['hidden_portlandc_extra'] = "geen";
		}	

		$cart_item_data['sub_total'] = $calcuated_data['sub_total'];

		wc_get_logger()->debug('Adding to cart: ' . json_encode($cart_item_data));
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'beton_cart_item_data', 10, 3 );

//Display custom item data in the cart
function beton_get_item_data( $item_data, $cart_item_data ) {
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
	// wc_get_logger()->debug('Adding to order: ' . json_encode($values));
	
	foreach($values as $label => $cart_item){
		if((str_ends_with($label, 'label') || str_starts_with($label, 'hidden')) && !str_ends_with($label, 'extra')){
			$value = $values[str_replace('label', 'value', $label)];
			if($label == 'number_of_rooms_label') {
				$item->add_meta_data($values[$label], wc_clean($value), true);
			}elseif($label == 'surface_label'){
				$item->add_meta_data($values[$label], wc_clean($value) . ' m²', true);
			}else{
				$item->add_meta_data($values[$label], is_numeric($value) ? wc_price($value) : wc_clean($value), true);
			}
			$item->add_meta_data('raw_' . str_replace('label', 'value', $label), $value, true);
			$item->add_meta_data('raw_' . $label, $values[$label], true);
		}
		
		if(in_array($label, ['hidden_sterkte_extra', 'hidden_consitstentie_extra', 'hidden_milleuklasse_extra', 'hidden_grind_extra', 'hidden_portlandc_extra', 'hidden_selected_floor_extra', 'hidden_layer_thickness_extra', 'hidden_pumping_distance_value_extra'])) {
			$item->add_meta_data('raw_' . $label, $values[$label], true);
		} 
	}
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

add_filter('woocommerce_order_item_get_formatted_meta_data', function($formatted_meta, $item){
	$skippers = [
		'Hoog Vloeibaar', 'Extra Hoge Sterkte', 'Snelhardend', 'Fijn Grind', 'Concrete Cubic meters'
	];
	foreach($formatted_meta as $key => $meta){
		if(str_contains($meta->key, 'raw') || str_contains($meta->key, 'hidden') || is_numeric($meta->key) || in_array($meta->key, $skippers )){
			unset($formatted_meta[$key]);
		}
	}
	return $formatted_meta;
}, 10, 2);

function dayz_gcal($order, $orddd)
{
	if (!isset($orddd->order_weblink)) {
		$orddd->order_weblink = '';
	}

	$metaLine = '';

	foreach ($order->get_items() as $item_id => $item) {
		$allmeta = $item->get_meta_data();
		foreach ($allmeta as $meta) {
			$value = '';
			if ('Beton' === $meta->key) {
				$value = number_format($meta->value, 2) . 'm³ : ' . wc_price(wc_get_order_item_meta($item_id, 'aantal_price', true));
			} elseif ('Toepassing' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'application_price', true))) {
				$value = $meta->value . ': ' . wc_price(wc_get_order_item_meta($item_id, 'application_price', true));
			} elseif ('Samenstelling' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'composition_total_price', true))) {
				$value = $meta->value . ': ' . wc_price(wc_get_order_item_meta($item_id, 'composition_total_price', true));
			} elseif ('Pomp' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'pump_total', true))) {
				$value = $meta->value . ': ' . wc_price(floatval(wc_get_order_item_meta($item_id, 'pump_total', true)));
			} elseif ('Voorrijkosten' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'Voorrijkosten', true))) {
				$value = wc_price(wc_get_order_item_meta($item_id, 'Voorrijkosten', true));
			} elseif ('Pompafstand' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'pumping_distance_total', true))) {
				if (wc_get_order_item_meta($item_id, 'mini_extra_horse', true)) {
					$extra = wc_get_order_item_meta($item_id, 'mini_extra_horse', true);
				} else {
					$extra = 0;
				}
				$value = $meta->value . ': ' . wc_price(floatval(wc_get_order_item_meta($item_id, 'pumping_distance_total', true)) + floatval($extra));
			} elseif ('Vlindervloer' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'butterfly_floor', true))) {
				$value = $meta->value . ': ' . wc_price(floatval(wc_get_order_item_meta($item_id, 'butterfly_floor', true)));
			} elseif ('Uitvoering' === $meta->key && (!empty(wc_get_order_item_meta($item_id, 'all-in-total', true)))) {
				$additional = 0;
				if (!empty(wc_get_order_item_meta($item_id, 'all-in-total', true))) {
					$additional += floatval(wc_get_order_item_meta($item_id, 'all-in-total', true));
				}
				$value = $meta->value . ': ' . wc_price($additional);
			} elseif ($meta->key == 'Laagdikte') {
				$value = $meta->value;
			} elseif ($meta->key == 'Oppervlakte') {
				$value = $meta->value;
			} elseif ($meta->key == 'Hoog vloeibaar') {
				$value = wc_price($meta->value);
			} elseif ($meta->key == 'Fijn grind') {
				$value = wc_price($meta->value);
			} else {
				continue;
			}
			$metaLine .= $meta->key . ': ' . wp_strip_all_tags($value) . ' | ';
		}
	}

	// Find time difference from Greenwich as GCal asks UTC.
	$summary = str_replace(
		array('SITE_NAME', 'CLIENT', 'PRODUCTS', 'PRODUCT_WITH_QTY', 'ORDER_DATE_TIME', 'ORDER_DATE', 'ORDER_NUMBER', 'PRICE', 'PHONE', 'NOTE', 'FULL_ADDRESS', 'ADDRESS', 'EMAIL', 'ORDER_WEBLINK'),
		array(get_bloginfo('name'), $orddd->client_name, $orddd->products, $metaLine, $orddd->order_date_time, $orddd->order_date, $orddd->id, $orddd->order_total, $orddd->client_phone, $orddd->order_note, $orddd->client_full_address, $orddd->client_address, $orddd->client_email, urlencode($orddd->order_weblink)),
		get_option('orddd_calendar_event_summary')
	);

	$description = str_replace(
		array('SITE_NAME', 'CLIENT', 'PRODUCTS', 'PRODUCT_WITH_QTY', 'ORDER_DATE_TIME', 'ORDER_DATE', 'ORDER_NUMBER', 'PRICE', 'PHONE', 'NOTE', 'FULL_ADDRESS', 'ADDRESS', 'EMAIL', 'ORDER_WEBLINK'),
		array(get_bloginfo('name'), $orddd->client_name, $orddd->products, $metaLine, $orddd->order_date_time, $orddd->order_date, $orddd->id, $orddd->order_total, $orddd->client_phone, $orddd->order_note, $orddd->client_full_address, $orddd->client_address, $orddd->client_email, urlencode($orddd->order_weblink)),
		get_option('orddd_calendar_event_description')
	);

	if ($orddd->start_time == '' && $orddd->end_time == '') {
		$start = strtotime($orddd->start);
		$end   = strtotime($orddd->end . '+1 day');

		$gmt_start = date('Ymd', $start);
		$gmt_end   = date('Ymd', $end);
	} elseif ($orddd->end_time == '') {
		$start = strtotime($orddd->start . ' ' . $orddd->start_time);
		$end   = strtotime($orddd->end . ' ' . $orddd->start_time);

		$gmt_start = get_gmt_from_date(date('Y-m-d H:i:s', $start), 'Ymd\THis\Z');
		$gmt_end   = get_gmt_from_date(date('Y-m-d H:i:s', $end), 'Ymd\THis\Z');
	} else {
		$start = strtotime($orddd->start . ' ' . $orddd->start_time);
		$end   = strtotime($orddd->end . ' ' . $orddd->end_time);

		$gmt_start = get_gmt_from_date(date('Y-m-d H:i:s', $start), 'Ymd\THis\Z');
		$gmt_end   = get_gmt_from_date(date('Y-m-d H:i:s', $end), 'Ymd\THis\Z');
	}

	if (get_option('orddd_calendar_event_location') != '') {
		$location = str_replace(array('FULL_ADDRESS', 'ADDRESS_SHIP', 'ADDRESS', 'CITY'), array($orddd->client_full_address, $orddd->client_address, $orddd->client_address, $orddd->client_city), get_option('orddd_calendar_event_location'));
	} else {
		$location = get_bloginfo('description');
	}

	$param = array(
		'action'   => 'TEMPLATE',
		'text'     => $summary,
		'dates'    => $gmt_start . '/' . $gmt_end,
		'location' => $location,
		'details'  => $description,
	);

	return esc_url(
		add_query_arg(
			array($param, $start, $end),
			'http://www.google.com/calendar/event'
		)
	);
}

/**
 * translate 'optional' string behind the oreder note field in checkout
 */
add_filter( 'woocommerce_form_field', 'translate_optional_text', 10, 4 );

function translate_optional_text( $field, $key, $args, $value ) {
    if ( 'order_comments' === $key ) {
        $field = str_replace( '(optional)', '(optioneel)', $field );
    }
    return $field;
}

add_filter('dayz_moneybird_document_lines', 'dayz_moneybird_addon_document_lines', 10, 2);
function dayz_moneybird_addon_document_lines($lines, $order)
{
    foreach ($order->get_items() as $item_id => $item) {
        /* @var $item \WC_Order_Item_Product */
        $product = $item->get_product();
        if (!$product) {
            throw new \Exception("Product not found.");
        }

        $matchData = array(
            'Beton' => 'aantal_price',
            'Samenstelling' => 'composition_total_price',
            'Hoog vloeibaar' => 'composition_price_hoog-vloeibaar',
            'Snelhardend' => 'composition_price_snelhardend',
            'Fijn grind' => 'composition_price_fijn-grind',
            'Vlinderbeton' => 'composition_price_vlinderbeton',
            'Extra hoge sterkte' => 'composition_price_extra-hoge-sterkte',
            'Toepassing' => 'application_price',
            'Pomp' => 'pump_total',
            'Pompafstand' => 'pumping_distance_total',
            'Uitvoering' => 'all-in-total',
            'Vlindervloer' => 'butterfly_floor',
            'Voorrijkosten' => 'Voorrijkosten',
            // 'Forfait' => 'Forfait'
        );
        
        $subMeta = ['Oppervlakte', 'Laagdikte', 'Aantal vertrekken'];
        $add_formatted_more = ['Toeslag extra leidingwagen' => 'mini_extra_horse'];
        $replacers = get_field('replacer', 'option');
		
        foreach ($order->get_items() as $item_id => $item) {
            // Custom
            $deviations = array(
				'raw_application_label' => 'raw_application_value',
                'raw_concrete_label' => 'raw_hidden_concrete_qty_value',
                'raw_hidden_hoog-vloeibaar_label' => 'raw_hidden_concrete_qty_value',
                'raw_hidden_extra-hoge-sterkte_label' => 'raw_hidden_concrete_qty_value',
                'raw_hidden_snelhardend_label' => 'raw_hidden_concrete_qty_value',
                'raw_hidden_fijn-grind_label' => 'raw_hidden_concrete_qty_value',
                'raw_pumping_label' => 'raw_hidden_pumping_distance_value'
            );
    
            $skipping = array('raw_hidden_concrete_qty_label', 'raw_hidden_pumping_distance_label');

            foreach($item->get_meta_data() as $meta){
                if(str_contains($meta->key, 'raw_') && !in_array($meta->key, $skipping)){
                    if(str_contains($meta->key, 'label') && $meta->key !== 'raw_compositions_label'){
                        $value = $item->get_meta(str_replace('label', 'value', $meta->key));
						echo 'meta key : ' . $meta->key . '<br>';
						echo 'value : ' . $value . '<br>';
                        if(isset($deviations[$meta->key])){
                            $qty = $item->get_meta($deviations[$meta->key]);
							if ( $qty > 0 ) {
								$value = $value / $qty;
							} else {
								$qty = 1;
							}
                        }else{
                            $qty = 1;
                        }
                        
                        // if(is_string($value)){
                        //     $value = 0;
                        // }
                        // $formatted_meta[$meta->value] = $value;
                        
                        $description = $meta->value;
                        if (str_contains($description, 'Beton') && !str_contains($description, 'betonpomp')) {
                            //$ledger_account_id = '450784868029171239'; //Omzet Beton
							$value = $item->get_meta('raw_concrete_value');
							$qty = $item->get_meta('raw_hidden_concrete_qty_value');
							$value = $value / $qty;
                        }
                        
                        if (in_array($description, ['Hoog vloeibaar', 'Snelhardend', 'Fijn grind', 'Extra hoge sterkte', 'Vlinderbeton'])) {
                            //$ledger_account_id = '450784868029171239'; //Omzet Beton
                        }
                        
                        if (str_contains($description, 'All-in') || str_contains($description, 'Vlindervloer')) {
                            //$ledger_account_id = '450784890512737433'; //OMZET ALLIN
                        }
            
                        if (str_contains($description, 'Pomp')) {
                            //$ledger_account_id = '450784950650668889'; //OMZET POMPHUUR
                        }
						
						if (str_contains($description, 'Mini betonpomp')) {
                            //$ledger_account_id = '450784950650668889'; //Mini Pomp
                        }
                        if (str_contains($description, 'Voorrijkosten')) {
                            //$ledger_account_id = '450784884723549721'; //OMZET VOORRIJKOSTEN
                        }
                        if (str_contains($description, 'Pompafstand')) {
                            //$ledger_account_id = '450784996710417861'; //OMZET SLANGEN
							$value = $item->get_meta('raw_pumping_value') / $qty;
// 							$qty = 1;
                        }
						if (str_contains($description, 'Giekpomp')) {
							$pompafstand = $item->get_meta('raw_hidden_pumping_distance_value');
							if (!empty($pompafstand)) {
								$description .= ': ' . $pompafstand . 'm';
							}
						}

						foreach($replacers as $replace){
                            if($replace['seek'] == $description){
                                $description = $replace['replace'];
                            }
                        }
						
                        // Format cost
                        $cost = number_format(floatval($value), 2, '.', '');
                        
                        $lastLineItem = end($lines);
                        $lines[] = array(
                            'description' => $description,
                            'price' => floatval($cost),
                            'amount' => floatval($qty),
                            'tax_rate_id' => $lastLineItem['tax_rate_id'],
                            // 'ledger_account_id' => $ledger_account_id,
                            'row_order' => $lastLineItem['row_order'] + 1
                        );
            
                    }
                }
            }
        }
    }
    array_shift($lines); //remove the first line (main product)
    
    return $lines;
}

// add_action('wp_head', function(){

// 	if(!isset($_GET['test'])){return;}

// 	$order = wc_get_order(913);
// 	$test = dayz_moneybird_addon_document_lines([], $order);

// 	echo '<pre>';
// 	print_r($test);
// 	echo '</pre>';

// });

add_action('dayz_moneybird_after_invoice_generate', function($order, $mb_doc){
    $mbAPi = new WC_MoneyBird2();
    $mbapi_collect = $mbAPi->dayz_load_api_connector();
    $order_id = $order->get_id();
    $invoice_id = trim($order->get_meta('moneybird_invoice_id', true));
    $notes = '';
    $deliveryDate = get_post_meta($order_id, '_orddd_delivery_date' , true);
    $deliveryTime = get_post_meta($order_id, '_orddd_time_slot' , true);
    if($order->get_formatted_shipping_address()){
        $notes .= 'VerzendmethodenBewerken: ' . $order->get_formatted_shipping_address();
    }
    if(!empty($deliveryDate) and !empty($deliveryTime)){
        $notes .= ' | Leveringsdatum: ' . $deliveryDate . ', Gewenst levertijdslot: ' . $deliveryTime;
    }

    if(!empty($deliveryDate) and !empty($deliveryTime)){
        $delivery = 'Leveringsdatum: ' . $deliveryDate . ', Gewenst levertijdslot: ' . $deliveryTime;
    }
    if(!empty($mbapi_collect) && is_object($mbapi_collect)){
        $mbapi_collect->dayz_createSalesInvoiceNote($invoice_id, $delivery);
    }
}, 10, 2);

// add_filter('dayz_moneybird_document_custom_fields', 'dayz_moneybird_addon_document_custom_fields', 10, 2);
function dayz_moneybird_addon_document_custom_fields($custom_fields, $order)
{
	$deliveryDate = get_post_meta($order->get_id(), '_shipping_dayz_date_mapper_date' , true);
    $deliveryTime = get_post_meta($order->get_id(), '_shipping_dayz_date_mapper_timeslots' , true);
    if(!empty($deliveryDate) and !empty($deliveryTime)){
        $custom_fields[] = array(
            'id' => 450664252407023519,
            'value' => $deliveryDate . ', Gewenst levertijdslot: ' . $deliveryTime,
        );
    }
    if(empty($order->get_shipping_address_1())){
        $address = str_replace('<br/>', ',', $order->get_formatted_billing_address());
    }else{
        $address = str_replace('<br/>', ',', $order->get_formatted_shipping_address());
    }
    $custom_fields[] = array(
        'id' => 450677096878966316,
        'value' => str_replace('<br/>', ', ', $address),
    );
    return $custom_fields;
}
// add_action('init', function() {
//     $uri = $_SERVER['REQUEST_URI'];
//     // Check if URI is not the homepage and ends with a slash
//     if ($uri != '/' && substr($uri, -1) == '/') {
//     // Properly trim the slash and perform a 301 redirect
//         wp_redirect(rtrim($uri, '/'), 301);
//         exit();
//     }
// });
// 
function encrypt_code( $code ) {
    if ( empty( $code ) ) {
    return '';
    }
    $default_secure_auth_key = '0ba9a3f00578e986813891a38555f50a';

    $key = defined( 'SECURE_AUTH_KEY' ) ? SECURE_AUTH_KEY : $default_secure_auth_key;
    $encryption_key = base64_decode( $key );
    $iv = substr( openssl_random_pseudo_bytes( openssl_cipher_iv_length( 'aes-256-cbc' ) ), 0, 16 );
    $encrypted = openssl_encrypt( $code, 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA, $iv );
    
    // Append the $iv variable to use for decrypting later.
    return base64_encode( $encrypted . '::' . $iv );
}

function decrypt_code( $code ) {
    $default_secure_auth_key = '0ba9a3f00578e986813891a38555f50a';
    $key = defined( 'SECURE_AUTH_KEY' ) ? SECURE_AUTH_KEY : $default_secure_auth_key;
    $encryption_key = base64_decode( $key );
    
    // Grab the $iv from earlier, to decrypt.
    list( $encrypted_data, $iv ) = explode( '::', base64_decode( $code ), 2 );
    
    return openssl_decrypt( $encrypted_data, 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA, $iv );
}


add_action('wp_head', function() {
    if (!isset($_GET['tttt'])) return;
    
    $order = wc_get_order(1313);
    if (!$order) {
        echo '<pre>Order not found</pre>';
        return;
    }

    foreach ($order->get_items() as $item_id => $item) {
        echo '<h4>Item ID: ' . $item_id . '</h4>';
        
        $all_meta = $item->get_meta_data();
        $formatted_meta = [];
        foreach ($all_meta as $meta) {
            $formatted_meta[$meta->key] = $meta->value;
        }
        
        echo '<pre>All Meta (formatted): ';
        print_r($formatted_meta);
        echo '</pre>';
    }
});