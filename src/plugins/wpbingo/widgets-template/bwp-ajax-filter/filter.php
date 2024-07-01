<?php
	$relation = 'AND';
	$j = 0;
	if(!isset($chosen_attributes)){
		$chosen_attributes = array();
		if($attribute){
			foreach($attribute as $att){
				if(isset($_GET['filter_'.$att]) && $_GET['filter_'.$att]){
					$chosen_attributes['pa_'.$att]['terms'] = explode(',',$_GET['filter_'.$att]);
					$chosen_attributes['pa_'.$att]['query_type'] = 'and';
				}
				if($att){
					$j++;
				}
			}
		}					
		if(isset($_GET['min_price']) && $_GET['min_price']){
			$chosen_attributes['min_price'] = $_GET['min_price'];
		}
		if(isset($_GET['max_price']) && $_GET['max_price']){
			$chosen_attributes['max_price'] = $_GET['max_price'];
		}
	}
	//Tax Query	
	if(!isset($tax_query)){
		$taxonomy = get_query_var('taxonomy');
		$id_taxonomy = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : 0;
		if($id_taxonomy != 0){
			$tax_query = array(
				array(
					'taxonomy'      => $taxonomy,
					'field' 		=> 'term_id',
					'terms'         => $id_taxonomy,
					'operator'      => 'IN'
				)
			);
		}
		else
			$tax_query = array();
	}
	//Meta Query
	if(!isset($meta_query))
		$meta_query	= array();
	//Get Min Max Price
	if( !isset($default_min_price) || empty($default_min_price) || !isset($default_max_price) || empty($default_max_price) ){
		$prices = $this->get_filtered_price($meta_query,$tax_query);
		$default_min_price    = floor( $prices->min_price );
		$default_max_price    = ceil( $prices->max_price );
	}
	if($show_price){
		$j++;
	}
if($j>0){
?>
<div  class="widget bwp-filter-ajax grid-<?php echo esc_attr($j); ?>">
	<form id="bwp_form_filter_product">
	<?php
	//Filter Price
	if($show_price)
		$this->woocommerce_filter_price($chosen_attributes,$default_min_price,$default_max_price);
	//list atribute 
	if($attribute)
		$this->woocommerce_filter_atribute($attribute,$tax_query,$meta_query,$chosen_attributes,$relation,$showcount);
	?>
	</form>
</div>
<?php } ?>

