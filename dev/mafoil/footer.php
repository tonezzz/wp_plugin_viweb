	</div><!-- #main -->
		<?php 
			global $mafoil_page_id;
			$mafoil_settings = mafoil_global_settings();
			$footer_style = mafoil_get_config('footer_style','');
			$footer_style = (get_post_meta( $mafoil_page_id,'page_footer_style', true )) ? get_post_meta( $mafoil_page_id, 'page_footer_style', true ) : $footer_style ;
			$header_style = mafoil_get_config('header_style', ''); 
			$header_style  = (get_post_meta( $mafoil_page_id, 'page_header_style', true )) ? get_post_meta($mafoil_page_id, 'page_header_style', true ) : $header_style ;
		?>
		<?php /*
			//if(isset($_GET['d'])) { die('<pre>'.print_r(compact('footer_style','header_style'),true)); }
			if($footer_slug = get_post_field( 'post_name', $footer_style )){
				//$footer_slug_lang = $footer_slug.'_'.$_COOKIE['gz_lang'];
				//$site_url = site_url($footer_slug_lang);
				//if($footer_slug_id = url_to_postid( site_url($footer_slug_lang)) ) $footer_style = $footer_slug_id;
				//bwp_footer
				$args = [
					'post_type'      => 'bwp_footer',
					'posts_per_page' => 1,
				//	'post_name__in'  => [$footer_slug_lang],
					'fields'         => 'ids' 
				];
				$q = get_posts( $args );
				if(isset($q[0])) $footer_style=$q[0];
				//if(isset($_GET['d'])) { die('<pre>'.print_r(compact('header_style','footer_style','footer_slug','q','footer_slug_lang','site_url'),true)); }
			}
		*/ ?>
		<?php if($footer_style && (get_post($footer_style)) && in_array( 'elementor/elementor.php', apply_filters('active_plugins', get_option( 'active_plugins' )))){ ?>
			<?php $elementor_instance = Elementor\Plugin::instance(); ?>
			<footer id="bwp-footer" class="bwp-footer <?php echo esc_attr( get_post($footer_style)->post_name ); ?><?php if(!get_theme_mod('header_moble_bottom', true)){ ?>no-padding<?php } ?>">
				<?php echo mafoil_render_footer($footer_style);	?>
			</footer>
		<?php }else{
			mafoil_copyright();
		}?>
	</div><!-- #page -->
	<div class="search-overlay">	
		<div class="container wrapper-search">
			<div class="search-top">
				<h2><?php echo esc_html__('What are you looking for?','mafoil'); ?></h2>
				<div class="close-search"></div>
			</div>
			<?php mafoil_search_form_product(); ?>		
		</div>	
	</div>
	<div class="container-quickview">
		<div class="quickview-overlay"></div>
		<div class="bwp-quick-view"></div>
	</div>
	<?php 
	$back_active = mafoil_get_config('back_active',true);
	if($back_active): ?>
	<div class="back-top"></div>
	<?php endif;?>
	<?php if((isset($mafoil_settings['show-newsletter']) && $mafoil_settings['show-newsletter']) && is_active_sidebar('newsletter-popup-form') && function_exists('mafoil_popup_newsletter')) : ?>
		<?php mafoil_popup_newsletter(); ?>
	<?php endif;  ?>
	<?php 
	$time_nofication = mafoil_get_config('time-nofication',true);
	if($time_nofication): ?>
		<?php mafoil_time_nofication(); ?>
	<?php endif;?>	
	<?php 
	$cart_layout = mafoil_get_config('cart-layout','dropdown');
	if($cart_layout == 'dropdown'): ?>
	<div class="content-cart-popup">
	</div>
	<?php endif;?>
	<div class="remove-mobile-menu"></div>
	<div class="content-mobile-menu hidden-lg hidden-md">
		<div class="content">
			<div class="login-header">
				<a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
					<?php echo esc_html__('Login or Register','mafoil')?>
				</a>
			</div>
		</div>
	</div>
	<?php 
		$come_back_alert = mafoil_get_config('come_back_alert','hide');
		$come_back_text1 = mafoil_get_config('come_back_text1',"Don't forget this...");
		$come_back_text2 = mafoil_get_config('come_back_text2','Come back!');
		if($come_back_alert == "show"): ?>
		<div class="come-back-alert hidden" data-content1="⚡ <?php echo esc_attr($come_back_text1); ?>" data-content2="📢 <?php echo esc_attr($come_back_text2); ?>"></div>
	<?php endif;?>
	<?php wp_footer(); ?>
</body>
</html>
