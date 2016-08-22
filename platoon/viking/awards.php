<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
$actual_link1 = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$links1 = explode('/', $actual_link1);
$link1 = $links1[5];
$page = "SELECT under_maintenance,down_time FROM pages WHERE page='$link1'";
$pageres = mysqli_query($con, $page);
$status = array();
while ( $row3 = mysqli_fetch_assoc($pageres) )
{
	$status[] = $row3;
}
foreach($status as $status ) 
      { 
      	$downDate = $status['down_time'];
        $downtime = date('m/d/y H:i:s',strtotime($downDate));
      	if ( $status['under_maintenance'] && !hasPermission('is_admin') ) 
      		{ 
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
							<?php echo $downtime; ?>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
      		} 
      		else 
      		{ 
      		

// $sql = "SELECT awards.award_name FROM awards inner join user_awards on user_awards.award_id=awards.id where user_awards.user_id=1";
$sql = "SELECT * FROM awards ORDER BY award_name ASC";
$results = mysqli_query($con, $sql);
$awards = array();
while ( $row = mysqli_fetch_assoc($results) )
{
	$awards[] = $row;
}
				

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
    		<div class="col-md-10">
			<?php 
			foreach ( $awards as $award )
			{
				if ( $award['category'] == 'medal' )
				{ ?>
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading" id="award-<?php echo $award['image_name']; ?>">
							<?php echo $award['award_name']; ?>
						</div>
						<div class="panel-body awards-panel">
							<?php echo $award['award_desc']; ?>
						</div>
						<div class="panel-footer" style="background-color: rgba(36, 100, 179, 0.55);color: #00a8d0;text-shadow: 2px 2px black;">
							<?php if ( !$award['count'] )
							{
								echo 'Not awarded yet';
							}
							else
							{
								echo 'Awarded: '. $award['count'];
							}?>
						</div>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
			<!-- /.col-md-10 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php
}
}
?>