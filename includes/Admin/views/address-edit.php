<div class="wrap">
	<h1><?php esc_attr_e( 'Edit Address', 'wedevs-accademy' ); ?></h1>

	<?php
	if ( isset( $_GET['address-updated'] ) ) {
		?>
			<div class="notice notice-success">
				<p><?php echo esc_attr_e( 'Address has been updated successfully!', 'wedevs-accademy' ); ?></p>
			</div>
		<?php
	}
	?>

	<div>
		<form action="" method="post">
			<table class="form-table">
				<tr class="row<?php echo $this->has_errors( 'name' ) ? ' form-invalid' : ''; ?>">
					<th scope="row">
						<label for="name"><?php esc_attr_e( 'Name', 'wedevs-accademy' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $address->name ); ?>">
						<?php
						if ( $this->has_errors( 'name' ) ) {
							?>
							<p class="description error"><?php echo $this->get_errors( 'name' ); ?></p>	
							<?php } ?></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="address"><?php esc_attr_e( 'Address', 'wedevs-accademy' ); ?></label>
					</th>
					<td>
						<textarea name="address" id="address" class="regular-text"><?php echo esc_textarea( $address->address ); ?></textarea>
					</td>
				</tr>
				<tr class="row<?php echo $this->has_errors( 'phone' ) ? ' form-invalid' : ''; ?>">
					<th scope="row">
						<label for="phone"><?php esc_attr_e( 'Phone Number', 'wedevs-accademy' ); ?></label>
					</th>
					<td>
						<input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr( $address->phone ); ?>">
						
						<?php
						if ( $this->has_errors( 'phone' ) ) {
							?>
							<p class="description error"><?php echo $this->get_errors( 'phone' ); ?></p>
							
							<?php } ?>
					</td>
				</tr>
			</table>
			<input type="hidden" name="id" value="<?php echo esc_attr( $address->id ); ?>">
			<?php wp_nonce_field( 'new_address' ); ?>
			<?php submit_button( 'Update Address', 'primary', 'submit_address' ); ?>
		</form>
	</div>
</div>
