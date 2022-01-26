<?php
defined('ABSPATH') or die;

$orderby = di_wc_get_orderby();

$catalog_orderby_options = get_query_var('catalog_orderby_options');
$catalog_orderby_options = array_map(function($key, $val){
	return ([
		'id' => $key,
		'value' => $key,
		'name' => $val,
	]);
}, array_keys($catalog_orderby_options), $catalog_orderby_options );


?>

<div class="list-box-wrapper">
	<?php

		di_list_box( 'orderby', $catalog_orderby_options, [
			'label' => 'Sortera',
			'initial_id' => $orderby,
		]);

	?>
</div>
