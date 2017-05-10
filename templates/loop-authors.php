<?php
/**
 * Tni Core Authors List
 * This template can be customized by putting a copy in the `template_parts` directory of your active theme.
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.2.0
 * @license    GPL-2.0+
 */
?>

<li data-user-id="<?php echo $author->ID; ?>">

  <?php if( 0 < $author->post_count ) : ?>

    <a href="<?php echo get_author_posts_url( $author->ID, $author->user_nicename ); ?>" title="<?php _e( 'Posts by', 'tni-core' ); ?> <?php echo esc_attr( $author->display_name ); ?>" class="author url fn" rel="author"><?php echo esc_attr( $author->display_name ); ?></a>

  <?php else : ?>

    <span class="author url fn" rel="author"><?php echo esc_attr( $author->display_name ); ?></span>

  <?php endif; ?>

  <?php if( !empty( $author->description ) && $args['description'] ) : ?>
    <?php echo $author->description; ?>
  <?php endif; ?>

</li>
