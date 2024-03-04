<?php

namespace WeDevs\Academy;

/**
 * Admin Handler class
 */
class Admin {
	/**
	 * Construct
	 *
	 * @return void
	 */
	public function __construct() {
		$addressbook = new Admin\Addressbook();
		new Admin\Menu( $addressbook );
		$this->dispatch_action( $addressbook );
	}

	/**
	 * Dispatch action in this plugin
	 *
	 * @return void
	 */
	public function dispatch_action( $addressbook ) {
		add_action( 'admin_init', array( $addressbook, 'form_handler' ) );
		add_action( 'admin_post_wd-ac-delete-address', array( $addressbook, 'delete_address' ) );
	}
}
