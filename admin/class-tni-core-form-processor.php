<?php
/**
 * TNI Core Form Processor
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Admin
 * @since      1.0.6
 * @license    GPL-2.0+
 */

class TNI_Core_Form_Processor {

  /**
   * slug
   *
   * @access public
   * @var string $slug
   */
  public $slug = 'tni_core_processor';

  /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.6
	 */
  public function __construct() {

    if( class_exists( 'Caldera_Forms' ) ) {
      add_filter( 'caldera_forms_get_form_processors', array( $this, 'register_form_processor' ) );
    }

  }

  /**
   * Add processor
   *
   * @uses caldera_forms_get_form_processors filter
   *
   * @since 1.0.6
   *
   * @return array Processors
   */
  public function register_form_processor( $processors ) {
    $processors[$this->slug] 	= array(
   		"name"              =>  __( 'Submit to External URL', 'tni-core' ),
   		"description"       =>  __( 'Submit the form data to an external URL', 'tni-core' ),
   		"author"            =>  'Pea',
   		"author_url"        =>  'https://github.com/misfist',
   		"processor"         =>  array( $this, 'process_form' ),
   		"template"          =>  TNI_CORE_DIR . '/admin/templates/custom-form-processor.php',
   	);

   	return $processors;
  }

  /**
   * Callback function for the processor
   *
   * @since 1.0.6
   *
   * @param array $config Processor settings
   * @param array $form Form submission data.
   * @return void
   */
  public function process_form( $config, $form ) {

    // build a data array of submitted data
    $data = array();
    // Raw data is an array with field_id as the key
    $raw_data = Caldera_Forms::get_submission_data( $form );

    // create a new array using the slug as the key
    foreach( $raw_data as $field_id => $field_value ){

      // dont add buttons or html fields to data array as they are not capture values
      if( in_array( $form[ 'fields' ][ $field_id ][ 'type' ], array( 'button', 'html' ) ) )
        continue;

      // get the field slug for the key instead
      $data[ $form[ 'fields' ][ $field_id ][ 'slug' ] ] = $field_value;

    }

    $url = esc_url( $config['url'] );

    $response = wp_remote_post( $url, array( 'body' => $data ) );

    if( isset( $config['debug'] ) ) {
      if ( is_wp_error( $response ) ) {
          var_dump( $response->get_error_message() );
      } else {
          var_dump( $config, $data, $response['response'] );
      }
    }

    die;

  }

}

new TNI_Core_Form_Processor;
