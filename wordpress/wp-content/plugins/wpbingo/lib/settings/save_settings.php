<?php
	add_action('redux/options/mafoil_settings/saved', 'mafoil_save_theme_settings', 10, 2);
	use Leafo\ScssPhp\Compiler;
	use Leafo\ScssPhp\Server;	
	function mafoil_save_theme_settings() {
		global $mafoil_settings;
		$reduxmafoilSettings = new Redux_Framework_mafoil_settings();
		$reduxFramework = $reduxmafoilSettings->ReduxFramework;
		if (isset($mafoil_settings['compile-css']) && $mafoil_settings['compile-css']) {
			require_once( dirname(__FILE__) . '/scssphp/scss.inc.php');			
			ob_start();
            $sassDir = get_template_directory().'/sass/';
            $cssDir = get_template_directory().'/css/';
            $variables = '';
            if (is_writable($sassDir) == false){
                @chmod($sassDir, 0755);
            }
            $scss = new Compiler();
            $scss->addImportPath($sassDir);
			$variables = '$theme-color: '.$mafoil_settings['main_theme_color'].';';
			$string_sass = $variables . file_get_contents($sassDir . "template.scss");
			$string_css = $scss->compile($string_sass);
			file_put_contents($cssDir . 'template.css', $string_css);			
		}	
	}
?>