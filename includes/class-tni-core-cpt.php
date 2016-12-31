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
            'menu_icon'       => 'dashicons-book',
            ), array(
                'singular' => __( 'Magazine', 'tni' ),
                'plural'   => __( 'Magazines', 'tni' ),
                'slug'     => 'magazines'
            )
        );

        register_extended_post_type( 'blogs', array(
            'menu_icon'       => 'dashicons-id-alt',
                array(
                    'taxonomies' => array( 'blog-types' )
                )
            ), array(
                'singular' => __( 'Blog', 'tni' ),
                'plural'   => __( 'Blogs', 'tni' ),
                'slug'     => 'blogs'
            )
        );

        register_extended_post_type( 'books', array(
            'menu_icon'       => 'dashicons-book-alt'
            ), array(
                'singular' => __( 'Book', 'tni' ),
                'plural'   => __( 'Books', 'tni' ),
                'slug'     => 'books'
            )
        );

        // register_extended_post_type( 'av', array(
        //     'taxonomies' => array( 'category' )
        // ) );
        //
        // register_extended_post_type( 'features', array(
        //     'taxonomies' => array( 'category' )
        // ) );
        //
        // register_extended_post_type( 'essays', array(
        //     'taxonomies' => array( 'category' )
        // ) );
        //
        // register_extended_post_type( 'and-meanwhile', array(
        //     'taxonomies' => array( 'category' )
        // ) );
        //
        // register_extended_post_type( 'news', array(
        //     'taxonomies' => array( 'category' )
        // ) );
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
