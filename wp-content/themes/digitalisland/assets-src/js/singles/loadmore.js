"use strict";

jQuery(function($) {

	// 1: User clicks [data-load-more-ref="123456"]
	// 2: The value "123456" is used to find the container element ie [data-load-more="123456"]
	// 3: data-attribute values of the container element is used to build query
	// 4: A jQuery.ajax sends a POST request to the server
	// 5: Server responds with json which is automatically parsed into an Object by jQuery.ajax
	// 6: The string data in responseData.html is appended as HTML inside of the container DOM element
    
	$('[data-load-more-ref]').click( ajaxLoadMore );

	function ajaxLoadMore() {

		var requestData = {
			action: 'loadmore_products',
			query_info: loadmore_products_params.query_info,
			nonce: loadmore_products_params.nonce
		};

		var button = $(this),
			container = $( `[data-load-more="${ button.data('load-more-ref') }"]`  ),
			button_normal_text = button.text();


		if( container.length !== 1 ) {
			if( container.length == 0 ) {
				throw new Error(`No load-more container matching "${button.data('load-more-ref')}" could be found`)
			}
			if( container.length >  1 ) {
				console.warn(`More than one load-more container matching "${button.data('load-more-ref')}" could be found. The first element in the set will be used`)
				container = container.first()
			}
		}
		
		$.ajax({
			url : loadmore_products_params.ajaxurl, // AJAX handler
			data : requestData,
			type : 'POST',

			beforeSend : function() {
				button.text('...'); // change the button text, you can also add a preloader image
				button.off( 'click', ajaxLoadMore ); // remove event listener to prevent click while loading
				
			},

			success : function( responseData ){
				if( responseData ) {
					container.append(responseData.html) // insert new posts
					
					requestData.query_info.query_vars.paged = responseData.paged
                    
					

					if ( ~~responseData.paged >= ~~loadmore_products_params.max_num_pages ) {
						button.remove() // if last page, remove the button
						return;
					}

				} else {
					// if no data, remove the button as well
					console.log('no more posts to show');
					button.remove();
					return;
				}

				button.text( button_normal_text )
				button.click( ajaxLoadMore ) // reapply event listener
			},

			error : function() {
				console.warn('I am error');
				button.remove()
			}
		});
			
	}
});
