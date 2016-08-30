<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
date_default_timezone_set("America/Los_Angeles");
//Date formating
$dateFormat = "Y-m-d H:i:s";
$mysqliDebug =1;

$date = new DateTime();
$begin = new DateTime( 'first day of this month' );
$end = new DateTime( 'last day of this month' );
$end1 = new DateTime( 'last day of this month' );
$lastDay = $end1->format('d');
$end = $end->modify( '+1 day' );
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
$daterange2 = new DatePeriod($begin, $interval ,$end);

$oneweek = new DateTime( '-1 week' );
$twoweeks = strtotime('-2 week');


$date1 = new DateTime();
$dateString = $date1->format($dateFormat);
$dateDay = $date1->format('d');
$timestamp2 = strtotime($dateString);
$month2 = date('F', $timestamp2);
//generating days of the month
$month = date('m', $timestamp2);
$year = date('Y', $timestamp2);
$dayToday = new DateTime('now');
$dayToday->format('d');
$daysRemaining = $dayToday->diff($lastDay);
$daysRemaining->format('d');




//select username ane id
$sql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = user_ranks.user_id AND rosters.rplatoon='viking'
GROUP BY rosters.rname 
ORDER BY ranks.id,rosters.rname";


$results = mysqli_query($con, $sql);
if(!$results and $mysqliDebug) {
    echo "<p>There was an error in query:". $results."</p>";
    echo $con->error;
}
?>
<script>
$('#saveall').click(function(){
    var myTxt = $('#editable').html();
    $.ajax({
        type: 'post',
        url:  'save.php',
        data: 'varname=' +myTxt
    });

});
</script>

                        <div id="wrapper">
            <div id="page-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Viking Attendance</h1>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Approved Attendance <span class="alert alert-info attend-alert">Approve only when the OP is complete or at AAR.</span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              
                              <div class="col-md-5 roster-spacer"></div><div class="col-md-5 roster-spacer-month"><?php echo $month2; ?></div><div class="col-md-2 table-total">Totals</div>
                              <form action='approve.php' method='post' role='form' id="approveall">
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
            <th class="center">Rank/Name</th>
            <th class="center">Promotion Date</th>
            <?php
            foreach($daterange as $date)
            {
            echo '<th class="center">'.$date->format("d") . "</th>";
            }
            ?>
            <th class="center">P</th>
           <th class="center">A</th>
           <th class="center">T</th>
           <th class="center">Active</th>
		</tr>
	</thead>
<tbody>
                       
<?php
// $rows = array();
$pii = 0;

//(P + T) / ($lastDay - D)
while( $row = mysqli_fetch_assoc($results) )
{
$attenduserid = $row['user_id'];
$attendCountSql = "SELECT type,
sum(case when type=1 or type=6 or type=7 or type=8 then 1 else 0 end) as P,
sum(case when type=2 then 1 else 0 end) as T,
(sum(case when type=5 then 1 else 0 end) as A,
$lastDay - (sum(case when type=1 or type=6 or type=7 or type=8 then 1 else 0 end) + sum(case when type=2 then 1 else 0 end))  - sum(case when type=4 then 1 else 0 end) - sum(case when type=3 then 1 else 0 end) as total,
(sum(case when type=1 or type=6 or type=7 or type=8 then 1 else 0 end) + sum(case when type=2 then 1 else 0 end)) / ($lastDay - sum(case when type=4 then 1 else 0 end)) as active
FROM attendances WHERE user_id = $attenduserid";
$attendRes = mysqli_query($con, $attendCountSql);
if(!$attendRes and $mysqliDebug) {
    echo "<p>There was an error in query:". $attendRes ."</p>";
    echo $con->error;
}
$attendcount = array();
while ($row4 = mysqli_fetch_assoc($attendRes))
{
  $attendcount[] = $row4;
}








  $inactive = new DateTime( $row['last_active'] );
    $inactiveDate = $inactive->format('Y-m-d');
    if ( $row['is_loa'] )
    {
      echo "<tr class='tr-loa'><td><img height='25px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . " <span class='label label-default label-loa'>LOA</span></td>";
    }
    elseif ( $oneweek->format('Y-m-d') >= $inactiveDate )
    {
      echo "<tr class='tr-awol'><td><img height='25px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . " <span class='label label-danger'>AWOL</span></td>";
    }
    elseif ( $row['is_rrd'] )
    {
      echo "<tr class='tr-rrd'><td><img height='25px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . " <span class='label label-rrd'>RRD</span></td>";
    }
    else
    {
    echo "<tr><td><img height='25px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . "</td>";
  }
    echo "<td>" . date('m/d/y',strtotime($row['rpromoted_on'])) ."</td>";
    

    $userid1 = $row['ruser_id'];
    // $rows[] = $row;
    $attendsql = "SELECT attendances.id as attendid, created_on, is_approved, type from attendances
    inner join attendance_type on attendance_type.id = attendances.type 
    where user_id=$userid1";
    $attendresults = mysqli_query($con, $attendsql);
    if(!$attendresults and $mysqliDebug) 
    {
       echo "<p>There was an error in query: $attendresults</p>";
       echo $con->error;
    }
    $arows = array();

    while( $arow = mysqli_fetch_array($attendresults) )
    {
        $arows[] = $arow;
    }
    
   

    foreach($daterange as $date1)
    {
        $attendance = "A";


        foreach ( $arows as $arow ) 
        {

                   
            $date1String = $date1->format('Y-m-d');
            $createdOnDate = $arow['created_on'];
            $createdDate = new DateTime( $createdOnDate );
            $attendanceDateString = $createdDate->format('Y-m-d');

            $attendType = $arow['type'];
            
            // $pid2 = $arow['attendid'];
            if ( $attendanceDateString == $date1String )
            {
                if ( !$attendType )
                {
                    $attendance = "X";

                }
                elseif ( $attendType == 1 )
                {
                    $attendance = "OP";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];

                                        
                }
                elseif ( $attendType == 2 )
                {
                    $attendance = "T";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                elseif ( $attendType == 3 )
                {
                    $attendance = "-";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                elseif ( $attendType == 4 )
                {
                    $attendance = "/";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                elseif ( $attendType == 5 )
                {
                    $attendance = "A";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                elseif ( $attendType == 6 )
                {
                    $attendance = "OO";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                elseif ( $attendType == 7 )
                {
                    $attendance = "R";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                elseif ( $attendType == 8 )
                {
                    $attendance = "RS";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }
                else
                {
                    $attendance = "Y";
                    $approved = $arow['is_approved'];
                    
                    $pid = $arow['attendid'];
                }

                $attended = TRUE;
            }
        }
        
        // Checks to make sure values are supported
       if ( $attendance == "X" ) 
       {
        echo '<td class="absent"><div class="tooltip1"><p class="fa fa-times-circle fa-lg"></p>
  <span class="tooltiptext1">Invalid values are present.<br /> Must be only supported ones.</span>
</div></td>';
       }
       //end
       //Checks to make sure its not 0 or above 8
       elseif ( $attendance == "Y" ) 
       {
        echo '<td class="absent"><div class="tooltip1"><p class="fa fa-times-circle fa-lg"></p>
  <span class="tooltiptext1">Zero value given.<br />Must have value 1-8</span>
</div></td>';
       }
       //end
       //Checks if its an Open Play
       elseif ( $attendance == "OP" )
       {
        if ( $approved )
        {
            if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-openplay"><div class="tooltip3">P
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-openplay">P</td>'; }
        }
        else
        {
        if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-openplay unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-openplay unapproved">P</td>';}

}
       }
       //end
       //Checks if its Training
       elseif ( $attendance == "T" )
       {
        if ( $approved )
        {
            if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-training"><div class="tooltip3">T
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-training">T</td>'; }
        }
        else
        {
        if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-training unapproved"><div class="tooltip2">T
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-training unapproved">T</td>'; }
}
       }
       //end
       //Checks for LoA
       elseif ( $attendance == "-" )
       {
        if ( $approved )
        {
           if ( hasRank('SFC') || hasPermission('can_update') ) {  echo '<td class="roster-loa"><div class="tooltip3">-
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-loa">-</td>'; }

        }
        else
        {
       if ( hasRank('SFC') || hasPermission('can_update') ) {  echo '<td class="roster-loa unapproved"><div class="tooltip2">-
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-loa unapproved">-</td>'; }
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "/" )
       {
        if ( $approved )
        {
           if ( hasRank('SFC') || hasPermission('can_update') ) {  echo '<td class="roster-devday"><div class="tooltip3">/
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-devday">/</td>'; }
        }
        else
        {
        if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-devday unapproved"><div class="tooltip2">/
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-devday unapproved">/</td>'; }
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "A" )
       {
            echo '<td class="absent">A</td>';
        }
       //end
       //Checks for Dev day
       elseif ( $attendance == "OO" )
       {
        if ( $approved )
        {
           if ( hasRank('SFC') || hasPermission('can_update') ) {  echo '<td class="roster-present"><div class="tooltip3">P
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-present">P</td>'; }
        }
        else
        {
        if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-present unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-present unapproved">P</td>'; }
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "R" )
       {
        if ( $approved )
        {
          if ( hasRank('SFC') || hasPermission('can_update') ) {   echo '<td class="roster-rasp"><div class="tooltip3">P
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-rasp">P</td>'; }
        }
        else
        {
        if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-rasp unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-rasp unapproved">P</td>'; }
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "RS" )
       {
        if ( $approved )
        {
           if ( hasRank('SFC') || hasPermission('can_update') ) {  echo '<td class="roster-ranger"><div class="tooltip3">P
<span class="tooltiptext3"><a type="button" class="btn btn-info" href="edit.php?id=' . $pid . '">Edit</a></td>'; } else { echo '<td class="roster-ranger">P</td>'; }
        }
        else
        {
        if ( hasRank('SFC') || hasPermission('can_update') ) { echo '<td class="roster-ranger unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid . '&deny=0">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid .'"/></td>'; } else { echo '<td class="roster-ranger unapproved">P</td>'; }
}
       }
       //end
       //If does not exist, will be Absent
       else
       {
        echo '<td class="absent">A</td>';
       }
    
       //Calculates the attend percentage
    }
    foreach ( $attendcount as $count )
    {
    echo "<td>". isItEmpty($count['P']) . "</td>";
   
    echo "<td>". isItEmpty($count['total']) . "</td>";
    echo "<td>". isItEmpty($count['T']) . "</td>";
    echo "<td>". percentage($count['active']) . "</td>";
    
  }
    echo "</tr>";

}




?>
    </tbody>
</table>
<?php
if ( hasPermission('can_update') || hasRank('SFC') )
{
    ?>
<div class="col-md-2 attendance-approve-spacer"></div><div class="col-md-1 attendance-approve-all<?php echo $dateDay; ?>"><button type='submit' name='submit' class='btn btn-success btn-circle btn-xs' form="approveall"/><i class="fa fa-check"></i></button></div>

<?php
}
?>
</form>

</div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-2">
                <div class="panel panel-default">
                  <div class="panel-heading">
                            <u>Legend for Date of Events</u>
                  </div>
                  <div class="panel-body">
                    
                    <div class="col-xs-10" style="width:88%;background-color:rgb(136, 93, 12);border-right:1px black solid;color:white;">Training Day</div>
                    <span style="background-color:rgb(136, 93, 12);padding:2px 4px 2px 10px;color:white;">T</span>
                    <div class="col-xs-10" style="width:88%;background-color:rgb(18, 112, 12);border-right:1px black solid;color:white;">Official OP</div>
                    <span style="background-color:rgb(18, 112, 12);padding:2px 4px 2px 10px;color:white;">P</span>
                    <div class="col-xs-10" style="width:88%;background-color:rgb(38, 105, 174);border-right:1px black solid;color:white;">Open Play</div>
                    <span style="background-color:rgb(38, 105, 174);padding:2px 4px 2px 10px;color:white;">P</span>
                    <div class="col-xs-10" style="width:88%;background-color:rgb(121, 37, 198);border-right:1px black solid;color:white;">RASP</div>
                    <span style="background-color:rgb(121, 37, 198);padding:2px 4px 2px 10px;color:white;">P</span>
                    <div class="col-xs-10" style="width:88%;background-color:rgb(166, 141, 3);border-right:1px black solid;color:white;">Ranger School</div>
                    <span style="background-color:rgb(166, 141, 3);padding:2px 4px 2px 10px;color:white;">P</span>
                    <div class="col-xs-10" style="width:88%;background-color:rgb(137, 17, 12);border-right:1px black solid;color:white;">Dev Day/No Event</div>
                    <span style="background-color:rgb(137, 17, 12);padding:2px 5px 2px 14px;color:white;">/</span>
                    <div class="col-xs-10" style="width:88%;background-color:rgb(171, 38, 150);border-right:1px black solid;color:white;">Leave of Absence</div>
                    <span style="background-color:rgb(171, 38, 150);padding:2px 6px 2px 12px;color:white;">-</span>
                 
                  </div>
                </div>
              </div>
            </div>
            
            
            
        </div>
        <!-- /#page-wrapper -->
      </div>

    </div>
    <!-- /#wrapper -->

    <?php
include('../../templates/footer.php');
?>