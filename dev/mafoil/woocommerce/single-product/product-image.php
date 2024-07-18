<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 7.8.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if(mafoil_image_single_product()->product_layout_thumb == "one_column")
	wc_get_template( 'single-product/content-image/one_column.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "two_column")
	wc_get_template( 'single-product/content-image/two_column.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "slider")
	wc_get_template( 'single-product/content-image/slider.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "moderm")
	wc_get_template( 'single-product/content-image/moderm.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "full_width")
	wc_get_template( 'single-product/content-image/full_width.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "clean")
	wc_get_template( 'single-product/content-image/clean.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "grid")
	wc_get_template( 'single-product/content-image/grid.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "grid_sticky")
	wc_get_template( 'single-product/content-image/grid_sticky.php' );
elseif(mafoil_image_single_product()->product_layout_thumb == "lagre_gallery")
	wc_get_template( 'single-product/content-image/lagre_gallery.php' );
else
	wc_get_template( 'single-product/content-image/scroll.php' );