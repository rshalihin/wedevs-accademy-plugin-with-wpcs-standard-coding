<div class="wrap">
	<h1><?php esc_attr_e( 'New Address', 'wedevs-accademy' ); ?></h1>	

	<div>
		<form action="" method="post">
			<table class="form-table">
				<tr class="row<?php echo $this->has_errors( 'name' ) ? ' form-invalid' : ''; ?>">
					<th scope="row">
						<label for="name"><?php esc_attr_e( 'Name', 'wedevs-accademy' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text">
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
						<textarea name="address" id="address" class="regular-text"></textarea>
					</td>
				</tr>
				<tr class="row<?php echo $this->has_errors( 'phone' ) ? ' form-invalid' : ''; ?>">
					<th scope="row">
						<label for="phone"><?php esc_attr_e( 'Phone Number', 'wedevs-accademy' ); ?></label>
					</th>
					<td>
						<input type="text" name="phone" id="phone" class="regular-text">
						
						<?php
						if ( $this->has_errors( 'phone' ) ) {
							?>
							<p class="description error"><?php echo $this->get_errors( 'phone' ); ?></p>
							
							<?php } ?>
					</td>
				</tr>
			</table>
			<?php wp_nonce_field( 'new_address' ); ?>
			<?php submit_button( 'Add Address', 'primary', 'submit_address' ); ?>
		</form>
	</div>
</div>
