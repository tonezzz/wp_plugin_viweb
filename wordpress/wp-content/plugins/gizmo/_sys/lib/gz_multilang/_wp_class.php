<?php //die(__FILE__);
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
if(is_admin()){
	//include dirname(__FILE__)."/cmb2-nav-menus/cmb2-nav-menus.php";
	//include dirname(__FILE__)."/cmb2_nav_menus.php";
	//include dirname(__FILE__).'/sweet-custom-menu/custom_walker.php';
	//include dirname(__FILE__).'/sweet-custom-menu/edit_custom_walker.php';
}

class gz_multilang extends gz_tpl{
	public $the_content_off=false;
	private $is_load_theme_textdomain=false;
	private $text_domain='mafoil';

	public function __construct($text_domain=false){ //if(isset($_GET['d'])) die(__FILE__);
		if($text_domain) $this->text_domain = $text_domain;
		$config = [
			'enqueue'  => [
				//['type'=>'style' ,'load'=>true ,'prm'=>['font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css']],
				//['type'=>'style' ,'load'=>true ,'prm'=>[__CLASS__,'[REL_PATH]wp_style.scss'],['font-awesome']],
				['type'=>'script' ,'load'=>true ,'prm'=>[__CLASS__,'[REL_PATH]wp_script.js',['jquery-core']]],
				['type'=>'localize', 'prm'=>[__CLASS__,__CLASS__,[
					//'menu_lang'	=> $this->render_menu_lang(),
				]]]
			],
			'cmb2v2' => [
				['prm'=> [
					'id'					=> 'en',
					'title' 				=> __('English',$this->text_domain),
					'object_types'			=> ['post','page','product','nav_menu_item'],
					'context'				=> 'normal',
					'fields' 				=> [
						['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text'],
						//['id'=>'_post_sub_th' ,'name'=>__('Sub title (Thai)',$this->text_domain) ,'type'=>'textarea_small'],
						//['id'=>'_post_sub_en' ,'name'=>__('Sub title (English)',$this->text_domain) ,'type'=>'textarea_small'],
						['id'=>'post_content_en' ,'name'=>__('Post content (English)',$this->text_domain) ,'type'=>'wysiwyg'],
						['id'=>'post_excerpt_en' ,'name'=>__('Post excerpt (English)',$this->text_domain) ,'type'=>'wysiwyg'],
					]
				]],
				[
					'prm'=> [
						'id'					=> 'gz_term',
						'title' 				=> __('English',$this->text_domain),
						'object_types'			=> ['term'],
						'taxonomies'       		=> [ 'category', 'post_tag', 'product_cat' ],
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

				['prm'=>['the_title',[$this,'the_title'],10,2]],
				['prm'=>['the_content',[$this,'the_content'],10,2]],
				//['prm'=>['get_the_excerpt',[$this,'get_the_excerpt'],21,2]],
				['prm'=>['woocommerce_short_description',[$this,'get_the_excerpt'],21,2]],
				['prm'=>['get_term',[$this,'get_term'],10,2]],
				['prm'=>['locale',[$this,'get_locale']],10,1],
				//['prm'=>['theme_locale',[$this,'theme_locale'],10,2]],
				//['prm'=>['determine_locale',[$this,'determine_locale']]],
				//['prm'=>['pre_determine_locale',[$this,'get_locale'],10,1]],

				//['prm'=>['woocommerce_cart_shipping_method_full_label',[$this,'woocommerce_cart_shipping_method_full_label'],10,2]],
				//['prm'=>['woocommerce_shipping_rate_label',[$this,'woocommerce_shipping_rate_label'],10,2]],
				//['prm'=>['woocommerce_gateway_title',[$this,'woocommerce_gateway_title'],10,2]],
				//['prm'=>['woocommerce_gateway_description',[$this,'woocommerce_gateway_description'],10,2]],
				//['prm'=>['woocommerce_cart_item_name',[$this,'woocommerce_cart_item_name'],10,3]],

				//['prm'=>['wp_setup_nav_menu_item',[$this,'filter_menu_lang'],1]],
				//Old
				//['prm'=>['woocommerce_get_breadcrumb',[$this,'woocommerce_get_breadcrumb'],10,2]],
				//['prm'=>['woocommerce_before_main_content',[$this,'woocommerce_breadcrumb'],20,2]],
				//['prm'=>['woocommerce_before_main_content',[$this,'woocommerce_breadcrumb'],20]],
			],
			'remove_actions' => [
			],
			'actions' => [
				['prm'=>['cmb2_admin_init',[$this,'cmb2_admin_init']]],
				['prm'=>['cmb2_init',[$this,'cmb2_init']]],
				//['prm'=>['woocommerce_product_additional_information',[$this,'woocommerce_product_additional_information'],21,2]],
				//['prm'=>['init',[$this,'init_lang'],0]],
				///['prm'=>['template_redirect',[$this,'template_redirect'],0]],
				//['prm'=>['after_setup_theme',[$this,'load_translations']]],
				//['prm'=>['admin_init',[$this,'ajax_pre_process'],10,2]],
				//['prm'=>['storefront_page',[$this,'storefront_page_content'],20]],
				//['prm'=>['woocommerce_shop_loop_item_title',[$this,'woocommerce_shop_loop_item_title'],10]],
				//['prm'=>['woocommerce_single_product_summary',[$this,'woocommerce_single_product_summary'],5]],
			],
			'shortcodes' => [
				//['prm'=>['mv_text',[$this,'mv_text']]],
			],
		];
		parent::__construct($config);
		//add_action('init',[$this,'after_setup_theme'],10,2);
	}

	/**
	 * Adding language support fields to each menu item.
	 */
	function cmb2_admin_init(){
		$this->cmb2_menu_item_prm = [
			'id'					=> 'gz_menu_item',
			'title' 				=> __('English',$this->text_domain),
			'object_types'			=> ['nav_menu_item'],
			'fields' 				=> [
				['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text'],
			]
		];
		$this->cmb2_menu_item = new CMB2($this->cmb2_menu_item_prm);
		add_action('wp_nav_menu_item_custom_fields',[$this,'wp_nav_menu_item_custom_fields'],10,4);
		add_action('wp_update_nav_menu_item',[$this,'wp_update_nav_menu_item'],10,3);
	}
	function cmb2_init(){
		add_filter('nav_menu_item_title',[$this,'nav_menu_item_title'],10,4);
	}
	//function wp_nav_menu_item_custom_fields($item_id, $menu_item, $depth, $args, $current_object_id ) {
	function wp_nav_menu_item_custom_fields($item_id, $menu_item, $depth, $args ) {
		cmb2_print_metabox_form('gz_menu_item');
	}
	function wp_update_nav_menu_item($menu_id, $menu_item_db_id, $menu_item_args) { //return;
		if (defined('DOING_AJAX') && DOING_AJAX) return;

		if (!isset($_GET['edit-menu-item'])) return;
		check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');
		$metas = [];
		foreach($this->cmb2_menu_item_prm['fields'] as $field){
			$metas[$field['id']] = isset($_POST[$field['id']])?$_POST[$field['id']]:'';
		}
		$rs = wp_update_post( ['ID'=>$menu_item_db_id,'meta_input'=>$metas] );
	}
	function nav_menu_item_title( string $title, WP_Post $menu_item, stdClass $args, int $depth ){
		if(isset($_GET['d'])) die('<pre>'.print_r(compact('title','menu_item','args','depth'),true));
		return "Hello";
		return $title;
	}
	/**/

	function after_setup_theme(){//die(__FILE__);
		$this->init_locale();
		$this->load_translations(true);
		//remove_action( 'storefront_page', 'storefront_page_content', 20);
	}

	function get_locale($locale=false){
		$locale = isset($_COOKIE['gz_locale'])?$_COOKIE['gz_locale']:'th_TH';
		//if(isset($_GET['d'])) die("<pre>".print_r($locale));
		return $locale;
	}

	/**
	 * load_child_theme_textdomain($this->text_domain,get_stylesheet_directory().'/languages');
	 */
	function load_translations($force=false){
		if(is_admin()) return;
		$lang_dir = WP_CONTENT_DIR."/languages/loco/";
		$rs = load_theme_textdomain('mafoil',$lang_dir.'themes/');
		$rs = load_plugin_textdomain('woocommerce',false,$lang_dir.'plugins/');
		//$st[0] = esc_html_e( 'Out of order', 'woocommerce' );
		//if(isset($_GET['d'])) die('<pre>'.print_r($st,true));

		//if(isset($_GET['d'])) die('<pre>'.print_r([true,false,null,$rs],true));
		//$locale = apply_filters( 'theme_locale', determine_locale(), $this->text_domain );
		//if(isset($_GET['d'])) die($locale);
		//if(isset($_GET['d'])) die(determine_locale());
		//$lang_dir = WP_CONTENT_DIR."/languages/loco/themes/";
		//if(isset($_GET['d'])) die($this->text_domain."   ".$lang_dir);
		//if(isset($_GET['d'])) die($this->is_load_theme_textdomain);
		//if($force || !$this->is_load_theme_textdomain){
		//	update_option('template',$this->text_domain);
		//	$rs = load_theme_textdomain($this->text_domain,$lang_dir);
			//if(isset($_GET['d'])) die('<pre>'.print_r($rs,true));
		//}
	}

	/*
	* If there's meta _post_title_en then return it, otherwise return the original title;
	* https://developer.wordpress.org/reference/functions/get_the_title/
	*/
	function the_title($title,$post=false){ //if(isset($_GET['d'])) die($this->get_current_lang());
		if (empty($this->get_suffix())) return $title;
		$title = $this->get_field_lang($post,'post_title',$this->get_current_lang(),$title); //die($excerpt);
		return $title;
	}
	
	function the_content($content,$post=false){ //if(isset($_GET['d'])) die(__FILE__);
		if (empty($this->get_suffix())) return $content;
		$content = $this->get_field_lang($post,'post_content',$this->get_current_lang(),$content); //die($excerpt);
		return $content;
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

	function get_term($term, $taxonomy){ //if(isset($_GET['d'])) return "xxx";
		if (empty($this->get_suffix())) return $term;
		$term->name = $this->get_term_meta($term,'name',$this->get_current_lang());
		$term->description = $this->get_term_meta($term,'description',$this->get_current_lang());
		//die('<pre>'.print_r($_term,true).print_r($taxonomy,true));
		return $term;
	}

	function get_term_meta($term,$key,$single=false,$lang=false,$default=false){
		if ($val = get_term_meta($term->id,$key.$this->get_suffix(),$single)) return $val;
		return $term->key;
		//if(isset($_GET['d'])) die('<pre>'.print_r(compact('term','val'),true));
		//return $term->key;
		//if(term-)
		/*
		if(false===$post) global $post;
		if(is_integer($post)) $post_id = $post; else $post_id = $post->ID; //Get the post_id
		if(is_admin() && !wp_doing_ajax()) $data = get_post_meta($post_id,$fn,true);
		//global $post;
		if($val=get_post_meta($post_id,$fn.'_'.$lang,true)) $data = $val;

		if(empty($data)) return $default;

		//if(isset($_GET['d'])) die(print_r($data,true));
		return $data;
		*/
	}

	function get_field_lang($post,$fn,$lang,$default=''){ //if(isset($_GET['d'])) die($fn);
		if(false===$post) global $post;
		if(is_integer($post)) $post_id = $post; else $post_id = $post->ID; //Get the post_id
		if(is_admin() && !wp_doing_ajax()) $data = get_post_meta($post_id,$fn,true);
		//global $post;
		if($val=get_post_meta($post_id,$fn.'_'.$lang,true)) $data = $val;

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
	  
	///////////////////////
	//Initializing functions
	//

	/*
	 * 1. Use locale param if availabe.  Also update user_lang_pref if login.
	 * 2. Use loale from user_lang_pref if login.
	*/
	function init_locale(){
		if(isset($_GET['lang'])){ //"lang=th or lang=en"
			$lang = $_GET['lang'];
			//if($user_id=get_current_user_id()) update_user_option($user_id,'user_lang_pref',$locale);
			//$this->is_load_theme_textdomain = false; //Clear theme textdomain flag for reloading
		}else{
			//$lang = "th";
			//if($user_id=get_current_user_id()) $locale = get_user_option('user_lang_pref',$user_id );
			$lang = isset($_COOKIE['gz_lang'])?$_COOKIE['gz_lang']:"";
		}
		$this->set_lang($lang);
	}

	function set_lang($lang=''){
		global $gz_locale;
		if(is_admin()) return;
		switch($lang){
			case 'en': $lang='en'; $gz_locale='en_US'; break;
			case 'th': $lang='th'; $gz_locale='th_TH'; break;
			default: $lang='th'; $gz_locale='th_TH';
		}
		setcookie('gz_lang',$lang,time()+60*60*24*355); $_COOKIE['gz_lang'] = $lang;
		setcookie('wp_lang',$lang,time()+60*60*24*355); $_COOKIE['wp_lang'] = $lang;

		setcookie('gz_locale',$gz_locale,time()+60*60*24*355); $_COOKIE['gz_locale'] = $gz_locale;
		//if(isset($_GET['d'])) die('<pre>'.print_r(compact('gz_locale','lang'),true));
		$rs = switch_to_locale($gz_locale);
		//$rs = switch_to_locale('th_TH');
		$locale = apply_filters( 'theme_locale', determine_locale(), $this->text_domain );
		//if(isset($_GET['d'])) die($locale);
		//if(isset($_GET['d'])) die('<pre>'.print_r(compact('locale','lang','rs'),true));
		//$this->load_translations();
	}

	function get_current_lang(){
		if (isset($_GET['lang'])) $lang = $_GET['lang'];
		elseif (isset($_COOKIE['gz_lang'])) $lang = $_COOKIE['gz_lang'];
		else $lang = "th";
		return $lang;
	}

	function get_suffix(){
		if($_COOKIE['gz_lang']=='th') $suffix = '';
		else $suffix = '_'.$_COOKIE['gz_lang'];
		//if(isset($_GET['d'])) die('<br>'.print_r(compact('suffix'),true));
		return $suffix;
	}
	function theme_locale($locale=false,$domain=false){
		$locale = isset($_COOKIE['gz_locale'])?$_COOKIE['gz_locale']:'th_TH';
		//if(isset($_GET['d'])) die("<pre>".print_r($locale));
		return $locale;
	}
	function determine_locale($locale){
		$locale = isset($_COOKIE['gz_locale'])?$_COOKIE['gz_locale']:'th_TH';
		return $locale;
	}
	function pre_determine_locale(){
		$locale = isset($_COOKIE['gz_locale'])?$_COOKIE['gz_locale']:'th_TH';
		return $locale;
	}

	//
	//Support functions
	//
	function mv_text($atts,$content=null){//die('='.__($content,$this->text_domain).'=');
		$atts = shortcode_atts([
			'domain' 	=> $this->text_domain
		],$atts,'mv_text');
		extract($atts, EXTR_PREFIX_ALL,'att');
		$this->load_translations();
		$html = '';
		$html.= __($content,$att_domain);
		return $html;
	}

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
	// Unused
	/*
	//Get specific language from Valexar string
	function valexar_text_lang($txt,$lang,$default){
		$ts = $this->split_langs($txt); //ob_clean(); die('<pre>'.print_r($titles,true));
		return isset($ts[$lang])?$ts[$lang]:$default;
	}
	*/

	/*
	function woocommerce_get_breadcrumb($crumbs,$breadcrumb){
		//$lang = $this->get_current_lang();
		//foreach($crumbs as &$item){
		//	$arr = $this->split_langs($item[0]);
		//	$item[0] = isset($arr[$lang])?$arr[$lang]:$item[0];
		//}
		return $crumbs;
		//die('<pre>'.print_r($crumbs,true).print_r($breadcrumb,true));
	}
	*/

	/*
	function woocommerce_breadcrumb(){
		global $crumbs,$breadcrumb;
		die('<pre>'.print_r($crumbs,true).print_r($breadcrumb,true));
	}
	*/

	/*
	function get_product_title(){
		$titles = $this->split_langs(get_the_title()); //ob_clean(); die('<pre>'.print_r($titles,true));
		$lang = $this->get_current_lang();
		return isset($titles[$lang])?$titles[$lang]:get_the_title();
	}
	*/

	/*
	function split_langs($st,$langs=['th','en']){
		$arr = explode('[:',$st);
		$rs = [];
		foreach($arr as $item){
			$ss = substr($item,3);
			if(strlen($ss)>0) $rs[substr($item,0,2)] = $ss;
		}
		return $rs;
	}
	*/

	/*
  	function render_menu_lang(){
		$langs = [
			'th' 	=> 'ไทย',
			'en'	=> 'English',
		];
		$cl = $this->get_current_lang();
		$html = '';
		$html.= "<a cl='{$cl}'>".$langs[$cl]."</a>";
		$langs[$cl] = null;
		$html.= "<ul class='sub-menu'>";
		foreach($langs as $k=>$item){
			$html.= "<li class='menu-item'>";
			#$url = admin_url('admin-ajax.php').'?lang='.$k;
			$url = '?lang='.$k;
			$html.= "<a href='{$url}'>".$item."</a>";
			$html.= "</li>";
		}
		$html.= "</ul>";
		return $html;
	}
	*/

}


