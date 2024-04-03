<?php
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_size_guide', 20 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_get_countdown', 20 );		
	$video_style = mafoil_get_config("video-style","inner");
	?>
<div class="bwp-single-title">
	<div class="summary entry-summary entry-heading">
		<?php woocommerce_template_single_rating(); ?>
		<?php woocommerce_template_single_title(); ?>
		<?php woocommerce_template_single_price(); ?>
		<?php if($video_style == 'popup'){ mafoil_get_video_product(); } ?>
		<?php mafoil_view_product(); ?>
		<?php if(mafoil_image_single_product()->show_thumb) { ?>
		<div class="content-image-thumbnail">
			<?php wc_get_template( 'single-product/thumbnails-image/scroll.php' ); ?>
		</div>
		<?php } ?>
	</div>
</div>
<div class="bwp-single-image">
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
<div class="bwp-single-info">
	<div class="summary entry-summary entry-cart">
		<?php woocommerce_template_single_add_to_cart(); ?>
		<?php mafoil_get_countdown(); ?>
	</div>
	<div class="summary entry-summary entry-info">
	<?php
		/**
		 * woocommerce_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 */
		do_action( 'woocommerce_single_product_summary' );
	?>
	</div><!-- .summary -->
</div>