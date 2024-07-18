<?php
	/**
	 * Layout Default ajax
	 * @version     1.0.0
	 **/
	global $wp_query,$mafoil_settings;
	$filter 		= (isset($_POST['filter']) && $_POST['filter'] ) ? $_POST['filter'] : array();
	$data 			= (isset($filter['data']) && $filter['data']) ? $filter['data'] : array();
	$base_url 		= $_POST['base_url'] ? $_POST['base_url'] : '';
	$tax_name 			= $_POST['taxonomy'] ? $_POST['taxonomy'] : 'product_cat';
	$id_taxonomy 	= $_POST['id_taxonomy'] ? $_POST['id_taxonomy'] : 0;
	$attribute 		= $_POST['attribute'] ? explode(',',$_POST['attribute']) : array();
	$relation 		= $_POST['relation'] ? $_POST['relation'] : 'AND';
	$widget_template = (isset($_POST['widget_template']) && $_POST['widget_template']) ? $_POST['widget_template'] : 'default';
	$showcount 		= (isset($_POST['showcount']) && $_POST['showcount'] ) ? $_POST['showcount'] : 0 ;
	$show_price 	= (isset($_POST['show_price']) && $_POST['show_price'] ) ? $_POST['show_price'] : 0 ;
	$show_price 	= (isset($_POST['show_price']) && $_POST['show_price'] ) ? $_POST['show_price'] : 0 ;
	$show_brand 	= (isset($_POST['show_brand']) && $_POST['show_brand'] ) ? $_POST['show_brand'] : 0;
	$layout_shop 		= (isset($_POST['layout_shop']) && $_POST['layout_shop'] ) ? $_POST['layout_shop'] : 1;
	$shop_paging 		= (isset($_POST['shop_paging']) && $_POST['shop_paging'] ) ? $_POST['shop_paging'] : 'shop-pagination';
	$show_category 		= (isset($_POST['show_category']) && $_POST['show_category'] ) ? $_POST['show_category'] : 0;
	$array_value_url 	= (isset($_POST['array_value_url']) && $_POST['array_value_url'] ) ? unserialize(base64_decode($_POST['array_value_url'])) : array();
	$loadmore 		= ( isset($filter['loadmore']) && $filter['loadmore'] ) ? $filter['loadmore'] : 0;
	$tax_query = array();
	$link = get_term_link( (int)$id_taxonomy, $tax_name );
	if( $tax_name == "product_cat" ){
		if( $id_taxonomy == 0 ){
			$link = $base_url;
		}else{
			$link = get_category_link( (int)$id_taxonomy );
		}
	}
	$check_filter = array('only_sale','in_stock','min_price','max_price','paged','orderby','filter_brand');
	if($attribute){	
		foreach($attribute as $att){
			$check_filter[] = 'filter_'.$att;
		}
	}

	$meta_query	= array();
	
	if($array_value_url){
		foreach($array_value_url as $key=>$value_url)
		{
			if($key == "s")
				$check_search = $value_url;
			if(!in_array($key,$check_filter))
				$link = add_query_arg( $key, $value_url, $link );
		}
	}	
	
	if($id_taxonomy != 0){
		$tax_query[] =         
			array(
				'taxonomy'      => $tax_name,
				'field' 		=> 'term_id',
				'terms'         => $id_taxonomy,
				'operator'      => 'IN'
			);	
	}
	
	$chosen_attributes	 = array();
	$chosen_att	 = array();
	if($data){
		$f_data = array();
		foreach($data as $d){
			$f_data[$d['name']][] = $d['value'];
		}

		foreach($f_data as $key=>$p){
			$att = str_replace("filter_","",$key);
			$tax_query[] =         array(
				'taxonomy'      => 'pa_'.$att,
				'field' 		=> 'slug',
				'terms'         => $p,
				'operator'      => $relation
			);
			$chosen_att[$att] = $p;
			$chosen_attributes['pa_'.$att]['terms'] = $p;
			$chosen_attributes['pa_'.$att]['query_type'] = $relation;	
		}
		foreach($attribute as $att){
			if(isset($chosen_att[$att]) && $chosen_att[$att]){
				$link = add_query_arg( 'filter_'.$att, implode( ',', $chosen_att[$att] ), $link );
			}
		}
	}
	
	if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ){
		$meta_query[]	= array(
		  'key' => '_stock_status',
		  'value' => 'outofstock',
		  'compare' => '!='
		);
	}
	$tax_query[] = array(
	  'taxonomy'         => 'product_visibility',
	  'terms'            => array( 'exclude-from-catalog', 'exclude-from-search' ),
	  'field'            => 'name',
	  'operator'         => 'NOT IN',
	  'include_children' => false,
	);
	$default_min_price = isset($filter['default_min_price']) ? $filter['default_min_price'] : '' ;
	$default_max_price = isset($filter['default_max_price']) ? $filter['default_max_price'] : '' ;
	$min_price = isset($filter['min_price']) ? $filter['min_price'] : '' ;
	$max_price = isset($filter['max_price']) ? $filter['max_price'] : '' ;
	
	if(($min_price && ($min_price != $default_min_price)) || ($max_price && ($max_price != $default_max_price))){
		$link = add_query_arg( 'min_price', $min_price, $link );
		$link = add_query_arg( 'max_price', $max_price, $link );
		$chosen_attributes['min_price'] = $min_price;		
		$chosen_attributes['max_price'] = $max_price;		
		$meta_query[] =  array(
			'key'          => '_price',
			'value'        => array( $min_price, $max_price ),
			'compare'      => 'BETWEEN',
			'type'         => 'DECIMAL',
		);
	}	
	
	
	$paged = $filter['paged'] ? $filter['paged'] : 1;
	
	$per_page 	=   (isset($mafoil_settings['product_count']) && $mafoil_settings['product_count'])  ? (int)$mafoil_settings['product_count'] : 12;
	$default_posts_per_page = (isset($filter['product_count']) && $filter['product_count'] ) ? $filter['product_count'] : $per_page;
	$args = array(
		'post_type'             => 'product',
		'post_status'           => 'publish',
		'ignore_sticky_posts'   => 1,
		'paged' 					=>	$paged,
		'posts_per_page'        => $default_posts_per_page,
		'meta_query'            => $meta_query,
		'tax_query'             => $tax_query
	);	
	
	if(isset($check_search)){
		$args['s'] = $check_search;
	}
	$orderby = '';
	$order = '';	
	if(isset($check_search)){
		$args['s'] = $check_search;
		$orderby_value = isset( $filter['orderby'] ) ? wc_clean( $filter['orderby'] ) : 'relevance';
	}else{
		$orderby_value = $l_orderby =  isset( $filter['orderby'] ) ? wc_clean( $filter['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
	}
	// Get order + orderby args from string
	$orderby_value = explode( '-', $orderby_value );
	$orderby       = esc_attr( $orderby_value[0] );
	$order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;

	$orderby = strtolower( $orderby );
	$order   = strtoupper( $order );
	// default - menu_order
	$args['orderby']  = 'menu_order title';
	$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
	$args['meta_key'] = '';
	
	switch ( $orderby ) {
		case 'menu_order':
			$args['orderby'] = 'menu_order title';
			break;
		case 'relevance':
			$args['orderby'] = 'relevance';
			$args['order']   = 'DESC';
			break;		
		case 'date' :
			$args['orderby']  = 'date ID';
			$args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
		break;
		case 'price' :
			$args['orderby']  = "meta_value_num ID";
			$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
			$args['meta_key'] = '_price';
		break;
		case 'popularity':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'total_sales';
			$args['order'] = 'desc';
			break;
		break;
	}	
	
	if($l_orderby != 'menu_order')
		$link = add_query_arg( 'orderby', $l_orderby, $link );
	
	$args_count 	= 	$args;
	$args_count['posts_per_page'] 	= 	-1;

	$wp_query_count = new WP_Query($args_count);	
	$total = $wp_query_count->post_count;
		
	$wp_query = new WP_Query($args);
	$result = new stdClass();
	
	$result->base_url = $link;
	if( $tax_name == "product_cat" ){
		$category_bg_breadcrumb = get_term_meta( $id_taxonomy, 'category_bg_breadcrumb', true ) ? get_term_meta( $id_taxonomy, 'category_bg_breadcrumb', true ) : "";
		$result->result_background = $category_bg_breadcrumb;
	}
	ob_start();
		$category_view_mode = ( isset($filter['views']) && $filter['views'] ) ? $filter['views'] : 'grid';
		include(WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/products.php');
		$products = ob_get_contents();
		$result->products = $products;
	ob_end_clean();

	ob_start();
		include(WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/result-count.php');
		$result_count = ob_get_contents();
		$result->result_count = $result_count;
	ob_end_clean();

	ob_start();
		include(WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/filter.php');
		$left_nav = ob_get_contents();
		$result->left_nav = $left_nav;
	ob_end_clean();
	
	ob_start();
		include(WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/title.php');
		$title = ob_get_contents();
		$result->result_title = $title;
	ob_end_clean();	
	
	ob_start();
		include(WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/pagination.php');
		$pagination = ob_get_contents();
		$result->pagination = $pagination;
	ob_end_clean();

	ob_start();
		include(WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/breadcrumb.php');
		$breadcrumb = ob_get_contents();
		$result->result_breadcrumb = $breadcrumb;
	ob_end_clean();	
	
	ob_start();
		wc_get_template( 'loop/woocommerce-found-posts.php' );
		$total_html = ob_get_contents();
		$result->total_html = $total_html;
	ob_end_clean();	

	die (json_encode($result));