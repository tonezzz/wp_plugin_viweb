(function($){
	$('document').ready(function(){
		init_menu_lang();
		//init_tinymce_block();
	});

	function init_menu_lang(){
		var lang = $.cookie('gz_lang'); console.log("b4="+lang);
		$('.fl').css({ opacity: .5 });
		$('.fl.'+lang).css({ opacity: 1 });
		//$('.gz_menu_lang_switcher').html(gz_multilang.menu_lang);
		$('.fl').click(function(){
			var lang = $(this).attr('data-lang'); //console.log("af="+lang);
			$.cookie('gz_lang',lang); //console.log($.cookie('gz_lang'));
			$('body').fadeOut('slow');
		});
	}

	function init_tinymce_block(){
		tinymce.init({
			selector: 'textarea',  // change this value according to your HTML
			plugins: 'visualblocks',
			menubar: 'view',
			toolbar: 'visualblocks',
			visualblocks_default_state: true
		  });
		}
		console.log('tinyMCE');
})(jQuery);

