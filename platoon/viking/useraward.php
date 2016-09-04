<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');

$userid13 = $_GET['id'];
$date = new DateTime();
$dateFormat = "Y-m-d H:i:s";
$dateString = $date->format($dateFormat);

// $actual_link1 = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $links1 = explode('/', $actual_link1);
// $link1 = $links1[5];
// $page = "SELECT under_maintenance,down_time FROM pages WHERE page='$link1'";
// $pageres = mysqli_query($con, $page);
// $status = array();
// while ( $row3 = mysqli_fetch_assoc($pageres) )
// {
// 	$status[] = $row3;
// }
// foreach($status as $status ) 
//       { 
//       	$downDate = $status['down_time'];
//         $downtime = date('m/d/y H:i:s',strtotime($downDate));
//       	if ( $status['under_maintenance'] && !hasPermission('is_admin') ) 
//       		{ 
      			?>
<!-- <div id="wrapper">
	<div id="page-wrapper">
    	<div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Awards</h1>
	        </div> -->
            <!-- /.col-lg-12 -->
        <!-- </div> -->
        <!-- /.row -->
       <!--  <div class="row">
    		<div class="col-md-10">
    			<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							Under Maintenance						
						</div>
						<div class="panel-body awards-panel">
							Sorry, this page is under maintenance.	
							<p>Please contact a Dev or SFC</p>			
						</div>
						<div class="panel-footer" style="background-color: rgba(36, 100, 179, 0.55);color: #00a8d0;text-shadow: 2px 2px black;">
							<?php //echo $downtime; ?>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<?php
// $sql = "SELECT awards.award_name FROM awards inner join user_awards on user_awards.award_id=awards.id where user_awards.user_id=1";
$sql = "SELECT * FROM awards ORDER BY id ASC";
$results = mysqli_query($con, $sql);
$awards = array();
while ( $row = mysqli_fetch_assoc($results) )
{
	$awards[] = $row;
}
				
// var_dump($awards);

$asql = "SELECT *, GROUP_CONCAT(award_id SEPARATOR ',') as awards
FROM (user_awards, ranks)
inner join rosters on rosters.ruser_id=user_awards.user_id AND rosters.rankid=ranks.id
inner join awards on awards.id=user_awards.award_id
WHERE user_awards.user_id = $userid13
GROUP BY rosters.rname, user_id
ORDER BY ranks.id,rosters.rname
";
$aresults = mysqli_query($con, $asql);
if(!$aresults and $mysqliDebug) {
    echo "<p>There was an error in query:". $aresults."</p>";
    echo $con->error;
}

$uawards = array();
while ( $arow = mysqli_fetch_assoc($aresults) )
{
	$uawards[] = $arow;
}
// var_dump($uawards);
?>

<div id="wrapper">
	<div id="page-wrapper">
    	<div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Awards</h1>
	        </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Select an award <a href="#" class="btn btn-default openall">open all</a> <a href="#" class="btn btn-default closeall">close all</a> <span class="alert alert-info attend-alert">Only click the X or &#10004; once</span>
                        </div>
                        <!-- /.panel-heading -->
                        
					
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	<div class="panel-group" id="accordion">
                            		<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Medals</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseOne" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'medal')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->

								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Ribbons</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseTwo" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'ribbon')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->
								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Badges</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseThree" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'badge')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->
								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Airteam Qualifications</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseFour" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'quals')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->
								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Airteam Medals</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseFive" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'air')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->
								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">Patches &amp; Tabs</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseSix" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'tab')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->
								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">Weapon Qualifications</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseSeven" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'weapon')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->
								<div class="panel panel-default">
                            			<div class="panel-heading panel-award-heading">
                                        	<h4 class="panel-title">
                                            	<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">Training Classes &amp; Qualifications</a>
                                        	</h4>
                                    	</div>
                            		<div id="collapseEight" class="panel-collapse collapse">
                              			<form action='awarded.php' method='post' role='form' id="awards">
    										<table width="100%" class="table" id="dataTables-example">
												<thead>
													<tr>
            											<th class="award-th-center">Rank/Name</th>
            											<?php foreach ($awards as $award)
            													{
            														if ($award['category'] == 'training')
													            	{
													            		echo '<th style="text-align:center;"><div class="tooltip4"><div id="award-'. $award['image_name'] . '3">&nbsp;</div><span class="tooltiptext4">'. $award['award_name'] .'</span></div></th>';
													            	}
													        	}
													        	?>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($uawards as $users )
													{
														echo '<tr><td><img height="20px" src="' . $users['base64'] . '"/> '. $users['rname'] . '</td>';

														
            											
														   $award1=explode(',',$users['awards']);
														   $a1=26;
														   $b1=40;
														   for($i=$a1; $i<=$b1; $i++) {
														   echo awardCheck($i,$award1);
														}

														   
												echo '</tr>';
												} 
												?>
												</tbody>
											</table>
											<!-- Medals Table -->
										</form>
										<!-- /.form Awards -->
									</div>
									<!-- /#collapseOne -->
								</div>
								<!-- /.panel -->


								


							</div>
							<!-- /.panel-group | #accordion -->
						</div>
						<!-- /.dataTable -->
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
</div>
<!-- /#wrapper -->

<?php

include('../../templates/footer.php');
?>