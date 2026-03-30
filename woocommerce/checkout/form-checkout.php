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

if (! defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>
<div class="location-and-quantity-section2 section-wrap px-sm-5 py-sm-4 box-shadow-no-bottom box-sm-white position-relative z-3 filled inactive" data-step="1">
	<div class="step-title-block position-relative d-none d-sm-block">
		<div class="position-relative z-1 bg-sm-white bg-custom-gray-3 d-inline-block pe-3 py-sm-0 py-1">
			<h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative d-sm-inline-block d-none"></i> LOCATIE EN BETONHOEVEELHEID</h5>
		</div>
		<hr class="text-light-gray position-absolute w-100 top-0 mt-3">
	</div>
</div>
<div class="type-and-kind-section2 section-wrap px-sm-5 py-sm-4 box-shadow-no-bottom box-sm-white position-relative text-dark-gray z-2 pending inactive" data-step="2">
	<div class="step-title-block position-relative d-sm-block d-none">
		<div class="position-relative z-1 bg-white d-sm-inline-block pe-3">
			<h5 class="step-title text-dark-blue oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative d-sm-inline-block d-none"></i> TYPE EN SOORT</h5>
		</div>
		<hr class="text-light-gray position-absolute w-100 top-0 mt-3">
	</div>
</div>
<div class="confirm-and-pay-section active section-wrap px-sm-5 py-sm-4 box-shadow-no-top box-sm-white position-relative text-dark-gray z-1">
	<div class="step-title-block position-relative d-sm-inline-block d-none">
		<div class="position-relative z-1 bg-white d-inline-block pe-3">
			<h5 class="step-title text-custom-gray-4 oswald-600 text-20 d-inline-block mt-1 disabled"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> BEVESTIG ADRES EN BETAAL</h5>
		</div>
		<hr class="text-light-gray position-absolute w-100 top-0 mt-3">
	</div>
	<div class="confirm-and-pay-section-title position-relative pb-4 pending">
		<form name="checkout" method="post" class="checkout woocommerce-checkout row pl-5" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
			<div class="col-lg-6 pe-lg-5 verticle-separator">
				<h2 id="order_review_heading" class="pb-4 pt-sm-4 pt-0 text-uppercase">Afrekenen</h2>
				<?php if ($checkout->get_checkout_fields()) : ?>
					<?php do_action('woocommerce_checkout_before_customer_details'); ?>
					<div class="col2-set checkout-box mb-4">
						<div class="checkout-email-title-wrapper d-flex justify-content-between align-items-center mb-3">
							<div class="before-collapse-title">
								<h2>Persoonlijke informatie</h2>
							</div>
							<div class="after-collapse-title d-none">
								<div class="d-flex align-items-center">
									<h4 class="mb-0 me-2">Persoonlijke informatie</h4>
									<svg class="mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20px" width="20px" fill="green">
										<path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
									</svg>
								</div>
								<small><span class="preview-first-name"></span>&nbsp;<sapn class="preview-last-name"></sapn></small>
							</div>
							<a class="checkout-icons-btn d-none">
								<svg class="checkout-icons" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
									<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
								</svg>
							</a>

						</div>
						<div class="checkout-content-wrapper checkout-email-fields-wrapper">
							<div class="checkout-email-field">
								<p class="form-row form-row-wide validate-required validate-email" id="custom_email_field"><label for="custom_email" class="">E-mailadres&nbsp;<abbr class="required" title="vereist">*</abbr></label><span class="woocommerce-input-wrapper">
										<input type="email" class="input-text px-pixel-10" name="custom_email" id="custom_email" placeholder="" value="" aria-required="true" autocomplete="email username">
									</span><span id="custom_email_error" class="text-danger mt-2 d-none">Voer een geldig e-mailadres in.</span></p>

							</div>

							<div class="checkout-personal-info-fields d-none">
								<div class="form-row mb-2">
									<label class="label fs-lg" l10ntranslate="">Besteltype</label>
									<div class="d-if">
										<label data-tab="order-type-radio-1" for="order-type-private" l10ntranslate="" class="is_active">
											<input class="mr-1r ng-untouched ng-pristine ng-valid" formcontrolname="custom_order_type" id="order-type-private" name="custom_order_type" type="radio" value="0" checked>&nbsp; Privé </label> &nbsp;&nbsp;
										<label data-tab="order-type-radio-2" for="order-type-business" l10ntranslate="">
											<input formcontrolname="custom_order_type" id="order-type-business" name="custom_order_type" type="radio" value="1" class="ng-untouched ng-pristine ng-valid px-pixel-10">&nbsp; Bedrijf </label>
									</div>
								</div>
								<p class="form-row form-row-wide d-none" id="custom_company_field"><label for="custom_company" class="">Bedrijfsnaam&nbsp;</label><span class="woocommerce-input-wrapper">
										<input type="text" class="input-text px-pixel-10 " name="custom_company" id="custom_company" placeholder="" value="" autocomplete="organization">
									</span><span id="custom_company_error" class="text-danger mt-1 d-none">Voer uw bedrijfsnaam in.</span></p>

								<p class="form-row form-row-wide validate-eu-vat-number d-none" id="custom_eu_vat_number_field" data-priority="200">
									<label for="custom_eu_vat_number" class="">EU BTW-nummer</label><span class="woocommerce-input-wrapper">
										<input type="text" class="input-text " name="custom_eu_vat_number" id="custom_eu_vat_number" value="">
									</span><span id="custom_eu_vat_number_error" class="text-danger mt-1 d-none">Het veld "EU BTW-nummer" is verplicht.</span>
								</p>

								<p class="form-row form-row-first validate-required" id="custom_first_name_field"><label for="custom_first_name" class="">Voornaam&nbsp;<abbr class="required" title="vereist">*</abbr></label><span class="woocommerce-input-wrapper">
										<input type="text" class="input-text px-pixel-10" name="custom_first_name" id="custom_first_name" placeholder="" value="" aria-required="true" autocomplete="given-name">
									</span><span id="custom_first_name_error" class="text-danger mt-1 d-none">Voer uw voornaam in.</span></p>

								<p class="form-row form-row-last validate-required" id="custom_last_name_field"><label for="custom_last_name" class="">Achternaam&nbsp;<abbr class="required" title="vereist">*</abbr></label><span class="woocommerce-input-wrapper">
										<input type="text" class="input-text px-pixel-10 " name="custom_last_name" id="custom_last_name" placeholder="" value="" aria-required="true" autocomplete="family-name">
									</span><span id="custom_last_name_error" class="text-danger mt-1 d-none">Voer uw achternaam in.</span></p>

								<p class="form-row form-row-wide validate-required validate-phone" id="custom_phone_field"><label for="custom_phone" class="">Telefoon&nbsp;<abbr class="required" title="vereist">*</abbr></label><span class="woocommerce-input-wrapper">
										<input type="tel" class="input-text px-pixel-10 " name="custom_phone" id="custom_phone" placeholder="" value="" aria-required="true" autocomplete="tel">
									</span><span id="custom_phone_error" class="text-danger mt-1 d-none">Voer een geldig telefoonnummer in.</span></p>
							</div>
							<button type="button" class="w-100 oswald-600 text-sm-20 text-white text-uppercase border-2 border-orange bg-orange rounded-0 px-6 py-2 mb-3" id="checkout-email-confirm">Doorgaan</button>
						</div>
					</div>

					<div class="col2-set checkout-box mb-4" id="customer_details">
						<div class="checkout-billing-shipping-title-wrapper d-flex justify-content-between align-items-center mb-3">
							<div class="before-collapse-title">
								<h2>Verzendgegevens</h2>
							</div>
							<div class="after-collapse-title d-none">
								<div class="d-flex align-items-center mb-2">
									<h4 class="mb-0 me-2">Verzendgegevens</h4>
									<svg class="mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20px" width="20px" fill="green">
										<path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
									</svg>
								</div>
								<small class="preview-shipping-address mb-0" style="line-height: 12px;"></small><br>
								<small class="mb-0"><span>Gewenst levertijdslot: </span><span class="preview-time-slot"></span></small>
							</div>

							<a class="checkout-icons-btn d-none">
								<svg class="checkout-icons" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
									<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
								</svg>
							</a>

						</div>
						<div class="checkout-content-wrapper checkout-billing-shipping-fields-wrapper d-none">
							<div class="checkout-shipping-fields">
								<?php do_action('woocommerce_checkout_shipping'); ?>
								<?php echo do_shortcode('[dayz_date_mapper_snippet]'); ?>
							</div>
							<button type="button" class="w-100 oswald-600 text-sm-20 text-white text-uppercase border-2 border-orange bg-orange rounded-0 px-6 py-2 mb-3" id="checkout-billing-shipping-confirm">Doorgaan</button>
						</div>
					</div>

				<?php endif; ?>

				<div class="checkout-billing-content-wrapper checkout-box no-bottom-border-radius">
					<div class="checkout-payment-title-wrapper d-flex justify-content-between align-items-center pb-0 mb-0">
						<div class="before-collapse-title">
							<h2>Betalingsgegevens</h2>
						</div>
						<div class="after-collapse-title d-none">
							<div class="d-flex align-items-center ">
								<h4 class="mb-0 me-2">Betalingsgegevens</h4>
								<svg class="mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20px" width="20px" fill="green">
									<path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
								</svg>
							</div>
							<small class="preview-billing-address mb-0" style="line-height: 12px;"></small><br>
							<small class="mb-0"><span>Betaalmethode: </span><span class="payment-method-preview"></span></small>
						</div>
						<a class="checkout-icons-btn d-none">
							<svg class="checkout-icons" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
								<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
							</svg>
						</a>
					</div>
					<div class="checkout-billing-fields-wrapper checkout-content-wrapper pt-3 d-none">
						<h5 id="billing-to-different-address" class="pt-2 pb-1 mb-0">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
								<input id="billing-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="billing_to_different_address" checked> <span>Factuuradres is hetzelfde als afleveradres</span>
							</label>
						</h5>
						<div class="checkout-billing-fields col2-set pb-1 pt-2 d-none">
							<?php do_action('woocommerce_checkout_billing'); ?>
						</div>
					</div>

				</div>
				<?php do_action('woocommerce_checkout_after_customer_details'); ?>
			</div>


			<div class="col-lg-6 ps-lg-5 review-section">
				<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

				<h2 id="order_review_heading" class="pb-4 pt-sm-4 pt-0 text-uppercase d-flex align-items-center"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/03/icon-euro.png" alt="Euro" style="height: 30px;">&nbsp;Uw bestelling</h2>

				<?php do_action('woocommerce_checkout_before_order_review'); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action('woocommerce_checkout_order_review'); ?>
				</div>

				<?php do_action('woocommerce_checkout_after_order_review'); ?>

				<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt w-100 oswald-600 text-sm-20 text-white text-uppercase border-2 border-orange bg-orange rounded-0 px-6 py-2 mb-3" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( 'Doorgaan' ) . '" data-value="' . esc_attr( 'Doorgaan' ) . '">' . esc_html( 'Doorgaan' ) . '</button>' ); // @codingStandardsIgnoreLine ?>

			</div>


		</form>
	</div>
</div>


<?php do_action('woocommerce_after_checkout_form', $checkout); ?>