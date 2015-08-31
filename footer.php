<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
?>
    </div><!-- /.container -->

    <div class="blog-footer">
    
      <?php get_sidebar( 'footer' ); ?>
      
	  <?php 
	  $copyright_text = get_theme_mod( 'copyrighttext', '' ); ?>
	  <?php if ( $copyright_text !== '' ) : ?>
      <p class="copyright"><?php echo $copyright_text; ?></p>
      <?php else: ?>
      <p class="copyright"><?php _e( 'Blog template built for <a href="' . esc_url( 'http://getbootstrap.com' ) . '">Bootstrap</a> by <a href="' . esc_url( 'https://twitter.com/mdo' ) . '">@mdo</a>.', 'enlightenedlabsbootstrapwp' ); ?></p>
      <?php endif; ?>
      <p>
        <a href="#"><?php _e( 'Back to top', 'enlightenedlabsbootstrapwp' ); ?></a>
      </p>
    </div>

    <?php 
	if( !current_user_can( 'read_private_pages' ) && current_user_can('read') && get_cimyFieldValue( get_current_user_id(), 'PENDING' ) == "NO" ) { ?>
<script>
	(function($) {
	$(".blog-header .container").append('<div class="alert alert-warning" id="associati-warning" role="alert">Attendi che un amministratore confermi che sei socio per utilizzare tutte le features del sito. <br/> Non sei ancora socio? <a href="/associati/" title="Associati"> Associati Ora! </a></div>');
	})(jQuery);
</script>	
    <?php }
	  /*
	   * Always have wp_footer() just before the closing </body>
	   * tag of your theme, or you will break many plugins, which
	   * generally use this hook to reference JavaScript files.
	   */
	  wp_footer(); 
	?>
  </body>
</html>
