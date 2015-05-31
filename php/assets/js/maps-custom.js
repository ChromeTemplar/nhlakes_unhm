/**
 * 
 */
var nhvbsrMap = {
	marker: undefined,
	latitude :42.9869,
	longitude : -71.4686,
	mapID : 'map-canvas',
	latitudeID: 'latitude',
	longitudeID : 'longitude',
	edit : true,
	geocoder : new google.maps.Geocoder(),
	map: undefined,
	infowindow : undefined,
	initialize: function()
	{
		
		var latandLng = new google.maps.LatLng(nhvbsrMap.latitude, nhvbsrMap.longitude)
		var mapOptions = {  zoom: 13, center: latandLng };
		
		nhvbsrMap.infowindow = new google.maps.InfoWindow();
		nhvbsrMap.map = new google.maps.Map(document.getElementById(nhvbsrMap.mapID), mapOptions);
	  
		if(nhvbsrMap.edit)
		{
			google.maps.event.addListener(nhvbsrMap.map, 'click', function(evt) {
				nhvbsrMap.bindLatLong(evt.latLng);
				nhvbsrMap.placeMarker(evt.latLng, nhvbsrMap.map);
			});
		}
		
		nhvbsrMap.placeMarker(latandLng, nhvbsrMap.map);
	},
	placeMarker : function(position, map)
	{
		if (nhvbsrMap.marker == undefined)
		{
			nhvbsrMap.marker = new google.maps.Marker({
	  		position: position,
	  	    map: map,
	  	    draggable: nhvbsrMap.edit 
	  		});
	
	  	  google.maps.event.addListener(nhvbsrMap.marker, 'dragend', function(evt){
	  		  nhvbsrMap.bindLatLong(evt.latLng);
	  		});
	  	}
	  	else 
	  	{
	  		nhvbsrMap.marker.setPosition(position);
	    }
	   
	    //map.setCenter(position);
	},
	bindLatLong: function(latLng)
	{
		var lat = latLng.lat().toFixed(6);
		var long = latLng.lng().toFixed(6);
			
	    document.getElementById(nhvbsrMap.latitudeID).value = lat;
	    document.getElementById(nhvbsrMap.longitudeID).value = long;
	},
	codeLatLng: function () {
	  var lat =  document.getElementById(nhvbsrMap.latitudeID).value;
	  var lng = document.getElementById(nhvbsrMap.longitudeID).value;
	  var latlng = new google.maps.LatLng(lat, lng);
	  
	  nhvbsrMap.geocoder.geocode({'latLng': latlng}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      if (results[1]) {
	    	  nhvbsrMap.infowindow.setContent(results[1].formatted_address);
	          nhvbsrMap.infowindow.open(nhvbsrMap.map, nhvbsrMap.marker);
	          nhvbsrMap.marker.setPosition(latlng);
	          nhvbsrMap.map.setCenter(latlng);
	      } else {
	        alert('No results found');
	      }
	    } else {
	      alert('Geocoder failed due to: ' + status);
	    }
	  });
	}
}
