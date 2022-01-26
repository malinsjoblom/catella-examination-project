<?php


get_header();
get_part( 'site-header' );

if( is_front_page() ) {
    get_part( 'site-hero' );
} else {
    get_part( 'page-hero' );
}

get_part('wrapper/main-wrapper-start' );

if( have_posts() ) {
    the_post();
    // loop through flexible content

    while( have_rows('sections') ) {
        the_row();
        $layout = get_row_layout();
        echo "<!-- layout: $layout -->";
        get_layout( 'page', $layout );
    }
}

get_part('layouts/funds_slider');

get_footer();
