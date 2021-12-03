<?php
/**
 * Downloads
 *
 * Shows downloads on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$downloads     = WC()->customer->get_downloadable_products();
$has_downloads = (bool) $downloads;

do_action( 'woocommerce_before_account_downloads', $has_downloads ); ?>

<h2 class="second-title">Downloads</h2>

<?php if ( $has_downloads ) : ?>

	<table class="woocommerce-MyAccount-downloads shop_table shop_table_responsive">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_attr( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<?php foreach ( $downloads as $download ) : ?>
			<tr>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) : ?>
							<?php do_action( 'woocommerce_account_downloads_column_' . $column_id, $download ); ?>

						<?php elseif ( 'download-file' === $column_id ) : ?>
							<a href="<?php echo esc_url( get_permalink( $download['product_id'] ) ); ?>">
								<?php echo esc_html( $download['download_name'] ); ?>
							</a>

						<?php elseif ( 'download-remaining' === $column_id ) : ?>
							<?php
								if ( is_numeric( $download['downloads_remaining'] ) ) {
									echo esc_html( $download['downloads_remaining'] );
								} else {
									echo '&infin;';
								}
							?>

						<?php elseif ( 'download-expires' === $column_id ) : ?>
							<?php if ( ! empty( $download['access_expires'] ) ) : ?>
								<time datetime="<?php echo date( 'Y-m-d', strtotime( $download['access_expires'] ) ); ?>" title="<?php echo esc_attr( strtotime( $download['access_expires'] ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ); ?></time>
							<?php else : ?>
								<?php esc_html_e( 'Never', 'argenta' ); ?>
							<?php endif; ?>

						<?php elseif ( 'download-actions' === $column_id ) : ?>
							<?php
								$actions = array(
									'download'  => array(
										'url'  => $download['download_url'],
										'name' => esc_html__( 'Download', 'argenta' )
									)
								);

								if ( $actions = apply_filters( 'woocommerce_account_download_actions', $actions, $download ) ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="button woocommerce-Button ' . sanitize_html_class( $key ) . '">' . $action['name'] . '</a>';
									}
								}
							?>

						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php else : ?>
	<div class="message-box message-box-primary message-download woo-message-box">
		<?php esc_html_e( 'No downloads available yet.', 'argenta' ); ?>
		<div class="close brand-color-hover">
			<i class="ion-ios-close-empty"></i>
		</div>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_downloads', $has_downloads ); ?>
