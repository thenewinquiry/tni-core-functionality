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

/**
 * Editors List by Title
 *
 * @since 1.0.8.1
 *
 * @return void
 */
function tni_core_editors_by_title() {
  $titles = tni_get_users_meta();
  $template = 'loop-editors.php';

  if( $theme_file = locate_template( array( 'template_parts/' . $template ) ) ) {
    $file = $theme_file;
  } else {
    $file = TNI_CORE_DIR . '/templates/' . $template;
  }

  foreach( $titles as $title ) {
    include( $file );
  }

}

/**
 * Output Guest Authors
 *
 * @since 1.2.0
 *
 * @param  array  $args
 * @return void || array
 */
function tni_core_coauthors_wp_list_authors( $args = array() ) {
  /* Bail if `CoAuthors_Plus` class doesn't exist */
  if( !class_exists( 'CoAuthors_Plus' ) ) {
    return;
  }

	global $coauthors_plus;

	$defaults = array(
		'hide_empty'       => true,
    'description'      => true,
		'number'           => 200, // A sane limit to start to avoid breaking all the things
    'role'             => ''
	);

  $args['number'] = ( $args['number'] ) ? (int) $args['number'] : '';

	$args = wp_parse_args( $args, $defaults );

  $term_args = array(
    'orderby'      => 'name',
    'hide_empty'   => 0,
    'number'       => (int) $args['number'],
  );

	$author_terms = get_terms( $coauthors_plus->coauthor_taxonomy, $term_args );
	$authors = array();

	foreach ( $author_terms as $author_term ) {
		if ( false === ( $coauthor = $coauthors_plus->get_coauthor_by( 'user_login', $author_term->name ) ) ) {
			continue;
		}

		$authors[ $author_term->name ] = $coauthor;

		$authors[ $author_term->name ]->post_count = $author_term->count;
	}

	$authors = apply_filters( 'coauthors_wp_list_authors_array', $authors );

  $template = 'loop-authors.php';

  if( $theme_file = locate_template( array( 'template_parts/' . $template ) ) ) {
    $file = $theme_file;
  } else {
    $file = TNI_CORE_DIR . '/templates/' . $template;
  }

  if( !empty( $authors ) ) {

    echo '<ul>';

    foreach ( (array) $authors as $author ) {

      if( ( $args['hide_empty'] && 0 !== $author->post_count ) || ! $args['hide_empty'] ) {

        /* If a role is passed, check the role of the author matches the one passed */
        if( !empty( $args['role'] ) ) {

          $role = get_post_meta( $author->ID, 'guest_author_role', true );

          if(  $args['role'] !== $role ) {
            continue;
          }

        }

        include( $file );

      }

    }

    echo '</ul>';

  }

}
