<?php   
if( $select_category && $checkbox_order ){
	$numberposts = (int)$numberposts;
?>
<div class="bwp-filter-homepage tab-product slider bwp_slick-margin-mobile <?php echo esc_attr($layout); ?>" <?php if($style_product > 1) { ?>data-content_product="<?php echo esc_attr($style_product) ?>"<?php } ?>  data-numberposts = "<?php echo esc_attr($numberposts); ?>">
	<div class="bwp-filter-heading">
		<?php if(isset($title1) && $title1) { ?>
		<div class="title-block">
			<h2><?php echo esc_html($title1); ?></h2>
		</div>
		<?php } ?>
		<div class="filter-order-by">
			<ul class="filter-orderby">
				<?php $i=0; foreach($checkbox_order as $option){
					$tab_title = '';						
					switch ($option) {
						case 'date':
							$tab_title = __( 'Latest Products', "wpbingo" );
						break;
						case 'popularity':
							$tab_title = __( 'Best Sellers', "wpbingo" );
						break;						
						case 'featured':
							$tab_title = __( 'Featured Products', "wpbingo" );
						break;
						case 'rating':
							$tab_title = __( 'Top Rating', "wpbingo" );
						break;
				} ?>			
				<li data-value="<?php echo esc_attr($option); ?>" <?php if($i == 0) echo 'class="active"'?>><span><?php echo $tab_title; ?></span></li>
				<?php $i++;} ?>				
			</ul>
		</div>
		<?php if( $label_button) : ?>
			<div class="content-btn">
				<div class="btn-all">
					<a href="<?php echo esc_url($link_button); ?>"><?php echo esc_html($label_button) ?></a>
				</div>
			</div>
		<?php endif;?>
	</div>
	<div class="bwp-filter-content">
		<?php
		$select_order = (isset($checkbox_order[0]) && $checkbox_order[0]) ? $checkbox_order[0] : 'date';
		$args = array(
			'post_type' 			=> 'product',
			'post_status' 			=> 'publish',
			'posts_per_page' 		=> $numberposts,	
		);
		$tax_query = array();
		if($select_category != 'all'){
			$tax_query[] = array(
							'taxonomy'	=> 'product_cat',
							'field'		=> 'slug',
							'terms'		=> $select_category );
		}
		$meta_query = array();
		switch ($select_order) {
			case 'date':
				$args['orderby']	= 'date';
			break;
			case 'rating':
				add_filter( 'posts_clauses',  'order_by_rating_post_clauses'  );				
			break;
			case 'popularity':
				$args['meta_key']	= 'total_sales';
				$args['orderby']	= 'meta_value_num';
			break;
			case 'featured':
				$product_visibility_term_ids = wc_get_product_visibility_term_ids();
				$tax_query[] = 	array(
									'taxonomy' => 'product_visibility',
									'field'    => 'term_taxonomy_id',
									'terms'    => $product_visibility_term_ids['featured'],
								);		
			break;
		}	
		$args['tax_query'] = $tax_query;
		$args['meta_query'] = $meta_query;
		$list = new WP_Query( $args );
		$j = 1;
		?>
		<ul class="filter-category hidden">
			<li data-value="<?php echo esc_attr($select_category); ?>" class="active"><?php echo esc_html($select_category); ?></li>
		</ul>
		<div class="content-product-list content-products-<?php echo esc_attr($select_order); ?>">
			<div class="content products-list grid slick-carousel row" data-slidestoscroll="true" data-dots="<?php echo esc_attr($show_pag);?>" data-item_row="<?php echo esc_attr($item_row); ?>" data-nav="<?php echo esc_attr($show_nav);?>" data-columns4="<?php echo esc_attr($columns4); ?>" data-columns3="<?php echo esc_attr($columns3); ?>" data-columns2="<?php echo esc_attr($columns2); ?>" data-columns1="<?php echo esc_attr($columns1); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-columns1440="<?php echo esc_attr($columns1440); ?>">
				<?php while($list->have_posts()): $list->the_post();
					global $product, $post, $wpdb, $average;
					if( ( $j % $item_row ) == 1 && $item_row !=1) { ?>
					<div class="item-product">
					<?php } ?>
						<div class="item">
							<?php if ($style_product == 1) { ?>
								<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product.php'); ?>
							<?php }elseif ($style_product == 2){ ?>
								<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product2.php'); ?>
							<?php }elseif ($style_product == 3){ ?>
								<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product3.php'); ?>
							<?php }elseif ($style_product == 4){ ?>
								<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product4.php'); ?>
							<?php } ?>
						</div>
					<?php if( ($j % $item_row == 0 || $j == $list->post_count) && $item_row !=1  ){?> 
					</div>
					<?php  } $j++;?>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>	
</div>
<?php } ?>