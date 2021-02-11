<?php
$css = '';
extract(shortcode_atts(array(
  'image' => '',
  'zoom' => '17',
  'lat' => '51.51152',
  'lon' => '-0.125198',
  'type' => '',
), $atts));
wp_enqueue_script("map_api", "http://maps.google.com/maps/api/js",array(),false,true);
wp_enqueue_script("map", get_template_directory_uri()."/js/gmap3.min.js",array('jquery'),false,true);
?>
<div id="map" style="height: 360px;"></div>
<?php
if($image!=''){
	$img = wp_get_attachment_image_src($image,'full');
	$img = $img[0];
	}else{
		$img = get_template_directory_uri().'/images/marker.png';
	}
?>

<script>
	(function($){
		'use strict';
		
		$(document).ready(function(){

			/* ---------------------------------------------------------------------- */
			/*	Contact Map
			/* ---------------------------------------------------------------------- */

			var contact = {"lat":"<?php echo  esc_js($atts['lat']); ?>", "lon":"<?php echo esc_js($atts['lon']); ?>"}; //Change a map coordinate here!-38.3945495,144.9187974

			try {
				var mapContainer = $('#map');
				mapContainer.gmap3({
					action: 'addMarker',
					marker:{
						options:{
							icon : new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/images/marker.png')
						}
					},
					latLng: [contact.lat, contact.lon],
					map:{
						center: [contact.lat, contact.lon],
						zoom: 10
						},
					},
					{action: 'setOptions', args:[{scrollwheel:false}]}
				);
			} catch(err) {

			}

		

	
		});
		
	})(jQuery);
</script>