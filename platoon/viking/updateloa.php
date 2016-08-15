<?php
include('../../config/protection.php');

$id = $_GET['id'];
$type = $_GET['type'];

$sql = "UPDATE rosters SET is_loa=$type WHERE ruser_id=$id";
$results = mysqli_query($con, $sql);
if ( $results )
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	echo $con->err;
}
