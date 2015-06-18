<?php 
  $section_query = new WP_Query('post_type=ptype_whatsnearby&orderby=menu_order&order=ASC&posts_per_page=-1');

  $place_query = new WP_Query('post_type=ptype_places&orderby=menu_order&order=ASC&posts_per_page=-1');    

  while ($section_query->have_posts()) : $section_query->the_post();   	
      
      $whereToShopHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_heading_h2', true);
      $whereToShopHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_heading_h3', true);
      $whereToShopHeadingParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_paragraph_html', true);
      $whereToShopLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_link_text', true);
      $whereToShopLink = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_link', true);
      $whereToShopLink = get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_link', true);
      $whereToShopImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_where_to_shop_img', true), 'full');

      $exploreAttractionHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_heading_h2', true);
      $exploreAttractionHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_heading_h3', true);
      $exploreAttractionHeadingParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_paragraph_html', true);
      $exploreAttractionLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_link_text', true);
      $exploreAttractionLink = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_link', true);
      $exploreAttractionLink = get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_link', true);
      $exploreAttractionBgStamp = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_bg_stamp', true), 'full');
      $exploreAttractionImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_explore_attraction_img', true), 'full');

      $eatDrinkHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_heading_h2', true);
      $eatDrinkHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_heading_h3', true);
      $eatDrinkHeadingParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_paragraph_html', true);
      $eatDrinkLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_link_text', true);
      $eatDrinkLink = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_link', true);
      $eatDrinkLink = get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_link', true);
      $eatDrinkImg = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_eat_drink_img', true), 'full');

      $neighborhoodHeadingH2 = get_post_meta($post->ID, 'ptype_whatsnearby_neighborhood_heading_h2', true);
      $neighborhoodHeadingH3 = get_post_meta($post->ID, 'ptype_whatsnearby_neighborhood_heading_h3', true);
      $neighborhoodParagraphHTML = get_post_meta($post->ID, 'ptype_whatsnearby_neighborhood_paragraph_HTML', true);

      $shoppingPlaceHeadingH4 = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_heading_h4', true);
      $shoppingPlaceHeadingH5 = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_heading_h5', true);
      $shoppingPlaceLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_link_text', true);
      $shoppingPlaceLink = get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_link', true);
      $shoppingPlaceIcon = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_shopping_place_icon', true), 'full');

      $attractionPlaceHeadingH4 = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_heading_h4', true);
      $attractionPlaceHeadingH5 = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_heading_h5', true);
      $attractionPlaceLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_link_text', true);
      $attractionPlaceLink = get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_link', true);
      $attractionPlaceIcon = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_attraction_place_icon', true), 'full');

      $eateryPlaceHeadingH4 = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_heading_h4', true);
      $eateryPlaceHeadingH5 = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_heading_h5', true);
      $eateryPlaceLinkText = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_link_text', true);
      $eateryPlaceLink = get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_link', true);
      $eateryPlaceIcon = wp_get_attachment_image_src(get_post_meta($post->ID, 'ptype_whatsnearby_eatery_place_icon', true), 'full');

  endwhile; 
  wp_reset_query();
?>

<style>
  .this-text-content:after { background: url('<?php echo $exploreAttractionBgStamp[0]; ?>')!important; }
</style>

<div class="first-content">
  <div class="container">
    
    <?php if(!empty($whereToShopHeadingH3)): ?>
    <div class="content-section">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h3><?php echo $whereToShopHeadingH3; ?></h3>
            <h2><?php echo $whereToShopHeadingH2; ?></h2>
            <hr class="small">
            <?php echo $whereToShopHeadingParagraphHTML; ?>
            <a href="<?php echo $whereToShopLink; ?>" class="discover-more"><?php echo $whereToShopLinkText; ?></a>             
          </div>
          <div class="img-content">
            <img src="<?php echo get_home_url().'/timthumb.php?src='.$whereToShopImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $whereToShopHeadingH3; ?>">
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  
    <?php if(!empty($exploreAttractionHeadingH3)): ?>
    <div class="content-section">
      <div class="row">
        <div class="col-md-12">
          <div class="img-content">
            <img src="<?php echo get_home_url().'/timthumb.php?src='.$exploreAttractionImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $exploreAttractionHeadingH3; ?>">
          </div>
          <div class="text-content this-text-content">
            <h3><?php echo $exploreAttractionHeadingH3; ?></h3>
            <h2><?php echo $exploreAttractionHeadingH2; ?></h2>
            <hr class="small">
            <?php echo $exploreAttractionHeadingParagraphHTML; ?>
            <a href="<?php echo $exploreAttractionLink; ?>" class="discover-more"><?php echo $exploreAttractionLinkText; ?></a>             
          </div>            
        </div>
      </div>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($eatDrinkHeadingH3)): ?>
    <div class="content-section">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h3><?php echo $eatDrinkHeadingH3; ?></h3>
            <h2><?php echo $eatDrinkHeadingH2; ?></h2>
            <hr class="small">
            <?php echo $eatDrinkHeadingParagraphHTML ?>
            <a href="<?php echo $eatDrinkLink; ?>" class="discover-more"><?php echo $eatDrinkLinkText; ?></a>             
          </div>
          <div class="img-content">
            <img src="<?php echo get_home_url().'/timthumb.php?src='.$eatDrinkImg[0].'&h=400&w=640&zc=0'; ?>" alt="<?php echo $eatDrinkHeadingH3; ?>">
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</div>

<div class="neighborhood">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="heading">
              <h3><?php echo $neighborhoodHeadingH3; ?></h3>
              <h2><?php echo $neighborhoodHeadingH2; ?></h2>
              <hr class="small">
              <?php echo $neighborhoodParagraphHTML; ?>
            </div>    

            <div id="google-map-canvas" class="map"></div>                          

            <div class="places">
              <?php if(!empty($shoppingPlaceHeadingH4)): ?>
              <div class="each-place">
                <h4><?php echo $shoppingPlaceHeadingH4; ?></h4>
                <h5><?php echo $shoppingPlaceHeadingH5; ?></h5>
                <img src="<?php echo $shoppingPlaceIcon[0]; ?>" alt="<?php echo $shoppingPlaceHeadingH4; ?>">
                <ul>
                  <?php 
                    while ($place_query->have_posts()) : $place_query->the_post();
                      $terms = wp_get_post_terms( $post->ID, 'placetype' );
                      $place_type = ucfirst($terms[0]->name);

                      if('Shopping'==$place_type):
                        $placeName = get_post_meta($post->ID, 'ptype_places_place_name_heading_h2', true);
                  ?>
                  <li><a href="#google-map-canvas" id="<?php echo lcfirst(str_replace(' ', '', $placeName)); ?>" class="show-place"><?php echo $placeName; ?></a></li>                  
                  <?php
                      endif;
                    endwhile; 
                  ?>
                </ul>
                <a href="<?php echo $shoppingPlaceLink; ?>" class="learn-more"><?php echo $shoppingPlaceLinkText; ?></a>
              </div>
              <?php endif; ?>
              <?php if(!empty($attractionPlaceHeadingH4)): ?>
              <div class="each-place">
                <h4><?php echo $attractionPlaceHeadingH4; ?></h4>
                <h5><?php echo $attractionPlaceHeadingH5; ?></h5>
                <img src="<?php echo $attractionPlaceIcon[0]; ?>" alt="<?php echo $attractionPlaceHeadingH4; ?>">
                <ul>
                  <?php 
                    while ($place_query->have_posts()) : $place_query->the_post();
                      $terms = wp_get_post_terms( $post->ID, 'placetype' );
                      $place_type = ucfirst($terms[0]->name);

                      if('Attraction'==$place_type):
                        $placeName = get_post_meta($post->ID, 'ptype_places_place_name_heading_h2', true);
                  ?>
                  <li><a href="#google-map-canvas" id="<?php echo lcfirst(str_replace(' ', '', $placeName)); ?>" class="show-place"><?php echo $placeName; ?></a></li>
                  <?php
                      endif;
                    endwhile; 
                  ?>              
                </ul>
                <a href="<?php echo $attractionPlaceLink; ?>" class="learn-more"><?php echo $attractionPlaceLinkText; ?></a>
              </div>
              <?php endif; ?>
              <?php if(!empty($eateryPlaceHeadingH4)): ?>
              <div class="each-place">
                <h4><?php echo $eateryPlaceHeadingH4; ?></h4>
                <h5><?php echo $eateryPlaceHeadingH5; ?></h5>
                <img src="<?php echo $eateryPlaceIcon[0]; ?>" alt="<?php echo $eateryPlaceHeadingH4; ?>">
                <ul>
                  <?php 
                    while ($place_query->have_posts()) : $place_query->the_post();
                      $terms = wp_get_post_terms( $post->ID, 'placetype' );
                      $place_type = ucfirst($terms[0]->name);

                      if('Food'==$place_type):
                        $placeName = get_post_meta($post->ID, 'ptype_places_place_name_heading_h2', true);
                  ?>
                  <li><a href="#google-map-canvas" id="<?php echo lcfirst(str_replace(' ', '', $placeName)); ?>" class="show-place"><?php echo $placeName; ?></a></li>
                  <?php
                      endif;
                    endwhile; 
                  ?>  
                </ul>
                <a href="<?php echo $eateryPlaceLink; ?>" class="learn-more"><?php echo $eateryPlaceLinkText; ?></a>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    var map;
    function initialize() {

      /////
      // MAP STYLE
      /////

      var styles = [
          {
              "featureType": "water",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "color": "#d3d3d3"
                  }
              ]
          },
          {
              "featureType": "transit",
              "stylers": [
                  {
                      "color": "#808080"
                  },
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "geometry.stroke",
              "stylers": [
                  {
                      "visibility": "on"
                  },
                  {
                      "color": "#b3b3b3"
                  }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "color": "#ffffff"
                  }
              ]
          },
          {
              "featureType": "road.local",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "visibility": "on"
                  },
                  {
                      "color": "#ffffff"
                  },
                  {
                      "weight": 1.8
                  }
              ]
          },
          {
              "featureType": "road.local",
              "elementType": "geometry.stroke",
              "stylers": [
                  {
                      "color": "#d7d7d7"
                  }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "visibility": "on"
                  },
                  {
                      "color": "#ebebeb"
                  }
              ]
          },
          {
              "featureType": "administrative",
              "elementType": "geometry",
              "stylers": [
                  {
                      "color": "#a7a7a7"
                  }
              ]
          },
          {
              "featureType": "road.arterial",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "color": "#ffffff"
                  }
              ]
          },
          {
              "featureType": "road.arterial",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "color": "#ffffff"
                  }
              ]
          },
          {
              "featureType": "landscape",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "visibility": "on"
                  },
                  {
                      "color": "#efefef"
                  }
              ]
          },
          {
              "featureType": "road",
              "elementType": "labels.text.fill",
              "stylers": [
                  {
                      "color": "#696969"
                  }
              ]
          },
          {
              "featureType": "administrative",
              "elementType": "labels.text.fill",
              "stylers": [
                  {
                      "visibility": "on"
                  },
                  {
                      "color": "#737373"
                  }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "labels.icon",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "labels",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "road.arterial",
              "elementType": "geometry.stroke",
              "stylers": [
                  {
                      "color": "#d6d6d6"
                  }
              ]
          },
          {
              "featureType": "road",
              "elementType": "labels.icon",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {},
          {
              "featureType": "poi",
              "elementType": "geometry.fill",
              "stylers": [
                  {
                      "color": "#dadada"
                  }
              ]
          }
      ];

      ////
      // MAP INIT
      ////

      function setMarkerLatLng(lat, lng) {
        return new google.maps.LatLng(lat, lng);
      }

      var StrandLatlng = setMarkerLatLng(1.298447,103.850022);
      var mapOptions = {
        mapTypeControlOptions: {  
            mapTypeIds: ['Styled']  
        },  
        zoom: 17,
        center: StrandLatlng,
        disableDefaultUI: true,   
        mapTypeId: 'Styled'
      };
      map = new google.maps.Map(document.getElementById('google-map-canvas'),
        mapOptions);
      var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });  
      map.mapTypes.set('Styled', styledMapType);

      var service = new google.maps.places.PlacesService(map);

      /////
      // INFOBOX
      /////

      infobox = new InfoBox({           
        disableAutoPan: false,
        maxWidth: 225,
        zIndex: null,
        boxStyle: {
              opacity: 1,
              width: "225px"
          },
          closeBoxMargin: "0px",
          closeBoxURL: "../wp-content/themes/strand/images/icons/close-btn.png",
          infoBoxClearance: new google.maps.Size(1, 1)
      });

      ////
      // MARKERS
      ////

      var markersObj = {};

      function createGoogleMarker(markerName ,Latlng, icon, title) {        

          markersObj[markerName] = new google.maps.Marker({
            position: Latlng,
            map: map,
            title: title,
            icon: '../wp-content/themes/strand/images/icons/'+icon+'.png'
          });
      }

      createGoogleMarker('StrandMarker', StrandLatlng, 'strand', 'The Strand Hotel');

      //////
      /// Place IDs
      /////

      requestObj = {};

      function createRequestObj(requestObjName, PlaceId) {
        requestObj[requestObjName] = {
            placeId : PlaceId
          }
      }

      /////
      // EVENTS
      /////

      function events(Marker, MarkerLatLng, MarkerRequest) {

        service.getDetails(MarkerRequest, function(place, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
              google.maps.event.addListener(Marker, 'mouseover', function() {
                  infobox.open(map, this);              
                  infobox.setContent("<div class='infoBox-text'><h5>"+place.name+"</h5><p>"+place.formatted_address+"</p><a href='"+place.website+"' target='_blank'>VISIT WEBSITE <i class='fa fa-chevron-circle-right'></i></a><div class='arrow-down'></div></div>");
                  infobox.setOptions({ 'pixelOffset' : new google.maps.Size(-25, -195) });
                  map.panTo(MarkerLatLng);
              }); 

              google.maps.event.addListener(Marker, 'click', function() {
                  infobox.open(map, this);              
                  infobox.setContent("<div class='infoBox-text'><h5>"+place.name+"</h5><p>"+place.formatted_address+"</p><a href='"+place.website+"' target='_blank'>VISIT WEBSITE <i class='fa fa-chevron-circle-right'></i></a><div class='arrow-down'></div></div>");
                  infobox.setOptions({ 'pixelOffset' : new google.maps.Size(-25, -195) });
                  map.panTo(MarkerLatLng);
              }); 
            }else if (status === google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                  setTimeout(function() {
                      events(Marker, MarkerLatLng, MarkerRequest);
                  }, 200);
              }
          });
        
      }

      var strandPlaceId = 'ChIJF-8-srwZ2jERhn9mpTQylp4';
      createRequestObj('strandRequest', strandPlaceId);
      events(markersObj['StrandMarker'], StrandLatlng, requestObj['strandRequest']);

      <?php 
        while ($place_query->have_posts()) : $place_query->the_post();
          $terms = wp_get_post_terms( $post->ID, 'placetype' );
          $place_type = ucfirst($terms[0]->name);

          $placeName = get_post_meta($post->ID, 'ptype_places_place_name_heading_h2', true);          
          $placeLat = get_post_meta($post->ID, 'ptype_places_place_latitude', true);          
          $placeLong = get_post_meta($post->ID, 'ptype_places_place_longitude', true);          
          $placeID = get_post_meta($post->ID, 'ptype_places_place_google_map_id', true);          
      ?>
          var placeType = '<?php echo $place_type; ?>';
          var placeName = '<?php echo lcfirst(str_replace(' ', '', $placeName)); ?>';
          var placeLat = '<?php echo $placeLat; ?>';
          var placeLong = '<?php echo $placeLong; ?>';
          
          var placeID = '<?php echo $placeID; ?>';
          var icon;

          if(placeType == 'Shopping') {
            icon = 'shop';
          }else if(placeType == 'Attraction') {
            icon = 'museum';
          }else {
            icon = 'food';
          }

          if(placeLat != "" && placeLong != "") {
            var placeLatlng = setMarkerLatLng(placeLat, placeLong);
            createGoogleMarker(placeName+'Marker', placeLatlng, icon, '<?php echo $placeName; ?>');     
            createRequestObj(placeName+'Request', placeID);     
            events(markersObj[placeName+'Marker'], placeLatlng, requestObj[placeName+'Request']);    
          }
      <?php
        endwhile; 
      ?>

      $(".show-place").on('mouseover', function(e){        
          e.preventDefault();

        var placename = $(this).attr('id');

          google.maps.event.trigger(markersObj[placename+'Marker'], 'mouseover');
      });

      $(".show-place").on('click', function(e){        
          // e.preventDefault();

        var placename = $(this).attr('id');

          google.maps.event.trigger(markersObj[placename+'Marker'], 'click');
      });

      function getURLParameter(sParam)
      {
          var sPageURL = window.location.search.substring(1);
          var sURLVariables = sPageURL.split('&');
          for (var i = 0; i < sURLVariables.length; i++) 
          {
              var sParameterName = sURLVariables[i].split('=');
              if (sParameterName[0] == sParam) 
              {
                  return sParameterName[1];
              }
          }
      }

      var place = getURLParameter('place');

      if(place !== '') {
        console.log(place)
        if (typeof google === 'object' && typeof google.maps === 'object') {
          $('#'+place).trigger('click');
        }   
      }
    }

    initialize();
    </script>