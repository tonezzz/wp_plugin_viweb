<?php
if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<?php if( $shop_paging == "shop-loadmore" ): ?>
<nav class="woocommerce-pagination <?php echo esc_attr($shop_paging); ?>">
	<div class="woocommerce-product-count">	
		<?php
		$paged    = max( 1, $wp_query->get( 'paged' ) );
		$per_page = $wp_query->get( 'posts_per_page' );
		$total    = $wp_query->found_posts;
		$first    = ( $per_page * $paged ) - $per_page + 1;
		$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
		$percent= ( $last / $total) * 100;
		if ( 1 === $total ) {
			_e( 'Showing the single result', 'wpbingo' );
		} elseif ( $total <= $per_page || -1 === $per_page ) {
			printf( __( 'Showing all %d results', 'wpbingo' ), $total );
		} else {
			printf( _x( 'Showing %1$d&ndash;%2$d of %3$d item(s)', '%1$d = first, %2$d = last, %3$d = total', 'wpbingo' ), $first, $last, $total );
		}
		?>
	</div>
	<div class="percent-content"><div class="percent" style="width:<?php echo esc_attr("$percent") ?>%;"></div></div>
	<div class="loadmore">
		<button type="button" class="woocommerce-load-more" data-paged="<?php echo esc_attr($paged); ?>">
			<strong class="lds-ellipsis"><strong></strong><strong></strong><strong></strong><strong></strong></strong>
			<span class="loadmore-button-text"><?php echo esc_html__('Load More', 'wpbingo'); ?></span>
		</button>
	</div>
</nav>
<?php elseif ($shop_paging == "shop-infinity"): ?>
<nav class="woocommerce-pagination <?php echo esc_attr($shop_paging); ?>">
	<div class="woocommerce-load-more" data-paged="<?php echo esc_attr($paged); ?>">
		<div class="loading-filter"></div>
	</div>
</nav>
<?php else: ?>
<nav class="woocommerce-pagination">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => false,
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => esc_html__('Previous','wpbingo'),
			'next_text'    => esc_html__('Next','wpbingo'),
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
</nav>
<?php endif; ?>