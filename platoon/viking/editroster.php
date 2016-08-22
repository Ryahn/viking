<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');


if( isset($_POST['submit']) )
{
	$userid3 = $_POST['userid'];
	$username = $_POST['username'];
	$rank = $_POST['rank'];
	$dateform = $_POST['date'];
	$platoon = $_POST['platoon'];

		if ( !$dateform )
		{
			$updateRosterSql = "UPDATE rosters SET rname='$username', rankid=$rank where ruser_id=$userid3";
			$updateRankSql = "UPDATE user_ranks SET rank_id=$rank where user_id=$userid3";
			$updateRank = mysqli_query($con, $updateRankSql);
			$updateRoster = mysqli_query($con, $updateRosterSql);
				if(!$updateRoster and $mysqliDebug) 
				{
   					echo "<p>There was an error in query:". $updateRoster."</p>";
   					echo $con->error;
				}
				if(!$updateRank and $mysqliDebug) 
				{
   					echo "<p>There was an error in query:". $updateRank."</p>";
   					echo $con->error;
				}
				echo '<a type="button" style="margin-left: 847px;padding: 25px 95px 25px 95px;margin-top: 25px;font-size: 24px;" class="btn btn-info" href="/platoon/'.$platoon.'/roster.php">Back</a>';
				// $platoonURL = 'http://viking.dev/platoon/' .$platoon.'/roster.php';
				// exit(header('Location: ' . $platoonURL));
		}
		else
		{
			$updateRosterSql = "UPDATE rosters SET rname='$username', rankid=$rank, rpromoted_on='$dateform' where ruser_id=$userid3";
			$updateRankSql = "UPDATE user_ranks SET rank_id=$rank where user_id=$userid3";
			$updateRank = mysqli_query($con, $updateRankSql);
			$updateRoster = mysqli_query($con, $updateRosterSql);
				if(!$updateRoster and $mysqliDebug) 
				{
   					echo "<p>There was an error in query:". $updateRoster."</p>";
   					echo $con->error;
				}
				if(!$updateRank and $mysqliDebug) 
				{
   					echo "<p>There was an error in query:". $updateRank."</p>";
   					echo $con->error;
				}
				echo '<a type="button" style="margin-left: 847px;padding: 25px 95px 25px 95px;margin-top: 25px;font-size: 24px;" class="btn btn-info" href="/platoon/'.$platoon.'/roster.php">Back</a>';
				// $platoonURL = 'http://viking.dev/platoon/' .$platoon.'/roster.php';
				// exit(header('Location: ' . $platoonURL));
		}
		
}
else
{

$rosterID = $_GET['id'];

$rankSql = "SELECT * FROM ranks";
$results2 = mysqli_query($con, $rankSql);
if(!$results2 and $mysqliDebug) {
   echo "<p>There was an error in query:". $results2."</p>";
   echo $con->error;
}
$sql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = $rosterID AND user_ranks.user_id = $rosterID";
$results = mysqli_query($con, $sql);
if(!$results and $mysqliDebug) {
   echo "<p>There was an error in query:". $results."</p>";
   echo $con->error;
}?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modifying Roster</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="col-md-2"></div>
  			<div class="col-md-8">
            	<div class="panel panel-default">
                	<div class="panel-heading">
                            Only change what is needed!!!!
                    </div>
                    <div class="panel-body">
                    	<div class="row">

                        	<div class="col-lg-12">
                            	<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                	<div class="row" style="border-bottom:1px rgba(144, 144, 144, 0.68) solid">
                                		<div class="col-md-2">Name</div>                          
                                		<div class="col-md-2">Rank</div>                          
                                		<div class="col-md-3">Promotion Date</div>                          
                                		<div class="col-md-1">Awards</div>                          
                                		<div class="col-md-3">Last Active</div>                          
                                		<div class="col-md-1">On LoA</div>                          
  									</div>
  									<div class="row" style="padding-top:10px">

                                    		
                                    		<?php
											while ( $row = mysqli_fetch_assoc($results) )
											{
											?>
												<div class="col-md-2"><input type="hidden" name="platoon" value="<?php echo $row['rplatoon']; ?>" />
													<input type="hidden" name="userid" value="<?php echo $rosterID; ?>" />
                                            			<input class="form-control" type="text" size="10" name="username" value="<?php echo $row['rname']; ?>" />
                                            		</div>
                                            		<div class="col-md-2">
                                            			<select name="rank" class="form-control">
									 <?php 
												while ( $ranks = mysqli_fetch_assoc($results2) )
												{
													if ($ranks['id'] == $row['rankid'] )
													{
													echo '<option selected="selected" value="'.$ranks['id'].'">'.$ranks['name'].'</option>';
													}
													else
													{
													echo '<option value="'.$ranks['id'].'">'.$ranks['name'].'</option>';
													}
												}?>
														</select>
													</div>
												<div class="col-md-3"><input type="date" class="form-control" placeholder="mm/dd/yyyy" name="date"></div>
												<div class="col-md-1">
													8
												</div>
												<div class="col-md-3"><p class="form-control-static"><?php echo $row['last_active']; ?></p></div>
												<div class="col-md-1"><p class="form-control-static"><?php if ( $row['is_loa'] ) { echo "True"; } else { echo "False"; } ?></p></div>

											<?php } ?>
									</div>
											<div class="row" style="padding-top:10px;">
												<div class="col-md-4" style="padding-top:5px;">
													<input type="submit" value="Submit" name="submit" class="btn btn-success" />
													<a type="button" class="btn btn-info" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>
												</div>
											</div>
									
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('../../templates/footer.php');

}
		?>

												
