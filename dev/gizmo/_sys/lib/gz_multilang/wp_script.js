(function($){
	$('document').ready(function(){
		console.log($.cookie('gz_lang'));
		//test_cookie();
		init_menu_lang();
		//init_tinymce_block();
	});

	function test_cookie(){
		var c=[];
		c.push($.cookie('gz_lang'));
		$.cookie('gz_lang','th')
		c.push($.cookie('gz_lang'));
		console.log(c);
	}

	function init_menu_lang(){
		var c=[]; c.push($.cookie('gz_lang'));
		var lang = $.cookie('gz_lang');
		$('.fl').css({ opacity: .5 });
		$('.fl.'+lang).css({ opacity: 1 });
		//$('.gz_menu_lang_switcher').html(gz_multilang.menu_lang);
		$('.fl').click(function(){
			var lang = $(this).attr('data-lang'); c.push(lang);
			$.cookie('gz_lang',lang); c.push($.cookie('gz_lang')); console.log(c);
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

