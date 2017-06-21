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


/**
 * Show Single Future Posts
 * When posts are scheduled (`post_status` = `future`), show them in single views for authenticated users
 *
 * @since 1.2.6
 *
 * @param  array $posts
 *
 * @return array $posts
 */
function show_future_posts($posts) {
   global $wp_query, $wpdb;
   $auth = tni_core_check_auth();
   if ($auth && is_single() && empty($posts)) {
      $posts = $wpdb->get_results($wp_query->request);

      // make sure it only affects future posts, not trashed
      if(isset($posts[0]->post_status) && $posts[0]->post_status!='future'){
        $posts=array();
      }
   }
   return $posts;
}
add_filter('the_posts', 'show_future_posts');
