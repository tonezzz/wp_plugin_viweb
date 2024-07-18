<?php //die(dirname(__FILE__));
if(isset($_GET['drw'])) {
	echo '<a href="/en/?drw">/en/</a>';
	global $wp_query,$wp_rewrite;
	ob_clean(); die("<pre>".print_r([
		'xx'			=> 'xx',
		'__FILE__'      => __FILE__,
		'SERVER_NAME'   => $_SERVER['SERVER_NAME'],
		'REQUEST_URI'   => $_SERVER['REQUEST_URI'],
		'QUERY_STRING'  => $_SERVER['QUERY_STRING'],
		'_GET'          => $_GET,
		'_COOKIE'       => $_COOKIE,
		'_SERVER'       =>  $_SERVER,
	],true));
}
/*
* gz_facebook() class.
*	- Render page badge in iFrame.
* 	- Retrieve photos from FB album.
* v0.02/20180405:Tony
*	- Fix width doesn't apply on badge rendering (caused by wrong url param rendering).
* v0.01/20180223:Tony
*	- Use gz_tpl v0.01 style
*	- Add shortcode for FB box
* v0.00/20171002:Tony
* 	- Add feature, retrieve photos from FB album.
*		- Choose group by resolutions.
die
*/

global $gz_locale;

require dirname(__FILE__)."/_gz_rewrite_ml.php";
require dirname(__FILE__)."/_gz_menu_ml.php";
require dirname(__FILE__)."/_gz_quickedit_ml.php";

class gz_multilang extends gz_tpl{
	public $the_content_off=false;
	private $is_load_theme_textdomain=false;
	private $text_domain='mafoil';

	public function __construct($text_domain=false){ //if(isset($_GET['d'])) die(__FILE__);
		if($text_domain) $this->text_domain = $text_domain;
		$config = [
			'enqueue'  => [
				//['type'=>'style' ,'load'=>true ,'prm'=>['font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css']],
				['type'=>'style' ,'load'=>true ,'prm'=>[__CLASS__,'[REL_PATH]wp_style.css']],
				['type'=>'script' ,'load'=>true ,'prm'=>[__CLASS__,'[REL_PATH]wp_script.js',['jquery-core','jquery-cookie']]],
				['type'=>'localize', 'prm'=>[__CLASS__,__CLASS__,[
					'domain'	=> $_SERVER['HTTP_HOST']
					//'menu_lang'	=> $this->render_menu_lang(),
				]]]
			],
			'cmb2v2' => [
				['prm'=> [
					'id'					=> 'qen',
					'title' 				=> __('English',$this->text_domain),
					'object_types'			=> ['post','page','product','nav_menu_item'],
					'fields' 				=> [
						['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text'],
					]
				]],
				['prm'=> [
					'id'					=> 'en',
					'title' 				=> __('English',$this->text_domain),
					'object_types'			=> ['post','page','product','nav_menu_item'],
					'context'				=> 'normal',
					'fields' 				=> [
						['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text'],
						//['id'=>'_post_sub_th' ,'name'=>__('Sub title (Thai)',$this->text_domain) ,'type'=>'textarea_small'],
						//['id'=>'_post_sub_en' ,'name'=>__('Sub title (English)',$this->text_domain) ,'type'=>'textarea_small'],
						['id'=>'post_content_en' ,'name'=>__('Post content (English)',$this->text_domain) ,'type'=>'wysiwyg','options'=>['wpautop'=>true]],
						['id'=>'post_excerpt_en' ,'name'=>__('Post excerpt (English)',$this->text_domain) ,'type'=>'wysiwyg','options'=>['wpautop'=>true]],
					]
				]],
				[
					'prm'=> [
						'id'					=> 'gz_term',
						'title' 				=> __('English',$this->text_domain),
						'object_types'			=> ['term'],
						'taxonomies'       		=> [ 'category', 'post_tag', 'product_cat', 'product_tag' ],
						'fields' 				=> [
							['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text'],
						]
					],
				],
			],
  		   	'ajaxes' => [
			],
			'remove_filters' => [
				//['prm'=>['theme_locale']],
				//['prm'=>['woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10]],
				//['prm'=>['woocommerce_single_product_summary','woocommerce_template_single_title',5]],
				//['prm'=>['woocommerce_before_main_content','woocommerce_breadcrumb',20]],
			],
			'filters' => [
				//['prm'=>['query_vars',[$this,'public_query_vars']]],
				//['prm'=>['wp_redirect',[$this,'redirect_ml']]],
				['prm'=>['wp_nav_menu_objects',[$this,'wp_nav_menu_ml'],10,2]],
				['prm'=>['the_title',[$this,'the_title'],10,2]],
				['prm'=>['the_content',[$this,'the_content'],20,2]],
				['prm'=>['woocommerce_short_description',[$this,'get_the_excerpt'],21,2]],
				['prm'=>['get_term',[$this,'get_term_ml'],10,2]],
				['prm'=>['locale',[$this,'get_locale']],10,1],
				['prm'=>['gz_rewrite_ml_support_langs',[$this,'gz_rewrite_ml_support_langs']],10,1],
				['prm'=>['gz_rewrite_ml_default_lang',[$this,'gz_rewrite_ml_default_lang']],10,1],
				//['prm'=>['wp_list_categories',[$this,'wp_list_categories_ml']],10,2],
				//['prm'=>['get_taxonomy',[$this,'get_term_ml'],10,2]],
				//['prm'=>['get_the_excerpt',[$this,'get_the_excerpt'],21,2]],
				//['prm'=>['woocommerce_get_breadcrumb',[$this,'breadcrumb_ml'],10,2]],
				//['prm'=>['woocommerce_before_shop_loop',[$this,'get_cat_banner'],10,2]],
				//['prm'=>['theme_locale',[$this,'theme_locale'],10,2]],
				//['prm'=>['determine_locale',[$this,'determine_locale']]],
				//['prm'=>['pre_determine_locale',[$this,'get_locale'],10,1]],
				//['prm'=>['woocommerce_cart_shipping_method_full_label',[$this,'woocommerce_cart_shipping_method_full_label'],10,2]],
				//['prm'=>['woocommerce_shipping_rate_label',[$this,'woocommerce_shipping_rate_label'],10,2]],
				//['prm'=>['woocommerce_gateway_title',[$this,'woocommerce_gateway_title'],10,2]],
				//['prm'=>['woocommerce_gateway_description',[$this,'woocommerce_gateway_description'],10,2]],
				//['prm'=>['woocommerce_cart_item_name',[$this,'woocommerce_cart_item_name'],10,3]],
				//['prm'=>['wp_setup_nav_menu_item',[$this,'filter_menu_lang'],1]],
				//['prm'=>['woocommerce_get_breadcrumb',[$this,'woocommerce_get_breadcrumb'],10,2]],
				//['prm'=>['woocommerce_before_main_content',[$this,'woocommerce_breadcrumb'],20,2]],
				//['prm'=>['woocommerce_before_main_content',[$this,'woocommerce_breadcrumb'],20]],
			],
			'remove_actions' => [
				//['prm'=>['wpautop','wpautop']],
			],
			'actions' => [
				//['prm'=>['init',[$this,'rewrite_ml']]],
				['prm'=>['wp_footer',[$this,'footer_ml'],20]],
				['prm'=>['template_redirect',[$this,'init_ml']]],	//Init multi lang when everything is loaded.
				//['prm'=>['get_footer',[$this,'get_footer']]],
				//['prm'=>['init',[$this,'load_translations']]],
				['prm'=>['admin_menu',[$this,'admin_menu']]],
				['prm'=>['init',[$this,'init_modules']]],
			],
		];
		parent::__construct($config);
		//header("gz_url: ".$_SERVER['REQUEST_URI']);
		//header("lang: ".isset($_GET['lang'])?$_GET['lang']:'No');
		//header("gz_lang: " . ($_SERVER['REQUEST_URI']) );
		//if(isset($_GET['dv'])) {ob_clean(); die("<pre>".print_r($_SERVER,true)); }
	}

	function init_modules(){
		if (class_exists('gz_menu_ml')) $this->gz_menu_ml = new gz_menu_ml($this->text_domain);
		if (class_exists('gz_quickedit_ml')) $this->gz_quickedit_ml = new gz_quickedit_ml($this->text_domain);
		//gz_rewrite_ml is init as a static class
	}
	
	function gz_rewrite_ml_support_langs($langs){ return array_unique(['th','en','gr']); }
	function gz_rewrite_ml_default_lang($langs){ return 'th'; }

	function public_query_vars($qv){
		$qv[] = 'redirect';
		return $qv;
	}

	function redirect_ml($location){ //die(__FILE__);
		$redirect = get_query_var('redirect');
		//if(isset($_GET['d'])) {ob_clean(); die("<pre>".print_r(compact('location','redirect'),true)); }
		if (!empty($redirect)) return false;
		return $location;
	}

	function wp_list_categories_ml($args){ //echo "xx";
		//if(isset($_GET['d'])) {ob_clean(); die("<pre>".print_r(compact('args'),true)); }
	}

	function init_ml(){//die(__FILE__);
		if(is_admin() ) return;
		if(isset($_GET['drwml'])) {global $wp_query,$wp_rewrite; ob_clean(); die("<pre>".print_r([
			//'$_SERVER' => $_SERVER,
			'$_COOKIE' => $_COOKIE,
			'gz_lang' => get_query_var('gz_lang'),
			'get_supported_langs' => gz_rewrite_ml::get_supported_langs(),
			'get_default_lang' => gz_rewrite_ml::get_default_lang(),
			'current_action' => current_action(),
			'_GET' => $_GET,
			'wp_rewrite' => $wp_rewrite,
			'wp_query' => $wp_query,
		],true)); }

		$lang=$this->get_lang(); $this->set_lang($lang); //If lang is not set, set to "th"
	}
	
	function set_lang($lang){
		$this->set_cookie('gz_lang',$lang);
		//$this->init_locale();
		$this->load_translations(true);
		//remove_action( 'storefront_page', 'storefront_page_content', 20);
	}
	
	function get_lang(){
		$gz_lang = isset($_COOKIE['gz_lang'])?$_COOKIE['gz_lang']:'th';
		return $gz_lang;
	}
	function get_current_lang(){return $this->get_lang();}

	function get_locale($locale=false){
		//$locale = isset($_COOKIE['gz_locale'])?$_COOKIE['gz_locale']:'th_TH';
		//if(isset($_GET['d'])) die("<pre>".print_r($locale));
		if('en'==$this->get_lang()) $locale = 'en_US';
		else $locale = 'th_TH';
		return $locale;
	}

	function init_locale(){
		if(is_admin() ) return;


		//if(isset($_GET['d'])) {ob_clean(); echo '<pre>'; global $wp_query; print_r($wp_query); die();}


		//$lang = get_query_var('lang'); if(isset($_GET['d'])) { die('<pre>'.print_r($lang,true).'</pre>'); }

		//if(isset($_GET['d'])) { die('<pre>'.$_COOKIE['gz_lang'].'</pre>'); }
		//die('<pre>'.print_r([$this->get_lang(),$this->get_locale()],true));
		//if(isset($_GET['lang'])){ //"lang=th or lang=en"
		//	$lang = $_GET['lang'];
		//	$this->set_cookie('gz_lang',$lang);
		//	$locale = $this->get_locale();
		//	$this->set_cookie('wp_lang',$locale);
		//	$rs = switch_to_locale($locale);
			//$lang = $_GET['lang'];
			//if($user_id=get_current_user_id()) update_user_option($user_id,'user_lang_pref',$locale);
			//$this->is_load_theme_textdomain = false; //Clear theme textdomain flag for reloading
		//}
		//else{
			//$lang = "th";
			//if($user_id=get_current_user_id()) $locale = get_user_option('user_lang_pref',$user_id );
		//	$lang = isset($_COOKIE['gz_lang'])?$_COOKIE['gz_lang']:"";
		//}
		//$this->set_lang($lang);
	}

	/**
	 * load_child_theme_textdomain($this->text_domain,get_stylesheet_directory().'/languages');
	 */
	function load_translations($force=false){
		if(is_admin()) return;
		$path = WP_CONTENT_DIR."/languages/loco/";
		//$rs = load_theme_textdomain('mafoil',$lang_dir.'themes/');
		//$rs = load_plugin_textdomain('contact-form-7',false,$lang_dir.'plugins/');
		//$rs = load_plugin_textdomain('woocommerce',false,$lang_dir.'plugins/');
		if('en'!=$this->get_current_lang()){
			$lang = $this->get_current_lang();
			$loaded = load_textdomain('mafoil',$path."themes/mafoil-{$lang}.mo");
			$loaded = load_textdomain('woocommerce',$path."plugins/woocommerce-{$lang}.mo");
			$loaded = load_textdomain('contact-form-7',$path."plugins/contact-form-7-{$lang}.mo");
			//$loaded = load_textdomain('localizationsample',$path."plugins/localizationsample-{$lang}.mo");
		}
	}
	function get_cat_banner($a, $b=0 ){
		return "hello";
		//foreach($crumbs as &$item){
		//	$item['id'] = url_to_postid($item[1]);
		//}
		//if(isset($_GET['d'])) {ob_clean(); die("<pre>".print_r(compact('a','b'),true)); }
	}

	function wp_nav_menu_ml($menu_items, $args){
		if(is_admin()) return $content;
		foreach($menu_items as $item) if(!empty($item->submegamenu)) {
			if ($pp=$this->get_post_lang($item->submegamenu,$this->get_current_lang())){
				$item->submegamenu = $pp->ID;
			}
		}
		return $menu_items;
	}

	function admin_menu() { 
		add_options_page(
			'GZ multilang',            // admin page title
			'GZ multilang',            // menu item name
			'manage_options',               // access privilege
			basename(__FILE__),                         // page slug for the option page
			[$this,'gz_multilang_panel']  // call-back function name
		);
	}
	function gz_multilang_panel(){
		$arr = [
			['Hi there!','localizationsample'],
			['Hello world!','localizationsample'],
			['Name','localizationsample'],
			['Name','woocommerce'],
			['HOT','woocommerce'],
			['Hot','mafoil'],
			['SHOP NOW','woocommerce'],
			['Order ID','woocommerce'],
			['CHECKOUT','woocommerce'],
			['Name','contact-form-7'],
			['Address','contact-form-7'],
		];
		$path = WP_CONTENT_DIR."/languages/loco/";
		echo '<div class="wrap"><div id="icon-themes" class="icon32"></div>';
		echo '<h2>' . __('GZ Multilang control panel', 'gizmo') . '</h2>'; 
		echo '<p>';
		echo '<table>';
		foreach($arr as $item){
			$t = $item[0];
			$d = $item[1];
			echo "<tr><td>{$d}</td><td>{$t}</td><td>"; _e($t,$d); echo '</td></tr>';
			//echo "<tr><td>{$d}</td><td>{$t}</td><td>"; echo __($t,$d); echo "</td></tr>";
		}
		echo '</table>';
		echo '</p>';
		echo '</div>'; // end of wrap
	}
	
	function footer_ml( string $name=null, array $args=[] ) { //die(__FILE__);
		//$mafoil_settings = mafoil_global_settings();
		//if(isset($_GET['d'])) {ob_clean(); die("<pre>".print_r($mafoil_settings)); }
		return false;
	}

	/*
	* If there's meta _post_title_en then return it, otherwise return the original title;
	* https://developer.wordpress.org/reference/functions/get_the_title/
	*/
	function the_title($title,$post=false){
		//if(isset($post) && $post==43635) die('<pre>'.print_r(compact('title','post'),true).'</pre>');
		//if(isset($post) && $post==43635) die($this->get_suffix());
		if (empty($this->get_suffix($debug=true))) return $title;
		$title = $this->get_field_lang($post,'post_title',$this->get_current_lang(),$title); //die($excerpt);
		//if(isset($post) && $post==43635) die('<pre>'.print_r(compact('title','post'),true).'</pre>');
		return $title;
	}
	
	function get_suffix($debug=false){
		//if($debug || isset($_GET['d'])) die('<br>'.print_r($_COOKIE['gz_lang'],true));
		if('th'==$this->get_lang()) $suffix = '';
		else $suffix = '_'.$this->get_lang();
		return $suffix;
	}

	/**
	 * Elementor = no wpautop
	 * Otherwise = wpautop
	 */
	function the_content($content,$post=false){
		if(is_admin()) return $content;
		//if(is_admin() && !wp_doing_ajax()) return $content;

		if(empty($post)) global $post;
		$autop = true;
		if ($pp=$this->get_post_lang($post,$this->get_current_lang())){
			if($this->is_elementor($pp->ID)){
				$autop = false;
				$content = Elementor\Plugin::instance()->frontend->get_builder_content($pp->ID);
			} else $content = get_the_content(null,false,$pp);
			//if(isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('content','pp'),true)); }
		} else {
			if (empty($this->get_suffix())) return $content; //Default lang = default content.
			$content = $this->get_field_lang($post,'post_content',$this->get_current_lang(),$content);
		}
		
		//$content = do_shortcode($content);
		if($autop) $content = wpautop($content);
		return $content;
		//return wpautop($content);
	}

	function is_elementor($post){
		if(is_object($post)) $post_id = $post->ID; else $post_id = $post;
		return get_post_meta($post_id,'_elementor_template_type',true); //Check if meta exists.
	}

	/**
	 * function get_post_lang($post,$lang): Get post according to language (using prefixed)
	 * 
	 */
	function get_post_lang($post,$lang){
		if(empty($post)) global $post;
		$post_type=get_post_type($post);
		$slug = get_post_field( 'post_name', $post ); $slug = str_replace(['_en','_th'],'',$slug); //Clean up language suffix.
		$slug_lang = $slug.'_'.$this->get_lang();
		//if('page'===$post_type && isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('post_type','lang','slug','slug_lang','post'),true)); }
		$args = [
			'post_type'      => 'any',
			'posts_per_page' => 1,
			'post_name__in'  => [$slug_lang],
			//'fields'         => 'ids' 
		];
		$q = get_posts( $args );
		//if('page'===$post_type && isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('post_type','lang','slug','slug_lang','q'),true)); }
		return isset($q[0])?$q[0]:false;
	}

	/*
	* If there's meta _post_excerpt_en then return it, otherwise return the original excerpt;
	* https://developer.wordpress.org/reference/functions/get_the_excerpt/
	*/
	function get_the_excerpt($excerpt,$post=false){ //if(isset($_GET['d'])) die($this->get_suffix());
		if (empty($this->get_suffix())) return $excerpt;
		//if(isset($_GET['d'])) die($this->get_suffix());
		//if(isset($_GET['d'])) die($excerpt);
		$excerpt = $this->get_field_lang($post,'post_excerpt',$this->get_current_lang(),$excerpt);
		return $excerpt;
	}

	//function get_taxonomy_ml($_term, $taxonomy){
	//	if(is_admin() && !wp_doing_ajax()) return $_term;
	//	return $_term;
	//}

	function get_term_ml($term, $taxonomy){
		if(is_admin()) return $term;

		$term_list = ['product_cat','product_tag','category'];
		if(!in_array($taxonomy,$term_list)) return $term;
		//if(isset($_GET['d']) && ('product_cat'==$taxonomy)) die('<pre>'.print_r(compact('term','taxonomy'),true));
		if (empty($this->get_suffix())) return $term;
		$term->name = $this->get_term_meta_ml($term,'post_title'); //name,post_title
		$term->description = $this->get_term_meta_ml($term,'description');
		//if(isset($_GET['d']) && ('product_cat'==$taxonomy)) die('<pre>'.print_r(compact('term','taxonomy'),true));
		return $term;
	}

	/**
	 * get_term_meta() - Get termmeta according to $lang (or default.)
	 */
	function get_term_meta_ml($term,$key,$single=true,$lang=false,$default=false){
		$suffix = $this->get_suffix();
		//if(isset($_GET['d']) && 'ถุงมือ'==$term->name) { die('<pre>'.print_r(compact('term','key','single','suffix'),true).'</pre>'); }
		if ($val = get_term_meta($term->term_id,$key.$this->get_suffix(),$single)) return $val;
		else return $term->name;
	}

	function get_field_lang($post,$fn,$lang=false,$default=''){ //if(isset($_GET['d'])) die($fn);
		if(false===$post) global $post;
		if(is_integer($post)) $post_id = $post; else $post_id = $post->ID; //Get the post_id
		if(is_admin() && !wp_doing_ajax()) $data = get_post_meta($post_id,$fn,true);
		//global $post;
		if(!empty($lang)) $lang_suffix = '_'.$lang; else $lang_suffix = '';
		if($val=get_post_meta($post_id,$fn.$lang_suffix,true)) $data = $val;

		if(empty($data)) return $default;

		//if(isset($_GET['d'])) die(print_r($data,true));
		return $data;
	}

	function woocommerce_product_additional_information($product){ //if(isset($_GET['d'])) die(__FILE__);
		return $this->the_content('',$product);
	}

	function woocommerce_cart_item_name($product_name, $cart_item, $cart_item_key){
		return $this->the_title($product_name,$cart_item['product_id']);
	}

	//function ajax_pre_process(){
	//	die('<pre>'.print_r($_REQUEST,true).'</pre>');
	//}

	//function filter_menu_lang($menu){
	//	//if('th'!=$this->get_current_lang()) $menu->title = __($menu->title,'gz_multilang');
	//	return $menu;
	//}

	//Replace with correct language if exists.
	function template_redirect(){
		global $post;
		//if ($data=get_post_meta($post->ID,'_post_content_'.$this->get_current_lang(),true)) $post->post_content = $data;
		//if ($data=get_post_meta($post->ID,'_post_excerpt_'.$this->get_current_lang(),true)) $post->post_excerpt = $data;
		if ($data=$this->get_field_lang($post,'post_content',$this->get_current_lang(),false)) $post->post_content = $data;
		if ($data=$this->get_field_lang($post,'post_excerpt',$this->get_current_lang(),false)) $post->post_excerpt = $data;
	}


	///////////////////////
	// Woocommerce
	//

	//function woocommerce_cart_shipping_method_full_label($label, $method){//ob_clean(); die($label);
	//	if(strpos($label,'COD')) {ob_clean(); die(__($label,$this->text_domain));}
	//	return __($label,$this->text_domain);
	//}

	/**
	 * Translate payment gateway title (e.g. 'Direct Bank Transfer')
	 *
	 * @param [type] $title
	 * @param [type] $id
	 * @return translated title
	 */
	function woocommerce_gateway_title($title,$id){
		$this->load_translations();
		return __($title,$this->text_domain);
	}

	/**
	 * Translate payment gateway description (e.g. 'mv_text_direct_bank_transfer_description')
	 *
	 * @param [type] $description
	 * @param [type] $id
	 * @return translatre description
	 */
	function woocommerce_gateway_description($description,$id){ //return $description;
		//ob_clean(); die($this->get_current_lang()); die($description);
		$this->load_translations();
		return __($description,$this->text_domain);
	}

	function woocommerce_shipping_rate_label($label,$obj){
		$this->load_translations();
		return __($label,$this->text_domain);
	}

	function woocommerce_shop_loop_item_title(){
		echo $this->get_product_title();
	}

	function woocommerce_single_product_summary(){
		echo $this->get_product_title();
	}

	function set_cookie($key,$val,$dur=60*60*24*355){
		setcookie($key,$val,time()+$dur, '/', $_SERVER['HTTP_HOST']); $_COOKIE[$key] = $val;
		//if(isset($_GET['d'])) { die('<pre>'.$_SERVER['HTTP_HOST'].'</pre>'); }
	}

	/*
	function set_lang($lang=''){
		global $gz_locale;
		if(is_admin()) return;
		switch($lang){
			case 'en': $lang='en'; $gz_locale='en_US'; break;
			case 'th': $lang='th'; $gz_locale='th_TH'; break;
			default: $lang='th'; $gz_locale='th_TH';
		}
		//if(isset($_GET['d'])) { die('<pre>'.print_r(compact('lang','gz_locale'),true).'</pre>'); }
		$this->set_cookie('gz_lang',$lang);
		$this->set_cookie('wp_lang',$lang);
		$this->set_cookie('gz_locale',$gz_locale);
		$rs = switch_to_locale($gz_locale);
	}
	*/

	function show_debug_lang(){
		echo '<pre>'.print_r([
			'is_admin()'		=> is_admin(),
			'wp_doing_ajax()'	=> wp_doing_ajax(),
			'$_GET["lang"]'		=> isset($_GET['lang'])?$_GET['lang']:'n/a',
			'$_COOKIE["gz_locale"]'	=> $_COOKIE["gz_locale"],
			'$_COOKIE["gz_lang"]'	=> $_COOKIE["gz_lang"],
			//'get_current_user_id()'	=> get_current_user_id(),
			//'get_user_option()'		=> get_user_option( 'user_lang_pref', 1 ),
			//'$this->get_locale()'	=> $this->get_locale(),
			//'get_locale()'			=> get_locale(),
			//'get_current_lang()'	=> $this->get_current_lang(),
		],true).'</pre>';
	}
	///////////////////////////////////////////
}


