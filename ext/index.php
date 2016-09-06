<?php
include('../config/protection.php');
include('../templates/head.php');
// include('../templates/nav.php');

?>
<style>
body {
background-image: none;
background-color:transparent;
}
</style>
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

<!-- tabs left -->
      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#map1" data-toggle="tab">Battlefield Map</a></li>
          <li><a href="#roe" data-toggle="tab">Rules of Engagement</a></li>
          <li><a href="#story" data-toggle="tab">Background Story</a></li>
          <li><a href="#intel" data-toggle="tab">Intel Report</a></li>
          <li><a href="#redzone" data-toggle="tab">Red Zone Reports</a></li>
          <li><a href="#archives" data-toggle="tab">Archives</a></li>
        </ul>
        <div class="tab-content">
         <div class="tab-pane active" id="map1"> <div id="map" style="width: 700px; height: 500px"></div> </div>
         <div class="tab-pane" id="roe">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
         Quisque mauris augue, molestie tincidunt condimentum vitae. </div>
         <div class="tab-pane" id="story">Test</div>
         <div class="tab-pane" id="intel">
         	<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            	<div class="form-group">
                    <label>Field 1</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="test" name="feild1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Field 2</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="test" name="feild1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Field 3</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="test" name="feild1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Field 4</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="test" name="feild1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Textarea</label>
                    <textarea class="form-control text-rrd" rows="3" cols="5" name="reason"></textarea>
                </div>
                                        
                                        <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
                                        <button type="reset" class="btn btn-default">Reset Button</button>


         </div>
         <div class="tab-pane" id="redzone">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
         Quisque mauris augue, molestie tincidunt condimentum vitae. </div>
         <div class="tab-pane" id="archives">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
         Quisque mauris augue, molestie tincidunt condimentum vitae. </div>
        </div>
        </div>







<?php
include('../templates/footer.php');
?>