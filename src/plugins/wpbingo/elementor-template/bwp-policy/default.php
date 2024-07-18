
<div class="bwp-policy <?php echo esc_attr($layout); ?>">
	<?php  if($image || $icon): ?>
		<div class="<?php if($icon): ?>policy-icon<?php endif;?> <?php if($image): ?>policy-image<?php endif;?>">
			<?php  if($image): ?>
				<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__("Image Policy","wpbingo"); ?>">
			<?php endif;?>
			<?php  if($icon): ?>
				<div class="icon <?php if ($hover_animation) { ?> elementor-animation-<?php echo esc_attr($hover_animation); } ?>">
					<i class="<?php echo esc_html( $icon ); ?>"></i>
				</div>
			<?php endif;?>
		</div>
	<?php endif;?>
	<?php if($title1) : ?>
		<div class="policy-info">
			<?php if(isset($title1) && $title1) : ?>
				<h3 class="title-policy"><?php echo esc_html( $title1 ); ?></h3>
			<?php endif; ?>
			<?php if( $desc) : ?>
				<div class="desc-policy"><?php echo esc_html( $desc ); ?></div>
			<?php endif; ?>
			<?php  if($label): ?>
				<a class="button" href="<?php echo esc_url($link);?>"><?php echo ($label); ?></a>						
			<?php endif;?>
		</div>
	<?php endif; ?>
</div><!-- .bwp-policy -->
