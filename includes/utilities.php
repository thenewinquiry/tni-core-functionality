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
