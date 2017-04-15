<?php
/**
 * TNI Core Subscription Authorization
 *
 * @package    TNI_Core
 * @subpackage TNI_Core\Includes
 * @since      1.0.9
 * @license    GPL-2.0+
 */

class TNI_Core_Authorization {

  /**
   * The version number.
   * @var     string
   * @access  public
   * @since   1.0.9
   */
  public $_version;

  /**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   1.0.9
	 */
	public $file;

	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.9
	 */
	public $dir;

	/**
	 * The plugin assets directory.
	 * @var     string
	 * @access  public
	 * @since   1.0.9
	 */
	public $assets_dir;

	/**
	 * The plugin assets URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.9
	 */
	public $assets_url;

  /**
	 * The base authoriztion URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.9
	 */
  public $base_url;

  /**
   * The default authoriztion URL.
   * @var     string
   * @access  public
   * @since   1.0.9
   */
  public $default_url;

  /**
   * Initialize all the things
   *
   * @since 1.0.9
   *
   */
  function __construct( $file = '', $version ) {
    $this->_version = $version;

    // Load plugin environment variables
    $this->file = $file;
    $this->dir = dirname( $this->file );
    $this->assets_dir = trailingslashit( $this->dir ) . 'assets';
    $this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    $this->default_url = 'https://members.thenewinquiry.com';
    $this->set_base_url();

    $this->add_options_page();
    $this->add_options_fields();
  }

  /**
	 * Enqueue Scripts
	 *
	 * @since 1.0.9
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'tni-core-authentication', $this->assets_url . 'js/auth.js', array( 'jquery' ), $this->_version, true );
      $js_authorization = array(
          'baseURL' => $this->base_url,
          'nonce'   => wp_create_nonce( 'tni_js_authorization' )
    );
    wp_localize_script( 'tni-core-authentication', 'jsAuthorization', $js_authorization );
	}

  /**
   * Get Value of Class Variable
   *
   * @since 1.0.9
   *
   * @return string $this->base_url
   */
  public function get_base_url() {
    return $this->base_url;
  }

  /**
   * Set Value of Class Variable
   *
   * @since 1.0.9
   *
   * @return string $this->base_url
   */
  public function set_base_url() {
    if( null == get_option( 'options_authorization_base_url' ) ) {
      update_option( 'options_authorization_base_url', $this->default_url );
    }
    $this->base_url = get_option( 'options_authorization_base_url', $this->default_url );
  }

  /**
   * Add Options Page
   *
   * @since 1.0.9
   *
   * @uses acf_add_options_page()
   *
   * @return void
   */
  public function add_options_page() {
    if( function_exists( 'acf_add_options_page' ) ) {
      acf_add_options_sub_page( array(
    		'page_title' 	=> __( 'Authorization Settings', 'tni-core' ),
    		'menu_title'	=> __( 'Authorization Settings', 'tni-core' ),
    		'menu_slug' 	=> 'tni-authorization-settings',
    		'parent_slug'	=> 'options-general.php'
    	) );
    }
  }

  /**
   * Add Options Fields
   *
   * @since 1.0.9
   *
   * @uses acf_add_local_field_group()
   *
   * @return void
   */
  public function add_options_fields() {
    if( function_exists( 'acf_add_local_field_group' ) ) {
      acf_add_local_field_group( array (
        'key' => 'group_authorization_settings',
        'title' => __( 'Authorization Settings', 'tni-core' ),
        'fields' => array (
          array (
            'key' => 'field_authorization_base_url',
            'label' => __( 'Base URL', 'tni-core' ),
            'name' => 'authorization_base_url',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => 'https://members.thenewinquiry.com',
            'placeholder' => '',
          ),
        ),
        'location' => array (
          array (
            array (
              'param' => 'options_page',
              'operator' => '==',
              'value' => 'tni-authorization-settings',
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

}
