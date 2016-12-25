<?php
/**
 * TNI Core Register Taxonomy
 *
 * @package    TNI_Core
 * @subpackage TNI_Core\Includes
 * @since      1.0.0
 * @license    GPL-2.0+
 */

/**
 * Register Shortcodes
 *
 * @since 1.0.0
 *
 */
class TNI_Core_Taxonomy {

    private $slug = '';

    /**
     * Initialize all the things
     *
     * @since 1.0.0
     *
     */
    function __construct() {
        add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
        add_action( 'init', array( $this, 'add_media_category' ) );
    }

    /**
     * Register taxonomy
     *
     * @since 1.0.0
     *
     * @param string $shortcode_tag
     * @param function $shortcode_function
     *
     */
    public function register_taxonomy() {}

    /**
     * Add Media Category Term
     *
     * @since 1.0.0
     *
     * @uses term_exists
     * @uses wp_insert_term
     */
    public function add_media_category() {}
}

new TNI_Core_Taxonomy();
