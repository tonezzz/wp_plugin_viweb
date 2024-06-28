(function($){
	$('document').ready(function(){ //console.log('Hello');
		//init_slide_menu_panel();
		//init_mmenu();
		init_bank_logo();
		//add_menu_trigger();
		//init_jpanelmenu();
		init_related_products();
	});
	
	function init_related_products(){
		$('section.related.products').addClass('columns-4');
	}
	
	function add_menu_trigger(){ //console.log($('div.jPanelMenu-panel'));
		//if($('div.jPanelMenu-panel').length==0) return; //Don't add if there's no sliding menu.
		if($(window).width()>=768) return;
		$("<div class='menu-trigger'>").appendTo('body');
	}
	
	function init_jpanelmenu(){ //console.log('init_panel');
		//console.log('init_jpanelmenu begin');
		if($(window).width()>=768) return; //Don't init if screen is wide enough
		var $panel = $('div#secondary'); if($panel.length==0) return; //Only init if the panel exist
		$(document).bind('mobileinit',function(){
			$.extend($.mobile,{
				ajaxFormsEnabled : false
				,ajaxLinksEnabled : false
				,ajaxEnabled : false
				,ignoreContentEnabled : true
				,pushStateEnabled : false
			});
		});
		//console.log('init_jpanelmenu middle');
		$.when(
			$.getScript('https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js')
			,$.getScript('/wp/wp-content/themes/rwh/libs/jquery_jpanelmenu_v1.4.1/jquery.jpanelmenu.js')
		).done(function(){
			//var $menu = $.jPanelMenu({menu:'div#secondary' ,clone:false ,trigger: '.menu-trigger'}); //console.log($menu);
			var $menu = $.jPanelMenu({menu:'div#secondary' ,clone:false}); //console.log($menu);
			$menu.on();
			$(window).on('swiperight',function(){$menu.open();});
			$(window).on('swipeleft',function(){$menu.close();});
		});
		//console.log('init_jpanelmenu end');
	}
	
	//Works for older version of Woocommerce
	function init_bank_logo_0(){
		var $items = $('div.woocommerce>h3'); //console.log($items);
		if($items.length>0) $items.each(function(idx,item){
			var $item = $(item); //console.log($item.text());
			if($item.text().indexOf('Bangkok Bank')>=0) {$item.next('ul.wc-bacs-bank-details').find('li.account_number').addClass('bank_logo bbl');} //console.log('bbl')}
			if($item.text().indexOf('Kasikorn Bank')>=0) {$item.next('ul.wc-bacs-bank-details').find('li.account_number').addClass('bank_logo ksb');} //console.log('ksb')}
			if($item.text().indexOf('Siam Commercial Bank')>=0) {$item.next('ul.wc-bacs-bank-details').find('li.account_number').addClass('bank_logo scb');} //console.log('ksb')}
		});
	}

	//20170428:Tony:Modified for new version
	function init_bank_logo(){
		var $section = $('section.woocommerce-bacs-bank-details'); if($section.length==0) return;
		$section.find('ul.bacs_details').each(function(idx,item){
			var $item = $(item); //console.log($item.text());
			if($item.text().indexOf('Bangkok Bank')>=0) {$item.addClass('bank_logo bbl');} //console.log('bbl')}
			if($item.text().indexOf('Kasikorn Bank')>=0) {$item.addClass('bank_logo ksb');} //console.log('ksb')}
			if($item.text().indexOf('Siam Commercial Bank')>=0) {$item.addClass('bank_logo scb');} //console.log('ksb')}
		});
	}
})(jQuery);

