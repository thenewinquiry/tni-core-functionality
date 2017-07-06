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

/**
 * Is Content Subscriber Only
 * Checks if content is subscription only today
 *
 * @since 1.2.8
 *
 * @param int $post
 * @return bool true|false
 */
function tni_is_subscription_only( $post ) {
  $post = (int) $post;

  $subscription_date = get_post_meta( $post, 'subscriber_only_date', true );

  if( !isset( $subscription_date ) || empty( $subscription_date ) ) {
    return false;
  }

  $today = date( 'Ymd' );

  return strtotime( $subscription_date ) > strtotime( $today );
}
