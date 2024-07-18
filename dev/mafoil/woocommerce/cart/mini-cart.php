<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 7.9.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php 
if ( !class_exists('Woocommerce') ) { 
	return false;
}
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
$total_price 	= WC()->cart->total;
if($total_price >= $cart_free){
	$total_percent = 100;
}else{
	$total_percent	= ($total_price/$cart_free)*100;
}
global $woocommerce; ?>
<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="woocommerce-cart-header" data-count="<?php echo esc_attr($woocommerce->cart->cart_contents_count); ?>">
	<div class="cart-details">
		<div class="remove-cart">
			<div class="top-total-cart"><?php echo esc_html__("Shopping Cart","mafoil"); ?>(<?php echo esc_attr($woocommerce->cart->cart_contents_count); ?>)</div>
			<a class="cart-remove" href="#" title="<?php esc_attr_e("View your shopping cart", "mafoil"); ?>">
				<span class="close-wrap">
					<span class="close-line close-line1"></span>
					<span class="close-line close-line2"></span>
				</span>
			</a>
		</div>
		<?php if ( ! WC()->cart->is_empty() ) : ?>
		<?php if($cart_free){ ?>
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
					<div class="total-percent total-percent_free"><div class="percent free" style="width:<?php echo esc_attr($total_percent); ?>%"></div></div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php else : ?>
			<div class="empty">
				<span><?php echo esc_html__( 'No products in the cart.', 'mafoil' ); ?></span>
				<a class="go-shop" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__( 'Shop all products', 'mafoil' ); ?></a>
			</div>
		<?php endif; ?>
		<form class="cart-header-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ); ?>
						<div class="woocommerce-mini-cart-item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="content-cart-left">
								<div class="product-thumbnail">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo wp_kses($thumbnail,'social'); // PHPCS: XSS ok.
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
									}
									?>
								</div>
							</div>
							<div class="content-cart-right">
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
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( "Available on backorder", "mafoil" ) . '</p>', $product_id ) );
									}
									?>
								</div>
								<div class="product-flex">
									<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'mafoil' ); ?>">
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
									</div>
									<div class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'mafoil' ); ?>">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?>
									</div>
								</div>
								<div class="product-remove">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">%s</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											/* translators: %s is the product name */
											esc_attr( sprintf( __( 'Remove %s from cart', 'mafoil' ), $_product->get_name() ) ),
											esc_attr( $product_id ),
											esc_attr( $cart_item_key ),
											esc_attr( $_product->get_sku() ),
											esc_html__( "Remove", "mafoil" )
										),
										$cart_item_key
									);
									?>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			<input type="hidden" name="update_cart" value="<?php echo esc_attr__("Update cart","mafoil"); ?>">
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form><!-- end product list -->
	</div>
	<div class="widget_shopping_cart">
		<div class="widget_shopping_cart_content">
			<div class="ajaxcart__footer">
				<?php if ( ! WC()->cart->is_empty() ) : ?>
					<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
					<div class="total-cart">
						<div class="title-total"><?php echo esc_html__( 'Subtotal: ', 'mafoil' ); ?></div>
						<div class="total-price"><?php echo wp_kses($woocommerce->cart->get_cart_total(),'social'); ?></div>
					</div>
				<?php endif; ?>
				<?php if ( ! WC()->cart->is_empty() ) : ?>
					<div class="buttons">
						<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button btn checkout btn-default"><span><?php echo esc_html__( 'Check Out', 'mafoil' ); ?></span></a>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button btn view-cart btn-primary"><span><?php echo esc_html__( 'View Cart', 'mafoil' ); ?></span></a>
					</div>
				<?php endif; ?>
				<?php do_action( 'woocommerce_after_mini_cart' ); ?>
			</div>
		</div>
	</div>
</div>