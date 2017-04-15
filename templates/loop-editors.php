<?php
/**
 * Tni Core Editors List
 * This template can be customized by putting a copy in the `template_parts` directory of your active theme.
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.0.8.1
 * @license    GPL-2.0+
 */
?>

<h4 class="editorial-title"><?php echo esc_attr( $title ); ?></h4>
<ul>

<?php $users = tni_core_get_users_by_meta( $args = null, 'public_title', $title );

if( !empty( $users ) ) :
  foreach( $users as $user ) :
    $user_id = (int) $user;
    $user =  new WP_User( $user_id ); ?>

    <li data-user-id="<?php echo $user_id; ?>">

    <?php
    if( function_exists( 'coauthors_posts_links_single' ) ) : ?>

      <?php echo coauthors_posts_links_single( $user ); ?>

    <?php else : ?>

      <a href="<?php echo get_author_posts_url( $user_id ); ?>" title="<?php _e( 'Posts by', 'tni-core' ); ?> <?php echo esc_attr( $user->display_name); ?>" class="author url fn" rel="author"><?php echo esc_attr( $user->display_name ); ?></a>

    <?php endif; ?>

    </li>

  <?php
  endforeach;
endif; ?>

</ul>
