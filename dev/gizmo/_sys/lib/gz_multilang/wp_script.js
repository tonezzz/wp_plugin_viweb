(function($){
	$('document').ready(function(){
		init_menu_lang();
		//init_tinymce_block();
	});

	function init_menu_lang(){
		var lang = location.pathname.split("/")[1]; if('en'!==lang) lang='th';
		//Highlight flag
		$('.fl').css({ opacity: .5 });
		$('.fl.'+lang).css({ opacity: 1 });
		//Gen url
		var url = location.pathname.replace('/en/','/');
		url.replace('/en/','/');
		$('.fl.en').attr('href','/en'+url)
		$('.fl.th').attr('href',''+url)
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

