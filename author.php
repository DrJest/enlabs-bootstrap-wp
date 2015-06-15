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
                  <a target="_blank" href="<?php the_author_meta('gplus', $id); ?>#">
                    <?php the_author_meta('first_name', $id); ?> <?php the_author_meta('last_name', $id); ?> (<?php the_author_meta('user_nicename', $id); ?>)
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  Home Community
                </td>
                <td>
                  <a target="_blank" href="<?php the_author_meta('comm', $id); ?>">
                    <?php the_author_meta('comm', $id); ?> 
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  Telegram Nickname
                </td>
                <td>
                  <a target="_blank" href="https://telegram.me/<?php echo substr(get_the_author_meta('telegram', $id),1); ?>">
                    <?php the_author_meta('telegram', $id); ?>
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
                  <div id="map-canvas" style="min-height: 300px"></div>
                  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
                  <script>
                    var loc = "<?php the_author_meta('location', $id); ?>".split(",");
                    (function($) {
                      var map = new google.maps.Map($("#map-canvas")[0], {
                            zoom: 10,
                            disableDefaultUI: true
                        });
                      var geocoder = new google.maps.Geocoder();
                      var pos = new google.maps.LatLng(loc[0],loc[1]);
                      var me = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: "Current Position"
                      });
                      map.setCenter(pos)
                      geocoder.geocode( { latLng: pos }, function(results, status) {
                        $("#map-canvas").parent().prepend(results[0].formatted_address)
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