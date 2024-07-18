<?php
	$class_col_lg = ($columns == 5) ? '2-4'  : (12/$columns);
	$class_col_md = ($columns1 == 5) ? '2-4'  : (12/$columns1);
	$class_col_sm = ($columns2 == 5) ? '2-4'  : (12/$columns2);
	$class_col_xs = ($columns3 == 5) ? '2-4'  : (12/$columns3);
	$attributes = 'col-xl-'.$class_col_lg .' col-lg-'.$class_col_md .' col-md-'.$class_col_sm .' col-'.$class_col_xs;	
?>
<?php if($query->have_posts()):?>
<div class="bwp-recent-post <?php echo esc_attr($layout); ?>">
 <div class="block">
 	<?php if(isset($title1) && $title1) { ?>
	<div class="title-block">
		<h2><?php echo esc_html($title1); ?></h2>
		<?php if($description) { ?>
		<div class="page-description"><?php echo esc_html($description); ?></div>
		<?php } ?>  
	</div>
	<?php } ?>
	<div class="block_content row">
		<?php while($query->have_posts()):$query->the_post(); ?>
			<div class="item <?php echo esc_attr($attributes) ?>">
				<div  <?php post_class( 'post-grid' ); ?>>	
					<div class="post-inner style">
						<div class="post-image">
							<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
							<?php
								if( has_post_thumbnail() ) :
									the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
								else :
									echo '<img src="' . esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ) . '" alt="' . get_the_title() . '">';
								endif;
							?>
							</a>
						</div>
						<div class="post-content">
							<div class="content-post">
								<?php if( bwp_category_post()){ ?>
									<div class="post-categories">
										<a href="<?php echo esc_url(bwp_category_post()->cat_link);?>"><?php echo esc_html(bwp_category_post()->name); ?></a>
									</div>
								<?php } ?>
								<h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
								<div class="entry-by entry-meta">
									<?php if (mafoil_get_config('archives-author')) { ?>
										<div class="entry-author">
											<span class="entry-meta-link"><i class="wpb-icon-user"></i><?php echo esc_html__("By : ","wpbingo"); ?><?php echo the_author_posts_link(); ?></span>
										</div>
									<?php } ?>
									<div class="comments-link">
										<i class="wpb-icon-chat"></i>
										<a href="<?php echo esc_attr('#respond'); ?>" >
											<?php 
											$comment_count =  wp_count_comments(get_the_ID())->total_comments;
											if($comment_count > 0) {
											?>
												<?php if($comment_count == 1){?>
													<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comment', 'wpbingo').'</span>'; ?>
												<?php }else{ ?>
													<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comments', 'wpbingo').'</span>'; ?>
												<?php } ?>
											<?php }else{ ?>
												<?php echo esc_attr($comment_count) .'<span>'. esc_html__(' Comments', 'wpbingo').'</span>'; ?>
											<?php } ?>
										</a>
									</div>
								</div>
								<?php echo wpbingo_get_excerpt( $length, true ); ?>
							</div>
						</div>
					</div>
				</div><!-- #post-## -->
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
 </div>
</div>
<?php endif;?>