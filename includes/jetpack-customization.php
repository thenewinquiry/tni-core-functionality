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
  *
  * @uses jetpack_open_graph_tags filter
  * @uses get_post_meta
  *
  * @param {array} $tags
  * @return {array} $tags
  */
function tni_core_og_description( $tags ) {
  $seo_description = get_post_meta( get_the_id(), 'seo_description', true );
  if( $seo_description ) {
    $tags['og:description'] = esc_attr__( $seo_description, 'tni-core' );
  }
  return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'tni_core_og_description' );
