<?php
include('../../config/protection.php');
include('../../config/db.php');
date_default_timezone_set("America/Los_Angeles");
//Date formating
$dateFormat = "Y-m-d H:i:s";
$date = new DateTime();
$dateString = $date->format($dateFormat);
$timestamp2 = strtotime($dateString);
$month2 = date('F', $timestamp2) . ' ';
//generating days of the month
$month = date('m', $timestamp2);
$year = date('Y', $timestamp2);
$list=array();
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
        $list[]=date('d', $time);
}
$numdays = count($list);
//select username ane id
$sql = "SELECT id,username from login_users where platoon='viking'";
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
                <th class="center"><?php echo $list[0]; ?></th>
                <th class="center"><?php echo $list[1]; ?></th>
                <th class="center"><?php echo $list[2]; ?></th>
                <th class="center"><?php echo $list[3]; ?></th>
                <th class="center"><?php echo $list[4]; ?></th>
                <th class="center"><?php echo $list[5]; ?></th>
                <th class="center"><?php echo $list[6]; ?></th>
                <th class="center"><?php echo $list[7]; ?></th>
                <th class="center"><?php echo $list[8]; ?></th>
                <th class="center"><?php echo $list[9]; ?></th>
                <th class="center"><?php echo $list[10]; ?></th>
                <th class="center"><?php echo $list[11]; ?></th>
                <th class="center"><?php echo $list[12]; ?></th>
                <th class="center"><?php echo $list[13]; ?></th>
                <th class="center"><?php echo $list[14]; ?></th>
                <th class="center"><?php echo $list[15]; ?></th>
                <th class="center"><?php echo $list[16]; ?></th>
                <th class="center"><?php echo $list[17]; ?></th>
                <th class="center"><?php echo $list[18]; ?></th>
                <th class="center"><?php echo $list[19]; ?></th>
                <th class="center"><?php echo $list[20]; ?></th>
                <th class="center"><?php echo $list[21]; ?></th>
                <th class="center"><?php echo $list[22]; ?></th>
                <th class="center"><?php echo $list[23]; ?></th>
                <th class="center"><?php echo $list[24]; ?></th>
                <th class="center"><?php echo $list[25]; ?></th>
                <th class="center"><?php echo $list[26]; ?></th>
                                      
<?php
//checks if its leap year and months with 30 days
if ( $month == 2) 
{
	if ( $numdays >= 29 ) 
	{
		echo '<th class="center">' . $list[27] . '</th>';
		echo '<th class="center">' . $list[28] . '</th>';
	} else 
	{
		echo '<th class="center">' . $list[27] . '</th>';
	}
} else 
{
	if ( $numdays == 30 ) 
	{
		echo '<th class="center">' . $list[27] . '</th>';
		echo '<th class="center">' . $list[28] . '</th>';
		echo '<th class="center">' . $list[29] . '</th>';
	} elseif ( $numdays > 30 ) 
	{
		echo '<th class="center">' . $list[27] . '</th>';
		echo '<th class="center">' . $list[28] . '</th>';
		echo '<th class="center">' . $list[29] . '</th>';
		echo '<th class="center">' . $list[30] . '</th>';
	}
}
?>
		</tr>
	</thead>
<tbody>
                               
<?php
while( $row = mysqli_fetch_assoc($results) )
    {
    	echo '<tr>';
    	echo "<td>".$row['username'] ."</td>";
    	echo "<td>no</td>";

    	$userid = $row['id'];
    	$usersql = "SELECT is_training as training,
    				is_present as present
    				FROM attendances 
    				WHERE user_id=$userid 
    				GROUP BY month_day";

    	$userresults = mysqli_query($con, $usersql);

    	if(!$userresults and $mysqliDebug) 
    	{
            echo "<p>There was an error in query: $userresults</p>";
            echo $con->error;
        }
        while($prow = mysqli_fetch_assoc($userresults)) 
        {
    	 if ( mysqli_num_rows($userresults) == 0 )
    		{
    			echo '<td>A</td>';
    		} elseif ( $prow['present'] == true AND $prow['training'] == false )
    		{
    			echo '<td>P</td>';
    		} elseif ( $prow['present'] == false AND $prow['training'] == true )
    		{
    			echo '<td>T</td>';
    		} elseif ( $prow['present'] == false AND $prow['training'] == false )
    		{
    			echo '<td>A</td>';
    		}
    	
    	
    	}
    	echo '</tr>';
    }
?>
    </tbody>
</table>