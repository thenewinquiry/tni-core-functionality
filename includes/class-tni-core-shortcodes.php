<?php
/**
 * TNI Core Register Shortcodes
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
class TNI_Core_Shortcodes {

    /**
     * Initialize all the things
     *
     * @since 1.0.0
     *
     */
    function __construct() {
        add_action( 'init', array( $this, 'detect_shortcode_ui' ) );

        add_action( 'init', array( $this, 'register_shortcodes' ) );
        add_action( 'register_shortcode_ui', array( $this, 'shortcode_ui' ) );
    }

    /**
     * Detect if Shortcode UI is activated
     *
     * @since 1.0.0
     *
     */
    public function detect_shortcode_ui() {
        if ( !function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
            add_action( 'admin_notices', array( $this, 'shortcode_ui_notices' ) );
        }
    }

    /**
     * Show message if Shortcode UI not activated
     *
     * @since 1.0.0
     *
     */
    public function shortcode_ui_notices() {
        if ( current_user_can( 'activate_plugins' ) ) {
            ?>
            <div class="error message">
                <p><?php esc_html_e( 'Shortcode UI plugin must be active in order to take advantage of an improved shortcode user interface.', 'tni-core' ); ?></p>
            </div>
            <?php
        }
    }

    /**
     * Register shortcodes
     *
     * @since 1.0.0
     *
     * @param string $shortcode_tag
     * @param function $shortcode_function
     *
     */
    public function register_shortcodes() {}

    /**
     * Countdown Shortcode
     *
     * @since 1.0.0
     *
     * @param array $atts
     * @return string $output
     */
    public function shortcode( $attr, $content, $shortcode_tag ) {}

    /**
     * Countdown Shortcode UI
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function shortcode_ui() {}

}

new TNI_Core_Shortcodes();
