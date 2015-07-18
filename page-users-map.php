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
          		echo '<td><a href="https://telegram.me/'.$v->telegram.'" target="_blank">'.$v->telegram.'</a></td>';
          		echo '<td id="address-'.$v->ID.'"></td>';
          		echo '</tr>';
          	}

           ?> 
           	</table>

          <div id="map-canvas" style="min-height: 300px"></div>
          <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
          <script>
            (function($) {
	          var markers = [];
	          var bounds = new google.maps.LatLngBounds();
              var map = new google.maps.Map($("#map-canvas")[0], {
                    zoom: 10,
                    disableDefaultUI: true
                });
          	<?php
              	foreach ($users as $k => $v) { ?>
              	if("<?php echo $v->location; ?>".length) {
              		var pos = new google.maps.LatLng(<?php echo $v->location; ?>);
	              	var marker = new google.maps.Marker({
						position: pos,
						map: map,
						title: "<?php echo $v->display_name; ?>"
					});
					marker.set("id", "<?php echo $v->ID; ?>");
					bounds.extend(pos);
		          	var geocoder = new google.maps.Geocoder();
		            geocoder.geocode( { latLng: pos }, function(results, status) {
		                $("#address-<?php echo $v->ID; ?>").text(results[0].formatted_address)
		            });
		            markers.push(marker);
              	}
			<?php  	}	?>
				map.fitBounds(bounds);
            })(jQuery);
          </script>

        </div><!-- /.blog-main -->

        <?php get_sidebar(); ?>

      </div><!-- /.row -->
      
	<?php get_footer(); ?>