<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	do_action( 'woocommerce_before_single_product' );
	if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	}
	$mafoil_settings					= mafoil_global_settings();
	$product_layout_thumb 			= mafoil_get_config("layout-thumbs","scroll");
	$show_trust_bages 				= mafoil_get_config('show-trust-bages',true);
	$layout_thumbs				 	= mafoil_get_config('layout-thumbs','scroll');
	$description_style 				= mafoil_get_config('description-style','tab');
	$zoom_type 						= mafoil_get_config("zoom-type","inner");
	$product_zoom_image 			= mafoil_get_config("zoom-image",false);
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if($layout_thumbs == 'light') { ?><div class="single-product-background"><?php } ?>
	<div class="bwp-single-product product <?php echo esc_attr(mafoil_image_single_product()->product_layout_thumb); ?> <?php if($product_zoom_image): ?>zoom<?php endif; ?>"
		data-product_layout_thumb 		= 	"<?php echo esc_attr(mafoil_image_single_product()->product_layout_thumb); ?>"
		<?php if($product_zoom_image): ?>
		data-zoom_scroll 				=	"<?php echo esc_attr((isset($mafoil_settings['zoom-scroll']) && $mafoil_settings['zoom-scroll']) ? 'true' : 'false'); ?>" 
		data-zoom_contain_lens 			=	"<?php echo esc_attr((isset($mafoil_settings['zoom-contain-lens']) && $mafoil_settings['zoom-contain-lens']) ? 'true' : 'false'); ?>" 
		data-zoomtype 					=	"<?php echo esc_attr($zoom_type); ?>" 
		data-lenssize 					= 	"<?php echo esc_attr(isset($mafoil_settings['zoom-lens-size']) ? ($mafoil_settings['zoom-lens-size']) : '200'); ?>" 
		data-lensshape 					= 	"<?php echo esc_attr(isset($mafoil_settings['zoom-lens-shape']) ? ($mafoil_settings['zoom-lens-shape']) : 'zoom-lens-shape'); ?>" 
		data-lensborder 				= 	"<?php echo esc_attr(isset($mafoil_settings['zoom-lens-border']) ? ($mafoil_settings['zoom-lens-border']) : '10'); ?>"
		data-bordersize					= 	"<?php echo esc_attr(isset($mafoil_settings['zoom-border']) ? ($mafoil_settings['zoom-border']) : '2'); ?>"
		data-bordercolour 				= 	"<?php echo esc_attr(isset($mafoil_settings['zoom-border-color']) ? ($mafoil_settings['zoom-border-color']) : '#252525'); ?>"
		<?php endif; ?>
		data-popup 						= 	"<?php echo esc_attr(isset($mafoil_settings['product-image-popup'] ) && ($mafoil_settings['product-image-popup']) ? 'true' : 'false'); ?>">	
		<div class="row">
			<?php if($product_layout_thumb == "slider"): ?>
				<?php wc_get_template( 'single-product/content-single/slider.php' ); ?>
			<?php elseif($product_layout_thumb == "clean"): ?>
				<?php wc_get_template( 'single-product/content-single/clean.php' ); ?>
			<?php elseif($product_layout_thumb == "moderm"): ?>
				<?php wc_get_template( 'single-product/content-single/moderm.php' ); ?>
			<?php elseif($product_layout_thumb == "full_width"): ?>
				<?php wc_get_template( 'single-product/content-single/full_width.php' ); ?>
			<?php else: ?>
				<div class="bwp-single-image col-lg-7 col-md-12 col-12">
					<?php
						/**
						 * woocommerce_before_single_product_summary hooked
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>
				<div class="bwp-single-info col-lg-5 col-md-12 col-12 ">
					<?php if($description_style == 'accordion'){
							remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
						} ?>
					<div class="summary entry-summary">
						<?php
							/**
							 * woocommerce_single_product_summary hook
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 1
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 */
							do_action( 'woocommerce_single_product_summary' );
							if($description_style == 'accordion'){
								woocommerce_output_product_data_tabs();
							}
						?>
					</div><!-- .summary -->
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if($layout_thumbs == 'light') { ?> </div> <?php } ?>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
	<meta itemprop="url" content="<?php esc_url(the_permalink()); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' ); ?>