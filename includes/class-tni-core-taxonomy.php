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
        add_action( 'init', array( $this, 'register_blog_types' ), 0 );
        add_action( 'init', array( $this, 'register_bundles' ), 0 );
    }

    /**
     * Register taxonomy
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_blog_types() {

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

    /**
     * Register Bundle Taxonomy
     *
     * @since 1.3.0
     *
     * @return void
     */
    function register_bundles() {

    	$labels = array(
    		'name'                       => _x( 'Bundles', 'Taxonomy General Name', 'tni-core' ),
    		'singular_name'              => _x( 'Bundle', 'Taxonomy Singular Name', 'tni-core' ),
    		'menu_name'                  => __( 'Bundle', 'tni-core' ),
    		'all_items'                  => __( 'All Bundles', 'tni-core' ),
    		'parent_item'                => __( 'Parent Bundle', 'tni-core' ),
    		'parent_item_colon'          => __( 'Parent Bundle:', 'tni-core' ),
    		'new_item_name'              => __( 'New Bundle Name', 'tni-core' ),
    		'add_new_item'               => __( 'Add New Bundle', 'tni-core' ),
    		'edit_item'                  => __( 'Edit Bundle', 'tni-core' ),
    		'update_item'                => __( 'Update Bundle', 'tni-core' ),
    		'view_item'                  => __( 'View Bundle', 'tni-core' ),
    		'separate_items_with_commas' => __( 'Separate bundles with commas', 'tni-core' ),
    		'add_or_remove_items'        => __( 'Add or remove bundles', 'tni-core' ),
    		'choose_from_most_used'      => __( 'Choose from the most used', 'tni-core' ),
    		'popular_items'              => __( 'Popular Bundles', 'tni-core' ),
    		'search_items'               => __( 'Search Bundles', 'tni-core' ),
    		'not_found'                  => __( 'Not Found', 'tni-core' ),
    		'no_terms'                   => __( 'No bundles', 'tni-core' ),
    		'items_list'                 => __( 'Bundles list', 'tni-core' ),
    		'items_list_navigation'      => __( 'Bundles list navigation', 'tni-core' ),
    	);
    	$args = array(
    		'labels'                     => apply_filters( 'bundles_taxonomy_labels', $labels ),
    		'hierarchical'               => false,
    		'public'                     => true,
    		'show_ui'                    => true,
    		'show_admin_column'          => true,
    		'show_in_nav_menus'          => true,
    		'show_tagcloud'              => true,
    		'show_in_rest'               => true,
    	);
    	register_taxonomy( 'bundle', array( 'post', 'blogs' ), apply_filters( 'bundle_taxonomy_args', $args ) );

    }

}

new TNI_Core_Taxonomy();
