<?php
add_action( 'init', 'mafoil_button_product' );
add_action( 'woocommerce_before_single_product', 'mafoil_woocommerce_single_product_summary' );
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_after_subcategory', 'mafoil_woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_after_subcategory_only', 'mafoil_woocommerce_template_loop_only_category_title', 10 );
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action( 'woocommerce_before_subcategory_title', 'mafoil_woocommerce_subcategory_thumbnail', 10 );
add_filter( 'mafoil_custom_category', 'mafoil_woocommerce_maybe_show_product_subcategories' );
add_filter( 'woocommerce_add_to_cart_redirect','mafoil_quick_buy_redirect');
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display');
add_filter('woocommerce_placeholder_img_src', 'mafoil_woocommerce_placeholder_img_src');
add_filter( 'woosw_button_position_single', '__return_false' );
add_filter( 'woosw_button_position_archive', '__return_false' );
add_filter( 'woosc_button_position_single', '__return_false' );
add_filter( 'woosc_button_position_archive', '__return_false' );
function mafoil_quick_buy_redirect( $url_redirect ) {
	if ( ! isset( $_REQUEST['quick_buy'] ) || $_REQUEST['quick_buy'] == false ) {
		return $url_redirect;
	}
	return wc_get_checkout_url();
}
function mafoil_woocommerce_placeholder_img_src( $src ){
	$src = get_template_directory_uri().'/images/placeholder.jpg';
	return $src;
}
function mafoil_button_product(){
	$mafoil_settings = mafoil_global_settings();
	//Button List Product
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	//Category
	if(isset($mafoil_settings['show-category']) && $mafoil_settings['show-category'] ){
		add_action('woocommerce_before_shop_loop_item', 'mafoil_woocommerce_template_loop_category', 15 );
	}
	//Cart
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
		add_action('woocommerce_after_shop_loop_item', 'mafoil_woocommerce_template_loop_add_to_cart', 15 );
	//Whishlist
	if(isset($mafoil_settings['product-wishlist']) && $mafoil_settings['product-wishlist'] && class_exists( 'WPCleverWoosw' ) ){
		add_action('woocommerce_after_shop_loop_item', 'mafoil_add_loop_wishlist_link', 18 );
	}	
	//Quickview
		add_action('woocommerce_after_shop_loop_item', 'mafoil_quickview', 35 );
	/* Remove sold by in product loops */
	if(class_exists("WCV_Vendors")){
		remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'),9);
		add_action('woocommerce_after_shop_loop_item_title', array('WCV_Vendor_Shop', 'template_loop_sold_by'),5 );
	}
	//Attribute
	if( function_exists("bwp_display_woocommerce_attribute") && isset($mafoil_settings['product-attribute']) && $mafoil_settings['product-attribute'] ){
		add_action('woocommerce_after_shop_loop_item_title', 'bwp_display_woocommerce_attribute', 20 );
	}
	add_action('woocommerce_before_shop_loop_item_title', 'mafoil_add_countdownt_item', 15 );
	/* Remove result count in product shop */
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
}
function mafoil_woocommerce_single_product_summary(){
	global $product;
	$product_short_desc = mafoil_get_config('product-short-desc',true);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
	add_action( 'woocommerce_after_add_to_cart_button', 'mafoil_add_loop_wishlist_link', 15 );
	add_action( 'woocommerce_single_product_summary', 'mafoil_add_social', 45 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash');
	add_action( 'woocommerce_single_product_summary', 'mafoil_count_view', 15 );
	add_action( 'woocommerce_single_product_summary', 'mafoil_label_stock', 20 );
	add_action( 'woocommerce_single_product_summary', 'mafoil_get_countdown', 20 );
	remove_action( 'woocommerce_single_product_summary', 'mafoil_size_guide', 25 );
	add_action( 'woocommerce_single_product_summary', 'mafoil_safe_checkout', 35 );
	add_action( 'woocommerce_single_product_summary', 'mafoil_shipping_delivers', 35 );
	add_action( 'woocommerce_after_single_product', 'mafoil_prev_next_product', 0 );	
	add_action( 'woocommerce_single_product_summary', 'mafoil_sticky_cart', 50 );
	add_action( 'woocommerce_after_add_to_cart_button', 'mafoil_product_quick_buy_button', 35 );
	add_action( 'woocommerce_after_single_product_summary', 'mafoil_recent_view_products', 25 );
}
function mafoil_recent_view_products() {
	wc_get_template( 'single-product/recent-view.php' );
}
//End Contact Single Product //
function mafoil_count_view() {
	global $product;
	$show_count_view = mafoil_get_config('product-count-view',false);
	if( $show_count_view ){
		$min = mafoil_get_config('min-count-view',30);
		$max = mafoil_get_config('max-count-view',40);
		$timeout = mafoil_get_config('timeout-count-view',10000);
		$html = '';
		$html .= '<div class="product-count-view" data-min="'.esc_attr($min).'" data-max="'.esc_attr($max).'" data-timeout="'.esc_attr($timeout).'" data-id_product="'.esc_attr($product->get_id()).'"> <i class="feather-eye"></i> <span></span> '.esc_html__("people are viewing this right now","mafoil").'</div>';
		echo wp_kses($html,'social');
	}
}
function mafoil_safe_checkout(){
	global $product;
	$mafoil_settings = mafoil_global_settings();
	$safe_checkout = mafoil_get_config('safe-checkout',false);
	if($safe_checkout && $product->get_id()){
		if(isset($mafoil_settings['img-safe-checkout']['url']) && !empty($mafoil_settings['img-safe-checkout']['url'])):?>
		<div class="safe-checkout">
			<div class="img-safe-checkout">
				<img src="<?php echo esc_url($mafoil_settings['img-safe-checkout']['url']); ?>" alt="<?php echo esc_attr__( "Image Safe Checkout","mafoil" ); ?>">
			</div>
			<div class="title-safe-checkout"><?php echo esc_html__('Guaranteed Safe Checkout','mafoil') ?></div>
		</div>
		<?php endif; ?>
	<?php } ?>
<?php }
function mafoil_shipping_delivers(){
	$shipping_delivers = mafoil_get_config('shipping-delivers',false);
	$content_shipping = mafoil_get_config('content-shipping','');
	$content_delivers = mafoil_get_config('content-delivers','');
	$link_delivers = mafoil_get_config('link-delivers','');
	if($shipping_delivers && ( $content_shipping || $content_delivers )){ ?>
	<ul class="product-shipping-delivers">
		<?php if($content_shipping){ ?>
			<li class="product-shipping">
				<i class="wpb-icon-shipping"></i><?php echo esc_html($content_shipping); ?>
			</li>
		<?php } ?>
		<?php if($content_delivers){ ?>
			<li class="product-delivers">
				<i class="wpb-icon-delivers"></i><?php echo esc_html($content_delivers); ?>
				<?php if($link_delivers){ ?>
					<a href="<?php echo esc_url($link_delivers); ?>"><?php echo esc_html__('Shipping & Return','mafoil'); ?></a>
				<?php } ?>
			</li>
		<?php } ?>
	</ul>
	<?php }
}
function mafoil_woocommerce_template_loop_category() {
	global $product;
	$html = '';
	$category =  get_the_terms( $product->get_id(), 'product_cat' );
	if ( $category && ! is_wp_error( $category ) ) {	
		$html = '<div class="cat-products">';
			$html .= '<a href="'.get_term_link( $category[0]->term_id, 'product_cat' ).'">';
				$html .= $category[0]->name;
			$html .= '</a>';
		$html .= '</div>';
	}
	echo wp_kses($html,'social');
}
function mafoil_update_total_price() {
	global $woocommerce;
	$data = array(
		'total_price' => $woocommerce->cart->get_cart_total(),
	);
	wp_send_json($data);
}	
add_action( 'wp_ajax_mafoil_update_total_price', 'mafoil_update_total_price' );
add_action( 'wp_ajax_nopriv_mafoil_update_total_price', 'mafoil_update_total_price' );
/* Ajax Search */
add_action( 'wp_ajax_mafoil_search_products_ajax', 'mafoil_search_products_ajax' );
add_action( 'wp_ajax_nopriv_mafoil_search_products_ajax', 'mafoil_search_products_ajax' );
function mafoil_search_products_ajax(){
	check_ajax_referer( 'mafoil_ajax_nonce', 'security' );
	$character = (isset($_GET['character']) && $_GET['character'] ) ? $_GET['character'] : '';
	$limit = (isset($_GET['limit']) && $_GET['limit'] ) ? $_GET['limit'] : 5;
	$category = (isset($_GET['category']) && $_GET['category'] ) ? $_GET['category'] : "";
	$args = array(
		'post_type' 			=> 'product',
		'post_status'    		=> 'publish',
		'ignore_sticky_posts'   => 1,	  
		's' 					=> $character,
		'posts_per_page'		=> $limit
	);
	
	if($category){
		$args['tax_query'] = array(
			array(
				'taxonomy'  => 'product_cat',
				'field'     => 'slug',
				'terms'     => $category ));
	}
	$list = new WP_Query( $args );
	$json = array();
	if ($list->have_posts()) {
		while($list->have_posts()): $list->the_post();
		global $product, $post;
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'shop_catalog' );
		$json[] = array(
			'product_id' => $product->get_id(),
			'name'       => $product->get_title(),		
			'image'		 =>  $image[0],
			'link'		 =>  get_permalink( $product->get_id() ),
			'price'      =>  $product->get_price_html(),
		);			
		endwhile;
	}
	die (json_encode($json));
}
/* Time Nofication */
add_action( 'wp_ajax_mafoil_time_nofication_ajax', 'mafoil_time_nofication_ajax' );
add_action( 'wp_ajax_nopriv_mafoil_time_nofication_ajax', 'mafoil_time_nofication_ajax' );
function mafoil_time_nofication_ajax(){
	check_ajax_referer( 'mafoil_ajax_nonce', 'security' );
	$json = array();
	$id_product = (isset($_REQUEST["id_product"]) && $_REQUEST["id_product"]>0) ? $_REQUEST["id_product"] : 0;
	$query_args = array(
		'post_type'	=> 'product',
		'p'			=> $id_product
	);
	$list = new WP_Query($query_args);
	$json = array();
	if ($list->have_posts()) {
		while($list->have_posts()): $list->the_post();
		global $product, $post;
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'shop_catalog' );
		$json[] = array(
			'title'       => $product->get_title(),		
			'image'		 =>  $image[0],
			'href'		 =>  get_permalink( $product->get_id() ),
		);			
		endwhile;
	}
	die (json_encode($json));
}
/* Login ajax */
add_action( 'wp_ajax_mafoil_login_ajax', 'mafoil_login_ajax' );
add_action( 'wp_ajax_nopriv_mafoil_login_ajax', 'mafoil_login_ajax' );
function mafoil_login_ajax(){
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $info = array();
    $info['user_login'] = sanitize_user( wp_unslash( $_POST['username'] ), true );
    $info['user_password'] = wp_unslash(trim($_POST['password']));
    $info['remember'] = sanitize_text_field($_POST['rememberme']);
    $user_signon = wp_signon( $info, false );
    if ( !is_wp_error($user_signon) ){
        wp_set_current_user($user_signon->ID);
        wp_set_auth_cookie($user_signon->ID);
        echo json_encode(array('loggedin' => true, 'message' => esc_html__('Login successful, redirecting...','mafoil')));
    }else{
		echo json_encode(array('loggedin' => false, 'message'=> esc_html__('Wrong username or password.','mafoil')));
	}
    die();
}
//Stock Product //
function mafoil_label_stock(){
	global $product; 
	$stock = ( $product->is_in_stock() )? 'in-stock' : 'out-stock' ;
	$product_stock = mafoil_get_config('product-stock',true);
	if( $product_stock && !$product->is_type('grouped') ){ ?>
		<?php if($stock == "out-stock"): ?>
			<div class="product-stock">    
				<span class="stock"><?php echo esc_html__( 'Out Of Stock', 'mafoil' ); ?></span>
			</div>
			<div class="product-notify">    
				<span class="notify"><?php echo esc_html__( 'Notify Me When Available', 'mafoil' ); ?></span>
			</div>
			<?php mafoil_add_notify_me_form(); ?>
		<?php else: ?>
			<?php
			if($product->is_type('variable')){
				$available = 0;
				if(!$product->get_stock_quantity()){
					$variations = $product->get_available_variations();
					foreach($variations as $variation){
						$variation_id = $variation['variation_id'];
						$variation_obj = new WC_Product_variation($variation_id);
						$available = $available + $variation_obj->get_stock_quantity();
					}
				}else{
					$available 	=	$product->get_stock_quantity();
				}
			}else{
				$available 	=	$product->get_stock_quantity();
			}
			$sold		=	$product->get_total_sales();
			$total 		=	$available + $sold;
			if(($total > 0) && ($available > 0)){
				$percent = round( ($available  / $total ) * 100 ) ; ?>
				<div class="percent_quantity_stock">
					<div class="quantity_stock">
						<?php echo esc_html__("Only","mafoil"); ?><span><?php echo esc_attr($available); ?> <?php echo esc_html__("item(s)","mafoil"); ?></span><?php echo esc_html__("left in stock!","mafoil"); ?>
					</div>
					<div class="percent"><div class="content" style="width:<?php echo esc_attr($percent); ?>%;"></div></div>
				</div>
			<?php }	?>
		<?php endif; ?>
	<?php } ?>
<?php }
//Notify Me Form
function mafoil_add_notify_me_form() {
	global $product;
	$show_contact_form = mafoil_get_config('product-notify-me-form',true);
	if($show_contact_form){
		$html = "";
		$html .= '<div class="single-product-notify-me-form">';
			$html .= '<div class="close-back_notify_me-form full">';
			$html .= '</div>';
			$html .= '<div class="notify-me-form-popup">';
				$html .= '<div class="notify-me-form-close">';
					$html .= '<span class="close-wrap">';
						$html .= '<span class="close-line close-line1">';
						$html .= '</span>';
						$html .= '<span class="close-line close-line2">';
						$html .= '</span>';
					$html .= '</span>';
				$html .= '</div>';
				$html .= do_shortcode('[contact-form-7 id="36196" product="'.esc_html($product->get_title()).'" product_url="'.get_permalink($product->get_id()).'"]');
			$html .= '</div>';
		$html .= '</div>';
		echo wp_kses($html,'social');
	}
}
add_filter( 'shortcode_atts_wpcf7', 'mafoil_shortcode_atts_wpcf7_filter', 10, 3 );
function mafoil_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    if ( isset( $atts['product'] ) ) {
        $out['product'] = $atts['product'];
    }
    if ( isset( $atts['product_url'] ) ) {
        $out['product_url'] = $atts['product_url'];
    }	
    return $out;
}
function mafoil_product_quick_buy_button() {
	$show_quick_buy = mafoil_get_config('show-quick-buy',true);
	if($show_quick_buy){
		global $product;
		if ( $product->get_type() == 'external' ) {
			return;
		}
		$html = '<button class="button quick-buy">'.esc_html__("Buy Now","mafoil").'</button>';
		echo wp_kses($html,'social');		
	}
}
function mafoil_quickview_short_desc(){
	global $post;
	if ( ! $post->post_excerpt ) {
		return;
	}
	$length_product_short_desc = mafoil_get_config('length-product-short-desc',true);
	?>
	<div itemprop="description" class="description">
		<?php echo apply_filters( 'woocommerce_short_description', wp_trim_words( $post->post_excerpt, $length_product_short_desc ) ) ?>
	</div>
<?php }
function mafoil_get_countdown(){
	global $product;
	$dates = time();
	$start_time = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
	$countdown_time = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
	$orginal_price = get_post_meta( $product->get_id(), '_regular_price', true );	
	$sale_price = get_post_meta( $product->get_id(), '_sale_price', true );	
	$symboy = get_woocommerce_currency_symbol( get_woocommerce_currency() );
	$show_countdown = mafoil_get_config('show-countdown',true);
	if($show_countdown && ( $dates >= $start_time )){
		if ( $countdown_time ):
			$date = mafoil_timezone_offset( $countdown_time ); ?>
			<div class="countdown-single">
				<h2 class="title-countdown">
					<?php echo esc_html__('Hurry up! Sale ends in:','mafoil') ?>
				</h2>
				<div class="product-countdown"  data-day="<?php echo esc_attr__("d","mafoil"); ?>" data-hour="<?php echo esc_attr__("h","mafoil"); ?>" data-min="<?php echo esc_attr__("m","mafoil"); ?>" data-sec="<?php echo esc_attr__("s","mafoil"); ?>" data-date="<?php echo esc_attr( $date ); ?>" data-price="<?php echo esc_attr( $symboy.$orginal_price ); ?>" data-sttime="<?php echo esc_attr( $start_time ); ?>" data-cdtime="<?php echo esc_attr( $countdown_time ); ?>" data-id="<?php echo esc_attr('product_'.$product->get_id()); ?>"></div>
			</div>
		<?php endif; ?>
	<?php } ?>
<?php }
function mafoil_size_guide(){
	global $product;
	$mafoil_settings = mafoil_global_settings();
	$size_guide = mafoil_get_config('size-guide',false);
	if($size_guide && $product->is_type( 'variable' )){
		if(isset($mafoil_settings['img-size-guide']['url']) && !empty($mafoil_settings['img-size-guide']['url'])):?>
		<div class="size-guide">
			<div class="size-guide__title size-guide__click"><?php echo esc_html__('Size guide','mafoil') ?></div>
			<div class="size-guide__overlay size-guide__click"></div>
			<div class="size-guide__img">
				<div class="size-guide__close size-guide__click"></div>
				<img src="<?php echo esc_url($mafoil_settings['img-size-guide']['url']); ?>" alt="<?php echo esc_attr__( "Image Size Guide","mafoil" ); ?>">
			</div>
		</div>
		<?php endif; ?>
	<?php } ?>
<?php }
function mafoil_prev_next_product(){
	$prevnext_single = mafoil_get_config('prevnext-single',true);
	if($prevnext_single){
		$prev_post = get_previous_post();
		$next_post = get_next_post();
	?>
	<div class="prev_next_buttons">
		<?php
		if($prev_post){ 
			$prevpost = get_the_post_thumbnail( $prev_post->ID, array(180,120));
		?>
		<div class="prev_button">
			<?php previous_post_link( '%link', ''.esc_html__('Previous','mafoil').'' ); ?>
			<div class="image">
				<?php echo wp_kses($prevpost,'social'); ?>
				<?php previous_post_link( '%link', '<h2 class="title">%title</h2>' ); ?>
			</div>
		</div>
		<?php } ?>
		<?php
		if($next_post){ 
			$nextpost = get_the_post_thumbnail( $next_post->ID, array(180,120));
		?>
		<div class="next_button">
			<?php next_post_link( '%link', ''.esc_html__('Next','mafoil').'' ); ?>
			<div class="image">
				<?php echo wp_kses($nextpost,'social'); ?>
				<?php next_post_link( '%link', '<h2 class="title">%title</h2>' ); ?>
			</div>
		</div>
		<?php } ?>
		<div class="continue-shop">
			<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><i class="feather-grid"></i></a>
			<span><?php echo esc_html__("Back to Shop","mafoil") ?></span>
		</div>
	</div> <?php }
}
function mafoil_sticky_cart(){
	global $product; 
	$show_sticky_cart = mafoil_get_config('show-sticky-cart',true);
	remove_action( 'woocommerce_after_add_to_cart_button', 'mafoil_add_loop_wishlist_link', 35 );
	if($show_sticky_cart){ ?>
	<div class="sticky-product">
		<div class="content">
			<div class="content-product">
				<div class="item-thumb">
					<a href="<?php echo get_permalink( $product->get_id() ); ?>"><img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" /></a>
				</div>
				<div class="content-bottom">
					<div class="item-title">
						<a href="<?php echo esc_url(get_permalink( $product->get_id() )); ?>"><?php echo esc_html($product->get_title()); ?></a>
					</div>
					<div class="price">
						<?php echo wp_kses($product->get_price_html(),'social'); ?>
					</div>
				</div>
			</div>
			<div class="content-cart">
				<?php if ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) {
					woocommerce_template_single_add_to_cart();
				}else{ ?>
					<div class="select-cart-option"><?php echo esc_html__("select option","mafoil") ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
<?php }
function mafoil_add_countdownt_item(){
	global $product;
	$dates = time();
	$item_id = 'item_countdown_'.rand().time();
	$start_time = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
	$countdown_time = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );	
	$product_countdown = mafoil_get_config('product-countdown',true);
	if( $product_countdown && $start_time && $countdown_time && ( $dates >= $start_time )) {
	$date = mafoil_timezone_offset( $countdown_time );	
	?>
	<div class="countdown">
		<div class="item-countdown">
			<div class="product-countdown"  
				data-day="<?php echo esc_html__('d','mafoil'); ?>"
				data-hour="<?php echo esc_html__('h','mafoil'); ?>"
				data-min="<?php echo esc_html__('m','mafoil'); ?>"
				data-sec="<?php echo esc_html__('s','mafoil'); ?>"
				data-date="<?php echo esc_attr( $date ); ?>"  
				data-sttime="<?php echo esc_attr( $start_time ); ?>" 
				data-cdtime="<?php echo esc_attr( $countdown_time ); ?>"
				data-id="<?php echo esc_attr($item_id); ?>">
			</div>
		</div>
	</div>
	<?php }
}
function mafoil_woocommerce_template_loop_add_to_cart( $args = array() ) {
	global $product;
	if ( $product ) {
		$defaults = array(
			'quantity' => 1,
			'class'    => implode( ' ', array_filter( array(
					'button',
					'product_type_' . $product->get_type(),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : 'read_more',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			) ) ),
		);
		$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
		wc_get_template( 'loop/add-to-cart.php', $args );
	}
}	
function mafoil_add_excerpt_in_product_archives() {
	global $post;
	if ( ! $post->post_excerpt ) return;		
	echo '<div class="item-description item-description2">'.wp_trim_words( $post->post_excerpt, 25 ).'</div>';
}	
/*add second thumbnail loop product*/
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'mafoil_woocommerce_template_loop_product_thumbnail', 10 );
function mafoil_product_thumbnail( $size = 'woocommerce_thumbnail', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $mafoil_settings,$product;
	$html = '';
		$attachment_ids = $product->get_gallery_image_ids();
		$attachment_image = '';
		if(!empty($attachment_ids)) {
			$first_image_id = $attachment_ids[0];
			$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image back'));
		}
		if ( $attachment_image ){
			if( $attachment_image && isset($mafoil_settings['category-image-hover']) && $mafoil_settings['category-image-hover']){
				$html .= '<div class="product-thumb-hover">';
				$html .= '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">';
				$html .= (get_the_post_thumbnail( $product->get_id(), $size )) ? get_the_post_thumbnail( $product->get_id(), $size, array('class' => 'fade-in lazyload') ): '<img src="'.get_template_directory_uri().'/images/placeholder.jpg" alt="'. esc_attr__('No thumb', 'mafoil').'">';
				$html .= $attachment_image;
				$html .= '</a>';
				$html .= '</div>';				
			}else{
				$html .= '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">';		
				$html .= (get_the_post_thumbnail( $product->get_id(), $size )) ? get_the_post_thumbnail( $product->get_id(), $size, array('class' => 'fade-in lazyload') ): '<img src="'.get_template_directory_uri().'/images/placeholder.jpg" alt="'. esc_attr__('No thumb', 'mafoil').'">';
				$html .= '</a>';
			}		
		}else{
			$html .= '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">';		
			$html .= (get_the_post_thumbnail( $product->get_id(), $size )) ? get_the_post_thumbnail( $product->get_id(), $size, array('class' => 'fade-in lazyload') ): '<img src="'.get_template_directory_uri().'/images/placeholder.jpg" alt="'. esc_attr__('No thumb', 'mafoil').'">';
			$html .= '</a>';	
		}
	/* quickview */
	return $html;
}
function mafoil_woocommerce_template_loop_product_thumbnail(){
	echo mafoil_product_thumbnail();
}
function mafoil_countdown_woocommerce_template_loop_product_thumbnail(){
	echo mafoil_product_thumbnail("shop_single");
}
//Button List Product
/*********QUICK VIEW PRODUCT**********/
function mafoil_product_quick_view_scripts() {	
	wp_enqueue_script('wc-add-to-cart-variation');
}
add_action( 'wp_enqueue_scripts', 'mafoil_product_quick_view_scripts' );	
function mafoil_quickview(){
	global $product;
	$quickview = mafoil_get_config('product_quickview'); 
	if( $quickview ) : 
		echo '<span class="product-quickview"  data-title="'.esc_html__("Quick View","mafoil").'"><a href="#" data-product_id="'.esc_attr($product->get_id()).'" class="quickview quickview-button quickview-'.esc_attr($product->get_id()).'" >'.'<span>'.apply_filters( 'out_of_stock_add_to_cart_text', 'Quick View' ).'</span></a></span>';
	endif;
}
add_action("wp_ajax_mafoil_quickviewproduct", "mafoil_quickviewproduct");
add_action("wp_ajax_nopriv_mafoil_quickviewproduct", "mafoil_quickviewproduct");
function mafoil_quickviewproduct(){
	check_ajax_referer( 'mafoil_ajax_nonce', 'security' );
	echo mafoil_content_product();exit();
}
function mafoil_content_product(){
	$productid = (isset($_REQUEST["product_id"]) && $_REQUEST["product_id"]>0) ? $_REQUEST["product_id"] : 0;
	$query_args = array(
		'post_type'	=> 'product',
		'p'			=> $productid
	);
	$outputraw = $output = '';
	$r = new WP_Query($query_args);
	if($r->have_posts()){ 
		while ($r->have_posts()){ $r->the_post(); setup_postdata($r->post);
			ob_start();
			wc_get_template_part( 'content', 'quickview-product' );
			$outputraw = ob_get_contents();
			ob_end_clean();
		}
	}
	$output = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $outputraw);
	return $output;	
}
//Cart Ajax
add_action("wp_ajax_mafoil_cartajax", "mafoil_cartajax");
add_action("wp_ajax_nopriv_mafoil_cartajax", "mafoil_cartajax");
function mafoil_cartajax(){
	check_ajax_referer( 'mafoil_ajax_nonce', 'security' );
	echo mafoil_content_cart();exit();
}
function mafoil_content_cart(){
	$outputraw = $output = '';
	ob_start();
		wc_get_template_part( 'content', 'cart-popup' );
		$outputraw = ob_get_contents();
	ob_end_clean();
	$output = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $outputraw);
	return $output;
}
//sale flash
function mafoil_add_sale_flash(){	
	wc_get_template( 'loop/sale-flash.php' );
}
//Wish list
function mafoil_add_loop_wishlist_link(){
	global $product;
	$product_id = $product->get_id();
	$html = "";
	if( class_exists( 'WPCleverWoosw' ) ){
		$html .= '<div class="woosw-wishlist" data-title="'.esc_html__("Wishlist","mafoil").'">';
			$html .= do_shortcode('[woosw id='.esc_attr($product_id).']');
		$html .= '</div>';
	}
	echo wp_kses($html,'social');
}
function mafoil_add_social() {
	$product_share	 = mafoil_get_config('product-share',true);
	if ( shortcode_exists( 'social_share' ) && $product_share) :
		echo '<div class="social-icon">';
			echo '<label>';
			echo esc_html__('Share : ','mafoil');
			echo '</label>';
			echo do_action( 'woocommerce_share' );
			echo do_shortcode( '[social_share]' );
		echo '</div>';
	endif;	
}
function mafoil_add_thumb_single_product() {
	echo '<div class="image-thumbnail-list">';
	do_action( 'woocommerce_product_thumbnails' );
	echo '</div>';
}
function mafoil_get_class_item_product(){
	$product_col_large = 12 /(mafoil_get_config('product_col_large',4));	
	$product_col_medium = 12 /(mafoil_get_config('product_col_medium',3));
	$product_col_sm 	= 12 /(mafoil_get_config('product_col_sm',1));
	$product_col_xs 	= 12 /(mafoil_get_config('product_col_xs',1));
	$class_item_product = 'col-lg-'.$product_col_large.' col-md-'.$product_col_medium.' col-sm-'.$product_col_sm.' col-'.$product_col_xs;
	return $class_item_product;
}
function mafoil_catalog_perpage(){
	$mafoil_settings = mafoil_global_settings();
	$query_string = mafoil_get_query_string();
	parse_str($query_string, $params);
	$query_string 	= '?'.$query_string;
	$per_page 	=   (isset($mafoil_settings['product_count']) && $mafoil_settings['product_count'])  ? (int)$mafoil_settings['product_count'] : 12;
	$product_count = (isset($params['product_count']) && $params['product_count']) ? ($params['product_count']) : $per_page;
	?>
	<div class="mafoil-woocommerce-sort-count">
		<div class="woocommerce-sort-count">
			<ul class="list-show">
				<li data-value="<?php echo esc_attr($per_page); 	?>"<?php if ($product_count == $per_page){?>class="active"<?php } ?>><a href="<?php echo add_query_arg('product_count', $per_page, $query_string); ?>"><?php echo esc_attr($per_page); ?></a></li>
				<li data-value="<?php echo esc_attr($per_page*2); 	?>"<?php if ($product_count == $per_page*2){?>class="active"<?php } ?>><a href="<?php echo add_query_arg('product_count', $per_page*2, $query_string); ?>"><?php echo esc_attr($per_page*2); ?></a></li>
				<li data-value="<?php echo esc_attr($per_page*3); 	?>"<?php if ($product_count == $per_page*3){?>class="active"<?php } ?>><a href="<?php echo add_query_arg('product_count', $per_page*3,$query_string); ?>"><?php echo esc_attr($per_page*3); ?></a></li>
			</ul>
		</div>
	</div>
<?php }	
add_filter('loop_shop_per_page', 'mafoil_loop_shop_per_page');
function mafoil_loop_shop_per_page() {
	$mafoil_settings = mafoil_global_settings();
	$query_string = mafoil_get_query_string();
	parse_str($query_string, $params);
	$per_page 	=   (isset($mafoil_settings['product_count']) && $mafoil_settings['product_count'])  ? (int)$mafoil_settings['product_count'] : 12;
	$product_count = (isset($params['product_count']) && $params['product_count']) ? ($params['product_count']) : $per_page;
	return $product_count;
}	
function mafoil_found_posts(){
	wc_get_template( 'loop/woocommerce-found-posts.php' );
}	
remove_action('woocommerce_before_main_content', 'mafoil_woocommerce_breadcrumb', 20);	
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
function mafoil_search_form_product(){
	$query_string = mafoil_get_query_string();
	parse_str($query_string, $params);
	$category_slug = isset( $params['product_cat'] ) ? $params['product_cat'] : '';
	$terms =	get_terms( 'product_cat', 
	array(  
		'hide_empty' => true,	
		'parent' => 0	
	));
	$class_ajax_search 	= "";	 
	$ajax_search 		= mafoil_get_config('show-ajax-search',false);
	$limit_ajax_search 		= mafoil_get_config('limit-ajax-search',5);
	if($ajax_search){
		$class_ajax_search = "ajax-search";
	}
	?>
	<form role="search" method="get" class="search-from <?php echo esc_attr($class_ajax_search); ?>" action="<?php echo esc_url(home_url( '/' )); ?>" data-admin="<?php echo admin_url( 'admin-ajax.php', 'mafoil' ); ?>" data-noresult="<?php echo esc_html__('No Result','mafoil') ; ?>" data-limit="<?php echo esc_attr($limit_ajax_search); ?>">
		<?php if($terms && is_object($terms)){ ?>
		<div class="select_category pwb-dropdown dropdown">
			<span class="pwb-dropdown-toggle dropdown-toggle" data-toggle="dropdown"><?php echo esc_html__('Category','mafoil'); ?></span>
			<span class="caret"></span>
			<ul class="pwb-dropdown-menu dropdown-menu category-search">
			<li data-value="" class="<?php  echo (empty($category_slug) ?  esc_attr("active") : ""); ?>"><?php echo esc_html__('Browse Category','mafoil'); ?></li>
				<?php foreach($terms as $term){ ?>
					<?php if( $term && is_object($term) ){ ?>
						<li data-value="<?php echo esc_attr($term->slug); ?>" class="<?php  echo (($term->slug == $category_slug) ?  esc_attr("active") : ""); ?>"><?php echo esc_html($term->name); ?></li>
						<?php
							$terms_vl1 =	get_terms( 'product_cat', 
							array( 
									'parent' => '', 
									'hide_empty' => false,
									'parent' 		=> $term->term_id, 
							));						
						?>	
						<?php foreach ($terms_vl1 as $term_vl1) { ?>
							<?php if( $term_vl1 && is_object($term_vl1) ){ ?>
								<li data-value="<?php echo esc_attr($term_vl1->slug); ?>" class="<?php  echo (($term_vl1->slug == $category_slug) ?  esc_attr("active") : ""); ?>"><?php echo esc_html($term_vl1->name); ?></li>
								<?php
									$terms_vl2 =	get_terms( 'product_cat', 
									array( 
											'parent' => '', 
											'hide_empty' => false,
											'parent' 		=> $term_vl1->term_id, 
								));	?>					
								<?php foreach ($terms_vl2 as $term_vl2) { ?>
									<?php if( $term_vl2 && is_object($term_vl2) ){ ?>
										<li data-value="<?php echo esc_attr($term_vl2->slug); ?>" class="<?php  echo (($term_vl2->slug == $category_slug) ?  esc_attr("active") : ""); ?>"><?php echo esc_html($term_vl2->name); ?></li>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</ul>	
			<input type="hidden" name="product_cat" class="product-cat" value="<?php echo esc_attr($category_slug); ?>"/>
		</div>	
		<?php } ?>	
		<div class="search-box">
			<button id="searchsubmit" class="btn" type="submit">
				<i class="icon-search"></i>
				<span><?php echo esc_html__('search','mafoil'); ?></span>
			</button>
			<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="input-search s" placeholder="<?php echo esc_attr__( 'Search...', 'mafoil' ); ?>" />
			<div class="result-search-products-content">
				<ul class="result-search-products">
				</ul>
			</div>
		</div>
		<input type="hidden" name="post_type" value="product" />
	</form>
<?php }
function mafoil_top_cart(){
	global $woocommerce; ?>
	<div id="cart" class="top-cart">
		<a class="cart-icon" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" title="<?php esc_attr_e('View your shopping cart', 'mafoil'); ?>">
			<i class="flaticon-bag"></i>
		</a>
	</div>
<?php }
function mafoil_button_filter(){
	$html = '<a class="button-filter-toggle"></a>';
	echo wp_kses($html,'social');
}	
function mafoil_image_single_product(){
	$class = new stdClass;
	$class->show_thumb = mafoil_get_config('product-thumbs');
	$position = mafoil_get_config('position-thumbs',"bottom");
	$product_layout_thumb = mafoil_get_config("layout-thumbs","scroll");
	$class->position = $position;
	if($class->show_thumb == 'show' && $position == "outsite"){
		add_action( 'woocommerce_single_product_summary', 'mafoil_add_thumb_single_product', 40 );
	}	
	if(( $position == 'left' || $position == "right" ) &&  ( $product_layout_thumb == "scroll" || $product_layout_thumb == "light" ) && $class->show_thumb == 'show' ){
		$class->class_thumb = "col-md-2";
		$class->class_data_image = 'data-vertical="true" data-verticalswiping="true"';
		$class->class_image = "col-md-10";
	}else{
		$class->class_thumb = $class->class_image = "col-sm-12";
		$class->class_data_image = "";
	}
	$product_count_thumb = mafoil_get_config("product-thumbs-count",4) ? mafoil_get_config("product-thumbs-count",4) : apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
	$class->product_count_thumb =	$product_count_thumb;
	$product_layout_thumb = mafoil_get_config("layout-thumbs","scroll");
	$class->product_layout_thumb =	$product_layout_thumb;
	return $class;
}
function mafoil_category_top_bar(){
	remove_action('woocommerce_before_shop_loop','woocommerce_result_count',40); 
	add_action('woocommerce_before_shop_loop','mafoil_display_view', 35);
	remove_action('woocommerce_before_shop_loop','mafoil_found_posts', 20);
	add_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30);
	$category_style  = mafoil_get_config('category_style','sidebar');
	if(is_active_sidebar('sidebar-product')){
		add_action('woocommerce_before_shop_loop','mafoil_button_filter', 25);
	}
	do_action( 'woocommerce_before_shop_loop' );
}
function mafoil_get_product_discount(){
	global $product;
	$discount = 0;
	if ($product->is_on_sale() && $product->is_type( 'variable' )){
		$available_variations = $product->get_available_variations();
		for ($i = 0; $i < count($available_variations); ++$i) {
			$variation_id=$available_variations[$i]['variation_id'];
			$variable_product1= new WC_Product_Variation( $variation_id );
			$regular_price = $variable_product1->get_regular_price();
			$sales_price = $variable_product1->get_sale_price();
			if(is_numeric($regular_price) && is_numeric($sales_price)){
				$percentage = round( (( $regular_price - $sales_price ) / $regular_price ) * 100 ) ;
				if ($percentage > $discount) {
					$discount = $percentage;
				}
			}
		}
	}elseif($product->is_on_sale() && $product->is_type( 'simple' )){
		$regular_price	= $product->get_regular_price();
		$sales_price	= $product->get_sale_price();
		if(is_numeric($regular_price) && is_numeric($sales_price)){
			$discount = round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 );
		}
	}
	if( $discount > 0 ){
		$text_discount = "-".$discount.'%';
	}else{
		$text_discount = '';
	}
	return 	$text_discount;
}
add_action( 'woocommerce_before_quantity_input_field', 'mafoil_display_quantity_plus' );
function mafoil_display_quantity_plus() {
   $html = '<button type="button" class="plus" ><i class="feather-plus" aria-hidden="true"></i></button>';
   echo wp_kses($html,'social');
}
add_action( 'woocommerce_after_quantity_input_field', 'mafoil_display_quantity_minus' );
function mafoil_display_quantity_minus() {
	$html = '<button type="button" class="minus" ><i class="feather-minus" aria-hidden="true"></i></button>';
	echo wp_kses($html,'social');
}
function mafoil_woocommerce_template_loop_category_title( $category ) { ?>
	<div class="woocommerce-loop-category">
		<h2 class="woocommerce-loop-category__title">
			<a href="<?php echo get_term_link( $category->term_id, 'product_cat' ); ?>"><?php echo esc_html( $category->name ); ?></a>
		</h2>
	</div>
	<?php
}
function mafoil_woocommerce_template_loop_only_category_title( $category ) { ?>
		<div class="woocommerce-loop-category">
			<h2 class="woocommerce-loop-category__title">
				<a href="<?php echo get_term_link( $category->term_id, 'product_cat' ); ?>"><?php echo esc_html( $category->name ); ?></a>
			</h2>
			<div class="count-product">
				<?php if ( $category->count == 1 ) {
					echo apply_filters( 'woocommerce_subcategory_count_html', esc_html( $category->count ) . '' . esc_html__(' product','mafoil'), $category );
				}else{
					echo apply_filters( 'woocommerce_subcategory_count_html', esc_html( $category->count ) . '' . esc_html__(' products','mafoil'), $category );
				} ?>
			</div>
			<div class="view-all">
				<a href="<?php echo get_term_link( $category->term_id, 'product_cat' ); ?>"><?php echo esc_html__('View all products','mafoil'); ?></a>
			</div>
		</div>
	<?php
}
function mafoil_woocommerce_subcategory_thumbnail( $category ){
	$subcategories_style = mafoil_get_config('style-subcategories','shop_mini_categories');
	if($subcategories_style == "icon_categories"){
		$icon_category = get_term_meta( $category->term_id, 'category_icon', true );
		if($icon_category){?>
			<i class="<?php echo esc_attr($icon_category); ?>"></i>
			<?php }
	}else{
		$thumbnail_id         = get_term_meta( $category->term_id, 'thumbnail_id', true );
		if ( $thumbnail_id ) {
			$image        = wp_get_attachment_image_src( $thumbnail_id, 'full' );
			$image        = $image[0]; ?>
			<img class="fade-in lazyloaded" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $category->name ); ?>"/>
			<?php
		}
	}
}
function mafoil_get_video_product(){
	global $product;
	$video  = (get_post_meta( $product->get_id(), 'video_product', true )) ? get_post_meta($product->get_id(), 'video_product', true ) : "";
	if($video){ ?>
		<?php
			$youtube_id = mafoil_get_youtube_video_id($video);
			$vimeo_id = mafoil_get_vimeo_video_id($video);
			$url_video = "#";
			if($youtube_id){
				$url_video = "https://www.youtube.com/embed/".esc_attr($youtube_id);
			}elseif($vimeo_id){
				$url_video = "https://player.vimeo.com/video/".esc_attr($vimeo_id);
			}
		?>
		<div class="mafoil-product-button ">
			<div class="mafoil-bt-video">
				<div class="bwp-video modal" data-src="<?php echo esc_attr($url_video); ?>">
					<?php echo esc_html__( 'Play video', 'mafoil' ); ?>
				</div>
				<div class="content-video modal fade" id="myModal">
					<div class="remove-show-modal"></div>
					<div class="modal-dialog modal-dialog-centered">
						<?php mafoil_display_video_product(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
}
function mafoil_display_video_product(){
	global $product;
	$video  = (get_post_meta( $product->get_id(), 'video_product', true )) ? get_post_meta($product->get_id(), 'video_product', true ) : "";
	if($video){
		$youtube_id = mafoil_get_youtube_video_id($video);
		$vimeo_id = mafoil_get_vimeo_video_id($video);
		?>
		<?php if($youtube_id){ ?>
			<iframe id="video" src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" title="<?php echo esc_html__('YouTube video player','mafoil'); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		<?php }elseif($vimeo_id){?>
			<iframe id="video" src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>"  frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
		<?php } ?>
	<?php }
}
function mafoil_display_thumb_video(){
	global $product;
	$html = "";
	$video  = (get_post_meta( $product->get_id(), 'video_product', true )) ? get_post_meta($product->get_id(), 'video_product', true ) : "";
	if($video){
		$youtube_id = mafoil_get_youtube_video_id($video);
		$vimeo_id = mafoil_get_vimeo_video_id($video);		
		if($youtube_id){
			$html .= '<div class="img-thumbnail-video">';
				$html .= '<img src="http://img.youtube.com/vi/'.$youtube_id.'/sddefault.jpg"/>';
			$html .= '</div>';
		}elseif($vimeo_id){
			$arr_vimeo = unserialize(WP_Filesystem_Direct::get_contents("https://vimeo.com/api/v2/video/".esc_attr($vimeo_id).".php"));
			$html .= '<div class="img-thumbnail-video">';
				$html .= '<img src="'.esc_attr($arr_vimeo[0]['thumbnail_large']).'"/>';
			$html .= '</div>';
		}
	}
	if($html){
		echo wp_kses($html,'social');
	}
}
function mafoil_get_vimeo_video_id($url){
	$regs = array();
	$video_id = '';
	if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
	$video_id = $regs[3];
	}
	return $video_id;
}
function mafoil_get_youtube_video_id($url){
	$video_id = false;
	$url = parse_url($url);
	if (strcasecmp($url['host'], 'youtu.be') === 0)
	{
		$video_id = substr($url['path'], 1);
	}
	elseif (strcasecmp($url['host'], 'www.youtube.com') === 0)
	{
		if (isset($url['query'])){
			parse_str($url['query'], $url['query']);
			if (isset($url['query']['v'])){
				$video_id = $url['query']['v'];
			}
		}
		if ($video_id == false){
			$url['path'] = explode('/', substr($url['path'], 1));
			if (in_array($url['path'][0], array('e', 'embed', 'v'))){
				$video_id = $url['path'][1];
			}
		}
	}else{
		return false;
	}
	return $video_id;
}
function mafoil_view_product(){
	global $product;
	$view  = (get_post_meta( $product->get_id(), 'view_product', true )) ? get_post_meta($product->get_id(), 'view_product', true ) : "";
	if($view == 'true'){ $j=0; ?>
	<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
	<div class="mafoil-360-button"><i class="feather-box"></i><?php echo esc_html__('360 Degree','mafoil') ?></div>
	<div class="content-product-360-view">
		<div class="product-360-view" data-count="<?php echo esc_attr(count($attachment_ids)-1); ?>">
			<div class="mafoil-360-button"></div>
			<div class="images-display">
				<ul class="images-list">
				<?php
					foreach ( $attachment_ids as $attachment_id ) {		
						$image_link = wp_get_attachment_url( $attachment_id );
						if ( ! $image_link )
							continue;
						$image_title 	= esc_attr( get_the_title( $attachment_id ) );
						$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'full' ), 0, $attr = array(
							'title' => $image_title,
							'alt'   => $image_title
							) ); ?>
						<li class="images-display image-<?php echo esc_attr($j); ?> <?php if($j==0){ ?>active<?php } ?>"><?php echo wp_kses($image,'social'); ?></li>
						<?php $j++;
					}
				?>
				</ul>
			</div>
		</div>
	</div>
	<?php }
}
function mafoil_woocommerce_maybe_show_product_subcategories( $loop_html = '' ) {
	if(class_exists( 'WooCommerce' )){
		$product_categories = get_terms( 'product_cat', array('hide_empty' => true,'parent' => 0) );
		ob_start();
		foreach ( $product_categories as $category ) {
			wc_get_template(
				'content-product_cat.php',
				array(
					'category' => $category,
				)
			);
		}
		$loop_html .= ob_get_clean();
		return $loop_html;
	}
}
function mafoil_woocommerce_output_product_categories( ){
	if(class_exists( 'WooCommerce' )){ 
		$product_categories = get_terms( 'product_cat', array('hide_empty' => true,'parent' => 0) );
		if ( ! $product_categories ) {
			return false;
		}
		foreach ( $product_categories as $category ) {
			wc_get_template(
				'content-only-product_cat.php',
				array(
					'category' => $category,
				)
			);
		}
		return true;
	}
}
//Cart Ajax Page
add_action("wp_ajax_mafoil_cartajax_page", "mafoil_cartajax_page");
add_action("wp_ajax_nopriv_mafoil_cartajax_page", "mafoil_cartajax_page");
function mafoil_cartajax_page(){
	check_ajax_referer( 'mafoil_ajax_nonce', 'security' );
	echo mafoil_content_cart_page();exit();
}
function mafoil_content_cart_page(){
	$outputraw = $output = '';
	ob_start();
		wc_get_template('cart/cart.php');
		$outputraw = ob_get_contents();
	ob_end_clean();
	$output = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $outputraw);
	return $output;
}
function mafoil_timezone_offset( $countdowntime ){
	$timeOffset = 0;	
	if( get_option( 'timezone_string' ) != '' ) :
		$timezone = get_option( 'timezone_string' );
		$dateTimeZone = new DateTimeZone( $timezone );
		$dateTime = new DateTime( "now", $dateTimeZone );
		$timeOffset = $dateTimeZone->getOffset( $dateTime );
	else :
		$dateTime = get_option( 'gmt_offset' );
		$dateTime = intval( $dateTime );
		$timeOffset = $dateTime * 3600;
	endif;
	$offset =  ( $timeOffset < 0 ) ? '-' . gmdate( "H:i", abs( $timeOffset ) ) : '+' . gmdate( "H:i", $timeOffset );
	$date = date( 'Y/m/d H:i:s', $countdowntime );
	$date1 = new DateTime( $date );
	$cd_date =  $date1->format('Y-m-d H:i:s') . $offset;
	return strtotime( $cd_date );
}
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
 
function woocommerce_ajax_add_to_cart(){
	check_ajax_referer( 'mafoil_ajax_nonce', 'security' );
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX:: get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
 
        echo wp_send_json($data);
    }
    wp_die();
	echo mafoil_content_cart();exit();
}
function mafoil_time_nofication(){
	if ( class_exists( 'WooCommerce' ) ) {
		wc_get_template( 'time-nofication.php' );
	}
}
?>