<?php
/**
 * Tni Core Template Tags
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.0.8
 * @license    GPL-2.0+
 */

 /**
  * Display Autbor(s)
  * If Co-authors Plus is active, return co-author links
  *
  * @since 1.0.8
  *
  * @uses coauthors_posts_links()
  * @uses get_author_posts_url()
  * @uses get_the_author()
  *
  * @return string
  */
 function tni_core_authors() {

     if( function_exists( 'coauthors_posts_links' ) ) {
       $author_string = coauthors_posts_links( ', ', __( ' and ', 'tni' ), '<span class="author vcard">' . __( 'By ', 'tni' ), '</span>', false );
     } else {
       $author_string = sprintf( '<span class="author vcard">%s<a class="url fn n" href="%s" title="%s" rel="author">%s</a></span>',
           __( 'By ', 'tni' ),
           esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
           esc_attr( sprintf( esc_html__( 'View all posts by %s', 'tni' ),
           get_the_author() ) ),
           esc_html( get_the_author() )
       );
     }

     return '<span class="meta-author"> ' . $author_string . '</span>';
 }
