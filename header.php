<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, 
initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title><?php bloginfo('name'); ?><?php echo substr(wp_title(' | ', 0),0,-16); ?></title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
	<?php
	  /*
	   * We add some JavaScript to pages with the comment form
	   * to support sites with threaded comments (when in use).
	   */
	  if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	  /*
	   * Always have wp_head() just before the closing </head>
	   * tag of your theme, or you will break many plugins, which
	   * generally use this hook to add elements to <head> such
	   * as styles, scripts, and meta tags.
	   */
	  wp_head(); 
    ?>
    <script src="https://apis.google.com/js/platform.js">
      { lang: 'it' }
    </script>

  </head>
  <body <?php body_class(); ?>>
    
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"><?php _e( 'Toggle navigation', 'enlightenedlabsbootstrapwp' ); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        </div>
        <?php 
          if (!wp_is_mobile()) { 
            if ( is_user_logged_in() ) {
              $u = wp_get_current_user();
               ?>
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
                <span> Logged in as <?php echo $u->display_name; ?> </span><span class="caret"></span>
              </a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="<?php echo get_author_posts_url(get_current_user_id()); ?>">My Profile</a></li>
                      <li><a href="<?php echo get_edit_user_link( $u->ID ); ?>">Edit Profile</a></li>

              <?php if(is_super_admin()) { ?>
                      <li class="divider"></li>
                      <li><a href="<?php echo get_admin_url(); ?>">Administration</a></li>
              <?php } ?>
                      <li class="divider"></li>
                      <li><a href="<?php echo wp_logout_url(); ?>">Sign Out</a></li>
                    </ul>
                  </li>
                </ul>
          <?php } 
            else { ?>
            <div class="navbar-text navbar-right" style="margin-left: 0px;">
              <?php do_action( 'wordpress_social_login' ); ?>
            </div>
            <script>
              jQuery('.wp-social-login-provider-google').find("img").attr("src","<?php echo get_bloginfo('stylesheet_directory'); ?>/login/sign-in-button-small.png")
              jQuery('.wp-social-login-connect-with').remove();
            </script>
            <style>
              .navbar .wp-social-login-provider-google img {
                height: 30px;
              }
              .navbar .wp-social-login-provider-list {
                margin-top: -5px;
                height: 30px;
                padding: 0;
              }
            </style>
          <?php } 
          ?> 
        	<!-- search form -->
        	<form class="navbar-form navbar-right" role="search">
        	  <div class="form-group" id="header-search">
              <i class="glyphicon glyphicon-search"></i>
        	    <input type="text" class="form-control <?php if(isset($_GET['s'])&&$_GET['s']!="") echo 'full'; ?>" placeholder="Search" name="s" value="<?php echo (isset($_GET['s'])&&$_GET['s']!="")?$_GET['s']:"";?>">
        	  </div>
        	</form>
        	<!--/search form -->
          <?php } 
          else { ?>
            <script type="text/javascript">
              (function($) {
                $(document).ready(function() {
                  <?php
                    if ( is_user_logged_in() ) {  ?>
                    $(".navbar-nav").last().append('<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9999"><a title="Logout" href="<?php echo wp_logout_url(); ?>">Logout</a></li>')
                  <?php } else { ?>
                    $(".navbar-nav").last().append('<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9999"><a title="Login" href="./wp-login.php">Login</a></li>')
                  <?php } ?>
                })
              })(jQuery)
            </script>
          <?php }

          wp_nav_menu( array(
            'menu'              => 'primary',
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
          );
        ?><!--/.nav-collapse -->
      </div>
    </nav>
    
    <?php $header_image = get_header_image(); ?>
    <div class="blog-header" <?php if ( get_header_image() ) : ?>style="background-image: url( '<?php echo esc_url( $header_image ); ?>'); background-size: cover; background-repeat: no-repeat; background-position: top left; margin-bottom: 30px; width: 100%; height: 100%; min-height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; position: relative;"<?php endif; ?>>
      <div class="container" <?php if ( get_header_image() ) : ?>style="height: auto; min-height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; position: relative;"<?php endif; ?>>
        <?php if ( display_header_text() ) : ?>
        <?php $header_text_color = get_header_textcolor(); ?>
        <h1 class="blog-title" style="color: #<?php echo $header_text_color ?>;"><?php bloginfo( 'name' ); ?></h1>
        <p class="lead blog-description" style="color: #<?php echo $header_text_color ?>"><?php bloginfo( 'description' ); ?></p>
        <?php else : ?>
        <h1 class="blog-title" style="visibility: hidden; margin: 0; padding: 0; font-size: 0;"><?php bloginfo( 'name' ); ?></h1>
        <p class="lead blog-description" style="visibility: hidden; margin: 0; padding: 0; font-size: 0;"><?php bloginfo( 'description' ); ?></p>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="container">
