<?php 
	$mafoil_settings = mafoil_global_settings();
	$cart_layout = mafoil_get_config('cart-layout','dropdown');
	$cart_style = mafoil_get_config('cart-style','light');
	$show_minicart = (isset($mafoil_settings['show-minicart']) && $mafoil_settings['show-minicart']) ? ($mafoil_settings['show-minicart']) : false;
	$enable_sticky_header = ( isset($mafoil_settings['enable-sticky-header']) && $mafoil_settings['enable-sticky-header'] ) ? ($mafoil_settings['enable-sticky-header']) : false;
	$show_searchform = (isset($mafoil_settings['show-searchform']) && $mafoil_settings['show-searchform']) ? ($mafoil_settings['show-searchform']) : false;
	$show_wishlist = (isset($mafoil_settings['show-wishlist']) && $mafoil_settings['show-wishlist']) ? ($mafoil_settings['show-wishlist']) : false;
	$sticky_header = (isset($mafoil_settings['enable-sticky-header']) && $mafoil_settings['enable-sticky-header']) ? ($mafoil_settings['enable-sticky-header']) : false;
?>
<h1 class="bwp-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<header id='bwp-header' class="bwp-header header-v8 menu-left">
	<?php if($sticky_header) { mafoil_menu_stcky(); } ?>
	<?php mafoil_campbar(); ?>
	<?php if(get_theme_mod('top_bar_8', true)) { ?>
		<div id="bwp-topbar" class="topbar-v2<?php if(!get_theme_mod('topbar_mobile','')) { ?> hidden-sm hidden-xs <?php } ?>">
			<div class="topbar-inner">
				<div class="container">
					<div class="topbar-container">
						<?php if(get_theme_mod('content_left_top_bar_8', 'Free shipping on all orders over $50')) { ?>
							<div class="topbar-left">
								<?php echo get_theme_mod('content_left_top_bar_8', 'Free shipping on all orders over $50'); ?>
							</div>
						<?php } ?>
						<?php if(get_theme_mod('content_center_top_bar_8', '')) { ?>
							<div class="topbar-center">
								<?php echo get_theme_mod('content_center_top_bar_8', ''); ?>
							</div>
						<?php } ?>
						<?php if(get_theme_mod('content_right_top_bar_8', '<div class="address hidden-xs"><a target="_blank" href="https://www.google.com/maps/place/lastminute.com+London+Eye/@51.503297,-0.119554,10z/data=!4m5!3m4!1s0x0:0x4291f3172409ea92!8m2!3d51.5032973!4d-0.1195537?hl=en">07 Piney Creek Rd, Scottsburg, VA, USA</a></div><div class="email"><a href="mailto:support@mafoil.com">support@mafoil.com</a></div>')) { ?>
							<div class="topbar-right">
								<?php echo get_theme_mod('content_right_top_bar_8', '<div class="address hidden-xs"><a target="_blank" href="https://www.google.com/maps/place/lastminute.com+London+Eye/@51.503297,-0.119554,10z/data=!4m5!3m4!1s0x0:0x4291f3172409ea92!8m2!3d51.5032973!4d-0.1195537?hl=en">07 Piney Creek Rd, Scottsburg, VA, USA</a></div><div class="email"><a href="mailto:support@mafoil.com">support@mafoil.com</a></div>'); ?>
							</div>
						<?php } ?>
						<?php if(get_theme_mod('social_8', '') && shortcode_exists("social_link")) { ?>
							<div class="social-link_topbar">
								<?php echo do_shortcode ("[social_link]") ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php mafoil_menu_mobile(); ?>
	<div class="header-desktop">
		<?php if(($show_minicart || $show_wishlist || $show_searchform || is_active_sidebar('top-link')) && class_exists( 'WooCommerce' ) ){ ?>
		<div class='header-wrapper' data-sticky_header="<?php echo esc_attr($mafoil_settings['enable-sticky-header']); ?>">
			<div class="container">
				<div class="header-container">
					<div class="header-left">
						<div class="wpbingo-menu-mobile header-menu">
							<div class="header-menu-bg">
								<?php mafoil_top_menu(); ?>
							</div>
						</div>
					</div>
					<div class="header-center text-center">
						<?php mafoil_header_logo(); ?>
					</div>
					<div class="header-right">
						<div class="header-page-link">
							<!-- Begin Search -->
							<?php if($mafoil_settings['show-searchform']){ ?>
							<div class="search-box search-dropdown">
								<div class="search-toggle"><i class="icon-search"></i></div>
							</div>
							<?php } ?>
							<!-- End Search -->
							<div class="login-header">
								<?php if (is_user_logged_in()) { ?>
									<?php if(is_active_sidebar('top-link')){ ?>
										<div class="block-top-link">
											<?php dynamic_sidebar( 'top-link' ); ?>
										</div>
									<?php } ?>
								<?php }else{ ?>
									<a class="active-login" href="#" ><i class="icon-user"></i></a>
									<?php mafoil_login_form(); ?>
								<?php } ?>
							</div>	
							<?php if($show_wishlist && class_exists( 'WPCleverWoosw' )){ ?>
							<div class="wishlist-box">
								<a href="<?php echo WPcleverWoosw::get_url(); ?>"><i class="icon-heart"></i></a>
								<span class="count-wishlist"><?php echo WPcleverWoosw::get_count(); ?></span>
							</div>
							<?php } ?>
							<?php if($show_minicart && class_exists( 'WooCommerce' )){ ?>
								<div class="remove-cart-shadow"></div>
								<div class="mafoil-topcart mafoil-topcart-desktop <?php echo esc_attr($cart_layout); ?> <?php echo esc_attr($cart_style); ?>">
									<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- End header-wrapper -->
		<?php }else{ ?>
			<div class="header-normal">
				<div class='header-wrapper' data-sticky_header="<?php echo esc_attr($mafoil_settings['enable-sticky-header']); ?>">
					<div class="container">
						<div class="row">
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 header-left">
								<?php mafoil_header_logo(); ?>
							</div>
							<div class="col-xl-9 col-lg-9 col-md-6 col-sm-6 col-6 header-main">
								<div class="header-menu-bg">
									<?php mafoil_top_menu(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</header><!-- End #bwp-header -->