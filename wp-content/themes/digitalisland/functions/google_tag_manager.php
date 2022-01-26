<?php
defined('ABSPATH') or die();

// Prints google tag manager stuff in <head>
function dihello_gtm_head() {
	$site_gtm_id = '';

	if ( !empty( $site_gtm_id ) ) {
		echo "<!-- Google Tag Manager -->"
		. "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':"
		. "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],"
		. "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src="
		. "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);"
		. "})(window,document,'script','dataLayer','{$site_gtm_id}');</script>";
	}
}
add_action('wp_head', 'dihello_gtm_head', 0);


// Prints google tag manager stuff in <body>
function dihello_gtm_body() {
	$site_gtm_id = '';

	if ( !empty( $site_gtm_id ) ) {
		echo '<!-- Google Tag Manager (noscript) -->'
		. '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $site_gtm_id . '"'
		. 'height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>'
		. '<!-- End Google Tag Manager (noscript) -->';
	}
}
add_action( 'wp_body_open', 'dihello_gtm_body', 0, 0 );
