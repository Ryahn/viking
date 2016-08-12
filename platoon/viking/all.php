<?php
include('../../config/protection.php');
include('../../config/db.php');
date_default_timezone_set("America/Los_Angeles");
//Date formating
$dateFormat = "Y-m-d H:i:s";

$begin = new DateTime( 'first day of this month' );
$end = new DateTime( 'last day of this month' );
$end = $end->modify( '+1 day' );
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
$daterange2 = new DatePeriod($begin, $interval ,$end);


$date = new DateTime();
$date1 = new DateTime();
$dateString = $date1->format($dateFormat);
$timestamp2 = strtotime($dateString);
$month2 = date('j', $timestamp2);
//generating days of the month
$month = date('m', $timestamp2);
$year = date('Y', $timestamp2);

//select username ane id
$sql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = user_ranks.user_id
GROUP BY rosters.rname 
ORDER BY ranks.id";

$results = mysqli_query($con, $sql);
if(!$results and $mysqliDebug) {
    echo "<p>There was an error in query: $results</p>";
    echo $con->error;
}
?>
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
		</tr>
	</thead>
<tbody>
                       
<?php
// $rows = array();
while( $row = mysqli_fetch_assoc($results) )
{
    echo "<tr>";
    echo "<td>" . $row['rname'] . "</td>";
    echo "<td>N/A</td>";

    $userid1 = $row['ruser_id'];
    // $rows[] = $row;
    $attendsql = "SELECT * from attendances where user_id=$userid1";
    $attendresults = mysqli_query($con, $attendsql);
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

            $isPresent = $arow['is_present'];
            $isTraining = $arow['is_training'];

            if ( $attendanceDateString == $date1String )
            {
                if ( $isPresent && $isTraining )
                {
                    $attendance = "⚠︎";
                }
                elseif ( $isPresent )
                {
                    $attendance = "P";
                }
                elseif ( $isTraining )
                {
                    $attendance = "T";
                }
                else
                {
                    $attendance = "⚠︎";
                }

                $attended = TRUE;
            }
        }
    
       echo '<td style="text-align:center;">' . $attendance . '</td>';
    }

    echo "</tr>";
}
    	 




?>
    </tbody>
</table>