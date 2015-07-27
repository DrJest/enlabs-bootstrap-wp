<?php
/**
 * Template for displaying Author Archive pages
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */

	get_header(); ?>
      <?php 
        $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
        $id = $curauth->ID;
      ?>
    <?php if(is_user_logged_in()) { ?>
      <div class="row">
        <div class="col-sm-8 blog-main">
          <table style="width: 100%">
            <tr>
              <th colspan="2">
                <?php the_author_meta('display_name', $id); ?>'s details
              </th>
            </tr>
            <?php 
              if(is_super_admin()) { 
            ?>
              <tr>
                <td>
                  User Login
                </td>
                <td>
                <?php the_author_meta('user_login', $id); ?>
                </td>
              </tr>
              <tr>
                <td>
                  User Email
                </td>
                <td>
                  <a href="mailto:<?php the_author_meta('user_email', $id); ?>"><?php the_author_meta('user_email', $id); ?></a>
                </td>
              </tr>
            <?php 
              }
            ?>
              <tr>
                <td>
                  Name
                </td>
                <td>
                  <a target="_blank" href="<?php echo get_cimyFieldValue($id, 'GPLUS'); ?>#">
                    <?php the_author_meta('first_name', $id); ?> <?php the_author_meta('last_name', $id); ?> (<?php the_author_meta('user_nicename', $id); ?>)
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  Home Community
                </td>
                <td>
                  <a target="_blank" href="<?php echo get_cimyFieldValue($id,'COMM'); ?>">
                    <?php 
			$re = "/<title [^>]+>(.*)<\\/title>/";  
			$url = get_cimyFieldValue($id, 'COMM'); 
			if($url) :
			$ch = curl_init($url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$str = curl_exec($ch);
			preg_match($re, $str, $matches);
			echo str_replace(" - Community - Google+","",$matches[1]);
			endif;
 		    ?>
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  Telegram Nickname
                </td>
                <td>
                  <a target="_blank" href="https://telegram.me/<?php echo substr(get_cimyFieldValue($id, 'TELEGRAM'),1); ?>">
                    <?php echo get_cimyFieldValue($id, 'TELEGRAM'); ?>
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  Bio
                </td>
                <td>
                  <?php the_author_meta('description', $id); ?>
                </td>
              </tr>
              <tr>
                <td>
                  Location
                </td>
                <td>
                  <?php echo get_cimyFieldValue($id, 'ADDRESS'); ?>
                  <div id="map-canvas" style="min-height: 300px"></div>
                  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
                  <script>
                    var addr = "<?php echo get_cimyFieldValue($id, 'ADDRESS'); ?>";
                    (function($) {
                      if (!addr) 
                        return $("#map-canvas").hide();
                      var map = new google.maps.Map($("#map-canvas")[0], {
                            zoom: 13,
                            disableDefaultUI: true
                        });
                      var geocoder = new google.maps.Geocoder();
                      geocoder.geocode( { address : addr }, function(results, status) {
                        var me = new google.maps.Marker({
                          position: results[0].geometry.location,
                          map: map,
                          title: "Current Position",
                          zoom: 10
                        });
                        map.setCenter(results[0].geometry.location);
                      })
                    })(jQuery);
                  </script>
                </td>
              </tr>
          </table>
        </div>
      </div>
    <?php } ?>
      <div class="row">

        <div class="col-sm-8 blog-main">

          <h3><?php printf( __( 'Author Archives: %s', 'enlightenedlabsbootstrapwp' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h3>
          <hr />
		  <?php get_template_part( 'loop', 'author' ); ?>

        </div><!-- /.blog-main -->

        <?php get_sidebar(); ?>

      </div><!-- /.row -->
      
	<?php get_footer(); ?>
