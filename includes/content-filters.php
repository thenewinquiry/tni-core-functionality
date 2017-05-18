<?php
/**
 * Tni Core Content Filters
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.2.4
 * @license    GPL-2.0+
 */

/**
 * Get Pretty Permalink for Future Posts
 * When posts are scheduled (`post_status` = `future`), "pretty" permalinks aren't returned by `get_permalink()`
 *
 * @since 1.2.4
 *
 * @link https://github.com/thenewinquiry/tni-theme/issues/66
 * @link https://core.trac.wordpress.org/ticket/30910
 *
 * @param  string  $permalink
 * @param  obj  $post
 * @param  string  $leavename
 * @param  boolean $sample
 *
 * @return string  $permalink
 */
function tni_core_future_permalink( $permalink, $post, $leavename, $sample = false ) {
	static $recursing = false;

  /* If there is no post id or you're in the admin area */
	if ( empty( $post->ID ) || is_admin() ) {
		return $permalink;
	}

	if ( !$recursing ) {
		if ( isset( $post->post_status ) && ( 'future' === $post->post_status ) ) {
			$post->post_status = 'publish';
			$recursing = true;
			return get_permalink( $post, $leavename ) ;
		}
	}

	$recursing = false;
	return $permalink;
}
add_filter( 'post_link', 'tni_core_future_permalink', 10, 3 );
add_filter( 'post_type_link', 'tni_core_future_permalink', 10, 4 );
