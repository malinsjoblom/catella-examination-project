<?php
defined('ABSPATH') or die;


// If the current view is a product category archive,
// use the current term_id as the parent term
$parent_term = '0';
$obj = get_queried_object();
if( $obj instanceof \WP_Term ) {
	$parent_term = $obj->term_id;
}

$terms = get_terms([
	'taxonomy' => 'product_cat',
	'hide_empty' => true,
	'child_of' => $parent_term
]);

if(empty($terms)) {
	return;
}

$product_cat = '0';
$filterby = get_query_var('filterby');
if(is_array($filterby) && isset($filterby['product_cat']) ) {
	$product_cat = $filterby['product_cat'];
}

// Build a list of items from $terms that's consumable by di_list_box()
$list = di_prop_map( $terms, [
	'id' => 'term_id',
	'value' => 'term_id',
	'name' => 'name'
]);

// Prepend list with a default option
$list = array_merge( [[
	'id' => '0',
	'value' => '0',
	'name' => __( 'Alla', 'digitalisland' )
]], $list );

?>

<div class="ml-3 list-box-wrapper">
	<?php

		di_list_box( 'filterby[product_cat]', $list, [
			'label' => __('Produkttyper', 'digitalisland'),
			'initial_id' => $product_cat,
		] );

	?>
</div>

