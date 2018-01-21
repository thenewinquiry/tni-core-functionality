<?php
/**
 * TNI Core Field Settings
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Admin
 * @since      1.0.0
 * @license    GPL-2.0+
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link 		https://codex.wordpress.org/Settings_API
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Admin
 * @author     Pea <pea@misfist.com>
 */
class Tni_Core_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The Setting Name
	 * Used for page name and setting name
	 *
	 * @since    0.1.4
	 * @access   private
	 * @var      string    $setting_name    The setting that will be registered.
	 */
	private $setting_name = 'featured_content';

	private $option_id;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_id = 'toplevel_page_featured-content';

		if( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		}

		$this->add_fields();

		add_action( 'admin_print_footer_scripts', array( $this, 'quicktags' ) );

		add_filter( 'mce_buttons_2', array( $this, 'customize_wysiwyg_buttons' ) );
		add_filter( 'acf/fields/relationship/query/name=featured_post', array( $this, 'relationship_options_filter' ), 10, 3 );

		/**
		 * ACF footer action
		 * @since 1.2.1
		 */
		add_action( 'acf/input/admin_footer', array( $this, 'admin_footer' ) );
  }

	/**
	 * Add an Options Page using ACF
	 *
	 * @since 1.1.0
	 *
	 * @uses acf_add_options_page()
	 *
	 * @return void
	 */
	public function add_options_page() {
		if( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title' 	=> __( 'Featured Content', 'tni-core' ),
				'menu_title'	=> __( 'Featured Content', 'tni-core' ),
				'menu_slug' 	=> 'featured-content',
				'capability'	=> 'edit_posts',
				'icon_url' 		=> 'dashicons-star-filled',
				'position' 		=> 50,
				'redirect'		=> false
			) );
		}
	}

	/**
	 * Add Fields
	 *
	 * @since 1.1.0
	 *
	 * @uses acf_add_options_page()
	 *
	 * @return void
	 */
	public function add_fields() {

		if( function_exists( 'acf_add_local_field_group' ) ) {

			/**
			 * Featured Content Options Page Fields
			 */
			 acf_add_local_field_group( array (
			 	'key' => 'group_featured_content',
			 	'title' => __( 'Featured Article', 'tni-core' ),
			 	'fields' => array (
			 		array (
			 			'key' => 'field_featured_article',
			 			'label' => __( 'Featured Article', 'tni-core' ),
			 			'name' => 'featured_article',
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
			 				1 => 'magazines',
			 				2 => 'blogs',
			 			),
			 			'taxonomy' => array (
			 			),
			 			'filters' => array (
			 				0 => 'search',
			 				1 => 'post_type',
			 				2 => 'taxonomy',
			 			),
			 			'elements' => array (
			 				0 => 'featured_image',
			 			),
			 			'min' => 1,
			 			'max' => 1,
			 			'return_format' => 'id',
			 		),
					/**
					 * Featured Bundle
					 * @since 1.3.0
					 */
					array (
						'key' => 'field_featured_bundle',
						'label' => __( 'Featured Bundle', 'tni-core' ),
						'name' => 'featured_bundle',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'bundle',
						'field_type' => 'select',
						'allow_null' => 1,
						'add_term' => 1,
						'save_terms' => 1,
						'load_terms' => 0,
						'return_format' => 'id',
						'multiple' => 0,
					),
			 	),
			 	'location' => array (
			 		array (
			 			array (
			 				'param' => 'options_page',
			 				'operator' => '==',
			 				'value' => 'featured-content',
			 			),
			 		),
			 	),
			 	'menu_order' => 0,
			 	'position' => 'normal',
			 	'style' => 'seamless',
			 	'label_placement' => 'top',
			 	'instruction_placement' => 'label',
			 	'hide_on_screen' => '',
			 	'active' => 1,
			 	'description' => '',
			 ));

		}
	}

	/**
   * Filter out unpublished posts
   * Relationship fields will only show posts where `post_status = publish`
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @param  array $options
   * @param  string $field
   * @param  obj $the_post
   * @return array $options
   */
  public function relationship_options_filter( $options, $field, $the_post ) {

  	$options['post_status'] = array( 'publish' );

  	return $options;
  }

	/**
	 * Get Settings
	 * Get the name of the settings
	 *
	 * @since    1.0.0
	 */
	public function get_setting_name() {
		return $this->setting_name;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TNI_Core as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TNI_Core will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, TNI_CORE_DIR_URL . 'assets/css/admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TNI_Core as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TNI_Core will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, TNI_CORE_DIR_URL . 'assets/js/admin.js', array( 'jquery-chosen' ), $this->version, false );

		if( function_exists( 'get_current_screen' ) ) {
			$post_type = get_current_screen()->post_type;
			if( 'post' === $post_type  ) {
				wp_enqueue_script( $this->plugin_name . '-acf', TNI_CORE_DIR_URL . 'admin/js/acf.js', array( 'jquery' ), $this->version, true );
			}

		}
	}

	/**
	 * Add inline JS to guest author admin
	 *
	 * @since 1.2.1
	 *
	 * @see https://www.advancedcustomfields.com/resources/adding-custom-javascript-fields/
	 *
	 * @return void
	 */
	public function admin_footer() {
		$current_screen = get_current_screen();
		if( $current_screen->id === 'guest-author' ) :
		?>

	<script type="text/javascript">
	(function($) {

		var $publish = $('#coauthors-manage-guest-author-save');
		var $role = $('#acf-group_guest_author');

		$role.insertAfter( $publish );

	})(jQuery);
	</script>

		<?php
		endif;
	}

	/**
	 * Create Quicktags
	 *
	 * @since 1.0.3
	 *
	 * @uses admin_print_footer_script
	 * @link https://codex.wordpress.org/Quicktags_API
	 *
	 * @return void
	 */
	public function quicktags() {
		if ( wp_script_is( 'quicktags' ) ) { ?>

			<script type="text/javascript">
				QTags.addButton( 'dropcap', 'drop cap', '[drop-cap]', '[/drop-cap]', 'w', 'Dropcap', 50 );
				QTags.addButton( 'figcaption', 'caption', '[image-caption]', '[/image-caption]', 'f', 'Figcaption', 52 );
				QTags.addButton( 'showmore', 'show more', '[show-more]', '[/show-more]', 'm', 'Showmore', 54 );
				QTags.addButton( 'margin-right', 'margin-right', '[margin-right]', '[/margin-right]', 'r', 'Margin-right', 56 );
				QTags.addButton( 'margin-left', 'margin-left', '[margin-left]', '[/margin-left]', 'l', 'Margin-left', 58 );
				QTags.addButton( 'popover', 'popover', '[popover]', '[/popover]', 'p', 'Popover', 59 );
				QTags.addButton( 'inline-hover', 'inline-hover', '[inline-hover]', '[/inline-hover]', 'h', 'Inline Hover', 60 );
			</script>

		<?php
		}
	}

	/**
	 * Custom WYSIWYG Editor Buttons
	 *
	 * @since 1.0.3
	 *
	 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_buttons,_mce_buttons_2,_mce_buttons_3,_mce_buttons_4
	 *
	 * @param array $buttons
	 * @return array $buttons
	 */
	public function customize_wysiwyg_buttons( $buttons ) {
		$remove = array(
			'formatselect',
			'forecolor',
		 	'strikethrough'
		);

		return array_diff( $buttons, $remove );
	}

	/**
	 * Sanitize Input
	 *
	 * @since    1.0.0
	 *
	 * @param string $string
	 * @return sanitized string $string
	 */
	public function sanitize_string( $string ) {
		return sanitize_text_field( $string );
	}

}
