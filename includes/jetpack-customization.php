<?php
/**
 * Tni Core JetPack Customization
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.1.1
 * @license    GPL-2.0+
 */

 /**
  * Custom Description
  * Replace `og:description` with `seo_description` custom field, if it exists
  *
  * If `seo_description` doesn't exist for a post/page, do not modify `og:description`.
  *
  * @since 1.1.1
  * @since 1.3.1
  *
  * @uses jetpack_open_graph_tags filter
  * @uses get_post_meta
  *
  * @param {array} $tags
  * @return {array} $tags
  */
function tni_core_og_description( $tags ) {
  if( $seo_description_facebook = get_post_meta( get_the_id(), 'seo_description', true ) ) {
    $tags['og:description'] = esc_attr__( $seo_description_facebook, 'tni-core' );
  }
  if( $seo_description_twitter = get_post_meta( get_the_id(), 'seo_description_twitter', true ) ) {
    $tags['twitter:description'] = esc_attr__( $seo_description_twitter, 'tni-core' );
  }
  if( $seo_image = get_post_meta( get_the_id(), 'seo_image', true ) ) {
    unset( $tags['twitter:image'] );
    unset( $tags['og:image'] );
    $image_obj = wp_get_attachment_image_src( (int) $seo_image, 'seo' );
    $tags['twitter:image'] = esc_url( $image_obj[0] );
    $tags['og:image'] = esc_url( $image_obj[0] );
  }
  return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'tni_core_og_description', 99 );

/**
 * Add SEO Image Size
 *
 * @since 1.3.1
 *
 * @link https://developers.facebook.com/docs/sharing/best-practices/#images
 */
add_image_size( 'seo', 1200, 1200, array( 'center', 'top' ) );
