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
         $old_mag_meta = apply_filters( 'meta_content', get_post_meta( $magazine->ID, '_additional_content_1', true ) );
         add_post_meta( $magazine->ID, 'editors_note', $old_mag_meta, true );
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
