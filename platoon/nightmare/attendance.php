<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
date_default_timezone_set("America/Los_Angeles");
//Date formating
$dateFormat = "Y-m-d H:i:s";
$mysqliDebug =1;

$begin = new DateTime( 'first day of this month' );
$end = new DateTime( 'last day of this month' );
$end = $end->modify( '+1 day' );
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
$daterange2 = new DatePeriod($begin, $interval ,$end);


$date = new DateTime();
$date1 = new DateTime();
$dateString = $date1->format($dateFormat);
$dateDay = $date1->format('d');
$timestamp2 = strtotime($dateString);
$month2 = date('F', $timestamp2);
//generating days of the month
$month = date('m', $timestamp2);
$year = date('Y', $timestamp2);

//select username ane id
$sql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = user_ranks.user_id AND rosters.rplatoon='nightmare'
GROUP BY rosters.rname 
ORDER BY ranks.id,rosters.rname";

$results = mysqli_query($con, $sql);
if(!$results and $mysqliDebug) {
    echo "<p>There was an error in query: $results</p>";
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
<div class="navbar-default sidebar roster-legend-sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    
                        <div class="col-md-12 roster-legend">Legend for Date of Event</div> 
                                                  
                    
                        <div class="col-md-10 roster-legend-element roster-training">Training Day</div><div class="col-xs-1 roster-training">T</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-present">Offical Op</div><div class="col-xs-1 roster-present">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-openplay">Open Play</div><div class="col-xs-1 roster-openplay">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-rasp">RASP</div><div class="col-xs-1 roster-rasp">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-ranger">Ranger School</div><div class="col-xs-1 roster-ranger">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-devday">Dev Day/No Event/Holidy</div><div class="col-xs-1 roster-devday">/</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-loa">Leave of Absense</div><div class="col-xs-1 roster-loa">-</div>
                    
                    </ul>
                </div>
            </div>
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
                            Approved Attendance
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
		</tr>
	</thead>
<tbody>
                       
<?php
// $rows = array();
$pii = 0;
while( $row = mysqli_fetch_assoc($results) )
{
    echo "<tr>";
    echo "<td><img height='25px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . "</td>";
    echo "<td>N/A</td>";

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
            
            $pid2 = $arow['attendid'];
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
                    $pid = array();
                    $pid[] = $arow['attendid'];
                    
                }
                elseif ( $attendType == 2 )
                {
                    $attendance = "T";
                }
                elseif ( $attendType == 3 )
                {
                    $attendance = "-";
                }
                elseif ( $attendType == 4 )
                {
                    $attendance = "/";
                }
                elseif ( $attendType == 5 )
                {
                    $attendance = "A";
                }
                elseif ( $attendType == 6 )
                {
                    $attendance = "OO";
                }
                elseif ( $attendType == 7 )
                {
                    $attendance = "R";
                }
                elseif ( $attendType == 8 )
                {
                    $attendance = "RS";
                }
                else
                {
                    $attendance = "Y";
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
            echo '<td class="roster-openplay">P</td>';
        }
        else
        {
        echo '<td class="roster-openplay unapproved"><div class="tooltip2"><div id="editable" contenteditable>P</div>
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span></div>
<input type="hidden" name="pid'.$pii++ .'" value="'.$pid2 .'"/></td>';

}
       }
       //end
       //Checks if its Training
       elseif ( $attendance == "T" )
       {
        if ( $approved )
        {
            echo '<td class="roster-training">T</td>';
        }
        else
        {
        echo '<td class="roster-training unapproved"><div class="tooltip2">T
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span></div></td>';
}
       }
       //end
       //Checks for LoA
       elseif ( $attendance == "-" )
       {
        if ( $approved )
        {
            echo '<td class="roster-loa">-</td>';
        }
        else
        {
        echo '<td class="roster-loa unapproved"><div class="tooltip2">-
  <span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span>
</div></td>';
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "/" )
       {
        if ( $approved )
        {
            echo '<td class="roster-devday">/</td>';
        }
        else
        {
        echo '<td class="roster-devday unapproved"><div class="tooltip2">/
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span></div></td>';
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
            echo '<td class="roster-present">P</td>';
        }
        else
        {
        echo '<td class="roster-present unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span></div></td>';
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "R" )
       {
        if ( $approved )
        {
            echo '<td class="roster-rasp">P</td>';
        }
        else
        {
        echo '<td class="roster-rasp unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span></div></td>';
}
       }
       //end
       //Checks for Dev day
       elseif ( $attendance == "RS" )
       {
        if ( $approved )
        {
            echo '<td class="roster-ranger">P</td>';
        }
        else
        {
        echo '<td class="roster-ranger unapproved"><div class="tooltip2">P
<span class="tooltiptext2"><a type="button" class="btn btn-success" href="approve.php?id=' . $pid2 . '">Approved</a><a type="button" class="btn btn-danger" style="margin-left: 4px;" href="approve.php?id=' . $pid2 . '&deny=1">Deny</a></span></div></td>';
}
       }
       //end
       //If does not exist, will be Abesent
       else
       {
        echo '<td class="absent">A</td>';
       }
    
    }
    echo "<td>0</td>";
    echo "<td>0</td>";
    echo "<td>0</td>";
    echo "</tr>";

}




?>
    </tbody>
</table>
<?php
if ( hasPermission('can_update') )
{
    ?>
<div class="col-md-2 attendance-approve-spacer"></div><div class="col-md-1 attendance-approve-all<?php echo $dateDay; ?>"><button type='submit' name='submit' class='btn btn-success btn-circle btn-xs' form="approveall"/><i class="fa fa-check"></i></button></div>

<?php
}
?>
</form>
<button type="submit" class="btn btn-success" name="saveall" form="saveall" id="saveall">Save All</button>
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
            
            
            
        </div>
        <!-- /#page-wrapper -->

    <?php
include('../../templates/footer.php');
?>