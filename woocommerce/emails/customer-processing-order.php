<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

 /**
  * Custom processing order email template
  */
 if (!defined('ABSPATH')) {
	 exit;
 }
 
 do_action('woocommerce_email_header', $email_heading, $email); 
 ?>


 <h1 style="font-size: 26px; color: #040e56; text-align: center; font-weight: 400; margin-bottom: 20px; text-shadow: 0 1px 0 #040e56;">Bedankt voor de de beton aanvraag!</h1>

 <p style="margin-bottom: 30px; font-size: 18px; text-align: center;"><?php 
    printf(
		esc_html__('Beste %s,', 'woocommerce'),
		esc_html($order->get_billing_first_name())
	);

	echo '<br>Bedankt voor de bestelling op Betonstorten.nl. Onze planners gaan aan de slag met het verzoek en zullen per e-mail of telefoon contact opnemen om de planning van de betonlevering te bevestigen.';
    ?>
</p>
 
 
 <div style="padding-top: 20px; padding-bottom: 20px; background-color: #e4e0ff; margin-bottom: 20px;">
 	<h2 style="text-align: center; margin-bottom: 20px; color: #040e56; margin-bottom: 0px;">Jouw order gegevens</h2>
 </div>
 
 <?php 
 do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);
 echo '<div class="delivery-date-wrapper">';
 do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);
 echo '</div>';
 do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);
 do_action('woocommerce_email_footer', $email);
