<?php
/**
 * This is the most generic template file in a WordPress theme
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();

get_part( 'site-header' );

get_part('wrapper/main-wrapper-start' );

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			the_content();
		}
	}
	else {
		// :(
	}

get_part('wrapper/main-wrapper-end');

get_part( 'site-footer' );

get_footer();
