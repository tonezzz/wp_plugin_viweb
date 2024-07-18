<?php if($query->have_posts()):?>
<div class="bwp-widget-feature-product">
	<?php if(isset($title1) && $title1) { ?>
		<h3 class="widget-title"><?php echo esc_html($title1); ?></h3>
	<?php } ?>
	<div class="block_content">
		<ul class="content-products">
		<?php while($query->have_posts()): $query->the_post();
			global $product; ?>
			<li class="item-product">
				<div class="item-thumb">
					<a href="<?php echo get_permalink( $product->get_id() ); ?>"><img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="" /></a>
				</div>
				<div class="content-bottom">
					<?php if ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) { ?>
						<div class="rating">
							<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
						</div>
					<?php }else{ ?>
						<div class="rating none">
							<div class="star-rating none"></div>
						</div>
					<?php } ?>
					<div class="item-title">
						<a href="<?php echo esc_url(get_permalink( $product->get_id() )); ?>"><?php echo $product->get_title(); ?></a>
					</div>
					<div class="price">
						<?php echo $product->get_price_html(); ?>
					</div>
				</div>
			</li>
		<?php endwhile; wp_reset_postdata();?>
		</ul>
	</div>
</div>
<?php endif;?>