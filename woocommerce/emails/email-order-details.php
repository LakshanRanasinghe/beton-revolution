<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';

$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );
$heading_class              = $email_improvements_enabled ? 'email-order-detail-heading' : '';
$order_table_class          = $email_improvements_enabled ? 'email-order-details' : '';
$order_total_text_align     = $email_improvements_enabled ? 'right' : 'left';
$order_quantity_text_align  = $email_improvements_enabled ? 'right' : 'left';

if ( $email_improvements_enabled ) {
	add_filter( 'woocommerce_order_shipping_to_display_shipped_via', '__return_false' );
}

/**
 * Action hook to add custom content before order details in email.
 *
 * @param WC_Order $order Order object.
 * @param bool     $sent_to_admin Whether it's sent to admin or customer.
 * @param bool     $plain_text Whether it's a plain text email.
 * @param WC_Email $email Email object.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<h2 class="<?php echo esc_attr( $heading_class ); ?>" style="color:#040e56;font-size:22px;text-align:center;margin-bottom:20px;">
	<?php
	if ( $email_improvements_enabled ) {
		echo wp_kses_post( __( 'Order summary', 'woocommerce' ) );
	}
	if ( $sent_to_admin ) {
		$before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '" style="color:#040e56;text-decoration:none;">';
		$after  = '</a>';
	} else {
		$before = '';
		$after  = '';
	}
	if ( $email_improvements_enabled ) {
		echo '<br><span>';
	}

	$order_number_string = __( '[Order #%s]', 'woocommerce' );
	if ( $email_improvements_enabled ) {
		$order_number_string = __( 'Order #%s', 'woocommerce' );
	}

	echo wp_kses_post(
		$before .
		sprintf(
			$order_number_string . $after . ' (<time datetime="%s">%s</time>)',
			$order->get_order_number(),
			$order->get_date_created()->format( 'c' ),
			wc_format_datetime( $order->get_date_created() )
		)
	);

	if ( $email_improvements_enabled ) {
		echo '</span>';
	}
	?>
</h2>

<div style="margin-bottom:<?php echo $email_improvements_enabled ? '24px' : '40px'; ?>;">

	<table cellspacing="0" cellpadding="10" style="width:100%;border-collapse:collapse;border:1px solid #e5e5e5;font-family:Arial,Helvetica,sans-serif;" border="0">
		<thead>
			<tr style="background:#040e56;color:#ffffff;">
				<th style="text-align:<?php echo esc_attr( $text_align ); ?>;padding:12px;font-weight:600;"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th style="text-align:<?php echo esc_attr( $order_quantity_text_align ); ?>;padding:12px;font-weight:600;"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th style="text-align:<?php echo esc_attr( $order_total_text_align ); ?>;padding:12px;font-weight:600;"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			</tr>
		</thead>

		<tbody style="background:#ffffff;">
			<?php
			$image_size = $email_improvements_enabled ? 48 : 32;

			echo wc_get_email_order_items(
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => $email_improvements_enabled,
					'image_size'    => array( $image_size, $image_size ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
	</table>

	<table cellspacing="0" cellpadding="10" style="width:100%;border-collapse:collapse;border:1px solid #e5e5e5;border-top:0;font-family:Arial,Helvetica,sans-serif;" border="0">

		<?php
		$item_totals       = $order->get_order_item_totals();
		$item_totals_count = count( $item_totals );

		if ( $item_totals ) {
			$i = 0;
			foreach ( $item_totals as $total ) {
				++$i;
				$last_class = ( $i === $item_totals_count ) ? ' order-totals-last' : '';
				?>

				<tr class="order-totals">
					<th colspan="2" style="text-align:left;padding:12px;background:#f6f8ff;border-bottom:1px solid #e5e5e5;font-weight:600;color:#040e56;">
						<?php
						echo wp_kses_post( $total['label'] ) . ' ';
						if ( $email_improvements_enabled ) {
							echo isset( $total['meta'] ) ? wp_kses_post( $total['meta'] ) : '';
						}
						?>
					</th>

					<td style="text-align:<?php echo esc_attr( $order_total_text_align ); ?>;padding:12px;background:#f6f8ff;border-bottom:1px solid #e5e5e5;font-weight:600;">
						<?php echo wp_kses_post( $total['value'] ); ?>
					</td>
				</tr>

				<?php
			}
		}
		?>

	</table>

	<?php if ( $order->get_customer_note() && $email_improvements_enabled ) { ?>
	<table cellspacing="0" cellpadding="12" style="width:100%;border:1px solid #e5e5e5;margin-top:15px;background:#f6f8ff;">
		<tr>
			<td style="text-align:left;font-size:14px;">
				<strong style="color:#040e56;"><?php esc_html_e( 'Customer note', 'woocommerce' ); ?></strong><br>
				<?php echo wp_kses( nl2br( wc_wptexturize_order_note( $order->get_customer_note() ) ), array( 'br' => array() ) ); ?>
			</td>
		</tr>
	</table>
	<?php } ?>

</div>

<?php
if ( $email_improvements_enabled ) {
	remove_filter( 'woocommerce_order_shipping_to_display_shipped_via', '__return_false' );
}

/**
 * Action hook to add custom content after order details in email.
 *
 * @param WC_Order $order Order object.
 * @param bool     $sent_to_admin Whether it's sent to admin or customer.
 * @param bool     $plain_text Whether it's a plain text email.
 * @param WC_Email $email Email object.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
?>
