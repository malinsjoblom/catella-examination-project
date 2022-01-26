<?php
defined('ABSPATH') or die;

// Registers theme scripts and styles
function theme_register_assets() {
	$theme = get_template_directory_uri();
	$assets_uri = $theme . '/assets';

    // Alpine js
    wp_register_script( 'cdn/alpinejs', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js' );
    script_tag_add_attribute( 'cdn/alpinejs', 'defer', null ); // sets a 'defer' attribute on the script element

    // Tailwind css
	wp_register_style('tailwind', $assets_uri . '/css/tailwind.css' );

	// Theme css
	wp_register_style('theme-style', $assets_uri . '/css/theme-main.css');

	// Theme js
    wp_register_script('theme-script', $assets_uri . '/js/main-bundle.min.js', [], null, false);

}
add_action( 'wp_enqueue_scripts', 'theme_register_assets' );

// Enqueues assets which should be availabe on every page
function theme_main_enqueue() {

	// theme css
	// wp_enqueue_style('normalize');
	wp_enqueue_style('tailwind');
	wp_enqueue_style('theme-style');

	// webfonts
	// wp_enqueue_style('theme-google-fonts');

	// theme js
    wp_enqueue_script('cdn/alpinejs');
    wp_enqueue_script('theme-script');
}
add_action('wp_enqueue_scripts', 'theme_main_enqueue', 99);



/**
 * Adds html attributes to <script> tag
 *
 * @see script_tag_add_attribute()
 */
add_filter('script_loader_tag', function($tag, $handle, $src) {
    global $wp_scripts;

    $script_obj = $wp_scripts->registered[ $handle ];
    $attributes = isset( $script_obj->extra['html_atts'] ) ? $script_obj->extra['html_atts'] : false;

    if( empty($attributes) ) {
        return $tag;
    }

    foreach( $attributes as $attr => $value ) {
        $value = esc_attr( $value );
        $pair_or_single = empty($value) ? $attr : "$attr=\"$value\"";
        $pair_or_single = esc_attr( $pair_or_single );

        // if( false === stripos( $tag, "$attr=" ) ) {
        //     $pattern = preg_quote( '/^'.$attr.'="[^"]+"/' );
        //     $tag = preg_replace( $pattern , "$attr='$value'", $tag, 1 );
        // }
        $tag = preg_replace('/^<script /', "<script $pair_or_single ", $tag, 1 );
    }

    return $tag;
}, 99999, 3  );


/**
 * Appends an attribute name-value pair to a script object
 *
 * @param string $handle
 * @param string $attribute_name
 * @param string $value
 * @param bool $overwrite
 */
function script_tag_add_attribute( string $handle, string $attribute_name, ?string $value = null, $overwrite=false ) {
    global $wp_scripts;

    $script_obj = $wp_scripts->registered[ $handle ];
    $attributes = isset($script_obj->extra['html_atts']) ? $script_obj->extra['html_atts'] : [];

    if( in_array($attribute_name, $attributes) && false === $overwrite ) {
        return false;
    }

    $attributes[ $attribute_name ] = $value;

    wp_script_add_data( $handle, 'html_atts', $attributes );

    return true;
}
