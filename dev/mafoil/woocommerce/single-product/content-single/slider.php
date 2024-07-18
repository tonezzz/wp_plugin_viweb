<?php
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',5);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_size_guide', 20 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_get_countdown', 20 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_count_view', 15 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_label_stock', 20 );
	?>
	<div class="bwp-single-image col-lg-12 col-md-12 col-12">
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
	<div class="bwp-single-info col-lg-12 col-md-12 col-12">
		<div class="summary entry-summary entry-heading">
			<?php woocommerce_template_single_rating(); ?>
			<?php woocommerce_template_single_title(); ?>
			<?php woocommerce_template_single_price(); ?>
			<?php mafoil_count_view(); ?>
			<?php woocommerce_template_single_excerpt(); ?>
			<?php mafoil_get_countdown(); ?>
			<?php mafoil_label_stock(); ?>
		</div>
		<div class="summary entry-summary entry-cart">
			<?php woocommerce_template_single_add_to_cart(); ?>
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