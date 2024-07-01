<?php
	set_query_var('paged', false);
	if($tax_name == "product_cat"){
		mafoil_woocommerce_breadcrumb();
	}else{
		$list = "";
		$home = home_url( '/' );
		$delimiter = '<span class="delimiter"></span>';
		$before = '<span class="current">';
		$after = '</span> ';
		echo '<div id="breadcrumb" class="breadcrumb">';
			echo '<div class="bwp-breadcrumb">';
				if ($tax_name && $id_taxonomy){
					$ans = get_term_by('id', $id_taxonomy, $tax_name);
					$parentID=$ans->parent;
					$taxonomy_details = get_taxonomy( $tax_name );
					while ($parentID > 0){
						$parent = get_term_by('id', $parentID, $tax_name);
						$url = $home."/".$tax_name."/".$parent->slug;
						$list = "<a href='".$url."'>".$parent->name."</a>".wp_kses($delimiter,'social').$list;
						$parentID = $parent->parent;
					}
					$url = $home."/".$tax_name."/".$ans->slug;
					$list = $list.wp_kses($before,'social').$ans->name.wp_kses($after,'social');
				}
				if ($list) echo '<a href="'.esc_url( $home ).'">'.esc_html__('Home','wpbingo').'</a>'.wp_kses($delimiter,'social').esc_html($taxonomy_details->labels->singular_name) . '</a>' . wp_kses($delimiter,'social').$list;
			echo '</div>';
		echo '</div>';
	}
?>