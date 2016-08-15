<?php
include('../../config/protection.php');
include('../../config/db.php');
$sql = "SELECT awards.award_name FROM awards inner join user_awards on user_awards.award_id=awards.id where user_awards.user_id=1";
$results = mysqli_query($con, $sql);
if(!$results and $mysqliDebug) 
	{
	   echo "<p>There was an error in query: $results</p>";
	   echo $con->error;
	}
	while($row = mysqli_fetch_assoc($results))
	{
		echo $row['award_name'];
	}