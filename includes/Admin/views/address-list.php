<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Address Book', 'wedevs-accademy' ); ?></h1>

	<a href="<?php echo admin_url( 'admin.php?page=wedevs-academy&action=new' ); ?>" class="page-title-action"><?php _e( 'New Address', 'wedevs-accademy' ); ?></a>


	<?php
	if ( isset( $_GET['inserted'] ) ) {
		?>
			<div class="notice notice-success">
				<p><?php echo esc_attr_e( 'Address has been added successfully!', 'wedevs-accademy' ); ?></p>
			</div>
		<?php
	}
	?>
	<?php
	if ( isset( $_GET['address-deleted'] ) && $_GET['address-deleted'] === 'true' ) {
		?>
			<div class="notice notice-success">
				<p><?php echo esc_attr_e( 'Address has been deleteded successfully!', 'wedevs-accademy' ); ?></p>
			</div>
		<?php
	}
	?>


	<form action="" method="post">
		<?php
		$table = new \WeDevs\Academy\Admin\AddressList();
		$table->prepare_items();
		$table->search_box( 'search', 'search_id' );
		$table->display();
		?>
	</form>
</div>
