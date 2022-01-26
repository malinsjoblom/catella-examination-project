<?php
defined('ABSPATH') or die;

// Get the product attributes of 'Rolighet' a.k.a 'r_level'
$terms = get_terms([
	'taxonomy' => 'pa_city',
	'hide_empty' => true // don't show r_levels not associated with any products
]);

if( is_wp_error($terms) || empty($terms) ) {
	return;
}

$city = '0';
$filterby = get_query_var('filterby');
if(is_array($filterby)) {
	$city = $filterby['city'];
}

// Build a list of items from $terms that's consumable by uteliv_list_box()
$list = di_prop_map( $terms, [
	'id' => 'slug',
	'value' => 'slug',
	'name' => 'name'
]);

// Prepend list with a default option
$list = array_merge( [[
	'id' => '0',
	'value' => '0',
	'name' => 'Stad'
]], $list );

?>

<div class="list-box-wrapper">
	<?php
		di_list_box( 'filterby[city]', $list, [
			'label' => 'Stad',
			'initial_id' => $city,
		] );
	?>
</div>
