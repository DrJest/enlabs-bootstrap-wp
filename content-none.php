<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
?>
        <div class="entry clearfix">
          <h2 class="center"><?php _e( 'Nothing Found', 'enlightenedlabsbootstrapwp' ); ?></h2>
          <p class="center">
          <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'enlightenedlabsbootstrapwp' ); ?></p>
		  <?php get_search_form(); ?>
        </div>
        