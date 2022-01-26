<?php
defined('ABSPATH') or die;

// actions
add_action( 'wp_ajax_loadmore_products',        __NAMESPACE__ . '\\' . 'handle_load_more_products' );
add_action( 'wp_ajax_nopriv_loadmore_products', __NAMESPACE__ . '\\' . 'handle_load_more_products' );

// enqueues
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\' . 'enqueue_script' );


function handle_load_more_products() {

	$data = [];
	$is_nonce_valid = wp_verify_nonce( $_POST['nonce'] , 'wp_ajax_loadmore' );

	if( ! $is_nonce_valid ) {
		$data['code'] = 401;
		$data['message'] = 'you don\'t have permission to do that';

	} elseif( $_POST['max_num_pages'] >= $_POST['query_info']['query_vars']['paged'] ) {
		$data['code'] = 404;
		$data['is_last_page'] = true;

	} else {
		$query_info = $_POST['query_info'];
		$query_args = array_merge(
			$query_info['query_vars'],
			[
				'paged' => max( 1, $query_info['query_vars']['paged'] ) + 1,
			]
		);

		if( isset($query_info['tax_query']) && !empty($query_info['tax_query']) ) {
			$query_args['tax_query'] = $query_info['tax_query'];
		}

		$query = new \WP_Query( $query_args );

		$data['paged'] = $query->get('paged');


		wc_setup_loop();
		if( $query->have_posts() ) :
			ob_start();

			while( $query->have_posts() ):
				$query->the_post();

				if(get_post_type() == 'product') {
					$thumbnail = get_the_post_thumbnail_url( get_the_ID() ) ? get_the_post_thumbnail_url( get_the_ID() ) : wc_placeholder_img_src();
					$post_type = get_post_type();
					$currency = get_woocommerce_currency_symbol();
					
					$product = wc_get_product( get_the_ID() );
					//$price_string = $product->get_price() ? 'fr. ' . $product->get_price() . ' ' . $currency : __('Prisuppgift saknas');
					
					
					
					?>

<a href="<?php the_permalink() ?>" class="bg-gray-100 md:mb-0  border border-white" style="height:425px;">
    <div class="flex flex-wrap">
        <div class="mt-5 px-7">
            <p class="self-end px-2 py-1 text-sm bg-black hidden"><?= $price_string ?></p>
        </div>
        <div class="w-full pt-4 ">
            <h2 class="text-xl text-black font-normal px-8"><?php the_title() ?></h2>
            <img class="product-img ml-auto mr-auto h-auto w-72 mt-4" src="<?=$thumbnail?>,"></img>


        </div>
    </div>
</a>
<?php
				} else if (get_post_type() == 'aktuellt-hos-oss') {
					$thumbnail = get_the_post_thumbnail_url();

        			?>

<a href="<?php the_permalink() ?>" class="bg-gray-100 ofyr-aktuellt">
    <div class="flex flex-col w-80">
        <div class="w-full ">
            <img class="w-full mb-8 h-52" src="<?=$thumbnail?>"></img>
            <h2 class="px-5 pb-0 text-lg font-normal text-black"><?php the_title() ?></h2>
            <button
                class="block px-5 my-10 text-black underline transition-all ease-in hover:opacity-70 duration 100ms"><?= __('Läs mer', 'ofyr') ?></button>
        </div>
    </div>
</a>

<?php
				}
				
			endwhile;

			$data['html'] = ob_get_clean();
			$data['code'] = 200;
		else:
			$data['code'] = 404;
			$data['message'] = 'no posts found';
			$data['_log'] = $query;
		endif;
	}

	wp_send_json( $data, $data['code'] );

}


function enqueue_script() {

	wp_register_script( 'loadmore', get_template_directory_uri() . '/assets/js/singles/loadMore.js', array('jquery'), false, true );

	/** @var \WP_Query $wp_query */
	global $wp_query;

	$query_info = [];
	$query_info['query'] = $wp_query->query;
	if( isset($wp_query->tax_query) && isset($wp_query->tax_query->queries) ) {
		$query_info['tax_query'] = $wp_query->tax_query->queries;
	}
	$query_info['query_vars'] = [];

	$query_vars_to_get = [
		'posts_per_page',
		'orderby',
		'order',
		'post_type',
		'meta_query',
		'filterby',
	];

	foreach ($query_vars_to_get as $name) {
		$value = $wp_query->get( $name );
		if( !empty($value)) {
			$query_info['query_vars'][ $name ] = $value;
		}
	}

	$query_info['query_vars']['paged'] = max( 1, $wp_query->get('paged') ); // we always add paged


	wp_localize_script( 'loadmore', 'loadmore_products_params', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'wp_ajax_loadmore' ),
		'query_info' => $query_info,
		'max_num_pages' => $wp_query->max_num_pages
	) );

	wp_enqueue_script( 'loadmore' );
}