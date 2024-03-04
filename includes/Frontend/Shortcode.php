<?php
/**
 * Handle shortcode from this file.
 *
 * @package wedevs
 */

namespace WeDevs\Academy\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode {
	/**
	 * Shortcode class construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'wedevs-academy', array( $this, 'render_shortcode' ) );
	}

	/**
	 * Shortcode helder
	 *
	 * @param array  $atts an attribute array.
	 * @param string $content the content.
	 *
	 * @return $content
	 */
	public function render_shortcode( $atts, $content = '' ) {
		wp_enqueue_style( 'academy-style' );
		return '<div class="wedevs-bg">Hello form Shortcode</div>';
	}
}
