<?php

include('../../login/includes/api.php');
include('../../config/db.php');

date_default_timezone_set("America/Los_Angeles");

$uuid = $_POST['id1'];
$uplatoon = $_POST['platoon1'];
$type = $_POST['type'];

function checkStatus($item) 
{
  if ( $item == 'present' )
  {
    return true;
  } else
  {
    return false;
  }
}
$dateFormat = "Y-m-d H:i:s";
$date = new DateTime();
$dateString = $date->format($dateFormat);
$timestamp1 = strtotime($dateString);
$month1 = date('F j Y', $timestamp1);

$bsql = "SELECT * FROM attendances WHERE user_id=$uuid ORDER BY id DESC LIMIT 1 ";
$results = mysqli_query($con, $bsql);

if ( mysqli_num_rows($results) > 0 ) 
{
    
    while($row = mysqli_fetch_assoc($results))
    {
        $createdString = $row['created_on'];
        $createdDate   = new DateTime($createdString);
        $laterDate     = clone $createdDate;
        $laterInterval = new DateInterval('PT4H');
        $laterDate->add($laterInterval);

        // echo "Created: "    . $createdDate->format($dateFormat) . "<br>";
        // echo "Current: "    . $date->format($dateFormat) . "<br>";
        // echo "Difference: " . $createdDate->diff($date)->format('%a days, %h hours, %i minutes') . "<br>";
        if ( $row['is_approved'] == true) {
          if ( checkStatus($type) == true )
          {
            $present = 1;
           $nsql1 = "INSERT INTO attendances (platoons,is_present,created_on,user_id,month_day) 
           VALUES ('" . $uplatoon . "','" . $present . "','" . $dateString . "','" . $uuid . "','" . $month1 ."')";
           $results1 = mysqli_query($con, $nsql1);
               if(!$results1 and $mysqliDebug) {
                   echo "<p>There was an error in query: $results1</p>";
                   echo $con->error;
               }
            echo "Present: Can attend";
          } elseif (checkStatus($type) == false)
          {
            $training = 1;
            $nsql2 = "INSERT INTO attendances (platoons,is_training,created_on,user_id) VALUES ('" . $uplatoon . "','" . $training . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query: $results2</p>";
                   echo $con->error;
               }
            echo "Training: Can attend";
          }

        } elseif ( $date > $laterDate )
        {
          if ( checkStatus($type) == true )
          {
          $present = 1;
           $nsql1 = "INSERT INTO attendances (platoons,is_present,created_on,user_id,month_day) 
           VALUES ('" . $uplatoon . "','" . $present . "','" . $dateString . "','" . $uuid . "','" . $month1 ."')";
           $results1 = mysqli_query($con, $nsql1);
               if(!$results1 and $mysqliDebug) {
                   echo "<p>There was an error in query: $results1</p>";
                   echo $con->error;
               }
            echo "Present: Can attend";
          } else 
          {
            $training = 1;
            $nsql2 = "INSERT INTO attendances (platoons,is_training,created_on,user_id) VALUES ('" . $uplatoon . "','" . $training . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query: $results2</p>";
                   echo $con->error;
               }
            echo "Training: Can attend";
          }
        }
        else
        {
            echo "Can't attend";
        }
      }
    }
else
{
  if ( checkStatus($type) == true )
  {
    $present = 1;
    $nsql3 = "INSERT INTO attendances (platoons,is_present,created_on,user_id) VALUES ('" . $uplatoon . "','" . $present . "','" . $dateString . "','" . $uuid . "')";
    $results3 = mysqli_query($con, $nsql3);
      if(!$results3 and $mysqliDebug) 
      {
        echo "<p>There was an error in query: $results3</p>";
        echo $con->error;
      }
    echo "Present: Accounted for!";
} else
{
  $training = 1;
  $nsql4 = "INSERT INTO attendances (platoons,is_present,created_on,user_id) VALUES ('" . $uplatoon . "','" . $training . "','" . $dateString . "','" . $uuid . "')";
  $results4 = mysqli_query($con, $nsql4);
    if(!$results4 and $mysqliDebug) 
      {
        echo "<p>There was an error in query: $results4</p>";
        echo $con->error;
      }
    echo "Training: Accounted for!";
}
}

?>


