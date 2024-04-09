<?php
do_action( 'before' );
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $widget_id; ?>" class="bwp-countdown <?php echo esc_attr($layout); ?>">       
		<?php if($title1) { ?>
		<div class="block">
			<?php if($description) { ?>
			<div class="page-description"><?php echo esc_html($description); ?></div>
			<?php } ?> 
			<div class="title-block"><h2><?php echo esc_html($title1); ?></h2></div>   
		</div> 
		<?php } ?>
		<div class="content-product-list">	
			<div class="slider products-list grid slick-carousel" data-dots="<?php echo esc_attr($show_pag);?>" data-slidesToScroll="true" data-nav="<?php echo esc_attr($show_nav);?>" data-columns4="<?php echo $columns4; ?>" data-columns3="<?php echo $columns3; ?>" data-columns2="<?php echo $columns2; ?>" data-columns1="<?php echo $columns1; ?>" data-columns="<?php echo $columns; ?>">	
			<?php while($list->have_posts()): $list->the_post();?>
				<?php
				global $product, $post, $wpdb, $average;
				$start_time = get_post_meta( $post->ID, '_sale_price_dates_from', true );
				$countdown_time = get_post_meta( $post->ID, '_sale_price_dates_to', true );		
				$orginal_price = get_post_meta( $post->ID, '_regular_price', true );
				$date = bwp_timezone_offset( $countdown_time );
				$product_hot_label = isset($mafoil_settings['product-hot-label']) && !empty($mafoil_settings['product-hot-label']) ? $mafoil_settings['product-hot-label'] : esc_html__('Hot','wpbingo');
				$product_sale_label = mafoil_get_product_discount();
				$product_sale = mafoil_get_config('product-sale',true);
				add_action('woocommerce_after_shop_loop_item', 'mafoil_woocommerce_template_loop_add_to_cart', 15 );
				?>
				<div class="item-product">	
					<div class="item-product-content products-entry clearfix product-wapper">
						<div class="content-image">
							<div class="products-thumb">
								<a  href="<?php esc_url(the_permalink()); ?>">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php echo get_the_post_thumbnail( $product->get_id(), 'shop_single'); ?>
									<?php }else{ ?>
										<img src="<?php echo esc_attr(get_template_directory_uri().'/images/placeholder.jpg') ?>" alt="<?php echo esc_attr__('No thumb', 'wpbingo') ?>">
									<?php } ?>
								</a>
								<?php if($product_sale ) : ?>
									<div class='product-lable'>
										<?php if(isset($mafoil_settings['product-hot']) && $mafoil_settings['product-hot']) : ?>
											<?php if ($product->is_featured()) : ?>
												<?php echo apply_filters('woocommerce_featured_flash', '<div class="vgwc-label vgwc-featured hot">' . esc_html($product_hot_label) . '</div>', $post, $product); ?>
											<?php endif; ?>
										<?php endif; ?>	
										<?php if ( $product->is_on_sale() ) : ?>
											<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html($product_sale_label) . '</span>', $post, $product ); ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<div class='product-button'>
									<?php do_action('woocommerce_after_shop_loop_item'); ?>
								</div>
							</div>
						</div>
						<div class="products-content">
							<h3 class="product-title"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
							<div class="price"><?php echo $product->get_price_html(); ?></div>
							<div class="item-countdown">
								<div class="product-countdown"  
									data-day="<?php echo esc_html__("days","wpbingo"); ?>"
									data-hour="<?php echo esc_html__("hours","wpbingo"); ?>"
									data-min="<?php echo esc_html__("mins","wpbingo"); ?>"
									data-sec="<?php echo esc_html__("secs","wpbingo"); ?>"	
									data-date="<?php echo esc_attr( $date ); ?>"  
									data-sttime="<?php echo esc_attr( $start_time ); ?>" 
									data-cdtime="<?php echo esc_attr( $countdown_time ); ?>" 
									data-id="<?php echo $widget_id; ?>">
								</div>
							</div>
						</div>	
					</div>
				</div>
				<?php endwhile; wp_reset_postdata();?>
			</div>
		</div>
	</div>
	<?php
}
?>