<?php
    /*
    *
    *	Wpbingo Framework Menu Functions
    *	------------------------------------------------
    *	Wpbingo Framework v3.0
    * 	Copyright Wpbingo Ideas 2017 - http://wpbingosite.com/
    *
    *	mafoil_setup_menus()
    *
    */
    /* CUSTOM MENU SETUP
    ================================================== */
    register_nav_menus( array(
        'main_navigation' 	=> esc_html__( 'Main Menu', 'mafoil' ),
        'menu_category'   	=> esc_html__( 'Menu Category', 'mafoil' ),
        'menu_left'         => esc_html__( 'Menu Left', 'mafoil' ),
        'menu_right'        => esc_html__( 'Menu Right', 'mafoil' )
    ) );
?>