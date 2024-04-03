<?php
/***** Active Plugin ********/
add_action( 'tgmpa_register', 'mafoil_register_required_plugins' );
function mafoil_register_required_plugins() {
    $plugins = array(
		array(
            'name'               => esc_html__('Woocommerce', 'mafoil'), 
            'slug'               => 'woocommerce', 
            'required'           => true
        ),
		array(
            'name'      		 => esc_html__('Elementor', 'mafoil'),
            'slug'     			 => 'elementor',
            'required' 			 => true
        ),
		array(
            'name'               => esc_html__('Wpbingo Core', 'mafoil'), 
            'slug'               => 'wpbingo', 
            'source'             => get_template_directory() . '/plugins/wpbingo.zip',
            'required'           => true, 
        ),
        array(
            'name'               => esc_html__('Revolution Slider', 'mafoil'), 
            'slug'               => 'revslider', 
            'source'             => get_template_directory() . '/plugins/revslider.zip',
            'required'           => false, 
        ),		
		array(
            'name'               => esc_html__('Redux Framework', 'mafoil'), 
            'slug'               => 'redux-framework', 
            'required'           => true
        ),			
		array(
            'name'      		 => esc_html__('Contact Form 7', 'mafoil'),
            'slug'     			 => 'contact-form-7',
            'required' 			 => false
        ),	
		array(
            'name'     			 => esc_html__('WPC Smart Wishlist for WooCommerce', 'mafoil'),
            'slug'      		 => 'woo-smart-wishlist',
            'required' 			 => false
        ),		
		array(
            'name'     			 => esc_html__('WooCommerce Variation Swatches', 'mafoil'),
            'slug'      		 => 'variation-swatches-for-woocommerce',
            'required' 			 => false
        ),
    );
    $config = array();
    tgmpa( $plugins, $config );
}