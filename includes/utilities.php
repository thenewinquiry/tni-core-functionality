<?php
/**
 * Tni Core Utility Functions
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.2.0
 * @license    GPL-2.0+
 */

 /**
  * Copy Custom Fields
  * Copies meta field data from `_additional_content_*` fields to new custom fields
  * @usage run using WP-CLI `wp eval 'tni_copy_custom_fields();'`
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

 /**
  * Set Guest Account Roles
  * Updates all guest authors with role assigned to associated user
  * Can be run using WP-CLI `wp eval 'tni_core_assign_guest_author_roles();'`
  *
  * @since  1.2.0
  *
  * @return void
  */
 function tni_core_assign_guest_author_roles() {

    $args = array(
      'posts_per_page' => -1,
      'post_type'      => 'guest-author',
      'post_status'    => 'any'
    );

    $authors = get_posts( $args );

    if( !empty( $authors ) && !is_wp_error( $authors ) ) {

      $count = 1;

      foreach ( $authors as $author ) {

        $author_id = $author->ID;

        if( 'publish' !== $author->post_status ) {
          wp_update_post( array(
            'ID'            =>  $author_id,
            'post_status'   =>  'publish'
          ) );
        }

        $user_login = get_post_meta( $author_id, 'cap-linked_account', true );
        $user = get_user_by( 'login', $user_login );

        update_post_meta( $author_id, 'guest_author_role', $user->roles[0] );

        $count++;
      }

    }

  echo "DONE";

 }

/**
 * Switch Post Type
 * Change post type and taxonomy term, based on any valid WP_Query arguments
 * Can be run using WP-CLI `wp eval 'tni_switch_post_type();'`
 * example: `wp eval 'tni_switch_post_type( array( "post_type" => "blogs", "tax_query" => array( array( "taxonomy" => "blog-types", "field" => "term_id", "terms" => 3045 ) ) ), "post", 3049 );'`

 *
 * @uses set_post_type()
 * @uses wp_set_post_terms()
 *
 * @since 1.2.5
 *
 * @param array $find array of WP_Query arguments
 * @param string $new_post_type
 * @param int $new_term
 * @param string $new_taxonomy
 * @return void
 */
function tni_switch_post_type( $old_post_type, $old_term = null, $old_taxonomy = null, $new_post_type, $new_term = null, $new_taxonomy = null ) {
  $new_term = (int) $new_term;

  echo "START\n";

  if( !post_type_exists( $new_post_type ) ) {
    echo "The post type $new_post_type does not exist";
    return new WP_Error( 'post_type-invalid', __( "The post type {$new_post_type} does not exist", 'tni-core' ) );
  }

  /* Base query */
  $args = array(
    'post_type'       => $old_post_type,
    'posts_per_page'  => -1,
    'post_status'     => 'any'
  );

  /* If the ter doesn't exist, return an error */
  if( ( $old_term ) && !term_exists( $old_term, $old_taxonomy ) ) {
    echo "The taxonomy term $old_term does not exist";
    return new WP_Error( 'term-invalid', __( "The taxonomy term {$old_term} does not exist", 'tni-core' ) );
  }

  /* If the taxonomy doesn't exist, return an error */
  if( ( $old_taxonomy ) && !taxonomy_exists( $old_taxonomy ) ) {
    echo "The taxonomy $old_taxonomy does not exist";
    return new WP_Error( 'taxonomy-invalid', __( "The taxonomy {$old_taxonomy} does not exist", 'tni-core' ) );
  }

  /* If query term was provided */
  if( $old_term ) {
    $args['tax_query'] = array(
      'taxonomy'  => $old_taxonomy,
      'field'     => 'term_id',
      'terms'     => (int) $old_term
    );
  }

  /* If the ter doesn't exist, return an error */
  if( ( $new_term ) && !term_exists( $new_term, $new_taxonomy ) ) {
    echo "The taxonomy term $new_term does not exist";
    return new WP_Error( 'term-invalid', __( "The taxonomy term {$new_term} does not exist", 'tni-core' ) );
  }

  /* If the taxonomy doesn't exist, return an error */
  if( ( $new_taxonomy ) && !taxonomy_exists( $new_taxonomy ) ) {
    echo "The taxonomy $new_taxonomy does not exist";
    return new WP_Error( 'taxonomy-invalid', __( "The taxonomy {$new_taxonomy} does not exist", 'tni-core' ) );
  }

  $posts = get_posts( $args );

  if( empty( $posts ) || is_wp_error( $posts ) ) {
    echo "There are no posts that match the request";
    return new WP_Error( 'no-posts', __( 'There are no posts that match the $find request', 'tni-core' ) );
  }

  foreach( $posts as $post ) {
    set_post_type( $post->ID, $new_post_type );

    if( $new_term && $new_taxonomy ) {
      wp_set_post_terms( $post->ID, $new_term, $new_taxonomy, false );
    }
  }

  echo "DONE";
}
