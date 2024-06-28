<?php
namespace ElementorWpbingo;
class Plugin {
	private static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function register_widgets() {
		$this->include_widgets_files(WPBINGO_ELEMENTOR_PATH);
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Policy() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Recent_Post() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Instagram() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Ourteam() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Product_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Filter_Homepage() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Brand() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Content_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Product_Categories() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Countdown_Product() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Image_Countdown_Product() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Cta() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Google_Maps() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Lookbook() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bwp_Video() );
	}
	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'wpbingo',
			[
				'title' => __( 'Wpbingo', 'wpbingo' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
	function include_widgets_files($path){
		$files = array_diff(scandir($path), array('..', '.'));
		if(count($files)>0){
			foreach ($files as  $file) {
				if (strpos($file, '.php') !== false)
					require_once($path . $file);
			}
		}		
	}
	public function __construct() {
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'wp_ajax_bwp_load_more_callback', array( $this, 'bwp_load_more_callback' ) );
		add_action( 'wp_ajax_nopriv_bwp_load_more_callback', array( $this, 'bwp_load_more_callback' ) );
		add_action( 'wp_ajax_bwp_filter_homepage_callback', array( $this, 'bwp_filter_homepage_callback' ) );
		add_action( 'wp_ajax_nopriv_bwp_filter_homepage_callback', array( $this, 'bwp_filter_homepage_callback' ) );		
	}
	function bwp_load_more_callback(){
		global $wpdb;
		$dir =	WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-product-list/default_ajax.php';
		include $dir;
	}
	function bwp_filter_homepage_callback(){
		global $wpdb;
		$dir =	WPBINGO_ELEMENTOR_TEMPLATE_PATH.'bwp-filter-homepage/default_ajax.php';
		include $dir;
	}	
}
Plugin::instance();
