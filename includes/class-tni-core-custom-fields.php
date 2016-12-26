<?php
/**
 * TNI Core Register Custom Fields
 *
 * @package    TNI_Core
 * @subpackage TNI_Core\Includes
 * @since      1.0.0
 * @license    GPL-2.0+
 */

/**
 * Register Custom Fields
 *
 * @since 1.0.0
 *
 */
class TNI_Core_Custom_Fields {

    private $slug = '';

    /**
     * Initialize all the things
     *
     * @since 1.0.0
     *
     */
    function __construct() {

        if( function_exists( 'register_field_group' ) ) {
            $this->register_field_groups();
        }
    }

    /**
     * Register Field Groups
     *
     * @since 1.0.0
     *
     * @uses register_field_group()
     *
     * @return void
     */
    public function register_field_groups() {
        register_field_group( array (
    		'id' => 'acf_about-page',
    		'title' => __( 'Details', 'tni-core' ),
    		'fields' => array (
    			array (
    				'key' => 'field_58293c8caa284',
    				'label' => __( 'Contact Information', 'tni-core' ),
    				'name' => 'contact_information',
    				'type' => 'wysiwyg',
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    			array (
    				'key' => 'field_582ccd21430a2',
    				'label' => __( 'Advisory Board', 'tni-core' ),
    				'name' => 'advisory_board',
    				'type' => 'wysiwyg',
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'page',
    					'operator' => '==',
    					'value' => $this->get_page_id( 'about' ),
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'normal',
    			'layout' => 'no_box',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));

    	register_field_group(array (
    		'id' => 'acf_essay',
    		'title' => __( 'Featured Content', 'tni' ),
    		'fields' => array (
    			array (
    				'key' => 'field_582932fcbf795',
    				'label' => __( 'Featured Text', 'tni-core' ),
    				'name' => 'featured_text',
    				'type' => 'wysiwyg',
    				'instructions' => __( 'Text that appears with featured homepage article.', 'tni-core' ),
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'post_type',
    					'operator' => '==',
    					'value' => 'post',
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'normal',
    			'layout' => 'default',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));

    	register_field_group(array (
    		'id' => 'acf_magazine',
    		'title' => __( 'Magazine Details', 'tni-core' ),
    		'fields' => array (
    			array (
    				'key' => 'field_582ccddeef2a3',
    				'label' => __( 'Editor\'s Note', 'tni-core' ),
    				'name' => 'editors_note',
    				'type' => 'wysiwyg',
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'post_type',
    					'operator' => '==',
    					'value' => 'magazines',
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'normal',
    			'layout' => 'no_box',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));
    	register_field_group(array (
    		'id' => 'acf_publications-page',
    		'title' => __( 'Publication Details', 'tni-core' ),
    		'fields' => array (
    			array (
    				'key' => 'field_582ccdb6cd651',
    				'label' => 'Book Imprint',
    				'name' => 'book_imprint',
    				'type' => 'wysiwyg',
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'page',
    					'operator' => '==',
    					'value' => $this->get_page_id( 'publications' ),
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'normal',
    			'layout' => 'no_box',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));
    }

    /**
     * Get Page ID
     *
     * @since 1.0.0
     *
     * @uses get_page_by_path()
     *
     * @param  string $slug
     * @return int $page->ID
     */
    public function get_page_id( $slug ) {
        $page = get_page_by_path( $slug );
    	if ( $page ) {
    		return (int) $page->ID;
    	} else {
    		return null;
        }
    }
}

new TNI_Core_Custom_Fields();
