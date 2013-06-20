<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
        width:100%;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <?php
$street=$_GET['street'];
//$code=$_GET['code'];
$city=$_GET['city'];
$country=$_GET['country'];
$adress= $street." ".$city." ".$country;

?>
    <script>
	   var geocoder;
var map;
function initialize() {
	  geocoder = new google.maps.Geocoder();

  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(46.53333, 6.66667),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}




function codeAddress() {
  //var address = document.getElementById('address').value;
  var address= "<?php echo $adress; ?>";
  geocoder.geocode( { 'address': address}, function(results, status) {
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

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body onload="codeAddress()">
<!--<div id="panel">
      <input id="address" type="textbox" value="la plage villeneuve">
      <input type="button" value="Geocode" onclick="codeAddress()">
    </div>-->
    <div id="map-canvas"></div>

  </body>
</html>