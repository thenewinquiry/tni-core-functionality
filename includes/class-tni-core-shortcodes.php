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
        add_action( 'init', array( $this, 'register_shortcodes' ) );

        if( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
          $this->register_shortcode_ui();
        }

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Enqueue Assets
     *
     * @since 1.0.11
     *
     * @return void
     */
    public function enqueue_assets() {
      wp_register_style( 'darkgenius', esc_url( 'https://omen.darkinquiry.com/css/darkgenius.css' ), null, null );
      wp_register_script( 'darkgenius', esc_url( 'https://omen.darkinquiry.com/js/darkgenius.js' ), array( 'jquery' ), null, true );
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
      add_shortcode( 'margin-right', array( $this, 'margin_right_shortcode' ) );
      add_shortcode( 'margin-left', array( $this, 'margin_left_shortcode' ) );
      add_shortcode( 'rl', array( $this, 'margin_right_shortcode' ) );
      add_shortcode( 'rr', array( $this, 'margin_right_shortcode' ) );
      add_shortcode( 'lr', array( $this, 'margin_left_shortcode' ) );
      add_shortcode( 'll', array( $this, 'margin_left_shortcode' ) );
      add_shortcode( 'popover', array( $this, 'popover_shortcode' ) );
      add_shortcode( 'inline-hover', array( $this, 'inline_hover_shortcode' ) );
      add_shortcode( 'jetpack-custom-related', array( $this, 'jetpack_related_posts_shortcode' ) );
    }

    /**
  	 * Add Register Shortcode UI Action
  	 *
  	 * @since 0.1.2
  	 *
  	 * @return void
  	 */
  	public function register_shortcode_ui() {
  		add_action( 'register_shortcode_ui', array( $this, 'popover_shortcode_ui' ) );
      add_action( 'register_shortcode_ui', array( $this, 'inline_hover_shortcode_ui' ) );
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

      <span class="drop-cap"><?php echo esc_attr( $content ); ?></span>

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

      <figcaption class="wp-caption-text"><?php echo esc_attr( $content ); ?></figcaption>

      <?php
      return ob_get_clean();

    }

    /**
     * Margin Left
     *
     * @since 1.0.4
     *
     * @param array $atts
     * @return string $output
     */
    public function margin_left_shortcode( $attr, $content = null ) {

      ob_start(); ?>

      <div class="margin-left"><?php echo esc_attr( $content ); ?></div>

      <?php
      return ob_get_clean();

    }

    /**
     * Margin Left
     *
     * @since 1.0.4
     *
     * @param array $atts
     * @return string $output
     */
    public function margin_right_shortcode( $attr, $content = null ) {

      ob_start(); ?>

      <div class="margin-right"><?php echo esc_attr( $content ); ?></div>

      <?php
      return ob_get_clean();

    }

    /**
     * Hover Shortcode
     *
     * @since 1.0.11
     *
     * @return string $html
     */
    public function popover_shortcode( $attr, $content = null, $shortcode_tag ) {
      wp_enqueue_style( 'darkgenius' );
      wp_enqueue_script( 'darkgenius' );

      extract( shortcode_atts( array(
        'text'          => '',
        'url'           => '',
        'media'         => ''
  		), $attr, $shortcode_tag ));

      $caption = get_post( $media )->post_excerpt;
      $image = wp_get_attachment_url( intval( $media ) );

      $html = sprintf(  '<a href="%s" class="annotate" data-effect="popover" data-media="%s" data-caption="%s" target="_blank">%s</a>',
  			esc_url( $url ),
  			esc_url( $image ),
  			( $caption ) ? esc_attr( $caption ) : '',
  			esc_attr( $content )
  		);

      return $html;
    }

    /**
     * Inline Shortcode
     *
     * @since 1.0.11
     *
     * @return string
     */
    public function inline_hover_shortcode( $attr, $content = null, $shortcode_tag ) {
      wp_enqueue_style( 'darkgenius' );
      wp_enqueue_script( 'darkgenius' );

      extract( shortcode_atts( array(
        'url'           => '',
        'media'         => ''
  		), $attr, $shortcode_tag ));

      $caption = get_post( $media )->post_excerpt;
      $image = wp_get_attachment_url( intval( $media ) );

      $html = sprintf(  '<a href="%s" class="annotate" data-effect="inline" data-image="%s" data-caption="%s" target="_blank">%s</a>',
  			esc_url( $url ),
  			esc_url( $image ),
  			( $caption ) ? esc_attr( $caption ) : '',
  			esc_attr( $content )
  		);

      return $html;
    }

    /**
     * Popover Shortcode UI
     *
     * @since 1.0.11
     *
     * @uses shortcode_ui_register_for_shortcode()
     *
     * @return void
     */
    public function popover_shortcode_ui() {
      $fields = array(
  			array(
  				'label'  => esc_html__( 'Link URL', 'tni-core' ),
  				'attr'   => 'url',
  				'type'   => 'url',
  				'encode' => false,
  			),
  			array(
  				'label'  => esc_html__( 'Image', 'tni-core' ),
  				'attr'   => 'media',
  				'type'   => 'attachment',
  				'encode' => false,
  			),
  		);

  		$args = array(
  			'label' 					=> esc_html__( 'Popover', 'tni-core' ),
  			'listItemImage' 	=> 'dashicons-format-image',
  			'post_type'				=> array( 'post', 'blogs' ),
        'inner_content' => array(
          'label'        => esc_html__( 'Link text', 'tni-core' ),
        ),
  			'attrs' 					=> $fields,
  		);

  		/* Enable modifying arguments outside of this plugin */
  	 	shortcode_ui_register_for_shortcode( 'popover', $args );
    }

    /**
     * Popover Shortcode UI
     *
     * @since 1.0.11
     *
     * @uses shortcode_ui_register_for_shortcode()
     *
     * @return void
     */
    public function inline_hover_shortcode_ui() {
      $fields = array(
  			array(
  				'label'  => esc_html__( 'Link URL', 'tni-core' ),
  				'attr'   => 'url',
  				'type'   => 'url',
  				'encode' => false,
  			),
  			array(
  				'label'  => esc_html__( 'Image', 'tni-core' ),
  				'attr'   => 'media',
  				'type'   => 'attachment',
  				'encode' => false,
  			),
  		);

  		$args = array(
  			'label' 					=> esc_html__( 'Inline Hover', 'tni-core' ),
  			'listItemImage' 	=> 'dashicons-format-image',
  			'post_type'				=> array( 'post', 'blogs' ),
        'inner_content' => array(
          'label'        => esc_html__( 'Link text', 'tni-core' ),
        ),
  			'attrs' 					=> $fields,
  		);

  		/* Enable modifying arguments outside of this plugin */
      shortcode_ui_register_for_shortcode( 'inline-hover', $args );
    }

   /**
    * Custom JetPack Related Posts
    *
    * @since 1.0.6
    *
    * @todo Add template loader to allow template to be modified in the theme
    *
    * @uses Jetpack_RelatedPosts
    * @link https://jetpack.com/support/related-posts/customize-related-posts/
    *
    * @return string
    */
    public function jetpack_related_posts_shortcode( $atts ) {
      $related_html = '';
      if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
          $related = Jetpack_RelatedPosts::init_raw()
              ->get_for_post_id(
                  get_the_ID(),
                  array( 'size' => 4 )
              );

          if ( $related ) {
              global $post;
              foreach ( $related as $result ) {
                  $post = get_post( $result[ 'id' ] );
                  setup_postdata( $post );

                  $thumb = get_the_post_thumbnail( $post->ID, 'thumbnail' );
                  $category = get_the_category( $post->ID )[0];
                  $author = get_the_author_meta( 'display_name', $post->post_author );
                  $author_url = get_author_posts_url( $post->post_author );
                  $subhead = get_post_meta( $post->ID, 'post_subhead', true );
                  if ( !$subhead ) {
                      $subhead = get_the_excerpt( $post->ID );
                  }
                  $permalink = get_permalink( $post->ID );

                  ob_start();

                  include( TNI_CORE_DIR . '/templates/related-posts.php' );

                  $related_html .= ob_get_clean();
              }
              wp_reset_postdata();
          }
      }
      return '<div class="related-posts post-wrapper">' . $related_html . '</div>';
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
