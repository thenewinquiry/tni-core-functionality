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

    private $slug = 'blogs';

    /**
     * Initialize all the things
     *
     * @since 1.0.0
     *
     */
    function __construct() {
        add_action( 'init', array( $this, 'register_taxonomy' ), 0 );
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
    public function register_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Types', 'Taxonomy General Name', 'tni-core' ),
            'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'tni-core' ),
            'menu_name'                  => __( 'Types', 'tni-core' ),
            'all_items'                  => __( 'All Types', 'tni-core' ),
        );
        $rewrite = array(
            'slug'                       => $this->slug,
            'with_front'                 => true,
            'hierarchical'               => false,
        );
        $args = array(
            'labels'                     => apply_filters( 'blog_types_taxonomy_labels', $labels ),
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'query_var'                  => 'blog',
            'rewrite'                    => apply_filters( 'blog_types_taxonomy_rewrite', $rewrite ),
            'show_in_rest'               => true,
            'rest_base'                  => 'blogs',
        );
        register_taxonomy( 'blog-types', array( 'blogs' ), apply_filters( 'blog_types_taxonomy_args', $args ) );
    }

}

new TNI_Core_Taxonomy();
