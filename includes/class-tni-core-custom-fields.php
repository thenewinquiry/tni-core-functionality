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

      register_field_group( array(
      	'key' => 'group_subscriber_content',
      	'title' => __( 'Subscriber Only Content', 'tni-core' ),
      	'fields' => array (
          array (
      			'key' => 'field_subscriber_only',
      			'label' => __( 'Subscriber Only', 'tni-core' ),
      			'name' => 'subscriber_only',
      			'type' => 'true_false',
      			'instructions' => __( 'Viewable by Subscribers Only?', 'tni-core' ),
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'message' => '',
      			'default_value' => 0,
      			'ui' => 1,
      			'ui_on_text' => __( 'True', 'tni-core' ),
      			'ui_off_text' => __( 'False', 'tni-core' ),
      		),
      		array (
      			'key' => 'field_subscriber_only_date',
      			'label' => __( 'Date', 'tni-core' ),
      			'name' => 'subscriber_only_date',
      			'type' => 'date_picker',
      			'instructions' => __( 'Select date on which content will be available to non-subscribers.', 'tni-core' ),
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'display_format' => 'm/d/Y',
      			'return_format' => 'd/m/Y',
      			'first_day' => 1,
      		),
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'post',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'side',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
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

      acf_add_local_field_group( array(
      	'key' => 'group_seo_info',
      	'title' => 'SEO Information',
      	'fields' => array (
      		array (
      			'key' => 'field_seo_description',
      			'label' => __( 'Facebook Description', 'tni-core' ),
      			'name' => 'seo_description',
      			'type' => 'textarea',
      			'instructions' => __( 'Text that appears with article when shared on Facebook.', 'tni-core' ),
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'placeholder' => '',
      			'maxlength' => '',
      			'rows' => '',
      			'new_lines' => 'wpautop',
      		),
          array (
      			'key' => 'field_seo_description_twitter',
      			'label' => __( 'Twitter Description', 'tni-core' ),
      			'name' => 'seo_description_twitter',
      			'type' => 'textarea',
      			'instructions' => __( 'Text that appears with article when shared on Twitter.', 'tni-core' ),
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'placeholder' => '',
      			'maxlength' => '',
      			'rows' => '',
      			'new_lines' => 'wpautop',
      		),
          array (
      			'key' => 'field_seo_image',
      			'label' => __( 'SEO Image', 'tni-core' ),
      			'name' => 'seo_image',
      			'type' => 'image',
      			'instructions' => __( 'Image that appears with article when shared on social networks.', 'tni-core' ),
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'return_format' => 'url',
      			'preview_size' => 'thumbnail',
      			'library' => 'all',
      			'min_width' => '',
      			'min_height' => '',
      			'min_size' => '',
      			'max_width' => '',
      			'max_height' => '',
      			'max_size' => '',
      			'mime_types' => '',
      		),
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'post',
      			),
      		),
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      		),
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'magazines',
      			),
      		),
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'blogs',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

      acf_add_local_field_group( array(
      	'key' => 'group_featured_image',
      	'title' => __( 'Display Image', 'tni-core' ),
      	'fields' => array (
      		array (
      			'key' => 'field_hide_featured_image',
      			'label' => __( '', 'tni-core' ),
      			'name' => 'hide_featured_image',
      			'type' => 'true_false',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'message' => '',
      			'default_value' => 0,
      			'ui' => 1,
      			'ui_on_text' => __( 'Hide', 'tni-core' ),
      			'ui_off_text' => __( 'Show', 'tni-core' ),
      		),
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'post',
      			),
      		),
          array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'blogs',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'side',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));


      if( function_exists('acf_add_local_field_group') ) {

        /**
         * Add `audio_url` field to posts and blogs
         * @since 1.2.10
         */
        acf_add_local_field_group( array(
          'key' => 'group_post_audio',
          'title' => __( 'Post Audio', 'tni-core' ),
          'fields' => array (
            array (
              'key' => 'field_audio_url',
              'label' => __( 'Audio URL', 'tni-core' ),
              'name' => 'audio_url',
              'type' => 'url',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
            ),
          ),
          'location' => array (
            array (
              array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'blogs',
              ),
            ),
            array (
              array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
              ),
            ),
          ),
          'menu_order' => 0,
          'position' => 'normal',
          'style' => 'default',
          'label_placement' => 'top',
          'instruction_placement' => 'label',
          'hide_on_screen' => '',
          'active' => 1,
          'description' => '',
        ));

      }

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
      				1 => 'blogs',
      			),
      			'taxonomy' => array (),
      			'filters' => array (
      				0 => 'search',
      				1 => 'post_type',
      				2 => 'taxonomy',
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

    	register_field_group( array(
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

      acf_add_local_field_group( array(
      	'key' => 'group_user_fields',
      	'title' => __( 'Editorial Board', 'tni-core' ),
      	'fields' => array (
      		array (
      			'key' => 'field_public_title',
      			'label' => __( 'Title', 'tni-core' ),
      			'name' => 'public_title',
      			'type' => 'text',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'placeholder' => '',
      			'prepend' => '',
      			'append' => '',
      			'maxlength' => '',
      		),
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'user_form',
      				'operator' => '==',
      				'value' => 'all',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

      /**
       * Guest Author Fields
       * To add roles, update the `choices` array
       *
       * @since 1.2.0
       */
      acf_add_local_field_group( array(
      	'key' => 'group_guest_author',
      	'title' => __( 'Role', 'tni-core' ),
      	'fields' => array (
      		array (
      			'key' => 'field_guest_author_role',
      			'label' => __( '', 'tni-core' ),
      			'name' => 'guest_author_role',
      			'type' => 'select',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array (
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'choices' => array (
      				'contributor' => 'Contributor',
      				'editor' => 'Editor',
      			),
      			'default_value' => array (
      				0 => '',
      			),
      			'allow_null' => 1,
      			'multiple' => 0,
      			'ui' => 0,
      			'ajax' => 0,
      			'return_format' => 'value',
      			'placeholder' => '',
      		),
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'guest-author',
      			),
      		),
      	),
      	'menu_order' => 10,
      	'position' => 'side',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
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
