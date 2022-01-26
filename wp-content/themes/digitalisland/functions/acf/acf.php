<?php
namespace diis;


defined('ABSPATH') or die;

/**
 * Singleton class responsible for hooking into ACF and loading ACF related files
 */
final class ACF_Manager {
	private static $instance = null;

	private function __construct() {

		if (\is_admin() ) {
			\add_action( 'acf/init', [ $this, 'add_options_pages' ], 9 );
		}

		\add_action( 'acf/init', [ $this, 'setup_fields' ], 1 );
	}

	public static function instance() {
		if (self::$instance === null) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	// Setup theme settings admin page
	public function add_options_pages() {
		try {
			acf_add_options_page([
				'page_title'  => __("Theme Settings", "digitalisland"),
				'menu_title'  => __("Theme", "digitalisland"),
				'menu_slug' => "footer",
				'capability'  => "edit_theme_options",
				'redirect'    => false,
			]);
		}
		catch (\Throwable $th) {
			di_admin_notice( __('The plugin "<em>advanced custom fields pro</em>" must be installed and enabled for the theme Digitalisland to work correctly.', 'error') );
			trigger_error( $th->getMessage(), E_USER_WARNING );
			return false;
		};

		return true;
	}

	// Register our theme's acf fields
	public function setup_fields(  ) {
		require_once __DIR__ . '/page-layouts.php';
		require_once __DIR__ . '/site-hero.php';
		require_once __DIR__ . '/site-options.php';
	}
}
