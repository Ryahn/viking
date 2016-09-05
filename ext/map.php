<html>
<head>
<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />
<script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
<script>
function load() {
var map = L.map('map').setView([0, 0], 2);
        L.tileLayer('../assets/map/dariyah/{z}/{x}/{y}.png', {
            minZoom: 2,
            maxZoom: 7,
            noWrap: true,
            tms: true
        }).addTo(map);
    }

    map.on('click', function(e) {
    alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
});

</script>
</head>
<!-- 
<body onload="load()">

<div id="map" style="width: 700px; height: 500px"></div> -->
<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $actual_link;
?>
</body>
</html>

