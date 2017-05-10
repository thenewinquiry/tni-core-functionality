<?php
/**
 * Tni Core Co-Authors-Plus Customization
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.2.0
 * @license    GPL-2.0+
 */

/**
 * Filter Co-Authors-Plus Single Link
 *
 * @since 1.2.0
 *
 * @param  {array} $args
 * @return {array} $args
 */
function tni_core_coauthors_posts_link( $args ) {
  return $args;
}
add_filter( 'coauthors_posts_link', 'tni_core_coauthors_posts_link' );

/**
 * Add Guest Author Fields
 *
 * @since 1.2.0
 *
 * @param {array} $fields
 * @param {obj} $groups
 */
function tni_core_coauthors_guest_author_fields( $fields, $groups ) {
  if ( in_array( 'all', $groups ) || in_array( 'name', $groups ) ) {
    $fields[] = array(
      'key'      => 'public_title',
      'label'    => __( 'Title', 'tni-core' ),
      'group'    => 'name',
    );
  }
  return $fields;
}
add_filter( 'coauthors_guest_author_fields', 'tni_core_coauthors_guest_author_fields', 10, 2 );

/**
 * Populate Guest Author Roles with WP User Roles
 *
 * @since 1.2.0
 *
 * @param  obj $field
 * @return obj $field
 */
function tni_core_guest_author_role_choices( $field ) {
  global $wp_roles;

  $field['choices'] = array();

  foreach( $wp_roles->roles as $role => $name ) {
    $field['choices'][ $role ] = $name['name'];
  }

  return $field;
}
add_filter( 'acf/load_field/name=guest_author_role', 'tni_core_guest_author_role_choices' );
