<?php
$base = $_SERVER['DOCUMENT_ROOT'];
include($base .'/login/includes/api.php');

function hasPermission($perm1) {
    include('db.php');
    $puid = userValue(null, "id");
    $psql = "SELECT * FROM user_permissions where user_id=$puid";
    $results = mysqli_query($con, $psql);
    while($row1 = mysqli_fetch_assoc($results)) 
    {
       if ( $row1[$perm1] ) 
       {
           return true;
       } 
       elseif ( $row1['is_admin'])
       {
           return true;
       }
       else
       {
        return false;
       }

  }
}

function hasRank($rank1) {
    include('db.php');
    $rpuid = userValue(null, "id");
    $rsql = "SELECT * FROM user_ranks
    inner join ranks on ranks.id=user_ranks.rank_id
    where user_ranks.user_id=$rpuid";
    $results = mysqli_query($con, $rsql);
    while($row2 = mysqli_fetch_assoc($results)) 
    {
       if ( $row2['name'] == $rank1 ) 
       {
           return true;
       } 
       elseif ( $row2['rank_id'] <= 23 )
       {
           return true;
       }
       else
       {
        return false;
       }

  }
}