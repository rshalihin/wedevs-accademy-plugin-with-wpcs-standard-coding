<?php

namespace WeDevs\Academy;

/**
 * Admin Handler class
 */
class Assets {
	/**
	 * Action for enqueue
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}


	/**
	 * Get the script in array
	 *
	 * @return array
	 */
	public function get_scripts() {
		return array(
			'academy-scripts' => array(
				'src'     => WD_ACADEMY_ASSETS . '/js/frontend.js',
				'version' => filemtime( WD_ACADEMY_PATH . '/assets/js/frontend.js' ),
				'deps'    => array( 'jQuery' ),
			),
		);
	}

	/**
	 * Get Style in array
	 *
	 * @return array
	 */
	public function get_styles() {
		return array(
			'academy-style'       => array(
				'src'     => WD_ACADEMY_ASSETS . '/css/frontend.css',
				'version' => filemtime( WD_ACADEMY_PATH . '/assets/css/frontend.css' ),
			),
			'academy-admin-sytle' => array(
				'src'     => WD_ACADEMY_ASSETS . '/css/wedevs_admin.css',
				'version' => filemtime( WD_ACADEMY_PATH . '/assets/css/wedevs_admin.css' ),
			),
		);
	}

	/**
	 * Enqueue Assets
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		$scripts = $this->get_scripts();
		foreach ( $scripts as $handle => $script ) {
			$deps = isset( $script['deps'] ) ? $script['deps'] : false;
			wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
		}

		$styles = $this->get_styles();

		foreach ( $styles as $handle => $style ) {
			$deps = isset( $style['deps'] ) ? $style['deps'] : false;
			wp_register_style( $handle, $style['src'], $deps, $style['version'] );
		}
	}
}
