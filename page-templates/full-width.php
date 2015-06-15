<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package Enlightened Labs Bootstrap WP
 * @since Enlightened Labs Bootstrap WP 1.0
 */

	get_header(); ?>

      <div class="row">

        <div class="col-sm-12 blog-main">

          <?php get_template_part( 'loop', 'page' ); ?>

        </div><!-- /.blog-main -->

      </div><!-- /.row -->
      
	<?php get_footer(); ?>