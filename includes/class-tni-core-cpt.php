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
        add_action( 'init', array( $this, 'register_magazines' ), 0 );
        add_action( 'init', array( $this, 'register_blogs' ), 0 );
        add_action( 'init', array( $this, 'register_books' ), 0 );
    }

    /**
     * Register Custom Post Type
     *
     * @since 1.0.0
     *
     * @return void
     */
     public function register_magazines() {

     	$labels = array(
     		'name'                  => _x( 'Magazines', 'Post Type General Name', 'tni-core' ),
     		'singular_name'         => _x( 'Magazine', 'Post Type Singular Name', 'tni-core' ),
     		'menu_name'             => __( 'Magazines', 'tni-core' ),
     		'name_admin_bar'        => __( 'Magazine', 'tni-core' ),
     		'archives'              => __( 'Item Archives', 'tni-core' ),
     		'attributes'            => __( 'Item Attributes', 'tni-core' ),
     		'parent_item_colon'     => __( 'Parent Item:', 'tni-core' ),
     		'all_items'             => __( 'All Items', 'tni-core' ),
     		'add_new_item'          => __( 'Add New Item', 'tni-core' ),
     		'add_new'               => __( 'Add New', 'tni-core' ),
     		'new_item'              => __( 'New Item', 'tni-core' ),
     		'edit_item'             => __( 'Edit Item', 'tni-core' ),
     		'update_item'           => __( 'Update Item', 'tni-core' ),
     		'view_item'             => __( 'View Item', 'tni-core' ),
     		'view_items'            => __( 'View Items', 'tni-core' ),
     		'search_items'          => __( 'Search Item', 'tni-core' ),
     		'not_found'             => __( 'Not found', 'tni-core' ),
     		'not_found_in_trash'    => __( 'Not found in Trash', 'tni-core' ),
     		'featured_image'        => __( 'Featured Image', 'tni-core' ),
     		'set_featured_image'    => __( 'Set featured image', 'tni-core' ),
     		'remove_featured_image' => __( 'Remove featured image', 'tni-core' ),
     		'use_featured_image'    => __( 'Use as featured image', 'tni-core' ),
     		'insert_into_item'      => __( 'Insert into item', 'tni-core' ),
     		'uploaded_to_this_item' => __( 'Uploaded to this item', 'tni-core' ),
     		'items_list'            => __( 'Items list', 'tni-core' ),
     		'items_list_navigation' => __( 'Items list navigation', 'tni-core' ),
     		'filter_items_list'     => __( 'Filter items list', 'tni-core' ),
     	);

        $rewrite = array(
    		'slug'                  => 'magazine',
    		'with_front'            => true,
    		'pages'                 => true,
    		'feeds'                 => true,
    	);

     	$args = array(
     		'label'                 => __( 'Magazine', 'tni-core' ),
     		'description'           => __( 'Post type for magazines', 'tni-core' ),
     		'labels'                => apply_filters( 'register_magazines_labels', $labels ),
     		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', ),
     		'hierarchical'          => false,
     		'public'                => true,
     		'show_ui'               => true,
     		'show_in_menu'          => true,
     		'menu_position'         => 5,
     		'menu_icon'             => 'dashicons-book-alt',
     		'show_in_admin_bar'     => true,
     		'show_in_nav_menus'     => true,
     		'can_export'            => true,
     		'has_archive'           => true,
     		'exclude_from_search'   => false,
     		'publicly_queryable'    => true,
            'rewrite'               => apply_filters( 'register_magazines_rewrite', $rewrite ),
     		'capability_type'       => 'page',
     		'show_in_rest'          => true,
     		'rest_base'             => 'magazines',
     	);
     	register_post_type( 'magazines', apply_filters( 'register_magazines_args', $args ) );
     }

     /**
      * Register Custom Post Type
      *
      * @since 1.0.0
      *
      * @return void
      */
     public function register_blogs() {

     	$labels = array(
     		'name'                  => _x( 'Blogs', 'Post Type General Name', 'tni-core' ),
     		'singular_name'         => _x( 'Blog', 'Post Type Singular Name', 'tni-core' ),
     		'menu_name'             => __( 'Blogs', 'tni-core' ),
     		'name_admin_bar'        => __( 'Blog', 'tni-core' ),
     		'archives'              => __( 'Item Archives', 'tni-core' ),
     		'attributes'            => __( 'Item Attributes', 'tni-core' ),
     		'parent_item_colon'     => __( 'Parent Item:', 'tni-core' ),
     		'all_items'             => __( 'All Items', 'tni-core' ),
     		'add_new_item'          => __( 'Add New Item', 'tni-core' ),
     		'add_new'               => __( 'Add New', 'tni-core' ),
     		'new_item'              => __( 'New Item', 'tni-core' ),
     		'edit_item'             => __( 'Edit Item', 'tni-core' ),
     		'update_item'           => __( 'Update Item', 'tni-core' ),
     		'view_item'             => __( 'View Item', 'tni-core' ),
     		'view_items'            => __( 'View Items', 'tni-core' ),
     		'search_items'          => __( 'Search Item', 'tni-core' ),
     		'not_found'             => __( 'Not found', 'tni-core' ),
     		'not_found_in_trash'    => __( 'Not found in Trash', 'tni-core' ),
     		'featured_image'        => __( 'Featured Image', 'tni-core' ),
     		'set_featured_image'    => __( 'Set featured image', 'tni-core' ),
     		'remove_featured_image' => __( 'Remove featured image', 'tni-core' ),
     		'use_featured_image'    => __( 'Use as featured image', 'tni-core' ),
     		'insert_into_item'      => __( 'Insert into item', 'tni-core' ),
     		'uploaded_to_this_item' => __( 'Uploaded to this item', 'tni-core' ),
     		'items_list'            => __( 'Items list', 'tni-core' ),
     		'items_list_navigation' => __( 'Items list navigation', 'tni-core' ),
     		'filter_items_list'     => __( 'Filter items list', 'tni-core' ),
     	);

        $rewrite = array(
    		'slug'                  => 'blog',
    		'with_front'            => true,
    		'pages'                 => true,
    		'feeds'                 => true,
    	);

     	$args = array(
     		'label'                 => __( 'Blog', 'tni-core' ),
     		'description'           => __( 'Post type for blogs', 'tni-core' ),
     		'labels'                => apply_filters( 'register_blogs_labels', $labels ),
     		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', ),
     		'taxonomies'            => array( 'blog-types' ),
     		'hierarchical'          => false,
     		'public'                => true,
     		'show_ui'               => true,
     		'show_in_menu'          => true,
     		'menu_position'         => 5,
     		'menu_icon'             => 'dashicons-id-alt',
     		'show_in_admin_bar'     => true,
     		'show_in_nav_menus'     => true,
     		'can_export'            => true,
     		'has_archive'           => true,
     		'exclude_from_search'   => false,
     		'publicly_queryable'    => true,
            'rewrite'               => apply_filters( 'register_blogs_rewrite', $rewrite ),
     		'capability_type'       => 'page',
     		'show_in_rest'          => true,
     		'rest_base'             => 'blogs',
     	);
     	register_post_type( 'blogs', apply_filters( 'register_blogs_args', $args ) );

     }

     /**
      * Register Custom Post Type
      *
      * @since 1.0.0
      *
      * @return void
      */
     public function register_books() {

     	$labels = array(
     		'name'                  => _x( 'Books', 'Post Type General Name', 'tni-core' ),
     		'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'tni-core' ),
     		'menu_name'             => __( 'Books', 'tni-core' ),
     		'name_admin_bar'        => __( 'Book', 'tni-core' ),
     		'archives'              => __( 'Item Archives', 'tni-core' ),
     		'attributes'            => __( 'Item Attributes', 'tni-core' ),
     		'parent_item_colon'     => __( 'Parent Item:', 'tni-core' ),
     		'all_items'             => __( 'All Items', 'tni-core' ),
     		'add_new_item'          => __( 'Add New Item', 'tni-core' ),
     		'add_new'               => __( 'Add New', 'tni-core' ),
     		'new_item'              => __( 'New Item', 'tni-core' ),
     		'edit_item'             => __( 'Edit Item', 'tni-core' ),
     		'update_item'           => __( 'Update Item', 'tni-core' ),
     		'view_item'             => __( 'View Item', 'tni-core' ),
     		'view_items'            => __( 'View Items', 'tni-core' ),
     		'search_items'          => __( 'Search Item', 'tni-core' ),
     		'not_found'             => __( 'Not found', 'tni-core' ),
     		'not_found_in_trash'    => __( 'Not found in Trash', 'tni-core' ),
     		'featured_image'        => __( 'Featured Image', 'tni-core' ),
     		'set_featured_image'    => __( 'Set featured image', 'tni-core' ),
     		'remove_featured_image' => __( 'Remove featured image', 'tni-core' ),
     		'use_featured_image'    => __( 'Use as featured image', 'tni-core' ),
     		'insert_into_item'      => __( 'Insert into item', 'tni-core' ),
     		'uploaded_to_this_item' => __( 'Uploaded to this item', 'tni-core' ),
     		'items_list'            => __( 'Items list', 'tni-core' ),
     		'items_list_navigation' => __( 'Items list navigation', 'tni-core' ),
     		'filter_items_list'     => __( 'Filter items list', 'tni-core' ),
     	);

        $rewrite = array(
    		'slug'                  => 'book',
    		'with_front'            => true,
    		'pages'                 => true,
    		'feeds'                 => true,
    	);

     	$args = array(
     		'label'                 => __( 'Book', 'tni-core' ),
     		'description'           => __( 'Post type for books', 'tni-core' ),
     		'labels'                => apply_filters( 'register_books_labels', $labels ),
     		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', ),
     		'hierarchical'          => false,
     		'public'                => true,
     		'show_ui'               => true,
     		'show_in_menu'          => true,
     		'menu_position'         => 5,
     		'menu_icon'             => 'dashicons-book',
     		'show_in_admin_bar'     => true,
     		'show_in_nav_menus'     => true,
     		'can_export'            => true,
     		'has_archive'           => true,
     		'exclude_from_search'   => false,
     		'publicly_queryable'    => true,
            'rewrite'               => apply_filters( 'register_books_rewrite', $rewrite ),
     		'capability_type'       => 'page',
     		'show_in_rest'          => true,
     		'rest_base'             => 'books',
     	);
     	register_post_type( 'books', apply_filters( 'register_books_args', $args ) );
     }

}

new TNI_Core_CPT();
