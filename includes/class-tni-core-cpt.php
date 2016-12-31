<?php
/**
 * TNI Core Register Custom Post Types
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
class TNI_Core_CPT {

    private $slug = '';

    /**
     * Initialize all the things
     *
     * @since 1.0.0
     *
     */
    function __construct() {
        register_extended_post_type( 'magazines', array(
            'menu_icon'       => 'dashicons-book'
        ) );

        register_extended_post_type( 'blogs', array(
            'menu_icon'       => 'dashicons-id-alt',
            'blog-types' => array(
                'taxonomy' => 'blog-types'
            )
        ) );

        register_extended_post_type( 'books', array(
            'menu_icon'       => 'dashicons-book-alt'
        ) );

        register_extended_post_type( 'av' );

        register_extended_post_type( 'essays' );

        register_extended_post_type( 'and-meanwhile' );

        register_extended_post_type( 'news' );
    }

    /**
     * Register Custom Post Type
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_cpt( $args ) {
        register_extended_post_type( $args );
    }

}

new TNI_Core_CPT();
