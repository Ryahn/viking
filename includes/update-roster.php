<?php
include('../config/protection.php');
$mysqliDebug = 1;
$sql = "SELECT ruser_id, rname, rplatoon FROM rosters WHERE rplatoon=''";
$results = mysqli_query($con, $sql);
while ( $row = mysqli_fetch_assoc( $results ) )
{
	$userid = $row['ruser_id'];
	$sql1 = "SELECT platoon FROM login_users WHERE id=$userid";
	$results1 = mysqli_query($con, $sql1);
	if(!$results1 and $mysqliDebug) 
	{
    	echo "<p>There was an error in query:". $results1."</p>";
    	echo $con->error;
	}
	while ( $row2 = mysqli_fetch_assoc( $results1 ) )
	{
		$platoon = $row2['platoon'];
		$sql2 = "UPDATE rosters SET rplatoon='$platoon' WHERE ruser_id=$userid";
		$results2 = mysqli_query($con, $sql2);
		if(!$results2 and $mysqliDebug) 
		{
    		echo "<p>There was an error in query:". $results2."</p>";
    		echo $con->error;
		}
	}

}