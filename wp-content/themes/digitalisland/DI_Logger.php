<?php
defined('ABSPATH') or die;



/**
 * Logging script for wordpress.
 * It logs stuff to the javascript console by printing script tags in wp_footer.
 * Especially useful when you need to do some dirty debugging inside wordpress filters.
 */

class DI_Logger
{
	public static $logs  = [];
	public static $count = 0;

	public function __construct( $message, $context='', bool $print_as_pre=false )
	{
		$this->id = self::$count++;
		$this->message = $message;
		$this->context = (string) $context;
		$this->print_as_pre = $print_as_pre;

		self::$logs[$this->id] = $this;
	}

	public function remove() {
		unset( self::$logs[$this->id] );
	}

	public function print($return = false)
	{
		$json_options = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE;
		$logScript = '';

		$message = json_encode( $this->message, $json_options );

		if( ! $this->context ) {
			$logScript .= 'console.log(';
			$logScript .= $message;
			$logScript .= ')';
		}
		else {
			$logScript .= 'console.info(';
			$logScript .= "`%c$this->context\\n`, `color:#125c92;font-size:smaller`, ";
			$logScript .= $message;
			$logScript .= ');';
		}

		if( $return ) {
			return $logScript;
		}

		print $logScript;
		return null;
	}


	public function render_as_pre()
	{
		$id      = "log id: $this->id";
		$context = "context: $this->context";
		$message = esc_html(print_r( $this->message, 1) );

		$html    = "<pre class='di-prep'>";
		// $html   .= $id . PHP_EOL;
		// $html   .= $context  . PHP_EOL;
		$html   .= $message;
		$html   .= "</pre>";

		return $html;
	}


	public static function print_all()
	{
		$count = count(self::$logs);
		echo PHP_EOL . "<!-- DI LOGS ({$count}) -->" . PHP_EOL;
		echo '<script>';
		foreach ( self::$logs as $log ) {
			echo $log->print() . PHP_EOL;
		}
		echo '</script>';
	}

	public static function print_all_pre() {
		foreach ( self::$logs as $log ) {
			if( $log->print_as_pre ) {
				echo $log->render_as_pre() . PHP_EOL;
				$log->remove();
			}
		}
	}

	public static function init()
	{
		add_action('wp_footer',    [get_called_class(), 'print_all_pre'], 100);
		add_action('di_logger',    [get_called_class(), 'print_all'], 9998);
		add_action('wp_footer',    [get_called_class(), 'print_all'], 9998);
		add_action('admin_footer', [get_called_class(), 'print_all'], 9998);
	}
}
DI_Logger::init();



/**
 * wrapper function for DI_Logger
 *
 * @param mixed  $message
 * @param string $context
 * @param bool   $print_as_pre
 *
 * @return object DI_Logger
 */
function dilog( $message, $context=null, bool $print_as_pre=false ) {
	if(empty($context)){
		$btrace = debug_backtrace()[1];
		$basename = pathinfo( $btrace['file'], PATHINFO_BASENAME );
		$context =  sprintf( '%s() - %s:%s', $btrace['function'], $basename, $btrace['line'] );
	}
	return new DI_Logger( $message, $context, $print_as_pre );
}
dilog( 'DI_Log active' );
