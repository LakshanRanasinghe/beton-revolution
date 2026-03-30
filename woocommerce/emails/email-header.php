<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );
$store_name                 = $store_name ?? get_bloginfo( 'name', 'display' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?php echo esc_html( $store_name ); ?></title>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<style>
			#template_header_image p {
				text-align: center;
			}
			#template_header_image img {
				width: 200px !important;
				margin-right: 0px !important;
			}
			#template_header_image {
				background-color: #040e56;
				padding: 32px 32px 12px !important;
			}
			#header_wrapper {
				display: none;
			}
			h2 {
				color: #040e56;
			}
			address {
				border: 1px solid #040e56 !important;
				min-height: 110px;
			}
			#addresses tr td:first-child address {
				margin-right: 10px;
			}
			#body_content_inner > h2 {
				text-align: center;
			}
			.order-item-data img {
				display: none;
			}

			#addresses {
				margin-top: 20px;
				margin-bottom: 30px;
			}
			#addresses td {
				vertical-align: top;
			}
			#addresses .address-title {
				display: block;
				font-size: 16px;
				font-weight: 600;
				color: #040e56;
				margin-bottom: 8px;
			}
			#addresses address {
				border: 2px solid #040e56 !important;
				border-radius: 6px;
				padding: 16px !important;
				background-color: #f5f7ff;
				font-style: normal;
				line-height: 1.6;
				min-height: 120px;
				color: #333;
			}
			#addresses address a {
				color: #040e56;
				text-decoration: none;
				font-weight: 500;
			}
			#addresses address a:hover {
				text-decoration: underline;
			}
			.delivery-date-wrapper p:first-child {
				margin-bottom: 0px !important;
			}

			.email-order-detail-heading {
				font-size: 0 !important;
			}

			.email-order-detail-heading span {
				font-size: 14px !important;
			}
		</style>
		<table width="100%" id="outer_wrapper" role="presentation">
			<tr>
				<td><!-- Deliberately empty to support consistent sizing and layout across multiple email clients. --></td>
				<td width="600">
					<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
						<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="inner_wrapper" role="presentation">
							<tr>
								<td align="center" valign="top">
									<?php
									$img = get_option( 'woocommerce_email_header_image' );
									/**
									 * This filter is documented in templates/emails/email-styles.php
									 *
									 * @since 9.6.0
									 */
									if ( apply_filters( 'woocommerce_is_email_preview', false ) ) {
										$img_transient = get_transient( 'woocommerce_email_header_image' );
										$img           = false !== $img_transient ? $img_transient : $img;
									}

									if ( $email_improvements_enabled ) :
										?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
											<tr>
												<td id="template_header_image">
													<?php
													if ( $img ) {
														echo '<p style="margin-top:0;"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( $store_name ) . '" /></p>';
													} else {
														echo '<p class="email-logo-text">' . esc_html( $store_name ) . '</p>';
													}
													?>
												</td>
											</tr>
										</table>
									<?php else : ?>
										<div id="template_header_image">
											<?php
											if ( $img ) {
												echo '<p style="margin-top:0;"><img src="' . esc_url( $img ) . '" alt="' . esc_attr( $store_name ) . '" /></p>';
											}
											?>
										</div>
									<?php endif; ?>
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_container" role="presentation">
										<tr>
											<td align="center" valign="top">
												<!-- Header -->
												<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header" role="presentation">
													<tr>
														<td id="header_wrapper">
															<h1><?php echo esc_html( $email_heading ); ?></h1>
														</td>
													</tr>
												</table>
												<!-- End Header -->
											</td>
										</tr>
										<tr>
											<td align="center" valign="top">
												<!-- Body -->
												<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_body" role="presentation">
													<tr>
														<td valign="top" id="body_content">
															<!-- Content -->
															<table border="0" cellpadding="20" cellspacing="0" width="100%" role="presentation">
																<tr>
																	<td valign="top" id="body_content_inner_cell">
																		<div id="body_content_inner">
