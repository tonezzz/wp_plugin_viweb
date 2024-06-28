<?php

class gz_menu_ml extends gz_tpl{
	public function __construct($text_domain=false){ //if(isset($_GET['d'])) die(__FILE__);
		$config = [
			'actions' => [
				['prm'=>['cmb2_admin_init',[$this,'init_menu_ml']]],
            ]
        ];
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
}