<?php
/**
 * Tni Core Helper Functions
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.0.0
 * @license    GPL-2.0+
 */

/**
 * Run Once
 * Runs function once
 * *
 * @since 1.0.0
 */
if ( isset( $_GET['run_tni_copy_custom_fields'] ) && ! get_option( 'tni_copy_custom_fields_complete' ) ) {
     add_action( 'init', 'tni_copy_custom_fields', 10 );
     add_action( 'init', 'tni_copy_custom_fields_finished', 20 );
} elseif ( isset( $_GET['run_tni_copy_custom_fields'] ) && get_option( 'tni_copy_custom_fields_complete' ) ) {
     die( "Script already run." );
}

/**
 * Copy Custom Fields
 * Copies meta field data from `_additional_content_*` fields to new custom fields
 * @usage http://yourdomain.com/?run_tni_copy_custom_fields
 *
 * @since 1.0.0
 *
 * @return void
 */
function tni_copy_custom_fields() {
     $essay_args = array(
         'post_type' => 'essays',
         'posts_per_page' => -1,
         'post_status' => 'any'
     );

     $essays = get_posts( $essay_args );

     foreach( $essays as $essay ) {
         $old_meta = apply_filters( 'meta_content', get_post_meta( $essay->ID, '_additional_content_1', true ) ) . apply_filters( 'meta_content', get_post_meta( $essay->ID, '_additional_content_2', true ) );
         add_post_meta( $essay->ID, 'featured_text', $old_meta, true );
     }

     $magazine_args = array(
         'post_type' => 'magazines',
         'posts_per_page' => -1,
         'post_status' => 'any'
     );

     $magazines = get_posts( $magazine_args );

     foreach( $magazines as $magazine ) {
         $old_mag_meta = apply_filters( 'meta_content', get_post_meta( $magazine->ID, 'editors_note', true ) );
         add_post_meta( $magazine->ID, 'issue_toc', $old_mag_meta, true );
     }

}
add_action( 'init', 'tni_copy_custom_fields', 10 );

/**
 * Add `tni_copy_custom_fields_complete` Once Function is Run
 *
 * @since 1.0.0
 */
function tni_copy_custom_fields_finished() {
     add_option( 'tni_copy_custom_fields_complete', 1 );
     die( "Script finished." );
}

/**
 * Get Users
 *
 * @since   1.0.8.1
 *
 * @param  array $args
 * @return array user ids
 */
function tni_core_get_users( $args = null ) {
  $defaults = array(
    'role'      => 'editorial_board',
    'orderby'   => 'meta_value',
    'order'     => 'ASC',
    'meta_key'  => 'public_title',
    'fields'    => 'ids'
  );
  $args = wp_parse_args( $args, $defaults );

  return get_users( $args );
}

/**
 * Get Users by Meta
 *
 * @since   1.0.8.1
 *
 * @param  array $args
 * @param  string $field
 * @param  string $value
 * @return array user ids
 */
function tni_core_get_users_by_meta( $args = null, $field, $value ) {
  $defaults = array(
    'role'      => 'editorial_board',
    'fields'    => 'ids'
  );

  $args = wp_parse_args( $args, $defaults );

  $args['meta_query'] = array(
    array(
      'key'     => $field,
      'value'   => $value,
      'compare' => '='
    )
  );

  return get_users( $args );
}

/**
 * Get User Meta
 *
 * @since   1.0.8.1
 *
 * @param  string $field
 * @return array $titles
 */
function tni_get_users_meta( $field = null ) {
  $default = 'public_title';
  $field = ( !empty( $field ) ) ? $field : $default;

  $users = get_users( array( 'role' => 'editorial_board' ) );
  $titles = [];

  foreach( $users as $user ) {
    $title = get_user_meta( $user->ID, $field, $single = true );
    if( !empty( $title ) && !is_wp_error( $title ) ) {
      $titles[] = $title;
    }
  }
  sort( $titles );
  return array_unique( $titles );
}
