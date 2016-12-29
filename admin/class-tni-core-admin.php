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
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $setting_name    The setting that will be registered.
	 */
	private $setting_name = '';

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

		if( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
	}

	/**
	 * Add an Options Page
	 *
	 * @since 1.0.0
	 *
	 * @uses acf_add_options_page()
	 */
	public function add_options_page() {}

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
