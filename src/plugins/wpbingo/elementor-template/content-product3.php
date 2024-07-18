<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $woocommerce_loop;
$mafoil_settings = mafoil_global_settings();
$stock = ( $product->is_in_stock() )? 'in-stock' : 'out-stock' ;
add_action('woocommerce_after_shop_loop_item', 'mafoil_woocommerce_template_loop_add_to_cart', 15 );
add_action('woocommerce_before_shop_loop_item_title', 'mafoil_add_countdownt_item', 15 );
remove_action('woocommerce_after_shop_loop_item', 'mafoil_add_loop_wishlist_link', 18 );
?>
<div class="products-entry content-product3 clearfix product-wapper">
	<div class="products-thumb">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		<div class='product-button'>
			<?php do_action('woocommerce_after_shop_loop_item'); ?>
		</div>
		<?php if($stock == "out-stock"): ?>
			<div class="product-stock">    
				<span class="stock"><?php echo esc_html__( 'Out Of Stock', 'mafoil' ); ?></span>
			</div>
		<?php elseif($stock == "pre-order"): ?>
			<div class="product-stock pre-order">    
				<span class="stock"><?php echo esc_html__( 'Pre Order', 'mafoil' ); ?></span>
			</div>
		<?php endif; ?>
	</div>
	<div class="products-content">
		<div class="contents">
			<?php 
				if(isset($mafoil_settings['product-wishlist']) && $mafoil_settings['product-wishlist'] && class_exists( 'WPCleverWoosw' ) ){
					mafoil_add_loop_wishlist_link();
				}
			?>
			<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
		</div>
	</div>
</div>