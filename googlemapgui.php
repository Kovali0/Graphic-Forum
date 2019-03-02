<html>
	<head>
		<style>
			.googleMapBox {
				border: 1px solid black;
				border-radius: 15px;
				padding: 10px;
			}
			
			.addressBox {
				padding: 10px;
			}
		</style>
	</head>
	<body>
	
	<h1>Google Map</h1>
	
	<div class="adressBox" align="center">
        <input id="addressfield" type="text" value="New York">
        <input type="button" value="Geocode" onclick="codeAddress()">
    </div>
	
	<div class="googleMapBox" id="googleMapBox" align="center" style="width:300px;height:200px; "></div>
	
	<script>
		var geocoder;
  
		function myMap() {
			var mapProp= {
				center:new google.maps.LatLng(51.508742,-0.120850),
				zoom:5,
			};
			var map = new google.maps.Map(document.getElementById("googleMapBox"),mapProp);
		}
		
		function codeAddress() {
			var address = document.getElementById('addressfield').value;
			geocoder.geocode( { 'addressfield': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}
			});
		}
		
	</script>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo1lxd_UiJ1N8a1fh7nOtg7XGTDkSFD6I&callback=myMap"></script>
	<script> //klucz do testów wyłącznie = AIzaSyAo1lxd_UiJ1N8a1fh7nOtg7XGTDkSFD6I </script>
	</body>
</html>

<script>
	//funkcja centrujaca mape podczas odswiezenia
	function myMap(x,y) {
		var mapProp = {
			center:new google.maps.LatLng(x,y), //centrowanie mapki
			zoom:6,
		};
		var map = new google.maps.Map(document.getElementById("googleMapBox"),mapProp); //wstawianie nowej mapki do boxu, to wymaga przeladowania mapki
	}
	
	function setnewMarker(
		var marker = new google.maps.Marker({
		position:myCenter,
		animation:google.maps.Animation.BOUNCE
	}
  
	function changeMarkerPosition(marker, x, y) {
		var latlng = new google.maps.LatLng(x, y);
		marker.setPosition(latlng);
	}
});

marker.setMap(map);
</script>

