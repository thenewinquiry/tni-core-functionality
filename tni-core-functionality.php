<?php
/**
 * Plugin Name:     TNI Core Functionality Plugin
 * Plugin URI:
 * Description:     Contains the site's core functionality
 *
 * Author:          Pea <pea@misfist.com>
 * Author URI:      https://github.com/misfist
 *
 * Text Domain:     tni-core
 * Domain Path:     /languages
 *
 * Version:         1.0.11
 *
 * @package         Tni_Core_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Plugin Directory
 *
 * @since 1.0.0
 */
define( 'TNI_CORE_DIR', dirname( __FILE__ ) );
define( 'TNI_CORE_DIR_URL', plugin_dir_url( __FILE__ ) );

require_once( 'includes/helpers.php' );
require_once( 'includes/template-tags.php' );

// Load plugin class files
require_once( 'includes/class-tni-core.php' );
require_once( 'includes/class-tni-core-taxonomy.php' );
require_once( 'includes/class-tni-core-cpt.php' );
require_once( 'includes/class-tni-core-shortcodes.php' );
require_once( 'includes/class-tni-core-custom-fields.php' );
require_once( 'includes/class-tni-core-authorization.php' );
require_once( 'includes/authorization-functions.php' );

// Load admin files
require_once( 'admin/class-tni-core-admin.php' );

/**
 * Returns the main instance of Tni_Core to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Tni_Core
 */
function Tni_Core() {
	$instance = Tni_Core::instance( __FILE__, '1.0.11' );

	return $instance;
}

Tni_Core();
