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
<header id='bwp-header' class="bwp-header header-v5">
	<?php if($sticky_header) { mafoil_menu_stcky(); } ?>
	<?php mafoil_campbar(); ?>
	<?php if(get_theme_mod('top_bar_5', '')) { ?>
		<div id="bwp-topbar" class="topbar-v1<?php if(!get_theme_mod('topbar_mobile','')) { ?> hidden-sm hidden-xs <?php } ?>">
			<div class="topbar-inner">
				<div class="container">
					<div class="topbar-container">
						<?php if(get_theme_mod('content_left_top_bar_5', '')) { ?>
							<div class="topbar-left">
								<?php echo get_theme_mod('content_left_top_bar_5', ''); ?>
							</div>
						<?php } ?>
						<?php if(get_theme_mod('content_center_top_bar_5', '')) { ?>
							<div class="topbar-center">
								<?php echo get_theme_mod('content_center_top_bar_5', ''); ?>
							</div>
						<?php } ?>
						<?php if(get_theme_mod('content_right_top_bar_5', '')) { ?>
							<div class="topbar-right">
								<?php echo get_theme_mod('content_right_top_bar_5', ''); ?>
							</div>
						<?php } ?>
						<?php if(get_theme_mod('social_5', '') && shortcode_exists("social_link")) { ?>
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
						<div class="menu-sidebar">
							<div class="open-menu">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.08 21.98">
									<line x1="0.54" y1="0.56" x2="30.54" y2="0.56"></line>
									<line x1="0.54" y1="21.43" x2="30.54" y2="21.43"></line>
									<line x1="0.54" y1="11" x2="30.54" y2="11"></line>
								</svg>
							</div>
							<div class="overlay-sidebar"></div>
							<div class="header-main">
								<div class="close-sidebar">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.6 16.6">
										<line x1="0.8" y1="0.8" x2="15.8" y2="15.8"></line>
										<line x1="0.8" y1="15.8" x2="15.8" y2="0.8"></line>
									</svg>
								</div>
								<div class="wpbingo-menu-mobile wpbingo-menu-sidebar">
									<?php mafoil_top_menu(); ?>
								</div>
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