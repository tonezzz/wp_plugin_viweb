( function( $ ) {
	wp.customize('background_top_bar_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 .header-wrapper').css('background',value);
			$('.bwp-header.header-v1 .header-sticky').css('background',value);
        });
    });
	wp.customize('content_color_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 .header-wrapper').css('color',value);
			$('.bwp-header.header-v1 .header-wrapper a').css('color',value);
			$('.bwp-header.header-v1 .phone i').css('color',value);
        });
    });
	wp.customize('icon_color_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v1 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v1 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v1 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v1 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_1', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v1 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v1 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v1 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v1 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_1', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v1 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v1 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 2
	wp.customize('background_top_bar_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 .header-wrapper').css('background',value);
			$('.bwp-header.header-v2 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v2 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v2 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v2 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v2 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_2', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v2 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v2 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v2 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v2 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_2', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v2 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v2 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 3
	wp.customize('background_top_bar_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 .header-wrapper').css('background',value); 
			$('.bwp-header.header-v3 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v3 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v3 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v3 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v3 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_3', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v3 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v3 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v3 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v3 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_3', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v3 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v3 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 4
	wp.customize('background_top_bar_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 .header-wrapper').css('background',value);
			$('.bwp-header.header-v4 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v4 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v4 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v4 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v4 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_4', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v4 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v4 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v4 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v4 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_4', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v4 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v4 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 5
	wp.customize('background_top_bar_5', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v5 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_5', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v5 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_5', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v5 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_5', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v5 .header-wrapper').css('background',value);
			$('.bwp-header.header-v5 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_5', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v5 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v5 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v5 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v5 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v5 .header-page-link .mini-cart .cart-icon').css('color',value);
			$('.bwp-header.header-v5 .menu-sidebar .open-menu').css('color',value);
        });
    });
	wp.customize('width_logo_5', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v5 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v5 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v5 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v5 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_5', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v5 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v5 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 6
	wp.customize('background_top_bar_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 .header-wrapper').css('background',value);
			$('.bwp-header.header-v6 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v6 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v6 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v6 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v6 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_6', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v6 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v6 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v6 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v6 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_6', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v6 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v6 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 7
	wp.customize('background_top_bar_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 .header-wrapper').css('background',value);
			$('.bwp-header.header-v7 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v7 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v7 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v7 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v7 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_7', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v7 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v7 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v7 .header-sticky').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_bottom_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v7 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_7', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v7 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v7 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// HEADER 8
	wp.customize('background_top_bar_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 #bwp-topbar').css('background',value);
        });
    });
	wp.customize('color_top_bar_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 #bwp-topbar').css('color',value);
        });
    });
	wp.customize('color_link_top_bar_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 #bwp-topbar a').css('color',value);
        });
    });
	wp.customize('padding_topbar_top_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 #bwp-topbar').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_topbar_right_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 #bwp-topbar').css('padding-right',value + 'px');
        });
    });
	wp.customize('padding_topbar_bottom_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 #bwp-topbar').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_topbar_left_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 #bwp-topbar').css('padding-left',value + 'px');
        });
    });
	wp.customize('header_color_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 .header-wrapper').css('background',value);
			$('.bwp-header.header-v8 .header-sticky').css('background',value);
        });
    });
	wp.customize('icon_color_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 .header-page-link .search-box .search-toggle').css('color',value);
			$('.bwp-header.header-v8 .block-top-link>.widget .widget-custom-menu .widget-title').css('color',value);
			$('.bwp-header.header-v8 .bwp-header .header-page-link .login-header>a').css('color',value);
			$('.bwp-header.header-v8 .header-page-link .wishlist-box a').css('color',value);
			$('.bwp-header.header-v8 .header-page-link .mini-cart .cart-icon').css('color',value);
        });
    });
	wp.customize('menu_color_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 .bwp-navigation ul>li.level-0>a').css('color',value);
        });
    });
	wp.customize('width_logo_8', function(value) {
        value.bind(function(value) {
            $('.bwp-header.header-v8 .wpbingoLogo img').css('max-width',value + 'px');
        });
    });
	wp.customize('padding_top_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 .header-wrapper').css('padding-top',value + 'px');
			$('.bwp-header.header-v8 .header-sticky').css('padding-top',value + 'px');
        });
    });
	wp.customize('padding_right_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 .header-wrapper').css('padding-right',value + 'px');
			$('.bwp-header.header-v8 .header-wrapper').css('padding-sticky',value + 'px');
        });
    });
	wp.customize('padding_bottom_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 .header-wrapper').css('padding-bottom',value + 'px');
			$('.bwp-header.header-v8 .header-sticky').css('padding-bottom',value + 'px');
        });
    });
	wp.customize('padding_left_8', function(value) {
        value.bind(function(value) {
			$('.bwp-header.header-v8 .header-wrapper').css('padding-left',value + 'px');
			$('.bwp-header.header-v8 .header-sticky').css('padding-left',value + 'px');
        });
    });
	
	// MENU MOBILE
	wp.customize('background_menu_top', function(value) {
        value.bind(function(value) {
			$('.bwp-header .header-mobile').css('background',value );
			$('.bwp-header.sticky .header-mobile > .container').css('background',value );
        });
    });
	wp.customize('color_menu_top', function(value) {
        value.bind(function(value) {
			$('.bwp-header .header-mobile .navbar-toggle').css('color',value );
			$('.bwp-header .header-mobile .mini-cart .cart-icon').css('color',value );
        });
    });
	wp.customize('background_menu_bottom', function(value) {
        value.bind(function(value) {
			$('.bwp-header .header-mobile .header-mobile-fixed').css('background',value );
        });
    });
	wp.customize('color_menu_bottom', function(value) {
        value.bind(function(value) {
			$('.bwp-header .header-mobile .header-mobile-fixed a').css('color',value );
			$('.bwp-header .header-mobile .header-mobile-fixed .search-toggle').css('color',value );
			$('.bwp-header .header-mobile .header-mobile-fixed .wishlist-box a').css('color',value );
        });
    });
	wp.customize('background_menu_mobile', function(value) {
        value.bind(function(value) {
			$('.content-mobile-menu').addClass('active');
			$('.content-mobile-menu .bwp-canvas-navigation .mm-menu').css('background',value );
			$('.content-mobile-menu').css('background',value );
			$('.content-mobile-menu .bwp-canvas-navigation .mm-menu div').css('background',value );
			$('.content-mobile-menu .content').css('background',value );
        });
    });
	wp.customize('color_menu_mobile', function(value) {
        value.bind(function(value) {
			$('.content-mobile-menu').addClass('active');
			$('.content-mobile-menu .bwp-canvas-navigation .mm-menu .sub-menu li > a:not(.mm-next)').css('color',value );
			$('.content-mobile-menu .bwp-canvas-navigation .mm-menu ul > li.level-0 > a:not(.mm-next)').css('color',value );
        });
    });
} )( jQuery );