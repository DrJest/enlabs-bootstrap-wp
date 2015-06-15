<?php
/**
 * The loop that displays pages
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
?>
	  <?php 
	  /* Start the Loop */
	  if (have_posts()) : while (have_posts()) : the_post(); 
	  $date_format = get_option( 'date_format' );
	  ?>
      <div class="blog-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- check if the post has a Post Thumbnail assigned to it. -->
        <?php if ( is_singular() && has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'full' ); ?>
        <?php elseif ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php the_post_thumbnail( 'thumbnail' ); ?>
        </a>
        <?php endif; ?>
        <div class="g-plusone" data-size="standard" data-annotation="inline" <?php if ( !is_single() ) echo 'data-href="' . get_permalink(). '"'; ?> data-width="300"></div>
        <?php 
    /* Include the post format-specific template for the content. If you want to
     * this in a child theme then include a file called called content-___.php
     * (where ___ is the post format) and that will be used instead.
     */
    get_template_part( 'content', get_post_format() ); ?>
        <?php
          $link_args = array(
            'before'           => '<ul class="pager">',
            'after'            => '</ul>',
            'next_or_number'   => 'next',
            'separator'        => '<li>',
            'nextpagelink'     => __( 'Next &rarr;', 'enlightenedlabsbootstrapwp' ),
            'previouspagelink' => __( '&larr; Previous', 'enlightenedlabsbootstrapwp' )
          );
          wp_link_pages( $link_args );
        ?>
        <p class="blog-post-meta">
        <?php if ( is_single() ) : ?>
        <span class="glyphicon glyphicon-folder-open"></span> Posted in <?php the_category(', ') ?> 
        <strong>|</strong>
        <?php endif; ?> 
        <?php if ( is_user_logged_in() ) : ?>
        <?php edit_post_link(__( 'Edit', 'enlightenedlabsbootstrapwp' ),'<span class="glyphicon glyphicon-pencil"></span> '); ?> 
        <?php endif; ?> 
        <?php if ( has_tag() ) : ?>
          <p class="blog-post-meta"><span class="glyphicon glyphicon-tags"></span> <?php the_tags( __( 'Tags: ', 'enlightenedlabsbootstrapwp' ) ); ?></p>
        <?php endif; ?>
      </div><!-- /.blog-post -->
      <!--
      <?php trackback_rdf(); ?>
      -->
      <?php endwhile; ?>

      <?php endif; ?>