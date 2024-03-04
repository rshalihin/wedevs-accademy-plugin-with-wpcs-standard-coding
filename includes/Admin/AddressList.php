<?php
/**
 * Address list.
 *
 * @package wedevs
 */

namespace WeDevs\Academy\Admin;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Plugin page class
 */
class AddressList extends \WP_List_Table {

	/**
	 * Call parent __construct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'contact',
				'plural'   => 'contacts',
				'ajax'     => false,
			)
		);
	}

	/**
	 * Massage to show if no designation found.
	 *
	 * @return void
	 */
	public function no_items() {
		esc_attr_e( 'No address found !', 'wedevs-accademy' );
	}

	/**
	 * Gets a list of columns
	 *
	 * @return array
	 */
	public function get_columns() {
		return array(
			'cb'         => '<input type="checkbox" />',
			'name'       => __( 'Name', 'wedevs-accademy' ),
			'address'    => __( 'Address', 'wedevs-accademy' ),
			'phone'      => __( 'Phone Number', 'wedevs-accademy' ),
			'created_at' => __( 'Date', 'wedevs-accademy' ),
		);
	}

	/**
	 * Get sortable columns
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'name'       => array( 'name', true ),
			'created_at' => array( 'created_at', true ),
		);
		return $sortable_columns;
	}

	/**
	 * Set the bulk action
	 *
	 * @return array
	 */
	public function get_bulk_action() {
		$action = array(
			'trash' => __( 'Move to Trash', 'wedevs-accademy' ),
		);
		return $action;
	}

	/**
	 * To show table's data
	 *
	 * @param object      $item table data object.
	 * @param $column_name $column_name [explicite description].
	 *
	 * @return object
	 */
	protected function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'created_at':
				return wp_date( get_option( 'date_format' ), strtotime( $item->$column_name ) );
			default:
				return isset( $item->$column_name ) ? $item->$column_name : '';
		}
	}

	/**
	 * To show Column Name
	 *
	 * @param object $item [explicite description].
	 *
	 * @return array
	 */
	public function column_name( $item ) {
		$action         = array();
		$action['edit'] = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=wedevs-academy&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'wedevs-accademy' ) );

		$action['delete'] = sprintf( '<a href="%s" class="submitdelet" onclick="return confirm(\'Are you sure \');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=wd-ac-delete-address&id=' . $item->id ), 'wd-ac-delete-address' ), $item->id, __( 'Delete', 'wedevs-accademy' ) );

		return sprintf( '<a href="%1$s"><strong>%2$s</strong></a>%3$s', admin_url( 'admin.php?page=wedevs-academy&action=view&id=' . $item->id ), $item->name, $this->row_actions( $action ) );
	}

	/**
	 * Column Object
	 *
	 * @param $item $item [explicite description].
	 *
	 * @return object
	 */
	public function column_cb( $item ) {
		return sprintf( '<input type="checkbox" name="address_id[]" value="%d" />', $item->id );
	}

	/**
	 * Prepare Items
	 *
	 * @return void
	 */
	public function prepare_items() {

		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array( $columns, $hidden, $sortable );

		$per_page     = 20;
		$current_page = $this->get_pagenum();
		$offset       = ( $current_page - 1 ) * $per_page;

		$args = array(
			'number' => $per_page,
			'offset' => $offset,
		);

		if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
			$args['orderby'] = $_REQUEST['orderby'];
			$args['order']   = $_REQUEST['order'];
		}

		$this->items = wd_ac_get_addresses( $args );
		$this->set_pagination_args(
			array(
				'total_items' => wd_ac_addresses_count(),
				'per_page'    => $per_page,
			)
		);
	}
}
