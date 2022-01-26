<?php
defined('ABSPATH') or die;

add_filter( 'query_vars', 'di_filterby_query_var' );
add_action( 'pre_get_posts', 'di_wc_filterby', 11, 1 );
//add_action( 'alm_query_args_', 'alm_product_query_edit');
add_action( 'woocommerce_product_query', 'filter_product_query');
/**
 * Add 'filterby' to the list of known query vars accepted by WP
 */
function di_filterby_query_var( $query_vars ) {
    $query_vars[] = 'filterby';
    return $query_vars;
}


/**
 * Modifies sorting options before query is executed
 */
function  di_wc_get_catalog_ordering_args( $args ) {

    // $orderby_value = di_get_orderby();
    // switch($orderby_value){
    //     case 'r-level':
    //         $args['orderby'] = 'title';
    //         $args['order'] = 'ASC';
    //         $args['meta_key'] = '';
    //         break;
    // }

	return $args;
}


/**
 * Adds options to list of orderby options for wc product catalogs
 *
 * @param array $orderby_options
 */
function di_wc_add_orderby_options( array $orderby_options ) {

    // $orderby_options[ 'query_var_slug' ] = 'Displayed string'

	return $orderby_options;
}


/**
 * Filter and reorder sorting options shown
 */
function di_wc_reorder_orderby_options( $orderby_options ) {
    // Our custom order of the sorting options
    $keys_in_order = [
        // 'title-asc',
        // 'title-desc',
        'price',
        'price-desc',
        'popularity',
        'date',
    ];

    // We save any entries of $orderby_options that are not covered by $keys_in_order.
    // These entries are then removed (unset) from $orderby_options,
    // but will be prepended to the final outgoing array
    $diff = array_diff_key( $orderby_options, array_flip($keys_in_order) );
    foreach( $diff as $key => $val ) {
        unset( $orderby_options[ $key ] );
    }

    $result = array_merge( array_flip($keys_in_order), $orderby_options );
    if( !empty($diff) ) {
        $result = array_merge( $result, $diff );
    }

    return $result;
}


/**
 * Tries to get a value orderby from the main query vars or the request.
 * Defaults to the default value set in wc
 *
 * @return string|array
 */
function di_wc_get_orderby() {
    $value = "";

    if( !empty( get_query_var('orderby', null) ) ) {
		$value = wc_clean( get_query_var('orderby') );
	}
    elseif( isset($_REQUEST['orderby']) ) {
        $value = wc_clean( $_REQUEST['orderby'] );
    }
    else {
        $value = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    }

    return $value;
}

/**
 * Filter products by category
 * Hooks into the main query before launching
 * and manipulates the tax_query based on the value of 'filterby' in url querystring
 */
function di_wc_filterby( WP_Query $query ) {
    if ( ! is_admin() && $query->is_main_query() && 'product' === $query->get('post_type') ) {

        $filterby = get_query_var('filterby');
        if ( $filterby && is_array($filterby) ) {

            $tax_query = $query->get('tax_query');
            
            foreach( $filterby as $filter => $value ) {

                $value = preg_replace( '[^,a-z0-9\-_]', '', $value );

                if( empty($value) ) {
                    continue;
                }

                switch( $filter ) {
                    case 'product_cat':
                        $tax_query[] = [

                                'taxonomy' => 'product_cat',
                                'operator' => 'IN',
                                'field' => 'term_id',
                                'terms' => $value

                        ];
                        break;

                    case 'city':
                        $tax_query[] = [
                            [
                                'taxonomy' => 'pa_city',
                                'operator' => 'IN',
                                'field'    => 'slug',
                                'terms'    => $value,
                            ]
                        ];
                        break;

                    default:
                        break;
                }
            }
            
            
            $query->set('tax_query', $tax_query );

        }
    }
    

}

function filter_product_query($query){
    $tax_query = $query->get('tax_query') ? $query->get('tax_query') : null;
    $meta_query = $query->get('meta_query') ? $query->get('meta_query') : null;



    if (isset($_GET['color'])) {
        $colors_param = $_GET['color'];
    } else {
        $colors_param = 0;
    }
    $colors = explode(',', $colors_param);
    if ( $colors_param && is_array($colors) ) {

        $old_query = $query->get('meta_query');

        $meta_query = array('relation' => 'OR');
        $query->meta_query = true;
        
        foreach( $colors as $value ) {
            $value = preg_replace( '[^,a-z0-9\-_]', '', $value );
                    
            $meta_query[] = array(
                'key'     => 'current_color',
                'value'   => $value,
                'compare' => 'LIKE'
            );
            
        }
     
        if($old_query){
            $old_query[] = $meta_query;
        }
        else{
            $old_query = $meta_query;   
        }
        
        $query->set('meta_query', $old_query );
    }

    //var_dump($query);
    //exit;
}