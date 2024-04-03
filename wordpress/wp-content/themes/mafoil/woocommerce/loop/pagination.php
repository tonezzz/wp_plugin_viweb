<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wp_query;
if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
$shop_paging	= mafoil_get_config('shop_paging','shop-pagination');
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
			_e( 'Showing the single result', 'mafoil' );
		} elseif ( $total <= $per_page || -1 === $per_page ) {
			printf( __( 'Showing all %d results', 'mafoil' ), $total );
		} else {
			printf( _x( 'Showing %1$d&ndash;%2$d of %3$d item(s)', '%1$d = first, %2$d = last, %3$d = total', 'mafoil' ), $first, $last, $total );
		}
		?>
	</div>
	<div class="percent-content"><div class="percent" style="width:<?php echo esc_attr("$percent") ?>%;"></div></div>
	<div class="loadmore">
		<button type="button" class="woocommerce-load-more" data-paged="1">
			<strong class="lds-ellipsis"><strong></strong><strong></strong><strong></strong><strong></strong></strong>
			<span class="loadmore-button-text"><?php echo esc_html__('Load More', 'mafoil'); ?></span>
		</button>
	</div>
</nav>
<?php elseif ($shop_paging == "shop-infinity"): ?>
<nav class="woocommerce-pagination <?php echo esc_attr($shop_paging); ?>">
	<div class="woocommerce-load-more" data-paged="1">
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
			'prev_text'    => esc_html__('Previous','mafoil'),
			'next_text'    => esc_html__('Next','mafoil'),
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
</nav>
<?php endif; ?>