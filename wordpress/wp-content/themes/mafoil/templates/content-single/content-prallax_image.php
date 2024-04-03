<?php
	$mafoil_settings = mafoil_global_settings();
	$post_single_layout = mafoil_post_sidebar();
	$mafoil_settings = mafoil_global_settings();
	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
 ?>
<div class="content-single-prallax_image">
	<div class="content-image-single">
		<?php if ( get_the_post_thumbnail() ){ ?>
			<div class="entry-thumb single-thumb" style="background-image:url('<?php echo esc_url($featured_img_url); ?>');">	
			</div>
		<?php }; ?>
		<div class="content-info">
			<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && mafoil_categorized_blog() ) : ?>
				<div class="cat-links"><?php echo get_the_category_list(''); ?></div>
			<?php endif; ?>	
			<?php
				$show_post_title = mafoil_get_config('post-title',true);
				if ($show_post_title){
					if ( is_single() ){
						the_title( '<h3 class="entry-title">', '</h3>' );
					}else {
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				}
			?>
			<div class="entry-meta-head">
				<?php if (mafoil_get_config('archives-author')) { ?>
					<div class="entry-author">
						<span class="entry-meta-link"><?php echo esc_html__("By ",'mafoil') ?><?php echo the_author_posts_link(); ?> <?php echo esc_html__("on ",'mafoil') ?><?php mafoil_posted_on_2(); ?></span>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="single-post-content ">
			<div class="post-single <?php echo esc_attr($post_single_layout); ?>">
				<article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
					<?php if ( is_search() ) : ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php else : ?>
					<div class="post-content">
						<div class="post-excerpt clearfix">
							<?php
								/* translators: %s: Name of current post */
								the_content( sprintf(
									the_title( '<span class="screen-reader-text">', '</span>', false )
								) );
								wp_link_pages( array(
									'before'      => '<div class="page-links clearfix"><span class="page-links-title">' . esc_html__( 'Pages:', 'mafoil' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
							?>
						</div>
						<div class="clearfix"></div>
					</div><!-- .entry-content -->
					<div class="post-content-entry">
						<!-- Tag -->
						<?php
						if ( 'post' === get_post_type() ) {
							$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'mafoil' ) );
							if ( $tags_list ) {
								printf( '<div class="tags-links"> %1$s</div>', $tags_list ); // WPCS: XSS OK.
							}
						}		
						?>
					</div>
					<div class="clearfix"></div>
					<?php endif; ?>
				</article><!-- #post-## -->
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</div>
		</div>
	</div>
	<?php mafoil_post_related(); ?>
</div>