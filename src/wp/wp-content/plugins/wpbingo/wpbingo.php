<?php
/*
Plugin Name: Wpbingo Core
Plugin URI: https://themeforest.net/user/wpbingo
Description: Use For Wpbingo Theme.
Version: 1.0
Author: TungHV
Author URI: https://themeforest.net/user/wpbingo
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');

require_once( dirname(__FILE__) . '/function.php');
require_once( dirname(__FILE__) . '/elementor.php');
define('WPBINGO_ELEMENTOR_PATH', dirname(__FILE__) . '/elementor/');
define('WPBINGO_ELEMENTOR_TEMPLATE_PATH', dirname(__FILE__) . '/elementor-template/');
define('WPBINGO_WIDGET_PATH', dirname(__FILE__) . '/widgets/');
define('WPBINGO_WIDGET_TEMPLATE_PATH', dirname(__FILE__) . '/widgets-template/');
define('WPBINGO_CONTENT_TYPES_LIB', dirname(__FILE__) . '/lib/');
require_once WPBINGO_CONTENT_TYPES_LIB . 'lookbook/includes/bwp_lookbook_class.php';
define ( 'LOOKBOOK_TABLE', 'bwp_lookbook');
class WpbingoShortcodesClass {
    function __construct() {
        // Init plugins
		$this->loadInit();
		add_filter( 'wp_calculate_image_srcset', array( $this, 'bwp_disable_srcset' ) );
		remove_filter('pre_term_description', 'wp_filter_kses');
		load_plugin_textdomain('wpbingo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
	function loadInit() {
		global $woocommerce;
		if ( ! isset( $woocommerce ) || ! function_exists( 'WC' ) ) {
			add_action( 'admin_notices', array( $this, 'bwp_woocommerce_admin_notice' ) );
			return;
		}else{
			add_action('wp_enqueue_scripts', array( $this, 'bwp_framework_script' ) );	
			require_once(WPBINGO_CONTENT_TYPES_LIB.'settings/save_settings.php');
			$this->bwp_load_file(WPBINGO_WIDGET_PATH);
			$this->bwp_load_file(WPBINGO_CONTENT_TYPES_LIB);
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
			add_action( 'init',array( $this, 'wpbingo_remove_default_action'));
			add_action( 'template_redirect', 'bwp_track_product_view_always', 20 );
		}
    }
	function register_widgets(){
		register_widget( 'bwp_recent_post_widget');
		register_widget( 'bwp_ajax_filter_widget' );
	}	
	function wpbingo_remove_default_action(){
		remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
		remove_filter( 'woocommerce_get_item_data', 'dokan_product_seller_info', 10 );
	}
	function bwp_load_file($path){
		$files = array_diff(scandir($path), array('..', '.'));
		if(count($files)>0){
			foreach ($files as  $file) {
				if (strpos($file, '.php') !== false)
					require_once($path . $file);
			}
		}		
	}
	function bwp_framework_script(){
		wp_enqueue_script( 'jquery-ui-slider', false, array('jquery'));
		wp_enqueue_script( 'wc-cart-fragments' );
		wp_enqueue_script( 'accounting', false, array('jquery'));
		wp_register_script( 'jquery-cookie', plugins_url( '/wpbingo/assets/js/jquery.cookie.min.js' ), array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-cookie' );
		wp_register_script( 'wpbingo-newsletter', plugins_url( '/wpbingo/assets/js/newsletter.js' ), array('jquery','jquery-cookie'), null, true );
		wp_enqueue_script( 'wpbingo-newsletter' );
		wp_register_style( 'bwp_woocommerce_filter_products', plugins_url('/wpbingo/assets/css/bwp_ajax_filter.css') );
		if (!wp_style_is('bwp_woocommerce_filter_products')) {
			wp_enqueue_style('bwp_woocommerce_filter_products');
		}	
	}
	function bwp_woocommerce_admin_notice(){ ?>
		<div class="error">
			<p><?php echo esc_html__( 'Wpbingo is enabled but not effective. It requires WooCommerce in order to work.', 'wpbingo' ); ?></p>
		</div>
		<?php
	}
	function bwp_disable_srcset( $sources ) {		
		return false;	
	}
}

function lookbook_install () {
    global $wpdb;
	
    $table_name = $wpdb->prefix . LOOKBOOK_TABLE;
	include_once ABSPATH.'wp-admin/includes/upgrade.php';
    if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

        $sql = "CREATE TABLE IF NOT EXISTS `" . $table_name . "` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL,
				  `title` varchar(255),
				  `description` varchar(255),
				  `button` varchar(255),
				  `urlbutton` varchar(255),
                  `width` smallint(5) unsigned NOT NULL,
                  `height` smallint(5) unsigned NOT NULL,		  
                  `image` varchar(255) NOT NULL,
                  `pins` text NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
		if(dbDelta($sql)){
			$sql_insert = "INSERT INTO `" . $table_name . "` (`id`, `name`, `title`, `description`, `width`, `height`, `image`, `pins`) VALUES
				(120, 'Instagram 1', '', '', 320, 320, 'ig-1.jpg', '[{\"id\":\"1669363383338\",\"top\":174,\"left\":85,\"width\":30,\"height\":30,\"slug\":\"long-sleeve-t-shirt\",\"img_height\":320,\"img_width\":320,\"editable\":true}]'),
				(121, 'Instagram 2', '', '', 320, 320, 'ig-2.jpg', '[{\"id\":\"1669363430914\",\"top\":134,\"left\":126,\"width\":30,\"height\":30,\"slug\":\"faux-leather-wide-tote-bag\",\"img_height\":320,\"img_width\":320,\"editable\":true}]'),
				(122, 'Instagram 3', '', '', 320, 320, 'ig-3.jpg', '[{\"id\":\"1669363472202\",\"top\":115,\"left\":174,\"width\":30,\"height\":30,\"slug\":\"corduroy-slim-flared-pants\",\"img_height\":320,\"img_width\":320,\"editable\":true}]'),
				(123, 'Instagram 4', '', '', 320, 320, 'ig-4.jpg', '[{\"id\":\"1669363510064\",\"top\":182,\"left\":158,\"width\":30,\"height\":30,\"slug\":\"middle-gauge-crew-neck\",\"img_height\":320,\"img_width\":320,\"editable\":true}]'),
				(124, 'Instagram 5', '', '', 320, 320, 'ig-5.jpg', '[{\"id\":\"1669363551979\",\"top\":128,\"left\":52,\"width\":30,\"height\":30,\"slug\":\"znike-air-force-one\",\"img_height\":320,\"img_width\":320,\"editable\":true}]'),
				(125, 'Instagram 6', '', '', 320, 320, 'ig-6.jpg', '[{\"id\":\"1669363586871\",\"top\":106,\"left\":156,\"width\":30,\"height\":30,\"slug\":\"faux-leather-wide-tote-bag\",\"img_height\":320,\"img_width\":320,\"editable\":true}]'),
				(126, 'Look Book 1', '', '', 865, 1154, 'lookbook-1.jpg', '[{\"id\":\"1669368875905\",\"top\":351,\"left\":188,\"width\":30,\"height\":30,\"slug\":\"printed-v-neck-long-sleeve\",\"img_height\":1154,\"img_width\":865,\"editable\":true}]'),
				(127, 'Look Book 2', '', '', 815, 774, 'lookbook-2.jpg', '[{\"id\":\"1669368980066\",\"top\":170,\"left\":222,\"width\":30,\"height\":30,\"slug\":\"faux-shearling-bucket-hat\",\"img_height\":774,\"img_width\":815,\"editable\":true}]'),
				(128, 'Look Book 3', '', '', 690, 903, 'lookbook-3.jpg', '[{\"id\":\"1669705772732\",\"top\":124,\"left\":349,\"width\":30,\"height\":30,\"slug\":\"uv-protection-bucket-hat\",\"img_height\":903,\"img_width\":690,\"editable\":true},{\"id\":\"1669705783649\",\"top\":561,\"left\":364,\"width\":30,\"height\":30,\"slug\":\"cotton-dolman-oversized\",\"img_height\":903,\"img_width\":690,\"editable\":true}]'),
				(129, 'Look Book 4', '', '', 690, 903, 'lookbook-4.jpg', '[{\"id\":\"1669705822280\",\"top\":415,\"left\":249,\"width\":30,\"height\":30,\"slug\":\"zound-mini-shoulder-bag\",\"img_height\":903,\"img_width\":690,\"editable\":true}]'),
				(130, 'Look Book 5', '', '', 620, 930, 'lookbook-5.jpg', '[{\"id\":\"1669707610606\",\"top\":147,\"left\":229,\"width\":30,\"height\":30,\"slug\":\"vintage-fashion-eyewear\",\"img_height\":930,\"img_width\":620,\"editable\":true},{\"id\":\"1669707619419\",\"top\":276,\"left\":496,\"width\":30,\"height\":30,\"slug\":\"ribbed-short-sleeve-t-shirt\",\"img_height\":930,\"img_width\":620,\"editable\":true},{\"id\":\"1669707628757\",\"top\":515,\"left\":109,\"width\":30,\"height\":30,\"slug\":\"smart-ankle-pants\",\"img_height\":930,\"img_width\":620,\"editable\":true}]'),
				(131, 'Look Book 6', '', '', 450, 657, 'lookbook-6.jpg', '[{\"id\":\"1669971911109\",\"top\":298,\"left\":319,\"width\":30,\"height\":30,\"slug\":\"cotton-dolman-oversized\",\"img_height\":657,\"img_width\":450,\"editable\":true}]'),
				(132, 'Look Book 7', '', '', 690, 820, 'lookbook-7.jpg', '[{\"id\":\"1670320043787\",\"top\":497,\"left\":203,\"width\":30,\"height\":30,\"slug\":\"rayon-long-sleeve-blouse\",\"img_height\":820,\"img_width\":690,\"editable\":true}]'),
				(133, 'Look Book 8', '', '', 690, 820, 'lookbook-8.jpg', '[{\"id\":\"1670320085007\",\"top\":342,\"left\":240,\"width\":30,\"height\":30,\"slug\":\"faux-leather-wide-tote-bag\",\"img_height\":820,\"img_width\":690,\"editable\":true}]'),
				(134, 'Look Book 9', '', '', 690, 690, 'lookbook-9.jpg', '[{\"id\":\"1670407842433\",\"top\":280,\"left\":276,\"width\":30,\"height\":30,\"slug\":\"faux-leather-wide-tote-bag\",\"img_height\":690,\"img_width\":690,\"editable\":true}]'),
				(135, 'Look Book 10', '', '', 690, 960, 'lookbook-10.jpg', '[{\"id\":\"1670407886828\",\"top\":134,\"left\":252,\"width\":30,\"height\":30,\"slug\":\"mini-dipsea-blue-light\",\"img_height\":960,\"img_width\":690,\"editable\":true},{\"id\":\"1670407896425\",\"top\":534,\"left\":461,\"width\":30,\"height\":30,\"slug\":\"cotton-dolman-oversized\",\"img_height\":960,\"img_width\":690,\"editable\":true}]'),
				(136, 'Look Book 11', '', '', 547, 681, 'lookbook-11.jpg', '[{\"id\":\"1675758612079\",\"top\":257.1007125097656,\"left\":361.1111495214844,\"width\":30,\"height\":30,\"slug\":\"cotton-dolman-oversized\",\"img_height\":680.99,\"img_width\":546.997,\"editable\":true},{\"id\":\"1675758668389\",\"top\":443.10763999999995,\"left\":180.10419151367188,\"width\":30,\"height\":30,\"slug\":\"faux-leather-wide-tote-bag\",\"img_height\":680.99,\"img_width\":546.997,\"editable\":true}]'),
				(137, 'Look Book 12', '', '', 547, 681, 'lookbook-12.jpg', '[{\"id\":\"1675758706572\",\"top\":216.1111190039062,\"left\":294.0972335058594,\"width\":30,\"height\":30,\"slug\":\"faux-leather-wide-tote-bag\",\"img_height\":680.99,\"img_width\":546.997,\"editable\":true}]');";
			dbDelta($sql_insert);
		}
    }
    $file = new bwp_lookbook_class();
    $file->create_folder_recursive(LOOKBOOK_UPLOAD_PATH);
    $file->create_folder_recursive(LOOKBOOK_UPLOAD_PATH_THUMB);
	add_option('update2prof_notice', 0,0);
}

register_activation_hook(__FILE__, 'lookbook_install');

register_deactivation_hook(__FILE__, 'lookbook_deactivate');

function lookbook_deactivate() {
    if( !function_exists( 'the_field' )) {
        update_option( 'update2prof_notice', 0 );
    }
}
// Finally initialize code
new WpbingoShortcodesClass();
	