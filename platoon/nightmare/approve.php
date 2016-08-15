<?php
include('../../config/protection.php');
$mysqliDebug =1;
if ( isset($_POST['submit']) )
{
	foreach ( $_POST as $pid22 ) 
	{
		$sql = "UPDATE attendances SET is_approved=1 where id=$pid22";
		$results = mysqli_query($con, $sql);

		
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
elseif ( $_GET['deny'] )
{
	$id = $_GET['id'];
	$sql = "UPDATE attendances SET is_approved=1, type=5 where id=$id";
	$results = mysqli_query($con, $sql);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	$id = $_GET['id'];
	$sql = "UPDATE attendances SET is_approved=1 where id=$id";
	$results = mysqli_query($con, $sql);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
