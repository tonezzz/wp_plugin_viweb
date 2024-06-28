<?php 
	get_header(); 
	$mafoil_settings = mafoil_global_settings();
?>
<div class="page-404">
	<div class="content-page-404">
		<div class="title-error">
			<?php if(isset($mafoil_settings["title-error"]) && $mafoil_settings["title-error"]){
				echo esc_html($mafoil_settings["title-error"]);
			}else{
				echo esc_html__("404", "mafoil");
			}?>
		</div>
		<div class="sub-title">
			<?php if(isset($mafoil_settings["sub-title"]) && $mafoil_settings["sub-title"]){
				echo esc_html($mafoil_settings["sub-title"]);
			}else{
				echo esc_html__("Oops! That page can't be found.", "mafoil");
			}?>
		</div>
		<div class="sub-error">
			<?php if(isset($mafoil_settings["sub-error"]) && $mafoil_settings["sub-error"]){
				echo esc_html($mafoil_settings["sub-error"]);
			}else{
				echo esc_html__("We're really sorry but we can't seem to find the page you were looking for.", "mafoil");
			}?>
		</div>
		<a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">
			<?php if(isset($mafoil_settings["btn-error"]) && $mafoil_settings["btn-error"]){
				echo esc_html($mafoil_settings["btn-error"]);}
			else{
				echo esc_html__("Back The Homepage", "mafoil");
			}?>
		</a>
	</div>
</div>
<?php
get_footer();