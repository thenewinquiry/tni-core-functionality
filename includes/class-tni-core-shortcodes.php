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
        //add_action( 'init', array( $this, 'detect_shortcode_ui' ) );

        add_action( 'init', array( $this, 'register_shortcodes' ) );
        //add_action( 'register_shortcode_ui', array( $this, 'shortcode_ui' ) );
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
    public function register_shortcodes() {
      add_shortcode( 'show-more', array( $this, 'showmore_shortcode' ) );
      add_shortcode( 'image-caption', array( $this, 'caption_shortcode' ) );
      add_shortcode( 'drop-cap', array( $this, 'dropcap_shortcode' ) );
    }

    /**
     * Show More Shortcode
     *
     * @since 1.0.4
     *
     * @param array $atts
     * @return string $output
     */
    public function showmore_shortcode( $attr, $content = null ) {

      ob_start(); ?>

      <div class="show-more-section">
        <label for="show-more" class="show-more-label"><?php _e( 'Show More', 'tni-core' ); ?></label>
        <input type="checkbox" name="show-more" id="show-more">
        <div class="hide">
          <?php echo $content; ?>
        </div>
      </div>

      <?php
      return ob_get_clean();

    }

    /**
     * Drop-cap Shortcode
     *
     * @since 1.0.4
     *
     * @param array $atts
     * @return string $output
     */
    public function dropcap_shortcode( $attr, $content = null ) {

      ob_start(); ?>

      <span class="drop-cap"><?php echo $content; ?></span>

      <?php
      return ob_get_clean();

    }

    /**
     * Image Caption
     *
     * @since 1.0.4
     *
     * @param array $atts
     * @return string $output
     */
    public function caption_shortcode( $attr, $content = null ) {

      ob_start(); ?>

      <figcaption class="wp-caption-text"><?php echo $content; ?></figcaption>

      <?php
      return ob_get_clean();

    }


    /**
     * Shortcode UI
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function shortcode_ui() {}

}

new TNI_Core_Shortcodes();
