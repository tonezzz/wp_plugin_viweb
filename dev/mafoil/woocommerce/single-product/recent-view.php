<?php
$show_recent_view = mafoil_get_config('recent-view',false);
if( $show_recent_view ) :
	global $woocommerce;
	$viewed_products = ! empty( $_COOKIE['wpbingo_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['wpbingo_recently_viewed'] ) ) : array();
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
	$limit =  mafoil_get_config('recent-view-count',5);
	$query_args = array(
		'posts_per_page' => $limit,
		'no_found_rows'  => 1,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'post__in'       => $viewed_products,
		'orderby'        => 'post__in',
	);

	if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'outofstock',
				'operator' => 'NOT IN',
			),
		);
	}
	$products = new WP_Query( apply_filters( 'woocommerce_recently_viewed_products_widget_query_args', $query_args ) );
	if ( $products->have_posts() ) : ?>
		<div class="recent-view bwp_slick-margin-mobile">
			<div class="title-block"><h2><?php echo esc_html__( 'Recently Viewed Products', 'mafoil' ); ?></h2></div>
			<div class="content-product-list">
				<div class="products-list grid slick-carousel" data-nav="true" data-columns4="1" data-columns3="2" data-columns2="2" data-columns1="3" data-columns="<?php echo esc_attr((int)mafoil_get_config( 'product-related-cols',3 )); ?>">
					<?php while ( $products->have_posts()) { ?>
						<?php
						$products->the_post();
						global $product;
						wc_get_template_part( 'content-grid', 'product' );
						?>
					<?php } ?>
				</div>
			</div>	
		</div>
	<?php endif;
endif;