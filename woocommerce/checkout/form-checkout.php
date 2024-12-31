<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout row" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div class="col-lg-6 pe-lg-5 verticle-separator">
		<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set checkout-box mb-4" id="customer_details">
			<div class="checkout-billing-shipping-title-wrapper d-flex justify-content-between align-items-center mb-4">
				<h2>Factuur- en Verzendgegevens</h2>
				<a class="checkout-icons-btn d-none">
					<svg class="checkout-icons" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
					<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
					</svg>
				</a>
				
			</div>
			<div class="checkout-content-wrapper checkout-billing-shipping-fields-wrapper">
				<div class="checkout-billing-fields">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="checkout-shipping-fields">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
				<button type="button" class="w-100 oswald-600 text-sm-20 text-white text-uppercase border-2 border-orange bg-orange rounded-0 px-6 py-2 mb-3" id="checkout-billing-shipping-confirm">Doorgaan</button>
			</div>
		</div>

		<?php endif; ?>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
	</div>
	
	
	<div class="col-lg-6 ps-lg-5">
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
		<h2 id="order_review_heading" class="pb-4">Uw bestelling</h2>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</div>
	

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
