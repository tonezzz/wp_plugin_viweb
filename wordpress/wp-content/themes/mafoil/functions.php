<?php
define('mafoil_version','1.0'); 
if (!isset($content_width)) { $content_width = 1200; }
require_once( get_template_directory().'/inc/class-tgm-plugin-activation.php' );
require_once( get_template_directory().'/inc/plugin-requirement.php' );
require_once( get_template_directory().'/inc/megamenu/megamenu.php' );
include_once( get_template_directory().'/inc/megamenu/mega_menu_custom_walker.php' );
require_once( get_template_directory().'/inc/function.php' );
require_once( get_template_directory().'/inc/loader.php' );
include_once( get_template_directory().'/inc/menus.php' );
include_once( get_template_directory().'/inc/template-tags.php' );
require_once( get_template_directory().'/inc/woocommerce.php' );
require_once( get_template_directory().'/inc/admin/functions.php' );
require_once( get_template_directory().'/inc/admin/theme-options.php' );
require_once( get_template_directory().'/customizer/settings/custom-apply.php' );
require_once( get_template_directory().'/customizer/settings/customizer.php' );
function mafoil_custom_css() {
	global $mafoil_page_id;
	$mafoil_settings = mafoil_global_settings();
	if (!is_admin()) {
		wp_enqueue_style( 'mafoil-style-template', get_template_directory_uri().'/css/template.css');
		ob_start(); 
		include( get_template_directory().'/inc/custom-css.php' );
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$csss = explode("\n", $content);
		$custom_css = array();
		foreach ($csss as $i => $css) { if(!empty($css)) $custom_css[] = trim($css); }
		wp_add_inline_style( 'mafoil-style-template', implode($custom_css) );
	}
}
add_action('wp_enqueue_scripts', 'mafoil_custom_css' );
function mafoil_custom_js() {
	if (!is_admin()) {
		wp_enqueue_script( 'mafoil-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery'), null, true );
		wp_localize_script( 'mafoil-script', 'mafoil_ajax',
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'redirecturl' => home_url(),
				'ajax_nonce' => wp_create_nonce('mafoil_ajax_nonce'),
			)
		);
		$custom_js = 'jQuery(function($){ "use strict"; $(document).on("click",".plus, .minus",function(){var t=$(this).closest(".quantity").find(".qty"),a=parseFloat(t.val()),n=parseFloat(t.attr("max")),s=parseFloat(t.attr("min")),e=t.attr("step");a&&""!==a&&"NaN"!==a||(a=0),(""===n||"NaN"===n)&&(n=""),(""===s||"NaN"===s)&&(s=0),("any"===e||""===e||void 0===e||"NaN"===parseFloat(e))&&(e=1),$(this).is(".plus")?t.val(n&&(n==a||a>n)?n:a+parseFloat(e)):s&&(s==a||s>a)?t.val(s):a>0&&t.val(a-parseFloat(e)),t.trigger("change")})});';
		wp_add_inline_script( 'mafoil-script', $custom_js);
	}
}
add_action('wp_enqueue_scripts', 'mafoil_custom_js' );