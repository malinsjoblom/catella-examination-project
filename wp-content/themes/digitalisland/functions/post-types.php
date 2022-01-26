<?php
defined('ABSPATH') or die;
/* Register theme post types in this file */

function di_register_custom_post_types() {

    //register_post_type( 'recept',

       // array(
         //      'name' => __( 'Recept' ),
    //             'singular_name' => __( 'Recept' )
    //         ),
    //         'public' => true,
    //         'has_archive' => false,
    //         'rewrite' => array('slug' => 'recept'),
    //         'show_ui' => true,
    //         'show_in_rest' => true,
    //         'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    //         'taxonomies' => array('post_tag', 'category', 'post_meta'),
    //         'query_var' => true,

    //     )
    // );
    register_post_type( 'colleague',
    array(
        'labels' => array(
            'name' => 'colleagues',
            'singular_name' => 'colleague'
        ),
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'supports' => array('thumbnail', 'title', 'editor', 'excerpt'),
    ));

    register_post_type( 'fund',
    array(
        'labels' => array(
            'name' => 'funds',
            'singular_name' => 'fund'
        ),
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'supports' => array('thumbnail', 'title', 'editor', 'excerpt'),
    ));
}

add_action( 'init', 'di_register_custom_post_types' );
