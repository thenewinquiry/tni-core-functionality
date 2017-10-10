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
 * @since 1.2.13
 *
 * @param int $post
 * @return bool true|false
 */
function tni_is_subscription_only( $post ) {
  $post = (int) $post;

  /* We could just return `get_post_meta( $post, 'subscriber_only', true )`, but I think this is more readable */
  $subscription_only = get_post_meta( $post, 'subscriber_only', true );

  if( !isset( $subscription_only ) || empty( $subscription_only ) ) {
    return false;
  }

  return true;
}

/**
 * Get Unauthorized Posts
 *
 * @uses tni_is_subscription_only()
 * @uses tni_core_check_auth()
 * @uses get_transient()
 * @uses set_transient()
 * @link https://codex.wordpress.org/Transients_API
 *
 * @since 1.2.9
 *
 * @return array $posts | false
 *
 */
function tni_core_get_unauthorized_posts() {
  /* If user is authorized, all posts are shown regardless of whether they are "subscription_only" */
  if( !( function_exists( 'tni_core_check_auth' ) ) && $auth = tni_core_check_auth() ) {
    return false;
  }

  $posts = get_transient( 'tni_unauthorized_posts' );

  if( false === $posts ) {

    $args = array(
      'fields'          => 'ids',
      'posts_per_page'  => -1
    );
    $query = new WP_Query( $args );
    $post_query = $query->get_posts();

    if( !empty( $post_query ) || !is_wp_error( $post_query ) ) {
      $posts =  array_values( array_filter( $post_query, 'tni_is_subscription_only' ) );
    }

    set_transient( 'tni_unauthorized_posts', $posts, MINUTE_IN_SECONDS * 5 );

  }

  return $posts;
}

/**
 * Purge Transients
 * Each time a post is published, delete the transient
 * Note: It will not run when a post is updated
 *
 * @uses delete_transient()
 *
 * @param int $ID
 * @param obj $post
 *
 * @return void
 */
function tni_core_purge_transients( $ID, $post ) {
  if( 'post' === $post->post_type ) {
    delete_transient( 'tni_unauthorized_posts' );
  }
}
add_action( 'publish_post', 'tni_core_purge_transients' );
