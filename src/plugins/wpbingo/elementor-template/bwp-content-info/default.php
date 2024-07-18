<?php $arr = array('br' => array(), 'p' => array(), 'span' => array()); ?>
<div class="bwp-content-info <?php echo esc_attr($layout); ?>">
	<?php if($title1) : ?>
		<div class="content-info">
			<?php if(isset($subtitle) && $subtitle) : ?>
				<div class="subtitle-info">
					<?php echo wp_kses( $subtitle,$arr ); ?>
				</div>
			<?php endif; ?>
			<?php if(isset($title1) && $title1) : ?>
				<h3 class="title-info"><?php echo wp_kses( $title1,$arr ); ?></h3>
			<?php endif; ?>
			<?php if( $desc) : ?>
				<div class="desc-info"><?php echo wp_kses( $desc,$arr ); ?></div>
			<?php endif; ?>
			<?php  if($label): ?>
				<div class="content-btn">
					<a class="button" href="<?php echo esc_url($link);?>"><?php echo ($label); ?></a>		
				</div>		
			<?php endif;?>
		</div>
	<?php endif; ?>
</div><!-- bwp-content-info -->
