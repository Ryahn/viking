<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
$uid1 = userValue(null, "id");
$loasql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = $uid1
GROUP BY rosters.ruser_id";

$results = mysqli_query($con, $loasql);
if(!$results and $mysqliDebug) {
    echo "<p>There was an error in query: $results</p>";
    echo $con->error;
}


?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Leave of Absence</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="col-md-4"></div>
  <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Please fill out completely!
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label>Name &amp; Platoon</label>
                                            <p class="form-control-static">
                                            <?php 

                                            while( $row = mysqli_fetch_assoc($results) )
											{

												echo $row['rname'] . ', '. $row['rplatoon'];
											}




	?></p>
                                            <input type="hidden" name="userid" value="<?php echo $uid1; ?>" />
                                        </div>
                                      <div class="form-group">
                                      	<label>Start Date</label>
                                      	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" class="form-control" placeholder="mm/dd/yyyy" name="startdate">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                      	<label>End Date</label>
                                      	<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" class="form-control" placeholder="mm/dd/yyyy" name="enddate">
                                        </div>
                                    </div>

                                        
                                        <div class="form-group">
                                            <label>Reason</label>
                                            <textarea class="form-control" rows="3" name="reason"></textarea>
                                        </div>
                                        
                                        <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                    


<?php
if( isset($_POST['submit']) )
{
	$userid1 = $_POST['userid'];

	$startDatePost = $_POST['startdate'];
    $startDateTime = new DateTime( $startDatePost );
    $startdate = $startDateTime->format('Y-m-d');
    // echo $startdate;
	$endDatePost = $_POST['enddate'];
    $endDateTime = new DateTime( $endDatePost );
    $enddate = $endDateTime->format('Y-m-d');
    // echo $enddate;

	$updatesql = "INSERT INTO user_loa SET user_id=$userid1, start_date='$startdate', end_date='$enddate'";
	$results2 = mysqli_query($con, $updatesql);
	if(!$results2 and $mysqliDebug) {
	    echo "<p>There was an error in query: $results2</p>";
	    echo $con->error;
	}
	if ( $results2 )
	{
		echo 'Success!';
		$updateRoster = "UPDATE rosters SET is_loa=1 where ruser_id=$userid1";
		$results3 = mysqli_query($con, $updateRoster);
		if(!$results3 and $mysqliDebug) {
		    echo "<p>There was an error in query: $results2</p>";
		    echo $con->error;
		}
	}
}
?>


                                </div>

                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-md-4"></div>
            
            
            
        </div>
        <!-- /#page-wrapper -->






<?php
include('../../templates/footer.php');
?>

