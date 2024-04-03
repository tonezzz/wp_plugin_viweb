<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.9.0
 */
$show_product_related = mafoil_get_config('product-related',true);
$limit =  mafoil_get_config('product-related-count',5);
if( $show_product_related ) :
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	global $product;
	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}
	if ( $related_products ) : ?>
		<div class="related bwp_slick-margin-mobile">
			<div class="title-block"><h2><?php echo esc_html__( 'Related Products', 'mafoil' ); ?></h2></div>
			<div class="content-product-list">
				<div class="products-list grid slick-carousel" data-nav="true" data-columns4="1" data-columns3="2" data-columns2="2" data-columns1="3" data-columns="<?php echo esc_attr((int)mafoil_get_config( 'product-related-cols',3 )); ?>">
					<?php foreach ( $related_products as $key => $related_product ) : ?>
						<?php
							if( ($key+1) <= $limit){
								$post_object = get_post( $related_product->get_id() );
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