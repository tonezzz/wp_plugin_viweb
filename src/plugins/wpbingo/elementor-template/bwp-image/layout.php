<?php $arr = array('br' => array(), 'p' => array(), 'span' => array()); ?>
<div class="bwp-widget-banner <?php echo esc_html( $layout ); ?><?php if(isset($style_layout) && $style_layout){?> <?php echo esc_html( $style_layout ); ?><?php }?>">
	<?php  if($image): ?>	
	<div class="bg-banner">
		<div class="banner-wrapper banners">
			<div class="bwp-image <?php if ($image_hover) { ?> elementor-animation-<?php echo esc_attr($image_hover); } ?>">
				<?php  if($link): ?>
					<a href="<?php echo esc_url($link);?>"><img class="fade-in lazyload" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__("Banner Image","wpbingo"); ?>"></a>
				<?php endif;?>
			</div>
			<div class="banner-wrapper-infor">
				<div class="info">
					<div class="content">
						<?php if( $subtitle) : ?>
							<div class="bwp-image-subtitle">
								<?php if(isset($subtitle) && $subtitle){?>						
									<?php echo wp_kses( $subtitle,$arr); ?>							
								<?php }?>
							</div>	
						<?php endif;?>
						<?php if( $title1 ) : ?>
							<h3 class="title-banner"><?php echo wp_kses( $title1,$arr); ?></h3>
						<?php endif; ?>
						<?php if( $description) : ?>
						<div class="bwp-image-description">
							<?php if(isset($description) && $description){?>						
								<?php echo wp_kses( $description,$arr); ?>						
							<?php }?>
						</div>	
						<?php endif;?>
						<?php  if($label): ?>
							<a class="button" href="<?php echo esc_url($link);?>"><?php echo ($label); ?></a>						
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>
