<?php
defined('ABSPATH') or die;


if( ! include_once( __DIR__.'/DI_Logger.php' ) ) {
	function dilog(){} // fallback if DI_Logger is missing
}

// require 3rd party libs:
require_once __DIR__ . '/vendor/autoload.php';


// require theme functions
require_once __DIR__ . '/functions/theme-functions.php';
