<?php 
global $post, $woocommerce, $product;
$data_product = $product->get_data();
$image_id = $data_product['image_id'] ? $data_product['image_id'] : array();
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$video_style = mafoil_get_config("video-style","inner");
$video  = (get_post_meta( $product->get_id(), 'video_product', true )) ? get_post_meta($product->get_id(), 'video_product', true ) : "";
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'images',
) );
$attachment_ids = $product->get_gallery_image_ids();
$class = "";
if(mafoil_image_single_product()->show_thumb && (mafoil_image_single_product()->position == "left" || mafoil_image_single_product()->position == "right"))
	$class = "vertical";
?>
<div class="images <?php echo esc_attr($class); ?>">
	<figure class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
		<div class="row">
			<?php if(mafoil_image_single_product()->show_thumb && mafoil_image_single_product()->position == "left") : ?>
				<div class="col-md-2">
					<?php
						/**
						 * woocommerce_before_single_product_summary hooked
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */

						wc_get_template( 'single-product/thumbnails-image/grid_sticky.php' );
					?>
				</div>
			<?php endif; ?>
			<div class="col-md-10">
				<div class="scroll-image">
					<div class="image-additional" <?php if(mafoil_image_single_product()->show_thumb == 'show') { ?> data-asnavfor=".image-thumbnail"<?php } ?> data-fade="true">
						<?php
						$attributes = array(
							'id'						=> "image", 	
							'title'                   => $image_title,
							'data-src'                => $full_size_image[0],
							'data-large_image'        => $full_size_image[0],
							'data-large_image_width'  => $full_size_image[1],
							'data-large_image_height' => $full_size_image[2],
						);
						if ( has_post_thumbnail() ) {
							$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="img-thumbnail woocommerce-product-gallery__image" data-media-id="'. esc_attr($image_id.'-0').'">
							<a data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="image-additional" href="' . esc_url( $full_size_image[0] ) . '">';
								$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
								$html .= '</a>
							</div>';
						} else {
							$html  = '<div class="img-thumbnail woocommerce-product-gallery__image--placeholder">';
							$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'mafoil' ) );
							$html .= '</div>';
						} 		
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) ); ?>
						<?php
							if ( $attachment_ids ) {
								$loop 		= 1;
								foreach ( $attachment_ids as $attachment_id ) { ?>
									<div class="img-thumbnail"  data-media-id="<?php echo esc_attr($image_id.'-'.$loop); ?>">
									<?php $image_link = wp_get_attachment_url( $attachment_id );
									if ( ! $image_link )
										continue;
									$image_title 	= esc_attr( get_the_title( $attachment_id ) );
									$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
									$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
										'title' => $image_title,
										'alt'   => $image_title,
										) );
									$image_class = "image-scroll";
									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="image-additional"  data-image="%s" class="%s" title="%s">%s</a>', $image_link, $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
									?>
									</div>
									<?php $loop++;
								}							
							}
						?>
							<?php if($video_style == 'inner' && $video ){ ?>
							<div class="video-additional text-center">
								<?php mafoil_display_video_product($full_size_image); ?>
							</div>
						<?php } ?>
					</div>
					<?php if($video_style == 'popup'){ mafoil_get_video_product(); } ?>
					<?php mafoil_view_product(); ?>
				</div>
			</div>
			<?php if(mafoil_image_single_product()->show_thumb && (mafoil_image_single_product()->position == "right" || mafoil_image_single_product()->position == "bottom")) : ?>
				<div class="<?php echo esc_attr(mafoil_image_single_product()->class_thumb); ?> content-thumbs-scroll">
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>
				</div>
			<?php endif; ?>	
		</div>
	</figure>
</div>