<?php
add_filter('show_admin_bar', '__return_false');
/**
 * Enlightened Labs Bootstrap WP functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, enlightenedlabsbootstrapwp_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'enlightenedlabsbootstrapwp_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */

/*
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 900;

/* Tell WordPress to run enlightenedlabsbootstrapwp_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'enlightenedlabsbootstrapwp_setup' );

if ( ! function_exists( 'enlightenedlabsbootstrapwp_setup' ) ):
/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override enlightenedlabsbootstrapwp_setup() in a child theme, add your own enlightenedlabsbootstrapwp_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support()        To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses register_nav_menus()       To add support for navigation menus.
 * @uses add_editor_style()         To style the visual editor.
 * @uses load_theme_textdomain()    For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size()  To set a custom post thumbnail size.
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function enlightenedlabsbootstrapwp_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'editor-style.css' );
	
	// Post Format support.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
    // Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'enlightenedlabsbootstrapwp', get_template_directory() . '/languages' );
	
	// Register Custom Navigation Walker
	require_once('inc/wp_bootstrap_navwalker.php');
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'enlightenedlabsbootstrapwp' ),
	) );
	
	// The custom header business starts here.
	
	$args = array(
		// The height and width of our custom header.
		'width'         => '980',
		'height'        => '170',
		// Support flexible widths and heights.
		'flex-height'    => true,
		'flex-width'    => true,
		// Let WordPress know what our default text color is.
		'default-text-color'     => '333',
	);
	add_theme_support( 'custom-header', $args );
	
	// This feature allows themes to add document title tag to HTML <head>.
	add_theme_support( 'title-tag' );	
}
add_action( 'after_setup_theme', 'enlightenedlabsbootstrapwp_setup' );
endif;

/**
 * Enqueue scripts and styles for front-end and login page
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function enlightenedlabsbootstrapwp_scripts() {
	wp_enqueue_style( 'style-css', get_stylesheet_uri() );
	wp_enqueue_style( 'blog-css', get_template_directory_uri() . '/css/blog.css' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', '3.3.0' );
	if ( is_rtl() ) {
		wp_enqueue_style( 'blog-rtl-css', get_template_directory_uri() . '/css/blog-rtl.css' );
		wp_enqueue_style( 'bootstrap-rtl-css', get_template_directory_uri() . '/css/bootstrap-rtl.css', '3.3.0' );
	}
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '3.3.0', true );
	wp_enqueue_script( 'html5shiv-js', get_template_directory_uri() . '/js/html5shiv.js', array( 'jquery' ), '3.7.2' );
	wp_enqueue_script( 'ie-10-viewport-bug-workaround-js', get_template_directory_uri() . '/js/ie10-viewport-bug-workaround.js', array( 'jquery' ), '3.3.0', true );
	wp_enqueue_script( 'respond-js', get_template_directory_uri() . '/js/respond.js', array( 'jquery' ), '1.4.2' );
	wp_enqueue_script( 'scripts-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'enlightenedlabsbootstrapwp_scripts' );
add_action( 'login_enqueue_scripts', 'enlightenedlabsbootstrapwp_scripts' );

/**
 * Register widgetized areas, including main sidebar and three widget-ready columns in the footer.
 *
 * To override enlightenedlabsbootstrapwp_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 *
 * @uses register_sidebar()
 */
function enlightenedlabsbootstrapwp_widgets_init() {
	// Area 1, located at the top of the sidebar.
    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'enlightenedlabsbootstrapwp' ),
        'id' => 'primary-widget-area',
        'description' => __( 'Add widgets here to appear in your sidebar.', 'enlightenedlabsbootstrapwp' ),
		'before_widget' => '<div id="%1$s" class="sidebar-module widget %2$s">',
		'after_widget'  => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ) );
	
	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'enlightenedlabsbootstrapwp' ),
		'id'            => 'first-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer.', 'enlightenedlabsbootstrapwp' ), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	  
	// Area 3, located in the footer. Empty by default.  
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'enlightenedlabsbootstrapwp' ),
		'id'            => 'second-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer.', 'enlightenedlabsbootstrapwp' ), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	  
	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'enlightenedlabsbootstrapwp' ),
		'id'            => 'third-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer.', 'enlightenedlabsbootstrapwp' ), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'enlightenedlabsbootstrapwp' ),
		'id'            => 'fourth-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer.', 'enlightenedlabsbootstrapwp' ), 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'enlightenedlabsbootstrapwp_widgets_init' );

/**
 * Enqueue scripts and styles for login page.
 * Applies custom login form and logos.
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function custom_login_form() { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/login/style.css" />
	<script>
		(function($) {
			$(document).ready(function() {
				$('.wp-social-login-provider-google').find("img").attr("src","<?php echo get_bloginfo('stylesheet_directory'); ?>/login/sign-in-button.png")
			});
		})(jQuery)
	</script>
<?php
}
add_action( 'login_head'                      , 'custom_login_form' );

/**
 * Replace url when login logo is clicked 
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/**
 * Enqueue scripts and styles for login page.
 * Applies custom login form and logos.
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function my_login_logo_url_title() {
	return 'Enlightened Labs';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/**
 * Add required styles and script to show a map in user profile
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function show_custom_profile_edit() { 	?>
	<style type="text/css">
		#map-canvas {
			min-height: 400px;
			max-width: 650px;
		}
	</style>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script type="text/javascript">
		var map, markers = [], marker = false, me = false, bounds;
		(function($) {
	        var dragEND = function(e) {
	          if(marker) 
	            marker.setMap(null)
	          marker = new google.maps.Marker({
	            position: e.latLng,
	            draggable: true,
	            map: map,
	            title: "Saved Position",
	            animation: google.maps.Animation.BOUNCE
	          });
	          google.maps.event.addListener(marker, 'dragend', dragEND);
	          $("#location").val(e.latLng.A+","+e.latLng.F);
	        };
			function initiate_map(lat,lng) {
		        var pos = new google.maps.LatLng(lat,lng);
		        bounds = new google.maps.LatLngBounds();
		        me = new google.maps.Marker({
		          position: pos,
		          map: map,
		          title: "Current Position"
		        });
		       	bounds.extend(me.position);
				var user_ll = $("#location").val() ? $("#location").val().split(",") : [lat,lng];
				var user_pos = new google.maps.LatLng(user_ll[0],user_ll[1]);
		       	bounds.extend(user_pos);
		        dragEND( { latLng: user_pos } );
		        google.maps.event.addListener(map, 'click', dragEND);
		        map.setCenter(pos);
		        map.fitBounds(bounds);
		        var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { latLng: user_pos }, function(results, status) {
                    $("#geocode").val(results[0].formatted_address)
                })
		    }

			$(function() {
				$("#gplus").attr("disabled", "disabled").parent().append('<span class="description">Cannot be changed</span>');
				var p = $("#location").hide().parent().append("<div id='map-canvas'></div>");
				p.append('Your Address: <input id="geocode"><input hidden type="button" id="geocode-edit" value="Edit"><div id="geocode-res" hidden></div>');
				var geocoder = new google.maps.Geocoder();
                $("#geocode").on("keydown", function(e) {
					if(e.keyCode == 13) {
						e.preventDefault();
			            geocoder.geocode( { address: $(this).val() }, function(results, status) {
			                $("#geocode").hide();
			                $("#geocode-res").show();
			                $("#geocode-edit").show();
			                $("#geocode-res").html('');
			                for (i in results) {
			                	var r = results[i];
			                	$("<span>").css({display: "block", cursor: "pointer"}).addClass("geocode-result").text(r.formatted_address).data("lat", r.geometry.location.A).data("lng", r.geometry.location.F).appendTo($("#geocode-res"))
			                }
			            });
					}
				})
				$("#geocode-res").on("click", ".geocode-result", function(e) {
					var pos = new google.maps.LatLng($(this).data("lat"), $(this).data("lng"));
					dragEND({latLng:pos});
					$("#geocode-edit").click();
					$("#geocode").val($(this).text())
				})
				$("#geocode-edit").click(function(e) {
					e.preventDefault();
					$("#geocode").show();
					$(this).hide();
					$("#geocode-res").hide();
				})
				map = new google.maps.Map($("#map-canvas")[0], {
				      zoom: 10,
				      disableDefaultUI: true
			    });
				if(navigator.geolocation) {
				  navigator.geolocation.getCurrentPosition(function(position) {
				    initiate_map(position.coords.latitude, position.coords.longitude);
				  }, function() {
				    var user_ll = $("#location").val().split(",");
				    initiate_map(user_ll[0], user_ll[1]);
				  });
				} else {
				    var user_ll = $("#location").val().split(",");
				    initiate_map(user_ll[0], user_ll[1]);
				}
			});
		})(jQuery);
	</script>
<?php 
}

add_action('edit_user_profile','show_custom_profile_edit');
add_action('show_user_profile','show_custom_profile_edit');

/**
 * Add custom fields in wordpress database
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function modify_contact_methods($profile_fields) { 
	$profile_fields['comm'] = 'Home Community';
	$profile_fields['telegram'] = 'Telegram Username';
	$profile_fields['gplus'] = 'Google+ URL';
	$profile_fields['location'] = 'Your Location';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

/**
 * Use get_the_excerpt() to print an excerpt by specifying a maximium number of characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 *
 * @param int $charlength The number of excerpt characters.
 * @return int The filtered number of excerpt characters.
 */
function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
class Bootstrap_WP_Customize {
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since EnlightenedLabs Bootstrap WP 1.0
    */
   public static function register ( $wp_customize ) {
	  //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'title_tagline', 
         array(
            'title' => __( 'Site Title & Tagline', 'enlightenedlabsbootstrapwp' ), //Visible title of section
            'priority' => 1, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('', 'enlightenedlabsbootstrapwp'), //Descriptive tooltip
         ) 
      );
	   
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'enlightenedlabsbootstrapwp_copyright', 
         array(
            'title' => __( 'Copyright', 'enlightenedlabsbootstrapwp' ), //Visible title of section
            'priority' => 2, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('', 'enlightenedlabsbootstrapwp'), //Descriptive tooltip
         ) 
      );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'copyrighttext', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_text_field',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Control( //Instantiate the text control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_copyrighttext', //Set a unique ID for the control
         array(
            'label' => __( 'Copyright', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'enlightenedlabsbootstrapwp_copyright', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'copyrighttext', //Which setting to load and manipulate (serialized is okay)
            'priority' => 1, //Determines the order this control appears in for the specified section
			'type' => 'text',
         ) 
      ) );
	  
	  //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'enlightenedlabsbootstrapwp_fonts', 
         array(
            'title' => __( 'Fonts', 'enlightenedlabsbootstrapwp' ), //Visible title of section
            'priority' => 3, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('', 'enlightenedlabsbootstrapwp'), //Descriptive tooltip
         ) 
      );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'body_fontfamily', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => 'georgia, serif', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'enlightenedlabsbootstrapwp_sanitize_font_selection',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Control( //Instantiate the text control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_body_fontfamily', //Set a unique ID for the control
         array(
            'label' => __( 'Text Font', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'enlightenedlabsbootstrapwp_fonts', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'body_fontfamily', //Which setting to load and manipulate (serialized is okay)
            'priority' => 1, //Determines the order this control appears in for the specified section
			'type'     => 'select',
			'choices'  => array(
			  'arial, helvetica, sans-serif'                     => 'Arial',
			  'arial black, gadget, sans-serif'                  => 'Arial Black',
			  'comic sans ms, cursive, sans-serif'               => 'Comic Sans MS',
			  'courier new, courier, monospace'                  => 'Courier New',
			  'georgia, serif'                                   => 'Georgia',
			  'impact, charcoal, sans-serif'                     => 'Impact',
			  'lucida console, monaco, monospace'                => 'Lucida Console',
			  'lucida sans unicode, lucida grande, sans-serif'   => 'Lucida Sans Unicode',
			  'palatino linotype, book antiqua, palatino, serif' => 'Palatino Linotype',
			  'tahoma, geneva, sans-serif'                       => 'Tahoma',
			  'times new roman, times, serif'                    => 'Times New Roman',
			  'trebuchet ms, helvetica, sans-serif'              => 'Trebuchet MS',
			  'verdana, geneva, sans-serif'                      => 'Verdana',
		    )
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'headings_fontfamily', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => 'arial, helvetica, sans-serif', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'enlightenedlabsbootstrapwp_sanitize_font_selection',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Control( //Instantiate the text control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_headings_fontfamily', //Set a unique ID for the control
         array(
            'label' => __( 'Headings Font', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'enlightenedlabsbootstrapwp_fonts', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'headings_fontfamily', //Which setting to load and manipulate (serialized is okay)
            'priority' => 2, //Determines the order this control appears in for the specified section
			'type'     => 'select',
			'choices'  => array(
			  'arial, helvetica, sans-serif'                     => 'Arial',
			  'arial black, gadget, sans-serif'                  => 'Arial Black',
			  'comic sans ms, cursive, sans-serif'               => 'Comic Sans MS',
			  'courier new, courier, monospace'                  => 'Courier New',
			  'georgia, serif'                                   => 'Georgia',
			  'impact, charcoal, sans-serif'                     => 'Impact',
			  'lucida console, monaco, monospace'                => 'Lucida Console',
			  'lucida sans unicode, lucida grande, sans-serif'   => 'Lucida Sans Unicode',
			  'palatino linotype, book antiqua, palatino, serif' => 'Palatino Linotype',
			  'tahoma, geneva, sans-serif'                       => 'Tahoma',
			  'times new roman, times, serif'                    => 'Times New Roman',
			  'trebuchet ms, helvetica, sans-serif'              => 'Trebuchet MS',
			  'verdana, geneva, sans-serif'                      => 'Verdana',
		    )
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'menu_fontfamily', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => 'georgia, serif', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'enlightenedlabsbootstrapwp_sanitize_font_selection',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Control( //Instantiate the text control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_menu_fontfamily', //Set a unique ID for the control
         array(
            'label' => __( 'Menu Font', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'enlightenedlabsbootstrapwp_fonts', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'menu_fontfamily', //Which setting to load and manipulate (serialized is okay)
            'priority' => 3, //Determines the order this control appears in for the specified section
			'type'     => 'select',
			'choices'  => array(
			  'arial, helvetica, sans-serif'                     => 'Arial',
			  'arial black, gadget, sans-serif'                  => 'Arial Black',
			  'comic sans ms, cursive, sans-serif'               => 'Comic Sans MS',
			  'courier new, courier, monospace'                  => 'Courier New',
			  'georgia, serif'                                   => 'Georgia',
			  'impact, charcoal, sans-serif'                     => 'Impact',
			  'lucida console, monaco, monospace'                => 'Lucida Console',
			  'lucida sans unicode, lucida grande, sans-serif'   => 'Lucida Sans Unicode',
			  'palatino linotype, book antiqua, palatino, serif' => 'Palatino Linotype',
			  'tahoma, geneva, sans-serif'                       => 'Tahoma',
			  'times new roman, times, serif'                    => 'Times New Roman',
			  'trebuchet ms, helvetica, sans-serif'              => 'Trebuchet MS',
			  'verdana, geneva, sans-serif'                      => 'Verdana',
		    )
         ) 
      ) );
	  
	  //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'header_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Header Text Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'header_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 1, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'body_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#555', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_body_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Text Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'body_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 2, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#1FBA34', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_link_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 3, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'hover_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#78EF40', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_hover_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Hover Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'hover_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 4, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'headings_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#333', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_headings_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Headings Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'headings_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 5, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'primary_menucolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#1FBA34', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_primary_menucolor', //Set a unique ID for the control
         array(
            'label' => __( 'Primary Menu Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'primary_menucolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 6, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'primary_linkcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#cdddeb', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_primary_linkcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Primary Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'primary_linkcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 7, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'primary_hovercolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#fff', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_primary_hovercolor', //Set a unique ID for the control
         array(
            'label' => __( 'Primary Hover Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'primary_hovercolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 8, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'primary_activecolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#fff', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_primary_activecolor', //Set a unique ID for the control
         array(
            'label' => __( 'Primary Active Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'primary_activecolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 9, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'primary_activebackground', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#78EF40', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_primary_activebackground', //Set a unique ID for the control
         array(
            'label' => __( 'Primary Active Background Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'primary_activebackground', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'dropdown_menucolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#fff', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_dropdown_menucolor', //Set a unique ID for the control
         array(
            'label' => __( 'Dropdown Menu Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'dropdown_menucolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 11, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'dropdown_linkcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#333', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_dropdown_linkcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Dropdown Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'dropdown_linkcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 12, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'dropdown_hovercolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#333', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_dropdown_hovercolor', //Set a unique ID for the control
         array(
            'label' => __( 'Dropdown Hover Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'dropdown_hovercolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 13, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'dropdown_hoverbackground', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#f5f5f5', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_dropdown_hoverbackground', //Set a unique ID for the control
         array(
            'label' => __( 'Dropdown Hover Background Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'dropdown_hoverbackground', //Which setting to load and manipulate (serialized is okay)
            'priority' => 14, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'dropdown_activecolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#fff', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_dropdown_activecolor', //Set a unique ID for the control
         array(
            'label' => __( 'Dropdown Active Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'dropdown_activecolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 15, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'dropdown_activebackground', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#080808', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_dropdown_activebackground', //Set a unique ID for the control
         array(
            'label' => __( 'Dropdown Active Background Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'dropdown_activebackground', //Which setting to load and manipulate (serialized is okay)
            'priority' => 16, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'footer_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#999', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_footer_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Footer Text Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'footer_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 17, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'footer_linkcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#428bca', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_footer_linkcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Footer Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'footer_linkcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 18, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'footer_hovercolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#78EF40', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_footer_hovercolor', //Set a unique ID for the control
         array(
            'label' => __( 'Footer Hover Link Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'footer_hovercolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 19, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'footer_backgroundcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#f9f9f9', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'sanitize_hex_color',
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_footer_backgroundcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Footer Background Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'footer_backgroundcolor', //Which setting to load and manipulate (serialized is okay)
            'priority' => 20, //Determines the order this control appears in for the specified section
         ) 
      ) );
	  
	  //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'enlightenedlabsbootstrapwp_background_color', //Set a unique ID for the control
         array(
            'label' => __( 'Background Color', 'enlightenedlabsbootstrapwp' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'background_color', //Which setting to load and manipulate (serialized is okay)
            'priority' => 21, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	  $wp_customize->add_setting( 'display_header_text' , array( 'default' => true, 'sanitize_callback' => 'enlightenedlabsbootstrapwp_sanitize_checkbox' ) );
	  $wp_customize->get_setting( 'display_header_text' )->transport = 'postMessage';
      $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
   }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since EnlightenedLabs Bootstrap WP 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
         <?php self::generate_css('.blog-title, .blog-description', 'color', 'header_textcolor', '#'); ?>
         <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?>
		 <?php self::generate_css('.blog-nav .active', 'color', 'background_color', '#'); ?>
		 <?php self::generate_css('body', 'font-family', 'body_fontfamily'); ?>
		 <?php self::generate_css('body', 'color', 'body_textcolor'); ?>
         <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
		 <?php self::generate_css('a:hover, a:focus', 'color', 'hover_textcolor'); ?>
		 <?php self::generate_css('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6', 'font-family', 'headings_fontfamily'); ?>
		 <?php self::generate_css('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6', 'color', 'headings_textcolor'); ?> 
		 <?php self::generate_css('.navbar-inverse', 'font-family', 'menu_fontfamily'); ?>
		 <?php self::generate_css('.navbar-inverse', 'background-color', 'primary_menucolor'); ?> 
		 <?php self::generate_css('.navbar-inverse .navbar-brand, .navbar-inverse .navbar-nav > li > a', 'color', 'primary_linkcolor'); ?>
		 <?php self::generate_css('.navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav > li > a:focus', 'color', 'primary_hovercolor'); ?>
		 <?php self::generate_css('.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus', 'color', 'primary_activecolor'); ?>
		 <?php self::generate_css('.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus, .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:hover, .navbar-inverse .navbar-nav > .open > a:focus', 'background-color', 'primary_activebackground'); ?>
		 <?php self::generate_css('.dropdown-menu', 'background-color', 'dropdown_menucolor'); ?>
		 <?php self::generate_css('.dropdown-menu > li > a, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a', 'color', 'dropdown_linkcolor'); ?>
		 <?php self::generate_css('.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus', 'color', 'dropdown_hovercolor'); ?>
		 <?php self::generate_css('.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu > li > a:focus', 'background-color', 'dropdown_hoverbackground'); ?>
		 <?php self::generate_css('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:focus', 'color', 'dropdown_activecolor'); ?>
		 <?php self::generate_css('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu > .active > a:focus', 'background-color', 'dropdown_activebackground'); ?>
		 <?php self::generate_css('.blog-footer', 'color', 'footer_textcolor'); ?>
		 <?php self::generate_css('.blog-footer a', 'color', 'footer_linkcolor'); ?>
		 <?php self::generate_css('.blog-footer a:hover, .blog-footer a:focus', 'color', 'footer_hovercolor'); ?>
		 <?php self::generate_css('.blog-footer', 'background-color', 'footer_backgroundcolor'); ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since EnlightenedLabs Bootstrap WP 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'enlightenedlabsbootstrapwp-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since EnlightenedLabs Bootstrap WP 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Bootstrap_WP_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'Bootstrap_WP_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Bootstrap_WP_Customize' , 'live_preview' ) );

/**
 * Sanitize Customizer Font Selections
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function enlightenedlabsbootstrapwp_sanitize_font_selection( $input ) {
  $valid = array(
	'arial, helvetica, sans-serif'                     => 'Arial',
	'arial black, gadget, sans-serif'                  => 'Arial Black',
	'comic sans ms, cursive, sans-serif'               => 'Comic Sans MS',
	'courier new, courier, monospace'                  => 'Courier New',
	'georgia, serif'                                   => 'Georgia',
	'impact, charcoal, sans-serif'                     => 'Impact',
	'lucida console, monaco, monospace'                => 'Lucida Console',
	'lucida sans unicode, lucida grande, sans-serif'   => 'Lucida Sans Unicode',
	'palatino linotype, book antiqua, palatino, serif' => 'Palatino Linotype',
	'tahoma, geneva, sans-serif'                       => 'Tahoma',
	'times new roman, times, serif'                    => 'Times New Roman',
	'trebuchet ms, helvetica, sans-serif'              => 'Trebuchet MS',
	'verdana, geneva, sans-serif'                      => 'Verdana',
  );
	
  if ( array_key_exists( $input, $valid ) ) {
	return $input;
  } else {
	return '';
  }
}

/**
 * Sanitize Customizer Checkbox
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function enlightenedlabsbootstrapwp_sanitize_checkbox( $input ) {
  if ( $input == 1 ) {
	return 1;
  } else {
	return '';
  }
}

if ( ! function_exists( 'enlightenedlabsbootstrapwp_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own enlightenedlabsbootstrapwp_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since EnlightenedLabs Bootstrap WP 1.0
 */
function enlightenedlabsbootstrapwp_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
	// Display trackbacks differently than normal comments.
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<p><?php _e( 'Pingback:', 'enlightenedlabsbootstrapwp' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'enlightenedlabsbootstrapwp' ), '<span class="comment-meta edit-link"><span class="glyphicon glyphicon-pencil"></span> ', '</span>' ); ?></p>
  <?php
	break;
	default :
	// Proceed with normal comments.
	global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">
      <header class="comment-meta comment-author vcard">
        <?php
            echo get_avatar( $comment, 44 );
            printf( ' <cite><b class="fn">%1$s</b> %2$s</cite>',
                get_comment_author_link(),
                // If current post author is also comment author, make it known visually.
                ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'enlightenedlabsbootstrapwp' ) . '</span>' : ''
            );
            printf( '<span class="glyphicon glyphicon-calendar"></span> <a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                /* translators: 1: date, 2: time */
                sprintf( __( '%1$s at %2$s', 'enlightenedlabsbootstrapwp' ), get_comment_date(), get_comment_time() )
            );
        ?>
      </header><!-- .comment-meta -->

      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'enlightenedlabsbootstrapwp' ); ?></p>
      <?php endif; ?>

      <section class="comment-content comment">
        <?php comment_text(); ?>
        <?php edit_comment_link( __( 'Edit', 'enlightenedlabsbootstrapwp' ), '<p class="comment-meta edit-link"><span class="glyphicon glyphicon-pencil"></span> ', '</p>' ); ?>
      </section><!-- .comment-content -->

      <div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'enlightenedlabsbootstrapwp' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	  </div><!-- .reply -->
      <hr />
	</article><!-- #comment-## -->
<?php
    break;
  endswitch; // end comment_type check
}
endif;
