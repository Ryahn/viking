<?php
$base = $_SERVER['DOCUMENT_ROOT'];
include($base .'/login/includes/api.php');

function hasPerm($perm1) {
    include('db.php');
    $puid = userValue(null, "id");
    $psql = "SELECT * FROM user_permissions where user_id=$puid";
    $results = mysqli_query($con, $psql);
    while($row1 = mysqli_fetch_assoc($results)) {
       if ($row1[$perm1] == 1) {
           return true;
       } else {
           return false;
       }

}
}

    
