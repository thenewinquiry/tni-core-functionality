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

    	register_field_group( array (
    		'id' => 'acf_essay',
    		'title' => __( 'Featured Content', 'tni' ),
    		'fields' => array (
          array (
            'key' => 'field_58925eaad798e',
            'label' => __( 'Issue', 'tni-core' ),
            'name' => 'issue_relationship',
            'type' => 'page_link',
            'instructions' => __( 'Issue this article belongs to.', 'tni-core' ),
            'post_type' => array (
              0 => 'magazines',
            ),
            'allow_null' => 0,
            'multiple' => 0,
          ),
          array (
    				'key' => 'field_582932fpea002',
    				'label' => __( 'DEK (Subhead)', 'tni-core' ),
    				'name' => 'post_subhead',
    				'type' => 'wysiwyg',
    				'instructions' => __( 'Text that appears below article title.', 'tni-core' ),
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
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

    	register_field_group( array (
    		'id' => 'acf_magazine',
    		'title' => __( 'Magazine Details', 'tni-core' ),
    		'fields' => array (
    			array (
    				'key' => 'field_issue_toc',
    				'label' => __( 'Table of Contents', 'tni-core' ),
    				'name' => 'issue_toc',
    				'type' => 'wysiwyg',
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
          array (
            'key' => 'field_magazine_pdf',
            'label' => __( 'Magazine PDF', 'tni-core' ),
            'name' => 'magazine_pdf',
            'type' => 'file',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => 'pdf',
          ),
          array (
            'key' => 'field_related_articles',
            'label' => __( 'Articles in Magazine', 'tni-core' ),
            'name' => 'related_articles',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'post_type' => array (
              0 => 'post',
            ),
            'taxonomy' => array (
            ),
            'filters' => array (
              0 => 'search',
              1 => 'taxonomy',
            ),
            'elements' => array (
              0 => 'featured_image',
            ),
            'min' => '',
            'max' => '',
            'return_format' => 'id',
          ),
          array (
      			'tabs' => 'all',
      			'toolbar' => 'full',
      			'media_upload' => 1,
      			'default_value' => '',
      			'delay' => 0,
      			'key' => 'field_issue_gallery',
      			'label' => __( 'Insert Gallery', 'tni-core' ),
      			'name' => 'issue_gallery',
      			'type' => 'wysiwyg',
      			'instructions' => __( 'Use Add Media button to attach a gallery.', 'tni-core' ),
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      		),
          array (
      			'post_type' => array (
      				0 => 'post',
      			),
      			'taxonomy' => array (
      			),
      			'allow_null' => 0,
      			'multiple' => 0,
      			'return_format' => 'object',
      			'ui' => 1,
      			'key' => 'field_featured_article',
      			'label' => __( 'Featured Article', 'tni-core' ),
      			'name' => 'featured_article',
      			'type' => 'post_object',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
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
    				'label' => __( 'Book Imprint', 'tni-core' ),
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
