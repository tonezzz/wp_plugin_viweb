<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */
 
global $post, $product, $woocommerce;
$columns = 	mafoil_image_single_product()->product_count_thumb;
$attachment_ids = $product->get_gallery_image_ids();
$data_product = $product->get_data();
$video  = (get_post_meta( $product->get_id(), 'video_product', true )) ? get_post_meta($product->get_id(), 'video_product', true ) : "";
$video_style = mafoil_get_config("video-style","inner");
$image_id = $data_product['image_id'] ? $data_product['image_id'] : array();
if($image_id )
	array_unshift ($attachment_ids,$image_id);
if ( $attachment_ids ) {
	if ( $video && $video_style == "inner" ) {
		$loop 		= 1;
	}else{
		$loop 		= 0;
	}
	foreach ( $attachment_ids as $attachment_id ){
		$loop++;
	}
	?>
	<div class="content-thumbnail-scroll<?php if( $loop <= $columns){ ?> max-thumbnail<?php } ?>">
		<div class="image-thumbnail" data-asnavfor=".image-additional" data-vertical="true" data-centermode="true" data-focusonselect="true" data-columns4="4" data-columns3="<?php echo esc_attr($columns); ?>" data-columns2="<?php echo esc_attr($columns); ?>" data-columns1="<?php echo esc_attr($columns); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-nav="true"
		>
		<?php
			foreach ( $attachment_ids as $key=> $attachment_id ){
				$image_link = wp_get_attachment_url( $attachment_id );
				if ( ! $image_link )
					continue;
				$image_title 	= esc_attr( get_the_title( $attachment_id ) );
				$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), 0, $attr = array(
					'title' => $image_title,
					'alt'   => $image_title,
					'data-zoom-image'=> $image_link
					) ); ?>
				<div class="img-thumbnail" data-media-id="<?php echo esc_attr($image_id.'-'.$key); ?>">
					<span class="img-thumbnail-scroll">
					<?php echo wp_kses($image,'social'); ?>
					</span>
				</div>
				<?php
			}
			if($video_style == 'inner' && $video){ 
				mafoil_display_thumb_video();
			}
		?>
		</div>
	</div>
	<?php
}