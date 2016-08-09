<?php
//config.db.php
$host = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = '';
$mysqliDebug = true;

$con = mysqli_connect($host,$dbuser,$dbpass,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo '<p>There was an error connecting to the database!</p>';
        if ($mysqliDebug) {
            // mysqli->connect_error returns the latest error message,
            // hopefully clarifying the problem
            echo $con->connect_error;
        }
    die();
  }