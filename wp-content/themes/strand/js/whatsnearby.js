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

	//// shop

	var bugisJunctionLatlng = setMarkerLatLng(1.2994217, 103.8555408); 
	createGoogleMarker('bugisJunctionMarker', bugisJunctionLatlng, 'shop', 'Bugis Junction');	    

	var plazaSingapuraLatlng = setMarkerLatLng(1.3005476, 103.8449733);
	createGoogleMarker('plazaSingapuraMarker', plazaSingapuraLatlng, 'shop', 'Plaza Singapura');	    

	var theCathayLatlng = setMarkerLatLng(1.2997754, 103.8476223);
	createGoogleMarker('theCathayMarker', theCathayLatlng, 'shop', 'The Cathay Cineplex');

	var bugisVillageLatlng = setMarkerLatLng(1.3008467, 103.8552561);
	createGoogleMarker('bugisVillageMarker', bugisVillageLatlng, 'shop', 'Bugis Village');

	var hajiLaneLatlng = setMarkerLatLng(1.3008829,103.8590564);
	createGoogleMarker('hajiLaneMarker', hajiLaneLatlng, 'shop', 'Haji Lane');

	var rafflesCityLatlng = setMarkerLatLng(1.293836,103.852956);
	createGoogleMarker('rafflesCityMarker', rafflesCityLatlng, 'shop', 'Raffles City');

	//// museum

	var artMuseumLatlng = setMarkerLatLng(1.297307, 103.851062);
	createGoogleMarker('artMuseumMarker', artMuseumLatlng, 'museum', 'Art Museum');

	var historyMuseumLatlng = setMarkerLatLng(1.29668,103.848664);
	createGoogleMarker('historyMuseumMarker', historyMuseumLatlng, 'museum', 'History Museum');

	var peranakanMuseumLatlng = setMarkerLatLng(1.294357,103.849047);
	createGoogleMarker('peranakanMuseumMarker', peranakanMuseumLatlng, 'museum', 'Peranakan Museum');

	var philatelicMuseumLatlng = setMarkerLatLng(1.2929,103.848747);
	createGoogleMarker('philatelicMuseumMarker', philatelicMuseumLatlng, 'museum', 'Philatelic Museum');

	var amenianChurchLatlng = setMarkerLatLng(1.29311,103.849364);
	createGoogleMarker('amenianChurchMarker', amenianChurchLatlng, 'museum', 'Amenian Church');

	var stAndrewCathedralLatlng = setMarkerLatLng(1.292488,103.852315);
	createGoogleMarker('stAndrewCathedralMarker', stAndrewCathedralLatlng, 'museum', 'St Andrew\'s Cathedral');

	//// food

	var strictlyPancakesLatlng = setMarkerLatLng(1.299551, 103.849767);
	createGoogleMarker('strictlyPancakesMarker', strictlyPancakesLatlng, 'food', 'Strictly Pancakes');

	var mackenzieRexChickenRiceLatlng = setMarkerLatLng(1.3004199,103.8486887);
	createGoogleMarker('mackenzieRexChickenRiceMarker', mackenzieRexChickenRiceLatlng, 'food', 'Mackenzie Rex Restaurant');

	var artichokeCafeBarLatlng = setMarkerLatLng(1.299684,103.851963);
	createGoogleMarker('artichokeCafeBarMarker', artichokeCafeBarLatlng, 'food', 'Artichoke Cafe & Bar');

	var piedraNegraLatlng = setMarkerLatLng(1.300296,103.859366);
	createGoogleMarker('piedraNegraMarker', piedraNegraLatlng, 'food', 'Piedra Negra');

	var kithCafeLatlng = setMarkerLatLng(1.297874,103.845665);
	createGoogleMarker('kithCafeMarker', kithCafeLatlng, 'food', 'Kith Cafe');

	var chijmesLatlng = setMarkerLatLng(1.295051,103.851952);
	createGoogleMarker('chijmesMarker', chijmesLatlng, 'food', 'CHIJMES');

	//////
	/// Place IDs
	/////

	// function findPlaceID() {

	// }

	var strandPlaceId = 'ChIJF-8-srwZ2jERhn9mpTQylp4';

	var bugisJunctionPlaceId = 'ChIJA1_VvLoZ2jERaPl5iX91xFE';	    
	var plazaSingapuraPlaceId = 'ChIJR1Fyfr0Z2jERzwO-AZiJ-HM';	    
	var theCathayPlaceId = 'ChIJCwc9Ib0Z2jERGKkaxcJzE0c';	   
	var bugisVillagePlaceId = 'ChIJoXgri7oZ2jERLhcYSVy7rF0';
	var hajiLanePlaceId = 'ChIJyQfG_rAZ2jER6Yr2-WKP3mc';
	var rafflesCityPlaceId = 'ChIJHxkag6YZ2jERHDcr1cHhzc8';

	var artMuseumPlaceId = 'ChIJW8o1nqQZ2jERynZN2M1BODM';
	var historyMuseumPlaceId = 'ChIJ69IuoA0Z2jERi_Q7GmHkApA';
	var peranakanMuseumPlaceId = 'ChIJWZX956MZ2jERIGdnbs_SgMw';
	var philatelicMuseumPlaceId = 'ChIJtZIebKEZ2jERuxT_FLb6QgA';
	var amenianChurchPlaceId = 'ChIJqc0-Q6EZ2jERbzBEE3qq6p0';
	var stAndrewCathedralPlaceId = 'ChIJAQAA6KYZ2jER8Rfz0I9asBg';

	var strictlyPancakesPlaceId = 'ChIJO4tlvbwZ2jERAlR5D5aNXiY';
	var mackenzieRexChickenRicePlaceId = 'ChIJkQGWmbwZ2jERRuDwN6RisFk';
	var artichokeCafeBarPlaceId = 'ChIJzTqqFLsZ2jEROOgjd_-TM7k';
	var piedraNegraPlaceId = 'ChIJNXNVrbEZ2jERFPPHBFHMMfE';
	var kithCafePlaceId = 'ChIJOTveq6IZ2jER59dy6sf_U04';
	var chijmesPlaceId = 'ChIJNfw8b6QZ2jEREbGYft7-Q4A';

	requestObj = {};

	function createRequestObj(requestObjName, PlaceId) {
		requestObj[requestObjName] = {
	    	placeId : PlaceId
	    }
	}

	createRequestObj('strandRequest', strandPlaceId);

	createRequestObj('bugisJunctionRequest', bugisJunctionPlaceId);	    
	createRequestObj('plazaSingapuraRequest', plazaSingapuraPlaceId);
	createRequestObj('theCathayRequest', theCathayPlaceId);
	createRequestObj('bugisVillageRequest', bugisVillagePlaceId);
	createRequestObj('hajiLaneRequest', hajiLanePlaceId);
	createRequestObj('rafflesCityRequest', rafflesCityPlaceId);	    

	createRequestObj('artMuseumRequest', artMuseumPlaceId);
	createRequestObj('historyMuseumRequest', historyMuseumPlaceId);
	createRequestObj('peranakanMuseumRequest', peranakanMuseumPlaceId);
	createRequestObj('philatelicMuseumRequest', philatelicMuseumPlaceId);
	createRequestObj('amenianChurchRequest', amenianChurchPlaceId);
	createRequestObj('stAndrewCathedralRequest', stAndrewCathedralPlaceId);

	createRequestObj('strictlyPancakesRequest', strictlyPancakesPlaceId);
	createRequestObj('mackenzieRexChickenRiceRequest', mackenzieRexChickenRicePlaceId);
	createRequestObj('artichokeCafeBarRequest', artichokeCafeBarPlaceId);
	createRequestObj('piedraNegraRequest', piedraNegraPlaceId);
	createRequestObj('kithCafeRequest', kithCafePlaceId);
	createRequestObj('chijmesRequest', chijmesPlaceId);

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

	events(markersObj['StrandMarker'], StrandLatlng, requestObj['strandRequest']);
	events(markersObj['bugisJunctionMarker'], bugisJunctionLatlng, requestObj['bugisJunctionRequest']);	    
	events(markersObj['plazaSingapuraMarker'], plazaSingapuraLatlng, requestObj['plazaSingapuraRequest']);	    
	events(markersObj['theCathayMarker'], theCathayLatlng, requestObj['theCathayRequest']);
	events(markersObj['bugisVillageMarker'], bugisVillageLatlng, requestObj['bugisVillageRequest']);
	events(markersObj['hajiLaneMarker'], hajiLaneLatlng, requestObj['hajiLaneRequest']);
	events(markersObj['rafflesCityMarker'], rafflesCityLatlng, requestObj['rafflesCityRequest']);
	events(markersObj['artMuseumMarker'], artMuseumLatlng, requestObj['artMuseumRequest']);
	events(markersObj['historyMuseumMarker'], historyMuseumLatlng, requestObj['historyMuseumRequest']);
	events(markersObj['stAndrewCathedralMarker'], stAndrewCathedralLatlng, requestObj['stAndrewCathedralRequest']);	    
	events(markersObj['peranakanMuseumMarker'], peranakanMuseumLatlng, requestObj['peranakanMuseumRequest']);
	events(markersObj['philatelicMuseumMarker'], philatelicMuseumLatlng, requestObj['philatelicMuseumRequest']);
	events(markersObj['amenianChurchMarker'], amenianChurchLatlng, requestObj['amenianChurchRequest']);	   
	events(markersObj['strictlyPancakesMarker'], strictlyPancakesLatlng, requestObj['strictlyPancakesRequest']);
	events(markersObj['mackenzieRexChickenRiceMarker'], mackenzieRexChickenRiceLatlng, requestObj['mackenzieRexChickenRiceRequest']);
	events(markersObj['artichokeCafeBarMarker'], artichokeCafeBarLatlng, requestObj['artichokeCafeBarRequest']);
	events(markersObj['piedraNegraMarker'], piedraNegraLatlng, requestObj['piedraNegraRequest']);
	events(markersObj['kithCafeMarker'], kithCafeLatlng, requestObj['kithCafeRequest']);
	events(markersObj['chijmesMarker'], chijmesLatlng, requestObj['chijmesRequest']);


	$(".show-place").on('mouseover', function(e){        
	    e.preventDefault();

	 	var placename = $(this).attr('id');

	    google.maps.event.trigger(markersObj[placename+'Marker'], 'mouseover');
	});

	$(".show-place").on('click', function(e){        
	    e.preventDefault();

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