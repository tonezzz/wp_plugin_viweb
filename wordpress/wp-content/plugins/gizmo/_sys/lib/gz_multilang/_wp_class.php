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
				['type'=>'script' ,'load'=>true ,'prm'=>[__CLASS__,'[REL_PATH]wp_script.js',['jquery-core']]],
				//['type'=>'localize', 'prm'=>[__CLASS__,__CLASS__,[
					//'menu_lang'	=> $this->render_menu_lang(),
				//]]]
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
				['prm'=>['the_content',[$this,'the_content'],20,2]],
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
				['prm'=>['wp_footer',[$this,'wp_footer'],20]],
				//['prm'=>['wpautop','wpautop']],
			],
			'actions' => [
				['prm'=>['after_setup_theme',[$this,'after_setup_theme']]],
				['prm'=>['cmb2_admin_init',[$this,'nav_cmb2_admin_init']]],

				//['prm'=>['get_footer',[$this,'get_footer']]],
				['prm'=>['quick_edit_custom_box',[$this,'quick_edit_custom_box'], 10, 2]],
				['prm'=>['init',[$this,'load_translations']]],
				['prm'=>['admin_menu',[$this,'admin_menu']]],

				//['prm'=>['woocommerce_product_additional_information',[$this,'woocommerce_product_additional_information'],21,2]],
				//['prm'=>['init',[$this,'init_lang'],0]],
				///['prm'=>['template_redirect',[$this,'template_redirect'],0]],
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
		//$this->nav_cmb2_admin_init();
		//$this->nav_cmb2_init();
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
	
	function wp_footer( string $name=null, array $args=[] ) { //die(__FILE__);
		//if(isset($_GET['d'])) { die('<pre>'.print_r(compact('name','args'),true).'</pre>'); }
		return false;
	}

	function quick_edit_custom_box($column_name, $post_type){ return;
		$html = "";
		$html.= "<div>";
		if(isset($_GET['d'])) $html.= '<pre>'.print_r(compact('column_name','post_type'),true).'</pre>';
		$html.= "</div>";
		echo $html;
	}

	/**
	 * Adding language support fields to each menu item.
	 */
	function nav_cmb2_admin_init(){
		//$this->cmb2_menu_items = [];
		$this->cmb2_menu_item_prm = [
			'id'					=> 'gz_menu_item',
			'title' 				=> __('English',$this->text_domain),
			'object_types'			=> ['nav_menu_item'],
			'save_fields'           => true,
			'fields' 				=> [
				['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text' ],
				//['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text' ,'default_cb'=>[$this,'get_field']],
			]
		];
		add_action('wp_nav_menu_item_custom_fields',[$this,'wp_nav_menu_item_custom_fields'],10,4);
		add_action('wp_update_nav_menu_item',[$this,'wp_update_nav_menu_item'],10,3);
	}
	function get_field($field_array,$field_obj){
		//if(isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('field_array','field_obj'),true)); }	
	}
	//function nav_cmb2_init(){}
	function wp_nav_menu_item_custom_fields($item_id, $menu_item, $depth, $args ) {
		$cmb2_menu_item_prm = $this->cmb2_menu_item_prm;
		$cmb2_menu_item = new CMB2($cmb2_menu_item_prm,$item_id);

		$field_name = 'post_title_en';
		$field = $cmb2_menu_item->get_field($field_name);
		if($value=get_post_meta($item_id,$field_name,true))	$field->args['value'] = $value;
		//$field->args['_id'] 	= $field_name.'_'.$item_id;
		//$field->args['_name']	= $field_name.'['.$item_id.']';
		//$this->cmb2_menu_items[$item_id] = $cmb2_menu_item;
		cmb2_print_metabox_form($cmb2_menu_item,$item_id);
		//if(isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('item_id','menu_item','depth','args','field_name','value'),true)); }
	}
	function wp_update_nav_menu_item($menu_id, $menu_item_db_id, $menu_item_args) { //die(__FILE__);
		//if(1 || isset($_POST['edit-menu-item']) && ($_POST['edit-menu-item']==43635) ) { ob_clean(); die('<pre>'.print_r($_POST,true).print_r(compact('menu_id','menu_item_db_id','menu_item_args'),true)); }
		//ob_clean(); die('<pre>'.print_r($_POST['post_title_en'],true));

		if (defined('DOING_AJAX') && DOING_AJAX) return;

		//if (!isset($_GET['edit-menu-item'])) return;
		check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');
		if(is_array($data=$_POST['post_title_en'])) foreach($data as $id=>$value){
			//{ ob_clean(); die('<pre>'.print_r($id,true)); }
			//update_post_meta($id,'post_title_en',$value);
		}
	}
	/*
	function wp_nav_menu_items( string $items, stdClass $args ){
		//if(is_admin()) return $title;
		//if(isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('items','args'),true)); }
		return "Hello";
		return $title;
	}
	*/
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
		if(is_admin() && !wp_doing_ajax()) return;
		//if(is_admin()) return;
		$path = WP_CONTENT_DIR."/languages/loco/";
		//$rs = load_theme_textdomain('mafoil',$lang_dir.'themes/');
		//$rs = load_plugin_textdomain('contact-form-7',false,$lang_dir.'plugins/');
		//$rs = load_plugin_textdomain('woocommerce',false,$lang_dir.'plugins/');
		if($this->get_current_lang()!='en'){
			$lang = $this->get_current_lang();
			$loaded = load_textdomain('mafoil',$path."themes/mafoil-{$lang}.mo");
			$loaded = load_textdomain('woocommerce',$path."plugins/woocommerce-{$lang}.mo");
			$loaded = load_textdomain('contact-form-7',$path."plugins/contact-form-7-{$lang}.mo");
			//$loaded = load_textdomain('localizationsample',$path."plugins/localizationsample-{$lang}.mo");
		}
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
		if($_COOKIE['gz_lang']=='th') $suffix = '';
		else $suffix = '_'.$_COOKIE['gz_lang'];
		return $suffix;
	}

	/**
	 * Elementor = no wpautop
	 * Otherwise = wpautop
	 */
	function the_content($content,$post=false){ //if(isset($_GET['d'])) die(__FILE__);
		if(is_admin() || wp_doing_ajax()) return $content;

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
		$slug_lang = $slug.'_'.$_COOKIE['gz_lang'];
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

	function get_term($term, $taxonomy){
		if('product_cat'!==$taxonomy) return $term; //if(isset($_GET['d'])) die('<pre>'.print_r(compact('term','taxonomy'),true));
		if (empty($this->get_suffix())) return $term;
		$term->name = $this->get_term_meta($term,'name',$this->get_current_lang());
		$term->description = $this->get_term_meta($term,'description',$this->get_current_lang());
		//die('<pre>'.print_r($_term,true).print_r($taxonomy,true));
		return $term;
	}

	/**
	 * get_term_meta() - Get termmeta according to $lang (or default.)
	 */
	function get_term_meta($term,$key,$single=false,$lang=false,$default=false){
		if ($val = get_term_meta($term->id,$key.$this->get_suffix(),$single)) return $val;
		else return $term->$key;
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
	  
	///////////////////////
	//Initializing functions
	//

	/*
	 * 1. Use locale param if availabe.  Also update user_lang_pref if login.
	 * 2. Use loale from user_lang_pref if login.
	*/
	function init_locale(){
		if(is_admin() && !wp_doing_ajax()) return;

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


