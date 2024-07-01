<?php
	$j = 0;
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
	<div class="block_content">
		<div id="<?php echo esc_attr($tag_id); ?>" class="slick-carousel" data-slidestoscroll="true" data-dots="<?php echo esc_attr($show_pag);?>" data-nav="<?php echo esc_attr($show_nav);?>" data-columns4="<?php echo $columns4; ?>" data-columns3="<?php echo $columns3; ?>" data-columns2="<?php echo $columns2; ?>" data-columns1="<?php echo $columns1; ?>" data-columns="<?php echo $columns; ?>">
			<?php while($query->have_posts()):$query->the_post(); ?>
			<!-- Wrapper for slides -->
			<?php if( ( $j % $item_row ) == 0 && $item_row !=1) { ?>
				<div class="item">
				<?php } ?>
					<div  <?php post_class( 'post-grid' ); ?>>	
						<div class="post-inner">
							<div class="post-image">
								<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
								<?php
									if( has_post_thumbnail() ) :
										the_post_thumbnail( 'post-thumbnail',['class' => 'fade-in lazyload'],array( 'alt' => get_the_title()));
									else :
										echo '<img class="fade-in lazyload" src="' . esc_url( get_template_directory_uri() . '/images/placeholder.jpg' ) . '" alt="' . get_the_title() . '">';
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
									<div class="btn-read-more"><a class="read-more" href="<?php the_permalink() ?>"><?php echo esc_html__("Read More","wpbingo") ?></a></div>
								</div>
							</div>
						</div>
					</div><!-- #post-## -->
				<?php if( ($j % $item_row == 1 || $j == $post_count) && $item_row !=1  ){?> 
				</div>
				<?php  } $j++;?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
 </div>
</div>
<?php endif;?>