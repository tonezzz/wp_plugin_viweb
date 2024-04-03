<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.4.0
 */
$show_product_crosssells = mafoil_get_config('product-crosssells',true);
$limit =  mafoil_get_config('product-crosssells-count',5);
if( $show_product_crosssells ) :
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	global $product;
	if ( $cross_sells ) : ?>
		<div class="cross_sell">
			<div class="title-block"><h2><?php echo esc_html__( 'You may be interested in...', 'mafoil' ); ?></h2></div>
			<div class="content-product-list">
				<div class="products-list grid slick-carousel"  data-columns4="1" data-columns3="2" data-columns2="2" data-columns1="<?php echo esc_attr((int)mafoil_get_config( 'product-crosssells-cols',3 )); ?>" data-columns="<?php echo esc_attr((int)mafoil_get_config( 'product-crosssells-cols',3 )); ?>">
					<?php foreach ( $cross_sells as $key => $cross_sell ) : ?>
						<?php
						if( ($key+1) <= $limit){
							$post_object = get_post( $cross_sell->get_id() );
							setup_postdata( $GLOBALS['post'] =& $post_object );
							wc_get_template_part( 'content-grid', 'product' );
						}
						?>
					<?php endforeach; ?>
				</div>
			</div>	
		</div>
	<?php endif;
	wp_reset_postdata();
endif;