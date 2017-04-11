<?php
/**
 * Tni Core Related Posts Template
 *
 * @package    Tni_Core
 * @subpackage Tni_Core\Includes
 * @since      1.0.6
 * @license    GPL-2.0+
 */
?>

<div class="post-column clearfix">
  <article id="<?php get_the_ID(); ?>" class="related-post type-post">
    <figure class="post-thumbnail">
      <a href="<?php echo esc_url( the_permalink() ); ?>" rel="bookmark">
        <?php if( has_post_thumbnail( $post ) ) : ?>
          <?php the_post_thumbnail( 'thumbnail' ); ?>
        <?php endif; ?>
      </a>
    </figure>
    <div class="entry-meta">
      <span class="meta-category"><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" rel="category tag"><?php esc_html_e( $category->name ); ?> </a></span>
    </div>
    <h2 class="entry-title">
      <a href="<?php echo esc_url( the_permalink() ); ?>" rel="bookmark">
        <?php the_title(); ?>
      </a>
    </h2>
    <div class="entry-meta">
    <?php if( function_exists( 'tni_core_authors' ) ) : ?>
      <?php echo tni_core_authors(); ?>
    <?php else : ?>
      <span class="meta-author">
        <span class="author vcard">
          <?php _e( 'By', 'tni-core' ); ?> <a href="<?php echo esc_url( $author_url ); ?>" class="url fn n">
            <?php echo esc_attr( $author ); ?>
          </a>
        </span>
      </span>
    <?php endif; ?>

    </div>
    <div class="entry-content entry-excerpt clearfix">
      <?php echo esc_html_e( $subhead ); ?>
    </div>
  </article>
</div>
