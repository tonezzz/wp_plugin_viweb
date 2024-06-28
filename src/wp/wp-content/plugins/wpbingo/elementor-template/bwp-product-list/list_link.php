<?php
$widget_id = isset( $widget_id ) ? $widget_id : 'bwp_woo_slider_'.rand().time();
$class_col_lg = ($columns == 5) ? '2-4'  : (12/$columns);
$class_col_md = ($columns1 == 5) ? '2-4'  : (12/$columns1);
$class_col_sm = ($columns2 == 5) ? '2-4'  : (12/$columns2);
$class_col_xs = ($columns3 == 5) ? '2-4'  : (12/$columns3);
$attributes = 'col-xl-'.$class_col_lg .' col-lg-'.$class_col_md .' col-md-'.$class_col_sm .' col-'.$class_col_xs;
$j = 0;
do_action( 'before' ); 
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $widget_id; ?>" class="bwp_product_list <?php echo esc_attr($layout); ?>">
		<div class="content-heading">
			<?php if($title1) { ?>
			<div class="title-block">   
				<h2><?php echo wp_kses($title1,'social'); ?></h2>
			</div> 
			<?php } ?>
			<div class="list-link">
				<ul>
					<?php foreach ($settings['list_tab'] as  $item){ ?>
						<?php if( $item['label_list'] ){ ?>
							<?php if( $item['show_active'] ){ ?>
								<li class="active"><?php echo esc_html($item['label_list']); ?></li>
							<?php }else{ ?>
								<li><a href="<?php echo esc_url($item['link_list']); ?>"><?php echo esc_html($item['label_list']); ?></a></li>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="content products-list grid row">	
			<?php while($list->have_posts()): $list->the_post();
				global $product, $post, $wpdb, $average; ?>
				<div class="item-product <?php echo esc_attr($attributes); ?>">
					<?php if ($style_product == 1) { ?>
						<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product.php'); ?>
					<?php }elseif ($style_product == 2){ ?>
						<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product2.php'); ?>
					<?php }elseif ($style_product == 3){ ?>
						<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product3.php'); ?>
					<?php }elseif ($style_product == 4){ ?>
						<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product4.php'); ?>
					<?php }elseif ($style_product == 5){ ?>
						<?php include(WPBINGO_ELEMENTOR_TEMPLATE_PATH.'content-product8.php'); ?>
					<?php } ?>
				</div>
			<?php endwhile; wp_reset_postdata();?>
		</div>	
	</div>
	<?php
	}
?>