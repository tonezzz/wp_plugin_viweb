<?php
class bwp_ajax_filter_widget extends WP_Widget {

	function __construct(){
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'bwp_ajax_filte', 'description' => __('Allows you to filter atribute,price products', 'wpbingo') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bwp_ajax_filte' );

		/* Create the widget. */
		parent::__construct( 'bwp_ajax_filte', __('Wpbingo Ajax Filter', 'wpbingo'), $widget_ops, $control_ops );
		add_action('admin_enqueue_scripts', array( $this, 'bwp_filter_admin_script' ) );
		add_action('woocommerce_before_shop_loop', array( $this, 'bwp_filter_title'), 45);
		/* Ajax Call*/
		add_action( 'wp_ajax_bwp_filter_products_callback', array( $this, 'bwp_filter_products_callback') );
		add_action( 'wp_ajax_nopriv_bwp_filter_products_callback', array( $this, 'bwp_filter_products_callback') );
	}
	function bwp_filter_title(){
		$chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$meta_query	= WC()->query->get_meta_query();
		$tax_query = WC()->query->get_tax_query();
		$prices = $this->get_filtered_price($meta_query,$tax_query);
		$default_min_price    = floor( $prices->min_price );
		$default_max_price    = ceil( $prices->max_price );
		$min_price = get_query_var('min_price') ? get_query_var('min_price') : $default_min_price;
		$max_price = get_query_var('max_price') ? get_query_var('max_price') : $default_max_price;
		?>
			<div class="woocommerce-filter-title">
			<?php
			$check = false;
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			if($attribute_taxonomies){
				foreach ( $attribute_taxonomies as $attribute ) : $taxonomy     = wc_attribute_taxonomy_name( $attribute->attribute_name ); ?>
					<?php if( isset( $chosen_attributes[ $taxonomy ]['terms'] ) && $chosen_attributes[ $taxonomy ]['terms'] ): $check = true; ?>
						<?php foreach( $chosen_attributes[ $taxonomy ]['terms'] as $term ): ?>
							<?php $value = get_term_by('slug', $term , $taxonomy); ?>
							<span data-name="<?php echo esc_attr($taxonomy); ?>" data-value="<?php echo esc_attr($term); ?>"><?php echo esc_html($value->name); ?></span>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach;
			}
			?>
			<?php if(($min_price && ($min_price != $default_min_price)) || ($max_price && ($max_price != $default_max_price))): $check = true; ?>
				<span class="text-price"><?php echo wc_price($min_price); ?> - <?php echo wc_price($max_price); ?></span>
			<?php endif; ?>
			<?php if($check): ?>
			<button class="filter_clear_all" type="button"><?php echo esc_html__( 'Clear All', 'wpbingo' ); ?></button>
			<?php endif;		
		?>
		</div>
		<?php
	}
	function bwp_filter_products_callback(){
		global $wpdb;
		$dir =	WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter/default_ajax.php';
		include $dir;
	}	

	function bwp_filter_admin_script(){
		wp_enqueue_style( 'wp-color-picker' );
	}
	/**
	 * Display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract($args);
		echo $before_widget;
		$title1 = apply_filters( 'widget_title', empty( $instance['title1'] ) ? '' : $instance['title1'], $instance, $this->id_base );
		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
			_e('Please active woocommerce plugin or install woomcommerce plugin first!', 'wpbingo');
			return false;
		}
		extract($instance);

		if ( $tpl = $this->getTemplatePath( 'default' ) ){ 
			$link_img = plugins_url('images/', __FILE__);		
			include $tpl;
		}
				
		/* After widget (defined by themes). */
		echo $after_widget;
	}    
	
	protected function get_current_term_slug() {
		return absint( is_tax() ? get_queried_object()->slug : 0 );
	}

	protected function get_current_term_id() {
		return absint( is_tax() ? get_queried_object()->term_id : 0 );
	}	
	
	protected function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type,$tax_query,$meta_query ) {
		global $wpdb;

		if ( 'or' === $query_type ) {
			foreach ( $tax_query as $key => $query ) {
				if ( $taxonomy === $query['taxonomy'] ) {
					unset( $tax_query[ $key ] );
				}
			}
		}

		$meta_query      = new WP_Meta_Query( $meta_query );
		$tax_query       = new WP_Tax_Query( $tax_query );
		$meta_query_sql  = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql   = $tax_query->get_sql( $wpdb->posts, 'ID' );

		// Generate query
		$query           = array();
		$query['select'] = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
		$query['from']   = "FROM {$wpdb->posts}";
		$query['join']   = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql['join'] . $meta_query_sql['join'];
		$query['where']   = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'
			" . $tax_query_sql['where'] . $meta_query_sql['where'] . "
			AND terms.term_id IN (" . implode( ',', array_map( 'absint', $term_ids ) ) . ")
		";
		$query['group_by'] = "GROUP BY terms.term_id";
		$query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
		$query             = implode( ' ', $query );
		$results           = $wpdb->get_results( $query );

		return wp_list_pluck( $results, 'term_count', 'term_count_id' );
	}
	protected function get_page_base_url( $taxonomy ) {
		if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url();
		} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			$link = get_post_type_archive_link( 'product' );
		} elseif ( is_product_category() ) {
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		} elseif ( is_product_tag() ) {
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		} else {
			$link = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		}

		// Min/Max
		if ( isset( $_GET['min_price'] ) ) {
			$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
		}

		if ( isset( $_GET['max_price'] ) ) {
			$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
		}

		// Orderby
		if ( isset( $_GET['orderby'] ) ) {
			$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
		}

		/**
		 * Search Arg.
		 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
		 */
		if ( get_search_query() ) {
			$link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
		}

		// Post Type Arg
		if ( isset( $_GET['post_type'] ) ) {
			$link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
		}

		// Min Rating Arg
		if ( isset( $_GET['min_rating'] ) ) {
			$link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
		}

		// All current filters
		if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
			foreach ( $_chosen_attributes as $name => $data ) {
				if ( $name === $taxonomy ) {
					continue;
				}
				$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
				if ( ! empty( $data['terms'] ) ) {
					$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
				}
				if ( 'or' == $data['query_type'] ) {
					$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
				}
			}
		}

		return $link;
	}	

	protected function getTemplatePath($tpl='default', $type=''){
		$file = '/'.$tpl.$type.'.php';
		$dir = WPBINGO_WIDGET_TEMPLATE_PATH.'bwp-ajax-filter';
		if ( file_exists( $dir.$file ) ){
			return $dir.$file;
		}
		return $tpl=='default' ? false : $this->getTemplatePath('default', $type);
	}
	
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// strip tag on text field
		$instance['title1'] = strip_tags( $new_instance['title1'] );	
				
		if ( array_key_exists('attribute', $new_instance) ){
			if ( is_array($new_instance['attribute']) ){
				$instance['attribute'] = array_map( 'strval', $new_instance['attribute'] );
			} else {
				$instance['attribute'] = $new_instance['attribute'];
			}
		}else{
			$instance['attribute'] = '';
		}
		
		if ( array_key_exists('show_category', $new_instance) ){
			$instance['show_category'] = strip_tags( $new_instance['show_category'] );
		}		
		
		if ( array_key_exists('show_price', $new_instance) ){
			$instance['show_price'] = strip_tags( $new_instance['show_price'] );
		}				
		
		if ( array_key_exists('showcount', $new_instance) ){
			$instance['showcount'] = strip_tags( $new_instance['showcount'] );
		}
		if ( array_key_exists('show_brand', $new_instance) ){
			$instance['show_brand'] = strip_tags( $new_instance['show_brand'] );
		}
        
		return $instance;
	}	

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array();
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		$default_attribute = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();	
		$count_atribute = 0 ;
		if($attribute_taxonomies){
			foreach ( $attribute_taxonomies as $value ) :
				$default_attribute[] = $value->attribute_name;
				$c_taxonomy     = wc_attribute_taxonomy_name( $value->attribute_name );
				$c_terms = get_terms( $c_taxonomy);
				$count_atribute = $count_atribute + count($c_terms);
			endforeach;
		}	
		$title1 				= isset( $instance['title1'] )    ? 	strip_tags($instance['title1']) : '';			
		$attribute				= isset( $instance['attribute'] )  && is_array($instance['attribute']) ? $instance['attribute'] : $default_attribute;
		$showcount   			= isset( $instance['showcount'] ) ? strip_tags($instance['showcount']) : 1;  
		$show_price   			= isset( $instance['show_price'] ) ? strip_tags($instance['show_price']) : 1;
		$show_category   		= isset( $instance['show_category'] ) ? strip_tags($instance['show_category']) : 1;  	
		$show_brand   			= isset( $instance['show_brand'] ) ? strip_tags($instance['show_brand']) : 1;  	
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title', 'wpbingo')?></label>
			<br />
			<input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>"
				type="text"	value="<?php echo esc_attr($title1); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e("Show Categories", 'wpbingo')?></label>
			<br/>
			<select class="widefat"
				id="<?php echo $this->get_field_id('show_category'); ?>"	name="<?php echo $this->get_field_name('show_category'); ?>">
				<option value="1" <?php if ($show_category==1){?> selected="selected"
				<?php } ?>>
					<?php _e('Yes', 'wpbingo')?>
				</option>
				<option value="0" <?php if ($show_category==0){?> selected="selected"
				<?php } ?>>
					<?php _e('No', 'wpbingo')?>
				</option>				
			</select>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id('show_price'); ?>"><?php _e("Show Filter Price", 'wpbingo')?></label>
			<br/>
			<select class="widefat"
				id="<?php echo $this->get_field_id('show_price'); ?>"	name="<?php echo $this->get_field_name('show_price'); ?>">
				<option value="1" <?php if ($show_price==1){?> selected="selected"
				<?php } ?>>
					<?php _e('Yes', 'wpbingo')?>
				</option>
				<option value="0" <?php if ($show_price==0){?> selected="selected"
				<?php } ?>>
					<?php _e('No', 'wpbingo')?>
				</option>				
			</select>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('showcount'); ?>"><?php _e("Show Number Of Product", 'wpbingo')?></label>
			<br/>
			<select class="widefat"
				id="<?php echo $this->get_field_id('showcount'); ?>"	name="<?php echo $this->get_field_name('showcount'); ?>">
				<option value="1" <?php if ($showcount==1){?> selected="selected"
				<?php } ?>>
					<?php _e('Yes', 'wpbingo')?>
				</option>
				<option value="0" <?php if ($showcount==0){?> selected="selected"
				<?php } ?>>
					<?php _e('No', 'wpbingo')?>
				</option>				
			</select>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('show_brand'); ?>"><?php _e("Show Brand", 'wpbingo')?></label>
			<br/>
			<select class="widefat"
				id="<?php echo $this->get_field_id('show_brand'); ?>"	name="<?php echo $this->get_field_name('show_brand'); ?>">
				<option value="1" <?php if ($show_brand==1){?> selected="selected"
				<?php } ?>>
					<?php _e('Yes', 'wpbingo')?>
				</option>
				<option value="0" <?php if ($show_brand==0){?> selected="selected"
				<?php } ?>>
					<?php _e('No', 'wpbingo')?>
				</option>				
			</select>
		</p>		
		<?php if($attribute_taxonomies && $count_atribute > 0) : ?>
		<p>
			<label for="<?php echo $this->get_field_id('attribute'); ?>"><?php _e('Attribute', 'wpbingo')?></label>
			<br />
			<select class="widefat"	id="<?php echo $this->get_field_id('attribute'); ?>" name="<?php echo $this->get_field_name('attribute'); ?>[]" multiple="multiple">
				<option value=""><?php echo esc_html__('Null','wpbingo') ?></option>
				<?php
				$option ='';
				foreach ( $attribute_taxonomies as $value ) :
					$get_terms_args['menu_order'] = 'ASC';
					$taxonomy     = wc_attribute_taxonomy_name( $value -> attribute_name );
					$terms = get_terms( $taxonomy, $get_terms_args );
					if(count($terms) > 0){				
						$option .= '<option value="' . $value -> attribute_name  . '" ';
						if ( is_array( $attribute ) && in_array( $value -> attribute_name, $attribute ) ){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$value -> attribute_label.'</option>';
					}
				endforeach;
				echo $option;
				?>
			</select>
		</p>
		<?php endif;?>
		<p>
			<table>
			<?php 
				foreach( $attribute as $att ){
					if( preg_match('/'.__('color', 'wpbingo').'/', $att, $matches) ){ ?>
						<?php 
						$taxonomy     = wc_attribute_taxonomy_name( $att );
						$orderby = wc_attribute_orderby( $taxonomy );
						switch ( $orderby ) {
							case 'name' :
								$get_terms_args['orderby']    = 'name';
								$get_terms_args['menu_order'] = false;
							break;
							case 'id' :
								$get_terms_args['orderby']    = 'id';
								$get_terms_args['order']      = 'ASC';
								$get_terms_args['menu_order'] = false;
							break;
							case 'menu_order' :
								$get_terms_args['menu_order'] = 'ASC';
							break;
						}					
						?>
					<?php } 
				}
			?>
			</table>
		</p>		
	<?php
	}		
	
	function woocommerce_filter_price($chosen_attributes,$default_min_price,$default_max_price){
		$min_price = (isset($chosen_attributes['min_price']) && $chosen_attributes['min_price']) ? $chosen_attributes['min_price'] : $default_min_price; 
		$max_price = (isset($chosen_attributes['max_price']) && $chosen_attributes['max_price']) ? $chosen_attributes['max_price'] : $default_max_price; 
		echo '<div class="bwp-filter-price">';
		    echo '<h3>'.esc_html__('Price','wpbingo').'</h3>';
			echo '<div class="content-filter-price">';
				if(($min_price != $default_min_price) || ($max_price != $default_max_price)){
					echo '<facet-remove class="facet-remove-price">'.esc_html__("Reset","wpbingo").'</facet-remove>';
				}
				echo '<div id="bwp_slider_price" data-symbol="'.get_woocommerce_currency_symbol().'" data-min="'.$default_min_price.'" data-max="'.$default_max_price.'"></div>';
				echo '<div class="price-input">';
					echo '<span>'.esc_html__('Range : ','wpbingo').'</span>';
					echo '<span class="input-text text-price-filter" id="text-price-filter-min-text">'.wc_price($min_price).'</span> - ';
					echo '<span class="input-text text-price-filter" id="text-price-filter-max-text">'.wc_price($max_price).'</span>';
					echo '<input class="input-text text-price-filter hidden" id="price-filter-min-text" type="text" value="'.$min_price.'">';
					echo '<input class="input-text text-price-filter hidden" id="price-filter-max-text" type="text" value="'.$max_price.'">';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
	
	protected function get_filtered_price($meta_query,$tax_query) {
		global $wpdb, $wp_the_query;
		
		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );

		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		$sql  = "SELECT min( CAST( price_meta.meta_value AS UNSIGNED ) ) as min_price, max( CAST( price_meta.meta_value AS UNSIGNED ) ) as max_price FROM {$wpdb->posts} ";
		$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
		$sql .= " 	WHERE {$wpdb->posts}.post_type = 'product'
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
		$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

		return $wpdb->get_row( $sql );
	}	
	
	function woocommerce_filter_atribute($attribute,$tax_query,$meta_query,$chosen_attributes,$relation,$showcount){
		$query_type = $relation ;
		
		if($attribute){
		foreach( $attribute as $att ){
			$taxonomy     = wc_attribute_taxonomy_name( $att );
			$orderby = wc_attribute_orderby( $taxonomy );
			if($orderby ){
				switch ( $orderby ) {
					case 'name' :
						$get_terms_args['orderby']    = 'name';
						$get_terms_args['menu_order'] = false;
					break;
					case 'id' :
						$get_terms_args['orderby']    = 'id';
						$get_terms_args['order']      = 'ASC';
						$get_terms_args['menu_order'] = false;
					break;
					case 'menu_order' :
						$get_terms_args['menu_order'] = 'ASC';
					break;
				}
			}else{
				$get_terms_args    = array();
			}

			$get_terms_args['tax_query'] = $tax_query;
			$terms = get_terms( $taxonomy, $get_terms_args );
			$count_terms = 0;
			if (!empty($terms) && !is_wp_error($terms)){
				foreach( $terms as $term ){
					$d_term_counts      = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type ,$tax_query,$meta_query);	
					$d_count            = isset( $d_term_counts[ $term->term_id ] ) ? $d_term_counts[ $term->term_id ] : 0;
					$count_terms 		= $count_terms + $d_count;
				}
			}
			if ($count_terms > 0) {	
				if(count($terms)>0):
					$current_values    = isset( $chosen_attributes[ $taxonomy ]['terms'] ) ? $chosen_attributes[ $taxonomy ]['terms'] : array();
					$name_att = wc_attribute_label($taxonomy);	?>
				<div class="bwp-filter bwp-filter-<?php echo esc_attr($att);?>">
					<h3><?php echo ucfirst( $name_att ); ?><?php if( count($current_values) > 0 ): ?><label class="count-chosen"><?php echo count($current_values); ?></label><?php endif; ?></h3>
					<div class="content_filter">
						<?php if( count($current_values) > 0 ): ?>
							<facet-remove><?php echo esc_html__('Reset','wpbingo') ?></facet-remove>
						<?php endif; ?>
						<?php 
							$tax_attribute = bwp_get_tax_attribute($taxonomy);
							if(isset($tax_attribute->attribute_type) && $tax_attribute->attribute_type != "select"){
						?>
						<ul id="<?php echo esc_attr( 'pa_'.$att ); ?>">
							<?php
								$term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type ,$tax_query,$meta_query);				
								foreach( $terms as $term ){
									$option_is_set     = in_array( $term->slug, $current_values );	
									$count             = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;
									if($count > 0 ){
										$tax_attribute = bwp_get_tax_attribute($taxonomy);
										$text_count		= 	$showcount ? '' . absint( $count ) . '' : "";
										$text_count2	= 	$showcount ? '' . absint( $count ) . '' : "";
										if(isset($tax_attribute->attribute_type) && $tax_attribute->attribute_type == "color"){
											$color = get_term_meta( $term->term_id, 'color', true );
											echo '<li class="filter_color ' . ( $option_is_set ?  "active ". esc_attr( $term -> slug ) ."" : "". esc_attr( $term -> slug ) ."" ) . '">';
													echo '	<span style="background-color:'.esc_attr($color).';"> 
																<input value="'. esc_attr( $term -> slug ) .'" name="filter_'.esc_attr( $att ).'" type="checkbox" ' . ( $option_is_set ?  "checked"  : "" ) . '>
															</span>';
														echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">'.esc_html( $term->name ).'</label>', $count, $term );
											echo	'</li> ';
										}elseif(isset($tax_attribute->attribute_type) && $tax_attribute->attribute_type == "image"){
											$bg_image = '';
											$id_image = get_term_meta( $term->term_id, 'image', true );
											$image_attributes = wp_get_attachment_image_src( $id_image );
											if($image_attributes){
												$bg_image = 'style="background-image:url('.esc_url($image_attributes[0]).');"';
											}
											echo '<li class="filter_image">';
													echo '	<span ' . ( $option_is_set ?  "class='active ". esc_attr( $term -> slug ) ."'" : "class='". esc_attr( $term -> slug ) ."'" ) . ' '.$bg_image.'> 
																<input value="'. esc_attr( $term -> slug ) .'" name="filter_'.esc_attr( $att ).'" type="checkbox" ' . ( $option_is_set ?  "checked"  : "" ) . '>
															</span>';		
													echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">'.esc_html( $term->name ).'<mark>'.esc_html($text_count2).'</mark></label>', $count, $term );
											echo	'</li> ';
										}
										else{
											echo '<li '.( $option_is_set ?  "class='active'" : "" ).'>';
													echo '<span>
															<input  value="'. esc_attr( $term -> slug ) .'" name="filter_'.esc_attr( $att ).'"  type="checkbox" ' . ( $option_is_set ?  "checked" : "" ) . '>
															<label class="name">'.esc_html( $term->name ).'</label>';
															echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">'.esc_html($text_count).'</label>', $count, $term );
													echo '</span>';
											echo '</li> ';
										}
									}
								}
							?>
						</ul>
						<?php }else{ ?>
							<h2 class="dropdown-toggle" data-toggle="dropdown"><?php echo esc_html__('Choose option','wpbingo') ?></h2>
							<ul id="<?php echo esc_attr( 'pa_'.$att ); ?>" class="filter-select dropdown-menu">
								<?php
									$term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type ,$tax_query,$meta_query);				
									foreach( $terms as $term ){
										$current_values    = isset( $chosen_attributes[ $taxonomy ]['terms'] ) ? $chosen_attributes[ $taxonomy ]['terms'] : array();
										$option_is_set     = in_array( $term->slug, $current_values );	
										$count             = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;
										if($count > 0 ){
											$tax_attribute = bwp_get_tax_attribute($taxonomy);
											$text_count		= 	$showcount ? '(' . absint( $count ) . ')' : "";
											echo '<li class="filter_orther">';
													echo '<div ' . ( $option_is_set ?  "class='active'" : "" ) . '>
															<span></span><input  value="'. esc_attr( $term -> slug ) .'" name="filter_'.esc_attr( $att ).'"  type="checkbox" ' . ( $option_is_set ?  "checked" : "" ) . '>';
															echo apply_filters( 'woocommerce_layered_nav_count', '<label class="count">'.esc_html( $term->name ).'<mark>'.esc_html($text_count).'</mark>', $count, $term );
													echo '</div>';
											echo '</li> ';
										}
									}
								?>
							</ul>
						<?php } ?>
					</div>
				</div>
				<?php endif;
				}
			}
		}
	}

	function woocommerce_filter_category(){
		$id_item = is_tax('product_cat') ? get_queried_object()->term_id : 0;
		$terms = get_terms( 'product_cat', array('hide_empty' => true,'parent' => 0) );
		if($terms){
			echo '<div class="widget bwp-filter bwp-filter-category">';
			echo '<h3 class="widget-title">'.esc_html__('Categories','wpbingo').'</h3>';
			echo '<div id="pa_category" data-taxonomy="product_cat" class="block_content filter_taxonomy_product filter_category_product">';
			foreach ($terms as $term){
				$option_is_set     = ($term->term_id == $id_item) ? 1 : 0;
				$terms_vl1 =	get_terms( 'product_cat', array( 'hide_empty' => false,'parent' => $term->term_id) );
				echo '<div data-id_item="'.$term->term_id.'" class="item-taxonomy item-category '.( (count($terms_vl1) > 0) ?  'cat-parent' : '' ).' '.( ($option_is_set == 1) ?  'active' : '' ).'">';
					echo '<a href="'.get_term_link( $term->term_id, 'product_cat' ).'"><label class="name">'.esc_html($term->name).'</label>';
					echo '<label class="count">('.($term->count).')</label></a>';
					if($terms_vl1){
						echo '<div class="children">';
							foreach ($terms_vl1 as $term_vl){
								$option_is_set     = ($term_vl->term_id == $id_item) ? 1 : 0;
								$terms_vl2 =	get_terms( 'product_cat', array( 'hide_empty' => false,'parent' => $term_vl->term_id) );
								echo '<div data-id_item="'.$term_vl->term_id.'" class="item-taxonomy item-category  '.( (count($terms_vl2) > 0) ?  'cat-parent' : '' ).' '.( ($option_is_set == 1) ?  'active' : '' ).'">';
									echo '<a href="'.get_term_link( $term_vl->term_id, 'product_cat' ).'"><label class="name">'.esc_html($term_vl->name).'</label>';
									echo '<label class="count">('.($term_vl->count).')</label></a>';
										if($terms_vl2){
											echo '<div class="children">';
												foreach ($terms_vl2 as $term_vl2){
													$option_is_set     = ($term_vl2->term_id == $id_item) ? 1 : 0;
													echo '<div data-id_item="'.$term_vl2->term_id.'" class="item-taxonomy item-category '.( ($option_is_set == 1) ?  'active' : '' ).'">';
														echo '<a href="'.get_term_link( $term_vl2->term_id, 'product_cat' ).'"><label class="name">'.esc_html($term_vl2->name).'</label>';
														echo '<label class="count">('.($term_vl2->count).')</label></a>';
													echo '</div> ';
												}
											echo '</div>';
										}									
								echo '</div> ';
							}
						echo '</div>';
					}
				echo '</div> ';
			}
			echo '</div></div>';
		}
	}
	
	function woocommerce_filter_brand($showcount){
		$id_item = is_tax('product_brand') ? get_queried_object()->term_id : 0;
		$terms = get_terms( 'product_brand', array('hide_empty' => true) );
		if($terms){
			echo '<div class="widget bwp-filter bwp-filter-brand">';
			echo '<h3 class="widget-title">'.esc_html__('Brands','wpbingo').'</h3>';
			echo '<div id="pa_brand" data-taxonomy="product_brand" class="block_content filter_taxonomy_product filter_brand_product">';
			foreach ($terms as $term){
				$option_is_set     = ($term->term_id == $id_item) ? 1 : 0;
				echo '<div data-id_item="'.$term->term_id.'" class="item-taxonomy item-brand '.( ($option_is_set == 1) ?  'active' : '' ).'">';
					echo '<a href="'.get_term_link( $term->term_id, 'product_brand' ).'"><label class="name">'.esc_html($term->name).'</label>';
					echo '<label class="count">('.($term->count).')</label></a>';
				echo '</div> ';
			}
			echo '</div></div>';
		}
	}
}
?>