<?php

namespace WeDevs\Academy;

/**
 * Admin Handler class
 */
class Installer {
	/**
	 * Run the installer
	 */
	public function installer_run() {
		$this->add_version();
		$this->create_table();
	}

	/**
	 * Add Version.
	 */
	public function add_version() {

		$install = get_option( 'wedevs_academy_installed' );
		if ( ! $install ) {
			update_option( 'wedevs_academy_installed', time() );
		}
		update_option( 'wedevs_academy_version', WD_ACADEMY_VERSION );
	}

	/**
	 * Create wedevs-academy table
	 */
	public function create_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}ac_addresses` (`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , `address` VARCHAR(255) NULL , `phone` VARCHAR(30) NULL , `created_by` BIGINT(20) UNSIGNED NOT NULL , `created_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) $charset_collate";

		if ( ! function_exists( 'dbDelta()' ) ) {
			require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		}

		dbDelta( $schema );
	}
}
