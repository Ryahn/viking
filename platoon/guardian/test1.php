<?php
include('../../config/protection.php');
include('../../config/db.php');

$sql = "SELECT * FROM ranks";
$rankresults = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($rankresults))
{
	echo '<p>Rank: '. $row['name'] . ' <br>Description: '. $row['name_desc'] . '<br>Image: <img src="' . $row['base64'] . '"/></p>';
}