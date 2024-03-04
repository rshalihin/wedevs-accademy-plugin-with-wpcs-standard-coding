<?php

namespace WeDevs\Academy\Traits;

trait Form_Errors {

    
	/**
	 * Create an array for handle error
	 *
	 * @var array
	 */
    public $errors = array();

/**
	 * Check if has errors
	 *
	 * @param string $key array key.
	 *
	 * @return boolean
	 */
	public function has_errors( $key ) {
		if ( isset( $this->errors[ $key ] ) ) {
			return true;
		}
	}

	/**
	 * Get Errors
	 *
	 * @param string $key array key.
	 *
	 * @return array|boolean
	 */
	public function get_errors( $key ) {
		if ( isset( $this->errors[ $key ] ) ) {
			return $this->errors[ $key ];
		}
		return false;
	}
}
