$(document).ready(function(){   
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

		var StrandLatlng = setMarkerLatLng(1.309509,103.858058);
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
		// LAT LNG
		/////
		var lavendarMRTLatlng = setMarkerLatLng(1.307167,103.863007);
		var farrerParkMRTLatlng = setMarkerLatLng(1.312426,103.854317);


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

		createGoogleMarker('StrandMarker', StrandLatlng, 'classique', 'The Classique Hotel');
		createGoogleMarker('lavendarMRTMarker', lavendarMRTLatlng, 'mrt', 'Lavendar MRT');
		createGoogleMarker('farrerParkMRTMarker', farrerParkMRTLatlng, 'mrt', 'Farrer Park MRT');

		///////
		//// Place Info
		///////

		var strandPlaceId = 'ChIJB3vSXMgZ2jERLjx4pOi6IGA';
		var lavendarMRTPlaceId = 'ChIJ6X_R8LUZ2jERyA8cWVI1ITk';
		var farrerParkMRTPlaceId = 'ChIJ2_fgd8YZ2jERjjZDjwfps_c';

		requestObj = {};

		function createRequestObj(requestObjName, PlaceId) {
			requestObj[requestObjName] = {
		    	placeId : PlaceId
		    }
		}

		createRequestObj('strandRequest', strandPlaceId);
		createRequestObj('lavendarMRTRequest', lavendarMRTPlaceId);
		createRequestObj('farrerParkMRTRequest', farrerParkMRTPlaceId);

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
		    	}else if (status === google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
		            setTimeout(function() {
		                events(Marker, MarkerLatLng, MarkerRequest);
		            }, 200);
		        }
		    });
			
		}

		events(markersObj['StrandMarker'], StrandLatlng, requestObj['strandRequest']);
		events(markersObj['lavendarMRTMarker'], lavendarMRTLatlng, requestObj['lavendarMRTRequest']);
		events(markersObj['farrerParkMRTMarker'], farrerParkMRTLatlng, requestObj['farrerParkMRTRequest']);

	}
	initialize();
});