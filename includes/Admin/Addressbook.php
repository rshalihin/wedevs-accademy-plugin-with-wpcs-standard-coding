<?php
/**
 * Address book page.
 *
 * @package wedevs
 */

namespace WeDevs\Academy\Admin;

use WeDevs\Academy\Traits\Form_Errors;

/**
 * Plugin page class
 */
class Addressbook {

	use Form_Errors;

	/**
	 * Address book page function
	 */
	public function plugin_page() {

		$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
		$id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

		switch ( $action ) {
			case 'new':
				$template = __DIR__ . '/views/address-new.php';
				break;

			case 'edit':
				$address  = wd_ac_get_address_row( $id );
				$template = __DIR__ . '/views/address-edit.php';
				break;

			case 'view':
				$template = __DIR__ . '/views/address-wiew.php';
				break;

			default:
				$template = __DIR__ . '/views/address-list.php';
		}

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Handle the new address form
	 *
	 * @return void
	 */
	public function form_handler() {

		if ( ! isset( $_POST['submit_address'] ) ) {
			return;
		}
		if ( ! isset( $_POST['_wpnonce'] ) && ! wp_verify_nonce( $_POST['_wpnonce'], 'new_address' ) ) {
			wp_die( 'Are you cheating' );
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating' );
		}

		$id      = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
		$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
		$address = isset( $_POST['address'] ) ? sanitize_textarea_field( wp_unslash( $_POST['address'] ) ) : '';
		$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';

		if ( empty( $name ) ) {
			$this->errors['name'] = __( 'Please provide a name !!!', 'wedevs-accademy' );
		}
		if ( empty( $phone ) ) {
			$this->errors['phone'] = __( 'Please provide a phone number.', 'wedevs-accademy' );
		}
		if ( ! empty( $this->errors ) ) {
			return;
		}

		$args = array(
			'name'    => $name,
			'address' => $address,
			'phone'   => $phone,
		);
		if ( $id ) {
			$args['id'] = $id;
		}

		$insert_id = wd_ac_insert_address( $args );

		if ( is_wp_error( $insert_id ) ) {
			wp_die( esc_attr( $insert_id->get_error_message() ) );
		}

		if ( $id ) {
			$redirect_to = admin_url( 'admin.php?page=wedevs-academy&action=edit&address-updated=true&id=' . $id );
		} else {
			$redirect_to = admin_url( 'admin.php?page=wedevs-academy&inserted=true' );
		}

		wp_safe_redirect( $redirect_to );
		exit;
	}

	/**
	 * Delete Address form database function
	 *
	 * @return void
	 */
	public function delete_address() {

		// Varify wp nonce.
		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'wd-ac-delete-address' ) ) {
			wp_die( 'Are you cheating' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating' );
		}

		$id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

		if ( wd_ac_delete( $id ) ) {
			$redirect_to = admin_url( 'admin.php?page=wedevs-academy&address-deleted=true' );
		} else {
			$redirect_to = admin_url( 'admin.php?page=wedevs-academy&address-deleted=false' );
		}
		wp_safe_redirect( $redirect_to );
		exit;
	}
}
