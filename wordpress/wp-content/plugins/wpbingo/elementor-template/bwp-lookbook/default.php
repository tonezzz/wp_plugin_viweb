<?php
	$class_col_lg = ($columns == 5) ? '2-4'  : (12/$columns);
	$class_col_md = ($columns1 == 5) ? '2-4'  : (12/$columns1);
	$class_col_sm = ($columns2 == 5) ? '2-4'  : (12/$columns2);
	$class_col_xs = ($columns3 == 5) ? '2-4'  : (12/$columns3);
	$attributes = 'col-lg-'.$class_col_lg .' col-md-'.$class_col_md .' col-sm-'.$class_col_sm .' col-xs-'.$class_col_xs;
	global $wpdb;
	$widget_id = 'lookbook-'.rand().time();
	?>
	<?php $arr = array('br' => array(), 'p' => array(), 'span' => array()); ?>
	<div class="bwp-lookbook <?php echo esc_attr($layout); ?>">
		<div class="close-lookbook"></div>
		<div class="lookbook-container">
			<?php foreach ($settings['list_tab'] as  $key => $item_slider){ ?>
				<?php if( $item_slider['lookbook'] && $item_slider['lookbook'] ){ ?>
					<?php $item = $item_slider['lookbook']; ?>
					<?php
						$item = $wpdb->get_results(
							$wpdb->prepare(
								"SELECT
									*
								FROM
									`" . $wpdb->prefix . LOOKBOOK_TABLE . "`
								WHERE
									id = %d",
								$item
							),
						ARRAY_A
						);
						if(!empty($item)){?>
							<div class="item">
								<div class="bwp-content-lookbook">
									<?php if( $item_slider['url_lookbook'] && $item_slider['url_lookbook'] ){ ?>
										<a href="<?php echo wp_kses_post($item_slider['url_lookbook']); ?>">
											<img src="<?php echo esc_url(LOOKBOOK_UPLOAD_URL_IMAGE . '/'.UPLOAD_FOLDER_NAME.'/' . $item[0]['image']); ?>" alt="<?php echo esc_html($item[0]['name']); ?>"/>
										</a>
									<?php }else{ ?>
										<img src="<?php echo esc_url(LOOKBOOK_UPLOAD_URL_IMAGE . '/'.UPLOAD_FOLDER_NAME.'/' . $item[0]['image']); ?>" alt="<?php echo esc_html($item[0]['name']); ?>"/>
									<?php } ?>
									<?php
										$pins = ($item[0]['pins']) ? $item[0]['pins'] : "";
										if($pins){
											$pins = json_decode($pins);
											foreach($pins as $key => $pin){
												$style = "";
												$left = round(($pin->left/$pin->img_width)*100, 2);
												$top = round(($pin->top/$pin->img_height)*100, 2);		
												
												if($left > 50)
													$style .= " right:33px;";
												else
													$style .= " left:33px;";

												if($top > 50)
													$style .= " bottom:10px;";
												else
													$style .= " top:10px;";									
												?>
												<div class="item-lookbook" data-tager_lookbook="<?php echo esc_attr($widget_id.'-'.$pin->id.$key); ?>" style="height:<?php echo esc_attr($pin->height)?>px;width:<?php echo esc_attr($pin->width)?>px;left:<?php echo esc_attr($left)?>%;top:<?php echo esc_attr($top)?>%">
													<span class="number-lookbook"><?php echo esc_attr($key +1); ?></span>
												</div>
											<?php
											}
										} ?>
								</div>
							</div>						
						<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="box-title">
			<div class="content-info">
				<?php if($subtitle) { ?>
					<div class="subtitle-lookbook"><?php echo wp_kses($subtitle, $arr); ?></div>
				<?php } ?>
				<?php if($title1) { ?>
					<h2 class="title-lookbook"><?php echo wp_kses($title1, $arr); ?></h2>
				<?php } ?>
				<?php if($description) { ?>
					<div class="description-lookbook"><?php echo wp_kses($description, $arr); ?></div>
				<?php } ?>
				<?php  if($label): ?>
					<a class="button" href="<?php echo esc_url($link);?>"><span><?php echo ($label); ?></span></a>						
				<?php endif;?>
			</div>
		</div>
		<?php foreach ($settings['list_tab'] as  $key => $item){ ?>
			<?php if( $item['lookbook'] && $item['lookbook'] ){ ?>
				<?php $item = $item['lookbook']; ?>
				<?php $item = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT
								*
							FROM
								`" . $wpdb->prefix . LOOKBOOK_TABLE . "`
							WHERE
								id = %d",
							$item
						),
					ARRAY_A
					);
					if(!empty($item)){?>
						<?php
							$pins = ($item[0]['pins']) ? $item[0]['pins'] : "";
							if($pins){
								$pins = json_decode($pins);
								foreach($pins as $key => $pin){
									$class = "";
									$left = round(($pin->left/$pin->img_width)*100, 2);
									$top = round(($pin->top/$pin->img_height)*100, 2);		
									
									if($left > 50)
										$class  .= " left";
									else
										$class  .= " right";

									if($top > 50)
										$class  .= " top";
									else
										$class  .= " bottom";		
									?>
										<?php 
										if (!empty($pin->slug)){
											$result = get_posts(array(
												'name' => $pin->slug,
												'posts_per_page' => 1,
												'post_type' => 'product',
												'post_status' => 'publish'
											));
											if(isset($result[0]) && $result[0]){
												$post_data = $result[0];
												$id_product = $post_data->ID;
												$product = new WC_Product( $id_product );
												$product_url = get_permalink($id_product);
												$url = wp_get_attachment_image_src( get_post_thumbnail_id($id_product),'shop_catalog');															
												$img_block = (!empty($url[0])) ? '<img src="' . $url[0] . '"  alt="" />' : ''; ?>
												<div class="content-lookbook <?php echo esc_attr($class); ?>" data-lookbook="<?php echo esc_attr($widget_id.'-'.$pin->id.$key); ?>">
													<div class="content-product">
														<div class="mobile-lookbook hidden-lg hidden-md hidden-sm">
															<div class="title"><?php echo esc_html('Product','wpbingo'); ?></div>
															<div class="close-lookbook-mobile"><?php echo esc_html('Close','wpbingo'); ?></div>
														</div>
														<div class="item-thumb">
															<a href="<?php echo esc_url($product_url); ?>"><?php echo wp_kses_post($img_block); ?></a>
														</div>
														<div class="content-lookbook-bottom">
															<div class="item-title">
																<a href="<?php echo esc_url($product_url); ?>"><?php echo $product->get_title(); ?></a>
															</div>
															<div class="price">
																<?php echo $product->get_price_html(); ?>
															</div>
														</div>
													</div>
												</div>
											<?php }	
										} ?>
								<?php
							}
						} ?>					
					<?php } ?>
			<?php } ?>
		<?php } ?>
	</div>