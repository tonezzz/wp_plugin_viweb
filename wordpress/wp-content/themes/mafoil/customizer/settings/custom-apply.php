<?php
function mafoil_customize_css() {  ?>
	<?php if(get_theme_mod('font_family_base', '')) { ?>
	<link href="https://fonts.googleapis.com/css2?family=<?php echo get_theme_mod('font_family_base', '') ?>:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<?php } ?>
	<?php if(get_theme_mod('font_family_heading', '')) { ?>
	<link href="https://fonts.googleapis.com/css2?family=<?php echo get_theme_mod('font_family_heading', '') ?>:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<?php } ?>
    <style type="text/css">
		<?php if( get_theme_mod('gray_dark', '') || get_theme_mod('theme_color', '') || get_theme_mod('text_color', '') || get_theme_mod('button_color', '') || get_theme_mod('border_color', '') || get_theme_mod('font_family_base', '') || get_theme_mod('font_family_heading', '') || get_theme_mod('font_size_heading', '') || get_theme_mod('font_size_body', '') ) { ?>
			/* $opacity-to-hex: (
				0: '00',
				0.05: '0C',
				0.1: '19',
				0.15: '26',
				0.2: '33',
				0.25: '3F',
				0.3: '4C',
				0.35: '59',
				0.4: '66',
				0.45: '72',
				0.5: '7F',
				0.55: '8C',
				0.6: '99',
				0.65: 'A5',
				0.7: 'B2',
				0.75: 'BF',
				0.8: 'CC',
				0.85: 'D8',
				0.9: 'E5',
				0.95: 'F2',
				1: 'FF'
			); */
			:root {
				<?php if(get_theme_mod('gray_dark', '')) { ?>
					--gray-dark:<?php echo get_theme_mod('gray_dark', ''); ?>;
					--gray-dark-10:<?php echo get_theme_mod('gray_dark', ''); ?>19;
					--gray-dark-25:<?php echo get_theme_mod('gray_dark', ''); ?>3f;
					--gray-dark-50:<?php echo get_theme_mod('gray_dark', ''); ?>7f;
					--gray-dark-75:<?php echo get_theme_mod('gray_dark', ''); ?>bf;
				<?php } ?>
				<?php if(get_theme_mod('theme_color', '')) { ?>
					--theme-color:<?php echo get_theme_mod('theme_color', ''); ?>;
					--theme-color-25:<?php echo get_theme_mod('theme_color', ''); ?>3f;
					--theme-color-50:<?php echo get_theme_mod('theme_color', ''); ?>7f;
					--theme-color-75:<?php echo get_theme_mod('theme_color', ''); ?>bf;
				<?php } ?>
				<?php if(get_theme_mod('text_color', '')) { ?>
					--text-color:<?php echo get_theme_mod('text_color', ''); ?>;
					--text-color-25:<?php echo get_theme_mod('text_color', ''); ?>3f;
					--text-color-50:<?php echo get_theme_mod('text_color', ''); ?>7f;
					--text-color-75:<?php echo get_theme_mod('text_color', ''); ?>bf;
				<?php } ?>
				<?php if(get_theme_mod('button_color', '')) { ?>
					--button-color:<?php echo get_theme_mod('button_color', ''); ?>;
					--button-color-25:<?php echo get_theme_mod('button_color', ''); ?>3f;
					--button-color-50:<?php echo get_theme_mod('button_color', ''); ?>7f;
					--button-color-75:<?php echo get_theme_mod('button_color', ''); ?>bf;
				<?php } ?>
				<?php if(get_theme_mod('border_color', '')) { ?>
					--border-color:<?php echo get_theme_mod('border_color', ''); ?>;
					--border-color-25:<?php echo get_theme_mod('border_color', ''); ?>3f;
					--border-color-50:<?php echo get_theme_mod('border_color', ''); ?>7f;
					--border-color-75:<?php echo get_theme_mod('border_color', ''); ?>bf;
				<?php } ?>
				<?php if(get_theme_mod('font_family_base', '')) { ?>
					--font-family-base:<?php echo get_theme_mod('font_family_base', ''); ?>;
				<?php } ?>
				<?php if(get_theme_mod('font_family_heading', '')) { ?>
					--font-family-heading:<?php echo get_theme_mod('font_family_heading', ''); ?>;
				<?php } ?>
				<?php if(get_theme_mod('font_size_body', '')) { ?>
					--font-size-body:<?php echo get_theme_mod('font_size_body', ''); ?>px;
				<?php } ?>
				<?php if(get_theme_mod('font_size_heading', '')) { ?>
					--font-size-heading:<?php echo get_theme_mod('font_size_heading', ''); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if(get_theme_mod('theme_color', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { background: <?php echo get_theme_mod('theme_color', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('background_top_bar_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_1', '')) { ?>
			.bwp-header.header-v1 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_1', '')) { ?>
			.bwp-header.header-v1 .header-wrapper { background: <?php echo get_theme_mod('header_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-sticky { background: <?php echo get_theme_mod('header_color_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('content_color_1', '')) { ?>
			.bwp-header.header-v1 .header-wrapper  { color: <?php echo get_theme_mod('content_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-wrapper a { color: <?php echo get_theme_mod('content_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-sticky  { color: <?php echo get_theme_mod('content_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-sticky a { color: <?php echo get_theme_mod('content_color_1', ''); ?>; }
			.bwp-header.header-v1 .phone i { color: <?php echo get_theme_mod('content_color_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_1', '')) { ?>
			.bwp-header.header-v1 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_1', ''); ?>; }
			.bwp-header.header-v1 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_1', '')) { ?>
			.bwp-header.header-v1 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_1', '')) { ?>
			.bwp-header.header-v1 a:hover { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
			.bwp-header.header-v1 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_1', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_1', '')) { ?>
			.bwp-header.header-v1 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_1', '')) { ?>
			.bwp-header.header-v1 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_1', ''); ?>px; }
			.bwp-header.header-v1 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_1', '')) { ?>
			.bwp-header.header-v1 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_1', ''); ?>px; }
			.bwp-header.header-v1 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_1', '')) { ?>
			.bwp-header.header-v1 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_1', ''); ?>px; }
			.bwp-header.header-v1 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_1', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_1', '')) { ?>
			.bwp-header.header-v1 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_1', ''); ?>px; }
			.bwp-header.header-v1 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_1', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 2 ----------*/
		<?php if(get_theme_mod('background_top_bar_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_2', '')) { ?>
			.bwp-header.header-v2 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_2', '')) { ?>
			.bwp-header.header-v2 .header-wrapper { background: <?php echo get_theme_mod('header_color_2', ''); ?>; }
			.bwp-header.header-v2 .header-sticky { background: <?php echo get_theme_mod('header_color_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_2', '')) { ?>
			.bwp-header.header-v2 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_2', ''); ?>; }
			.bwp-header.header-v2 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_2', ''); ?>; }
			.bwp-header.header-v2 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_2', ''); ?>; }
			.bwp-header.header-v2 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_2', '')) { ?>
			.bwp-header.header-v2 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_2', '')) { ?>
			.bwp-header.header-v2 a:hover { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_2', ''); ?>; }
			.bwp-header.header-v2 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
			.bwp-header.header-v2 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_2', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_2', '')) { ?>
			.bwp-header.header-v2 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_2', '')) { ?>
			.bwp-header.header-v2 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_2', ''); ?>px; }
			.bwp-header.header-v2 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_2', '')) { ?>
			.bwp-header.header-v2 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_2', ''); ?>px; }
			.bwp-header.header-v2 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_2', '')) { ?>
			.bwp-header.header-v2 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_2', ''); ?>px; }
			.bwp-header.header-v2 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_2', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_2', '')) { ?>
			.bwp-header.header-v2 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_2', ''); ?>px; }
			.bwp-header.header-v2 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_2', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 3 ----------*/
		<?php if(get_theme_mod('background_top_bar_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_3', '')) { ?>
			.bwp-header.header-v3 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_3', '')) { ?>
			.bwp-header.header-v3 .header-wrapper { background: <?php echo get_theme_mod('header_color_3', ''); ?>; }
			.bwp-header.header-v3 .header-sticky { background: <?php echo get_theme_mod('header_color_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_3', '')) { ?>
			.bwp-header.header-v3 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_3', ''); ?>; }
			.bwp-header.header-v3 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_3', ''); ?>; }
			.bwp-header.header-v3 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_3', ''); ?>; }
			.bwp-header.header-v3 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_3', '')) { ?>
			.bwp-header.header-v3 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_3', '')) { ?>
			.bwp-header.header-v3 a:hover { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_3', ''); ?>; }
			.bwp-header.header-v3 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
			.bwp-header.header-v3 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_3', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_3', '')) { ?>
			.bwp-header.header-v3 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_3', '')) { ?>
			.bwp-header.header-v3 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_3', ''); ?>px; }
			.bwp-header.header-v3 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_3', '')) { ?>
			.bwp-header.header-v3 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_3', ''); ?>px; }
			.bwp-header.header-v3 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_3', '')) { ?>
			.bwp-header.header-v3 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_3', ''); ?>px; }
			.bwp-header.header-v3 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_3', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_3', '')) { ?>
			.bwp-header.header-v3 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_3', ''); ?>px; }
			.bwp-header.header-v3 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_3', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 4 ----------*/
		<?php if(get_theme_mod('background_top_bar_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_4', '')) { ?>
			.bwp-header.header-v4 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_4', '')) { ?>
			.bwp-header.header-v4 .header-wrapper { background: <?php echo get_theme_mod('header_color_4', ''); ?>; }
			.bwp-header.header-v4 .header-sticky { background: <?php echo get_theme_mod('header_color_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_4', '')) { ?>
			.bwp-header.header-v4 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_4', ''); ?>; }
			.bwp-header.header-v4 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_4', ''); ?>; }
			.bwp-header.header-v4 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_4', ''); ?>; }
			.bwp-header.header-v4 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_4', '')) { ?>
			.bwp-header.header-v4 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_4', '')) { ?>
			.bwp-header.header-v4 a:hover { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_4', ''); ?>; }
			.bwp-header.header-v4 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
			.bwp-header.header-v4 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_4', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_4', '')) { ?>
			.bwp-header.header-v4 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_4', '')) { ?>
			.bwp-header.header-v4 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_4', ''); ?>px; }
			.bwp-header.header-v4 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_4', '')) { ?>
			.bwp-header.header-v4 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_4', ''); ?>px; }
			.bwp-header.header-v4 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_4', '')) { ?>
			.bwp-header.header-v4 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_4', ''); ?>px; }
			.bwp-header.header-v4 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_4', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_4', '')) { ?>
			.bwp-header.header-v4 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_4', ''); ?>px; }
			.bwp-header.header-v4 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_4', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 5 ----------*/
		<?php if(get_theme_mod('background_top_bar_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_5', '')) { ?>
			.bwp-header.header-v5 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_5', '')) { ?>
			.bwp-header.header-v5 .header-wrapper { background: <?php echo get_theme_mod('header_color_5', ''); ?>; }
			.bwp-header.header-v5 .header-sticky { background: <?php echo get_theme_mod('header_color_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_5', '')) { ?>
			.bwp-header.header-v5 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
			.bwp-header.header-v5 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
			.bwp-header.header-v5 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
			.bwp-header.header-v5 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
			.bwp-header.header-v5 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
			.bwp-header.header-v5 .menu-sidebar .open-menu { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_5', '')) { ?>
			.bwp-header.header-v5 a:hover { color: <?php echo get_theme_mod('hover_color_5', ''); ?>; }
			.bwp-header.header-v5 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_5', ''); ?>; }
			.bwp-header.header-v5 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_5', ''); ?>; }
			.bwp-header.header-v5 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_5', ''); ?>; }
			.bwp-header.header-v5 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_5', ''); ?>; }
			.bwp-header.header-v5 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_5', ''); ?>; }
			.bwp-header.header-v5 .menu-sidebar .open-menu:hover { color: <?php echo get_theme_mod('hover_color_5', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_5', '')) { ?>
			.bwp-header.header-v5 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_5', '')) { ?>
			.bwp-header.header-v5 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_5', ''); ?>px; }
			.bwp-header.header-v5 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_5', '')) { ?>
			.bwp-header.header-v5 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_5', ''); ?>px; }
			.bwp-header.header-v5 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_5', '')) { ?>
			.bwp-header.header-v5 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_5', ''); ?>px; }
			.bwp-header.header-v5 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_5', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_5', '')) { ?>
			.bwp-header.header-v5 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_5', ''); ?>px; }
			.bwp-header.header-v5 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_5', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 6 ----------*/
		<?php if(get_theme_mod('background_top_bar_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_6', '')) { ?>
			.bwp-header.header-v6 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_6', '')) { ?>
			.bwp-header.header-v6 .header-wrapper { background: <?php echo get_theme_mod('header_color_6', ''); ?>; }
			.bwp-header.header-v6 .header-sticky { background: <?php echo get_theme_mod('header_color_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_6', '')) { ?>
			.bwp-header.header-v6 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_6', ''); ?>; }
			.bwp-header.header-v6 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_6', ''); ?>; }
			.bwp-header.header-v6 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_6', ''); ?>; }
			.bwp-header.header-v6 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_6', '')) { ?>
			.bwp-header.header-v6 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_6', '')) { ?>
			.bwp-header.header-v6 a:hover { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_6', ''); ?>; }
			.bwp-header.header-v6 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
			.bwp-header.header-v6 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_6', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_6', '')) { ?>
			.bwp-header.header-v6 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_6', '')) { ?>
			.bwp-header.header-v6 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_6', ''); ?>px; }
			.bwp-header.header-v6 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_6', '')) { ?>
			.bwp-header.header-v6 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_6', ''); ?>px; }
			.bwp-header.header-v6 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_6', '')) { ?>
			.bwp-header.header-v6 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_6', ''); ?>px; }
			.bwp-header.header-v6 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_6', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_6', '')) { ?>
			.bwp-header.header-v6 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_6', ''); ?>px; }
			.bwp-header.header-v6 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_6', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 7 ----------*/
		<?php if(get_theme_mod('background_top_bar_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_7', '')) { ?>
			.bwp-header.header-v7 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_7', '')) { ?>
			.bwp-header.header-v7 .header-wrapper { background: <?php echo get_theme_mod('header_color_7', ''); ?>; }
			.bwp-header.header-v7 .header-sticky { background: <?php echo get_theme_mod('header_color_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_7', '')) { ?>
			.bwp-header.header-v7 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_7', ''); ?>; }
			.bwp-header.header-v7 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_7', ''); ?>; }
			.bwp-header.header-v7 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_7', ''); ?>; }
			.bwp-header.header-v7 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_7', '')) { ?>
			.bwp-header.header-v7 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_7', '')) { ?>
			.bwp-header.header-v7 a:hover { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_7', ''); ?>; }
			.bwp-header.header-v7 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
			.bwp-header.header-v7 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_7', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_7', '')) { ?>
			.bwp-header.header-v7 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_7', '')) { ?>
			.bwp-header.header-v7 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_7', ''); ?>px; }
			.bwp-header.header-v7 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_7', '')) { ?>
			.bwp-header.header-v7 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_7', ''); ?>px; }
			.bwp-header.header-v7 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_7', '')) { ?>
			.bwp-header.header-v7 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_7', ''); ?>px; }
			.bwp-header.header-v7 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_7', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_7', '')) { ?>
			.bwp-header.header-v7 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_7', ''); ?>px; }
			.bwp-header.header-v7 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_7', ''); ?>px; }
		<?php } ?>
		
		/*------------ header 8 ----------*/
		<?php if(get_theme_mod('background_top_bar_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar { background: <?php echo get_theme_mod('background_top_bar_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_top_bar_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar { color: <?php echo get_theme_mod('color_top_bar_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_link_top_bar_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar a { color: <?php echo get_theme_mod('color_link_top_bar_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_hover_top_bar_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar a:hover { color: <?php echo get_theme_mod('color_hover_top_bar_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_top_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar { padding-top: <?php echo get_theme_mod('padding_topbar_top_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_right_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar { padding-right: <?php echo get_theme_mod('padding_topbar_right_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_bottom_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar { padding-bottom: <?php echo get_theme_mod('padding_topbar_bottom_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_topbar_left_8', '')) { ?>
			.bwp-header.header-v8 #bwp-topbar { padding-left: <?php echo get_theme_mod('padding_topbar_left_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('header_color_8', '')) { ?>
			.bwp-header.header-v8 .header-wrapper { background: <?php echo get_theme_mod('header_color_8', ''); ?>; }
			.bwp-header.header-v8 .header-sticky { background: <?php echo get_theme_mod('header_color_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('icon_color_8', '')) { ?>
			.bwp-header.header-v8 .header-page-link .search-box .search-toggle  { color: <?php echo get_theme_mod('icon_color_8', ''); ?>; }
			.bwp-header.header-v8 .block-top-link>.widget .widget-custom-menu .widget-title { color: <?php echo get_theme_mod('icon_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-header .header-page-link .login-header>a { color: <?php echo get_theme_mod('icon_color_8', ''); ?>; }
			.bwp-header.header-v8 .header-page-link .wishlist-box a { color: <?php echo get_theme_mod('icon_color_8', ''); ?>; }
			.bwp-header.header-v8 .header-page-link .mini-cart .cart-icon { color: <?php echo get_theme_mod('icon_color_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('menu_color_8', '')) { ?>
			.bwp-header.header-v8 .bwp-navigation ul>li.level-0>a { color: <?php echo get_theme_mod('menu_color_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('hover_color_8', '')) { ?>
			.bwp-header.header-v8 a:hover { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .header-page-link .search-box .search-toggle:hover  { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .block-top-link>.widget .widget-custom-menu .widget-title:hover { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-header .header-page-link .login-header>a:hover { color: <?php echo get_theme_mod('icon_color_8', ''); ?>; }
			.bwp-header.header-v8 .header-page-link .wishlist-box a:hover { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .header-page-link .mini-cart .cart-icon:hover { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul>li.level-0>a:hover { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul>li.level-0.current-menu-ancestor>a>span:before { background: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul>li.level-0.current-menu-item>a>span:before { background: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul>li.level-0.current_page_item>a>span:before { background: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul>li.level-0:hover>a>span:before { background: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul > li.level-0 > a > span:before { background: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul > li.level-0.current_page_item > a { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul > li.level-0:hover > a { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul > li.level-0.current-menu-item > a { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
			.bwp-header.header-v8 .bwp-navigation ul > li.level-0.current-menu-ancestor > a { color: <?php echo get_theme_mod('hover_color_8', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('width_logo_8', '')) { ?>
			.bwp-header.header-v8 .wpbingoLogo img { max-width: <?php echo get_theme_mod('width_logo_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_top_8', '')) { ?>
			.bwp-header.header-v8 .header-wrapper { padding-top: <?php echo get_theme_mod('padding_top_8', ''); ?>px; }
			.bwp-header.header-v8 .header-sticky { padding-top: <?php echo get_theme_mod('padding_top_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_right_8', '')) { ?>
			.bwp-header.header-v8 .header-wrapper { padding-right: <?php echo get_theme_mod('padding_right_8', ''); ?>px; }
			.bwp-header.header-v8 .header-sticky { padding-right: <?php echo get_theme_mod('padding_right_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_bottom_8', '')) { ?>
			.bwp-header.header-v8 .header-wrapper { padding-bottom: <?php echo get_theme_mod('padding_bottom_8', ''); ?>px; }
			.bwp-header.header-v8 .header-sticky { padding-bottom: <?php echo get_theme_mod('padding_bottom_8', ''); ?>px; }
		<?php } ?>
		<?php if(get_theme_mod('padding_left_8', '')) { ?>
			.bwp-header.header-v8 .header-wrapper { padding-left: <?php echo get_theme_mod('padding_left_8', ''); ?>px; }
			.bwp-header.header-v8 .header-sticky { padding-left: <?php echo get_theme_mod('padding_left_8', ''); ?>px; }
		<?php } ?>
		
		/*------------ Menu mobile ----------*/
		<?php if(get_theme_mod('background_menu_top', '')) { ?>
			.bwp-header .header-mobile { background: <?php echo get_theme_mod('background_menu_top', ''); ?>; }
			.bwp-header.sticky .header-mobile > .container { background: <?php echo get_theme_mod('background_menu_top', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_menu_top', '')) { ?>
			.bwp-header .header-mobile .navbar-toggle { color: <?php echo get_theme_mod('color_menu_top', ''); ?>; }
			.bwp-header .header-mobile .mini-cart .cart-icon { color: <?php echo get_theme_mod('color_menu_top', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('background_menu_bottom', '')) { ?>
			.bwp-header .header-mobile .header-mobile-fixed { background: <?php echo get_theme_mod('background_menu_bottom', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_menu_bottom', '')) { ?>
			.bwp-header .header-mobile .header-mobile-fixed a{ color: <?php echo get_theme_mod('color_menu_bottom', ''); ?>; }
			.bwp-header .header-mobile .header-mobile-fixed .search-toggle{ color: <?php echo get_theme_mod('color_menu_bottom', ''); ?>; }
			.bwp-header .header-mobile .header-mobile-fixed .wishlist-box a{ color: <?php echo get_theme_mod('color_menu_bottom', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('background_menu_mobile', '')) { ?>
			.content-mobile-menu .bwp-canvas-navigation .mm-menu { background: <?php echo get_theme_mod('background_menu_mobile', ''); ?>; }
			.content-mobile-menu { background: <?php echo get_theme_mod('background_menu_mobile', ''); ?>; }
			.content-mobile-menu .bwp-canvas-navigation .mm-menu div { background: <?php echo get_theme_mod('background_menu_mobile', ''); ?>; }
			.content-mobile-menu .content { background: <?php echo get_theme_mod('background_menu_mobile', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_menu_mobile', '')) { ?>
			.content-mobile-menu .bwp-canvas-navigation .mm-menu .sub-menu li > a:not(.mm-next) { color: <?php echo get_theme_mod('color_menu_mobile', ''); ?>; }
			.content-mobile-menu .login-header a { color: <?php echo get_theme_mod('color_menu_mobile', ''); ?>; }
			.content-mobile-menu .bwp-canvas-navigation .mm-menu ul > li.level-0 > a:not(.mm-next) { color: <?php echo get_theme_mod('color_menu_mobile', ''); ?>; }
		<?php } ?>
		<?php if(get_theme_mod('color_menu_mobile_hover', '')) { ?>
			.content-mobile-menu .bwp-canvas-navigation .mm-menu .sub-menu li > a:not(.mm-next):hover { color: <?php echo get_theme_mod('color_menu_mobile_hover', ''); ?>; }
			.content-mobile-menu .bwp-canvas-navigation .mm-menu ul > li.level-0 > a:not(.mm-next):hover { color: <?php echo get_theme_mod('color_menu_mobile_hover', ''); ?>; }
			.content-mobile-menu .login-header a:after { background: <?php echo get_theme_mod('color_menu_mobile_hover', ''); ?>; }
			.content-mobile-menu .bwp-canvas-navigation .mm-menu .mm-navbar a { color: <?php echo get_theme_mod('color_menu_mobile_hover', ''); ?>; }
			.content-mobile-menu .bwp-canvas-navigation .mm-menu ul > li.current_page_item > a > span.menu-item-text, .content-mobile-menu .bwp-canvas-navigation .mm-menu ul > li.level-0.current_page_item > a > span.menu-item-text { color: <?php echo get_theme_mod('color_menu_mobile_hover', ''); ?>; }
		<?php } ?>
    </style> <?php 
} 
add_action( 'wp_head', 'mafoil_customize_css');
