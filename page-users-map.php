<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */

	get_header(); ?>

      <div class="row">

        <div class="col-sm-8 blog-main">

        	<table>
          <?php 
          	$users = get_users();
          	foreach ($users as $k => $v) {
          		echo '<tr data-id="'.$v->ID.'">';
          		echo '<td><a target="_blank" href="'.$v->gplus.'">'.$v->user_login.'</a></td>';
          		echo '<td>'.$v->user_email.'</td>';
          		echo '<td><a href="https://telegram.me/'.str_replace("@", "", $v->telegram).'" target="_blank">'.$v->telegram.'</a></td>';
              echo '<td id="address-'.$v->ID.'">'.($v->address?$v->address:"N/D").'</td>';
          		echo '</tr>';
          	}

           ?> 
           	</table>

          <div id="map-canvas" style="min-height: 300px"></div>
          <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
          <script>
            var map;
	          var markers = [];
	          var bounds = new google.maps.LatLngBounds();
            (function($) {
              map = new google.maps.Map($("#map-canvas")[0], {
                    zoom: 10,
                    disableDefaultUI: true
                });
          	<?php
              	foreach ($users as $k => $v) { 
                  if($v->address) : ?>
              		var addr = "<?php echo $v->address; ?>";
                  (new google.maps.Geocoder()).geocode( { address: addr }, function(results, status) {
                    var marker = new google.maps.Marker({
                      position: results[0].geometry.location,
                      map: map,
                      title: "<?php echo $v->display_name; ?>"
                    })
                    marker.set("id", "<?php echo $v->ID; ?>");
                    markers.push( marker );
                    bounds.extend(results[0].geometry.location);
                    map.fitBounds(bounds);
                  });
			<?php  	endif;
              }	?>
            })(jQuery);
          </script>

        </div><!-- /.blog-main -->

        <?php get_sidebar(); ?>

      </div><!-- /.row -->
      
	<?php get_footer(); ?>