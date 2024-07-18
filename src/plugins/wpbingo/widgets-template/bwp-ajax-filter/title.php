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
<?php endif; ?>
