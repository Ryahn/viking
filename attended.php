<?php
include('../../config/protection.php');

date_default_timezone_set("America/Los_Angeles");
$mysqliDebug =1;

$uuid = $_POST['id1'];
$uplatoon = $_POST['platoon1'];
$type = $_POST['type'];

$dateFormat = "Y-m-d H:i:s";
$date = new DateTime();
$dateString = $date->format($dateFormat);
$timestamp1 = strtotime($dateString);
$month1 = date('F j Y', $timestamp1);

$bsql = "SELECT * FROM attendances WHERE user_id=$uuid ORDER BY id DESC LIMIT 1 ";
$results = mysqli_query($con, $bsql);

$updateRosterSql = "UPDATE rosters SET last_active='$dateString' WHERE ruser_id=$uuid";
$rosterResults1 = mysqli_query($con, $updateRosterSql);
if(!$rosterResults1 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $rosterResults1."</p>";
                   echo $con->error;
               }

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
          if ( checkStatus($type) == 6 )
          {
            $official = 6;
           $nsql1 = "INSERT INTO attendances (platoons,type,created_on,user_id) 
           VALUES ('" . $uplatoon . "','" . $official . "','" . $dateString . "','" . $uuid . "')";
           
           $results1 = mysqli_query($con, $nsql1);
               if(!$results1 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results1."</p>";
                   echo $con->error;
               }
               
            echo "Offical OP: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          } elseif (checkStatus($type) == 2)
          {
            $training = 2;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $training . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Training: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 7)
          {
            $rasp = 7;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $rasp . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "RASP: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 8)
          {
            $ranger = 8;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $ranger . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Ranger: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 4)
          {
            $devday = 4;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $devday . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Dev Day: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 1)
          {
            $openplay = 1;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $openplay . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Open Play: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }


        } elseif ( $date > $laterDate )
        {
          if ( checkStatus($type) == 6 )
          {
            $official = 6;
           $nsql1 = "INSERT INTO attendances (platoons,type,created_on,user_id) 
           VALUES ('" . $uplatoon . "','" . $official . "','" . $dateString . "','" . $uuid . "')";

           $results1 = mysqli_query($con, $nsql1);

               if(!$results1 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results1."</p>";
                   echo $con->error;
               }
            echo "Offical OP: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          } elseif (checkStatus($type) == 2)
          {
            $training = 2;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $training . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Training: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 7)
          {
            $rasp = 7;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $rasp . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "RASP: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 8)
          {
            $ranger = 8;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $ranger . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Ranger: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 4)
          {
            $devday = 4;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $devday . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Dev Day: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 1)
          {
            $openplay = 1;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $openplay . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Open Play: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
        }
        else
        {
            echo "Can't attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
      }
    }
else
{
  if ( checkStatus($type) == 6 )
          {
            $official = 6;
           $nsql1 = "INSERT INTO attendances (platoons,type,created_on,user_id) 
           VALUES ('" . $uplatoon . "','" . $official . "','" . $dateString . "','" . $uuid . "')";
           $results1 = mysqli_query($con, $nsql1);
               if(!$results1 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results1."</p>";
                   echo $con->error;
               }
            echo "Offical OP: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          } elseif (checkStatus($type) == 2)
          {
            $training = 2;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $training . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Training: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 7)
          {
            $rasp = 7;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $rasp . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "RASP: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 8)
          {
            $ranger = 8;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $ranger . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Ranger: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 4)
          {
            $devday = 4;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $devday . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Dev Day: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
          elseif (checkStatus($type) == 1)
          {
            $openplay = 1;
            $nsql2 = "INSERT INTO attendances (platoons,type,created_on,user_id) VALUES ('" . $uplatoon . "','" . $openplay . "','" . $dateString . "','" . $uuid . "')";
            $results2 = mysqli_query($con, $nsql2);
               if(!$results2 and $mysqliDebug) {
                   echo "<p>There was an error in query:". $results2."</p>";
                   echo $con->error;
               }
            echo "Open Play: Can attend";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
          }
}

?>


