<?php

class gz_quickedit_ml extends gz_tpl{
	public function __construct($text_domain=false){ //if(isset($_GET['d'])) die(__FILE__);
		$this->text_domain = $text_domain;
		$this->init();
    }
/**
	 * Adding language support fields to each menu item.
	 */
	function init(){
		//die(__FILE__);
		//$this->cmb2_menu_items = [];
		$this->cmb2_quickedit_prm = [
			'id'					=> 'gz_quickedit',
			'title' 				=> __('GZML',$this->text_domain),
			'object_types'			=> ['product'],
			'save_fields'           => true,
			'fields' 				=> [
				['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text' ],
				//['id'=>'post_title_en' ,'name'=>__('Title (English)',$this->text_domain) ,'type'=>'text' ,'default_cb'=>[$this,'get_field']],
			]
		];
		add_action('quick_edit_custom_box',[$this,'quickedit_custom_fields'],10,4);
		//add_action('woocommerce_product_quick_edit_save',[$this,'wp_update_nav_menu_item'],10,3);
	}
	
	function quickedit_custom_fields($column_name, $post_type){ //if(!isset($_GET['d'])) return;
		//die(__FILE__);
		$html = "";
		$html.= "<div>";
		if(isset($_GET['d'])) $html.= '<pre>'.print_r(compact('column_name','post_type'),true).'</pre>';
		$html.= "</div>";
		echo $html;
	}

	function get_field($field_array,$field_obj){
		//if(isset($_GET['d'])) { ob_clean(); die('<pre>'.print_r(compact('field_array','field_obj'),true)); }	
	}
	//function nav_cmb2_init(){}
	function quickedit_custom_fieldsx($item_id, $menu_item, $depth, $args ) {
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