<?php
/**
 * Function file.
 *
 * @package wedevs.
 */

/**
 * Insert new address.
 *
 * @param array $args [ arguments ].
 *
 * @return init|WP_Error
 */
function wd_ac_insert_address( $args = array() ) {
	global $wpdb;

	if ( empty( $args['name'] ) ) {
		return new \WP_Error( 'no-name', __( 'You must provide your name to submit form !!!' ) );
	}

	$defaults = array(
		'name'       => '',
		'address'    => '',
		'phone'      => '',
		'created_by' => get_current_user_id(),
		'created_at' => current_time( 'mysql' ),
	);

	$data = wp_parse_args( $args, $defaults );

	if ( isset( $data['id'] ) ) {

		$id = $data['id'];
		unset( $data['id'] );

		// Data Update in database.
		$update = $wpdb->update(
			"{$wpdb->prefix}ac_addresses",
			$data,
			array( 'id' => $id ),
			array(
				'%s',
				'%s',
				'%s',
				'%d',
				'%s',
			),
			array( '%d' ),
		);
		return $update;
	} else {

		// Data Insert in database.
		$inserted = $wpdb->insert(
			"{$wpdb->prefix}ac_addresses",
			$data,
			array(
				'%s',
				'%s',
				'%s',
				'%d',
				'%s',
			)
		);

		if ( ! $inserted ) {
			return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'wedevs-accademy' ) );
		}
		return $wpdb->insert_id;
	}
}

/**
 * Get Adddresses
 *
 * @param array $args arguments.
 *
 * @return array
 */
function wd_ac_get_addresses( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'number'  => 20,
		'offset'  => 0,
		'orderby' => 'id',
		'order'   => 'ASC',
	);

	$data = wp_parse_args( $args, $defaults );

	$items = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT * FROM {$wpdb->prefix}ac_addresses
			ORDER BY {$data['orderby']} {$data['order']}
			LIMIT %d, %d",
			$data['offset'],
			$data['number']
		)
	);

	return $items;
}

/**
 * Count the number of address
 *
 * @return int
 */
function wd_ac_addresses_count() {
	global $wpdb;

	return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}ac_addresses" );
}

/**
 * Get row from database.
 *
 * @param int $id .
 *
 * @return Object
 */
function wd_ac_get_address_row( $id ) {
	global $wpdb;

	return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ac_addresses WHERE id = %d", $id ) );
}

/**
 * Delete row from database.
 *
 * @param int $id .
 *
 * @return init|boolean
 */
function wd_ac_delete( $id ) {
	global $wpdb;

	return $wpdb->delete(
		$wpdb->prefix . 'ac_addresses',
		array( 'id' => $id ),
		array( '%d' ),
	);
}
