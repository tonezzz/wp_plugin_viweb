<?php if($settings['list_tab']){ ?>
	<?php 
		$class_col_lg = ($columns == 5) ? '2-4'  : (12/$columns);
		$class_col_md = ($columns1 == 5) ? '2-4'  : (12/$columns1);
		$class_col_sm = ($columns2 == 5) ? '2-4'  : (12/$columns2);
		$class_col_xs = ($columns3 == 5) ? '2-4'  : (12/$columns3);
		$attributes = 'col-xl-'.$class_col_lg .' col-lg-'.$class_col_md .' col-md-'.$class_col_sm .' col-'.$class_col_xs; 
		$j = 0;
	?>
	<div class="bwp-slider <?php echo esc_attr($layout); ?>">
		<?php if($title1) { ?>
			<div class="title-block">
				<h2><?php echo wp_kses($title1,'social'); ?></h2>
			</div>
		<?php } ?>
		<div class="row">
			<?php foreach ($settings['list_tab'] as $item){ ?>
				<div class="item <?php echo esc_attr($attributes); ?>">
					<div class="item-content">
						<div class="content-image<?php if ($image_hover) { ?> elementor-animation-<?php echo esc_attr($image_hover); } ?>">
							<?php if( $item['image'] && $item['image']['url'] ){ ?>
								<a href="<?php echo wp_kses_post($item['buttonlink_slider']); ?>">
									<img class="fade-in lazyload" src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr__('Image Slider','wpbingo'); ?>">
								</a>
							<?php } ?>
						</div>
						<div class="item-info <?php echo esc_html($item['horizontal_align']); ?> <?php echo esc_html($item['vertical_align']); ?> <?php echo esc_html($item['text_align']); ?>">
							<div class="content">
								<?php if( $item['subtitle_slider'] && $item['subtitle_slider'] ){ ?>
									<div class="subtitle-slider"><span><?php echo wp_kses($item['subtitle_slider'],'social'); ?></span></div>
								<?php } ?>
								<?php if( $item['title_slider'] && $item['title_slider'] ){ ?>
									<h2 class="title-slider"><span><?php echo wp_kses($item['title_slider'],'social'); ?></span></h2>
								<?php } ?>
								<?php if( $item['description_slider'] && $item['description_slider' ]){ ?>
									<div class="description-slider"><span><?php echo wp_kses($item['description_slider'],'social'); ?></span></div>
								<?php } ?>
								<?php if( $item['button_slider'] && $item['button_slider'] ){ ?>
									<a class="button-slider" href="<?php echo wp_kses_post($item['buttonlink_slider']); ?>"><span><?php echo wp_kses($item['button_slider'],'social'); ?></span></a>						
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php }?>