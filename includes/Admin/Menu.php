<?php
/**
 * Add Menu in admin dashbord by Menu Class.
 *
 * @package wedevs
 */

namespace WeDevs\Academy\Admin;

/**
 * Menu handler class
 */
class Menu {
	/**
	 * Addressbook Class
	 *
	 * @var mixed
	 */
	public $addressbook;
	/**
	 * Add action in menu class construct method
	 *
	 * @return void
	 */
	public function __construct( $addressbook ) {
		$this->addressbook = $addressbook;
		add_action( 'admin_menu', array( $this, 'add_admin_menu_callback' ) );
	}

	/**
	 * Add menu and submenu in admin dashbord
	 *
	 * @return void
	 */
	public function add_admin_menu_callback() {

		$capability  = 'manage_options';
		$parent_slug = 'wedevs-academy';

		$hook = add_menu_page( __( 'Wedevs Academy', 'wedevs-accademy' ), __( 'Academy', 'wedevs-accademy' ), $capability, $parent_slug, array( $this->addressbook, 'plugin_page' ), 'dashicons-welcome-learn-more' );

		add_submenu_page( $parent_slug, __( 'Address Book', 'wedevs-accademy' ), __( 'Address Book', 'wedevs-accademy' ), $capability, $parent_slug, array( $this->addressbook, 'plugin_page' ) );

		add_submenu_page( $parent_slug, __( 'Settings', 'wedevs-accademy' ), __( 'Settings', 'wedevs-accademy' ), $capability, 'wedevs-settings', array( $this, 'plugin_settings_page_callback' ) );

		add_action( 'admin_head-' . $hook, array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Method plugin_settings_page_callback
	 *
	 * @return void
	 */
	public function plugin_settings_page_callback() {
		echo '<h1>Hello submenu World.</h1>';
	}

	/**
	 * Enqueue style for admin page.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		wp_enqueue_style( 'academy-admin-sytle' );
	}
}
