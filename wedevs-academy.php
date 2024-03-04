<?php
/**
 * Plugin Name: Wedevs Accademy
 * Description: WeDevs Academy's learning plugin with standard coding. This allows you to keep contact of your members in  WordPress database system.
 * Plugin URI: https://test.com
 * Author : Readush Shgalihin
 * Author URI: https://test.com
 * Version: 0.0.1
 * License : GPLv2 or leater
 * Text Domain: wedevs-accademy
 *
 * @package wedevs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';
/**
 * Wedevs Class start.
 */
final class WedevsAcademy {

	const VERSION = '1.0.0';

	/**
	 * Class main constract function.
	 *
	 * @return void
	 */
	protected function __construct() {
		$this->define_const();
		register_activation_hook( WD_ACADEMY_FILE, array( $this, 'activate' ) );
		add_action( 'plugins_loaded', array( $this, 'plugin_init' ) );
	}

	/**
	 * Singleton instance.
	 *
	 * @return \WedevAcademy
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * Defining plugin constant.
	 *
	 * @return void
	 */
	public function define_const() {
		define( 'WD_ACADEMY_VERSION', self::VERSION );
		define( 'WD_ACADEMY_FILE', __FILE__ );
		define( 'WD_ACADEMY_PATH', __DIR__ );
		define( 'WD_ACADEMY_URL', plugin_dir_url( WD_ACADEMY_FILE ) );
		define( 'WD_ACADEMY_ASSETS', plugin_dir_url( WD_ACADEMY_FILE ) . 'assets' );
	}

	/**
	 * After activation keep plugin version.
	 *
	 * @return void
	 */
	public function activate() {

		$installer = new \WeDevs\Academy\Installer();
		$installer->installer_run();
	}

	/**
	 * Load all plugin's class
	 *
	 * @return void
	 */
	public function plugin_init() {
		new WeDevs\Academy\Assets();

		if ( is_admin() ) {
			new WeDevs\Academy\Admin();
		} else {
			new WeDevs\Academy\Frontend();
		}
	}
}

/**
 * Initialize the plugin.
 *
 * @return \WedevsAcademy
 */
function wedevs_academy() {
	return WedevsAcademy::init();
}

/**
 * Kick of the plugin.
 */
wedevs_academy();
