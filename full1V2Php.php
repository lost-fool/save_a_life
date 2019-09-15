<!DOCTYPE html>
<html>
<head>
	<title> Get it Done </title>

	<style type="text/css">
		
		#maprefer{
			height: 400px;
			width: 80%;
		}

	</style>
</head>
<body>

	<h1> <b>Directions</b> </h1>

	<div class="details">
		
		<p><u>Get my location</u></p>
		<div id="omed"></div>
		<label> From: </label>
		<input type="text" id="from" placeholder="Start Location" />
		<br/>
		<label> To:   </label>
		<input type="text" id="to" placeholder="Destination" />
		<br/>
		<div data-role="page" id="mapInfo">
				<button onclick="journeyDirec()"> GO </button>
			<h2> Map Reference </h2>
			<div id="maprefer"></div>
		</div>
	</div>
  <?php

     include 'marker.php';

  ?>

	<script src="LocateMe.js"></script>
	<script type="text/javascript">
		
		function initAuto()
    {
			var  autocompleteFrom, autocompleteTo;
			autocompleteFrom = new google.maps.places.Autocomplete(
      document.getElementById('from'), {types: ['geocode']});
      autocompleteTo = new google.maps.places.Autocomplete(
      document.getElementById('to'), {types: ['geocode']});
			autocompleteFrom.setFields(['address_component']);
			autocompleteTo.setFields(['address_component']);
			getMap();
		}
		function geolocate() 
    {
  			if (navigator.geolocation) 
        {
    			navigator.geolocation.getCurrentPosition(function(position) {
      		var geolocation = {
        			lat: position.coords.latitude,
        			lng: position.coords.longitude
      		};
      		  var circle = new google.maps.Circle(
          		{center: geolocation, radius: position.coords.accuracy});
      		    autocompleteFrom.setBounds(circle.getBounds());
      		    autocompleteTo.setBounds(circle.getBounds());
    			});
  			}
		}
		var map;
		function getMap()
    {
			function getDirectionsLocation() 
        {
            console.log("getDirectionsLocation");
            if (navigator.geolocation) 
            {
              navigator.geolocation.getCurrentPosition(showDirectionsPosition);
            } 
            else 
            {
              z.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
      var directionsLatitude, directionsLongitude;
      function showDirectionsPosition(position) 
      {
          console.log("showDirectionsPosition");
          directionsLatitude = position.coords.latitude;
          directionsLongitude = position.coords.longitude;
          directionsLatLng = new google.maps.LatLng(directionsLatitude,directionsLongitude);
      }
			 var options = {
				  zoom: 10,
				  center: {lat:13.0557676,lng:80.2105602}
			 }
		    map = new google.maps.Map(document.getElementById('maprefer'),options);
		    var marker = new google.maps.Marker({
          		  position: {lat: 13.0557676,lng: 80.2105602},
          		  map:map,
        	 });
    }
		function journeyDirec()
    {
			var directionsService = new google.maps.DirectionsService;
      var directionsDisplay = new google.maps.DirectionsRenderer;
      directionsDisplay.setMap(map);
      calculateAndDisplayRoute(directionsService, directionsDisplay);
    }
		function calculateAndDisplayRoute(directionsService, directionsDisplay) 
    {
       	 	var waypts = [];
         	waypts.push({
          		location: {lat:13.0557676,lng:80.2105602},
          		stopover: true
         	});
         	directionsService.route({
          		origin: document.getElementById('from').value,
          		destination: document.getElementById('to').value,
          		waypoints: waypts,
          		optimizeWaypoints: true,
          		travelMode: 'DRIVING'
          	}, function(response, status) {
          		  if (status === 'OK') 
                {
            		  directionsDisplay.setDirections(response);
            		  var route = response.routes[0];
            		  var summaryPanel = document.getElementById('directions-panel');
            		  summaryPanel.innerHTML = '';
            		  for (var i = 0; i < route.legs.length; i++) 
                  {
              			var routeSegment = i + 1;
              			summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  		'</b><br>';
              			summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              			summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              			summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            		  }
          		  } 
                else 
                {
            		  window.alert('Directions request failed due to ' + status);
          		  }
        	 });
      }

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=YourApiKey&libraries=places&callback=initAuto" async defer></script>

</body>
</html>