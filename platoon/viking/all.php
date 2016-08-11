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
$sql = "SELECT *,ranks.name from login_users,attendances,rosters,ranks 
inner join user_ranks on user_ranks.rank_id=ranks.id 
where login_users.id = user_ranks.user_id AND login_users.id = attendances.user_id AND login_users.id = rosters.ruser_id 
GROUP BY rosters.rname ORDER BY ranks.id ";

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
$rows = array();
while( $row = mysqli_fetch_array($results) )
    {
        $rows[] = $row;
    }
    	


    $mostRecent = 0;
    foreach( $rows as $row ) 
    {
        echo '<tr>';
        echo "<td><img height='25px' src='".$row['base64'] . "'/> " .$row['rname'] ."</td>";
        echo "<td>no</td>";
        $createdDateString = $row['created_on'];
        $row['created_on'] = new DateTime( $createdDateString );
        $pDate = $row['created_on']->format('d');
            foreach($daterange as $date1)
                // echo $date1->format('Y-m-d') . '<br>';
                // echo 'Pdate: ' . $pDate . '<br>';
            if ( $date1->format('d') == $pDate)
            {
                if ($row['is_present'] == true) 
                {
                    echo "<td style='text-align: center;'>P</td>";
                }
                else
                {
                    echo "<td style='text-align: center;'>A</td>";
                }
            } 
            else 
            {
                echo "<td style='text-align: center;'>A</td>";
            }

    }
?>
        </tr>
    </tbody>
</table>