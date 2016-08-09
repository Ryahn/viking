<?php
include('login/includes/api.php');
include('config/db.php');
$id = $_GET['id'];
$uname = $_GET['username'];

echo "<h2>Editting " . $uname . "</h2>";

$grabPerms = "SELECT * FROM user_permissions WHERE user_id=$id";
        $grabPresults = mysqli_query($con, $grabPerms);
        if(!$grabPresults and $mysqliDebug) {
            echo "<p>There was an error in query: $grabUsers</p>";
            echo $con->error;
        }
        while($erow = mysqli_fetch_assoc($grabPresults)) {
            echo $erow['is_admin'];
        }
