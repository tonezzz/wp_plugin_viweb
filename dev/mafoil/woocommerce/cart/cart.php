<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;
global $woocommerce;
do_action( 'woocommerce_before_cart' );
$shipping_zones = WC_Shipping_Zones::get_zones();
foreach ($shipping_zones as $shipping_zone) {
    $shipping_methods = $shipping_zone['shipping_methods'];
	foreach ($shipping_methods as $shipping_method) {
		if ($shipping_method->id === 'free_shipping' && $shipping_method->enabled === 'yes') {
			$free_shipping_settings = $shipping_method ->min_amount;
		}
	}
}
$cart_free = (isset($free_shipping_settings) && $free_shipping_settings) ? $free_shipping_settings: 0;
?>
<div class="woocommerce-page-header">
	<ul>
		<li class="shopping-cart-link line-hover active">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php echo esc_html__('Cart','mafoil'); ?></a>
		</li>
		<li class="checkout-link line-hover "><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php echo esc_html__('Checkout','mafoil'); ?></a></li>
		<?php if (get_page_by_path('order-tracking')) { ?>
			<li class="order-tracking-link"><a href="<?php echo get_permalink( get_page_by_path( 'order-tracking' ) ); ?>"><?php echo esc_html__('Order Tracking','mafoil'); ?></a></li>
		<?php } ?>
	</ul>
</div>
<div class="woocommerce-cart-page row">
	<div class="col-xl-8 col-lg-12 col-md-12 col-12">
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php if($cart_free && $cart_free !=0){ 
					$total_price 	= WC()->cart->total;
					if($total_price >= $cart_free){
						$total_percent = 100;
					}else{
						$total_percent	= ($total_price/$cart_free)*100;
					}
				?>
				<div class="percent-cart">
					<div class="free-ship">
						<?php if( $cart_free > $total_price){ ?>
							<div class="title-ship"><?php echo esc_html__("Spend","mafoil") ?> 
								<strong><?php echo get_woocommerce_currency_symbol(); ?><?php echo esc_attr($cart_free - $total_price); ?></strong>
								<?php echo esc_html__("more and get ","mafoil") ?> <strong><?php echo esc_html__("free shipping!","mafoil") ?></strong>
							</div>
							<div class="total-percent"><div class="percent" style="width:<?php echo esc_attr($total_percent); ?>%"></div></div>
						<?php }else{ ?>
							<div class="title-ship">
								<?php echo esc_html__("Congratulations , you've got free shipping!","mafoil") ?> 
							</div>
							<div class="total-percent "><div class="percent free" style="width:<?php echo esc_attr($total_percent); ?>%"></div></div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>
						<th class="product-thumbnail"><?php echo esc_html__( 'Product', 'mafoil' ); ?></th>
						<th class="product-price"><?php echo esc_html__( 'Price', 'mafoil' ); ?></th>
						<th class="product-quantity"><?php echo esc_html__( 'Quantity', 'mafoil' ); ?></th>
						<th class="product-subtotal"><?php echo esc_html__( 'Subtotal', 'mafoil' ); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>
					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								
								<td class="product-thumbnail">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo wp_kses($thumbnail,'social'); // PHPCS: XSS ok.
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
									}
									?>
									<div class="product-name">
										<?php
										if ( ! $product_permalink ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
										} else {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
										}

										do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

										// Meta data.
										echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

										// Backorder notification.
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'mafoil' ) . '</p>', $product_id ) );
										}
										?>
										<p class="price">
											<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
										</p>
										<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													esc_html__( 'Remove this item', 'mafoil' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
										?>
									</div>
								</td>

								<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'mafoil' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</td>

								<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'mafoil' ); ?>">
									<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
									<p class="subtotal">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?>
									</p>
								</td>
								<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'mafoil' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</td>
								<td class="product-remove">
									<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												esc_html__( 'Remove this item', 'mafoil' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											),
											$cart_item_key
										);
									?>
								</td>
							</tr>
							<?php
						}
					}
					?>
					<?php do_action( 'woocommerce_cart_contents' ); ?>
					<tr>
						<td colspan="6" class="actions">
							<div class="bottom-cart">
								<?php if ( wc_coupons_enabled() ) { ?>
									<div class="coupon">
										<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php echo esc_attr__( 'Coupon code', 'mafoil' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php echo esc_attr__( 'Apply coupon', 'mafoil' ); ?>"><?php esc_attr_e( 'Apply coupon', 'mafoil' ); ?></button>
										<?php do_action( 'woocommerce_cart_coupon' ); ?>
									</div>
								<?php } ?>
								<h2><a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__('Continue Shopping','mafoil') ?></a></h2>
								<button type="submit" class="button hidden" name="update_cart" value="<?php echo esc_attr__( 'Update cart', 'mafoil' ); ?>"><?php echo esc_html__( 'Update cart', 'mafoil' ); ?></button>
							</div>
							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</td>
					</tr>
					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
	</div>
	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
	<div class="col-xl-4 col-lg-12 col-md-12 col-12">
		<div class="cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>