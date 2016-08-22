<?php
include('../../config/protection.php');
if ( hasRank('SFC') || hasPermission('can_update') )
{
date_default_timezone_set("America/Los_Angeles");
$dateFormat = "Y-m-d";
$date = new DateTime();
$dateString = $date->format($dateFormat);
$id = $_GET['id'];
$type = $_GET['type'];
if ( $type == 1)
{
$sql = "UPDATE rosters SET is_loa=$type WHERE ruser_id=$id";
$usql = "INSERT INTO user_loa (user_id, start_date)
VALUES ('$id','$dateString')";
$uresults = mysqli_query($con, $usql);
$results = mysqli_query($con, $sql);
if ( $results && $uresults)
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	echo $con->err;
}
}
else
{
$sql = "UPDATE rosters SET is_loa=$type WHERE ruser_id=$id";
$results = mysqli_query($con, $sql);
$rsql = "DELETE FROM user_loa WHERE user_id=$id";
$rresults = mysqli_query($con, $rsql);
if ( $results && $rresults )
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	echo $con->err;
}	
}
}
else
{
	echo 'You do not have permission!';
}