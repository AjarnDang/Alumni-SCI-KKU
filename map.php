<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
		<title>Simple Map</title>
		<meta name="viewport" content="initial-scale=1.0">
		<meta charset="utf-8">
		<style>
			#map {
				height: 100%;
			}
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			}
		</style>
	
	
		<div id="map"></div>
		<script>
                        var map;
                        function initMap() {
                                map = new google.maps.Map(document.getElementById('map'), {
                                        center: {lat: 13.7245601, lng: 100.493024},
                                        zoom: 8
                                });
                        }
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGj6BeRqvL5IqkYSE4H7b2w4NIoUngGqw&callback=initMap" async defer></script>
	
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
	jQuery(function($) {
		$('#showMap').click(function() {
			$.getScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyAGj6BeRqvL5IqkYSE4H7b2w4NIoUngGqw&callback=initMap');
			$(this).hide();
		});
	});
</script>
</body>
</html>