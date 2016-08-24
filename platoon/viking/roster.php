<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
date_default_timezone_set("America/Los_Angeles");
$dateFormat = "Y-m-d H:i:s";
$date = new DateTime();
$dateString = $date->format($dateFormat);
$timestamp = strtotime($dateString);

$oneweek = new DateTime( '-1 week' );
$twoweeks = strtotime('-2 week');

$rsql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = user_ranks.user_id AND rosters.rplatoon='viking'
GROUP BY rosters.rname 
ORDER BY ranks.id,rosters.rname";
$results = mysqli_query($con, $rsql);

?>
<div id="wrapper">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Roster</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Viking
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped" id="dataTables-example">
                                    <thead>
                                        
<tr style="border-bottom: 2px solid rgba(221, 221, 221, 0.38);">                                     
  <th style="border-bottom:0px;" class="center">Rank/Name</th>
                                            <th style="border-bottom:0px;" class="center">Promotion Date</th>
                                            <th style="border-bottom:0px;" class="center">Awards</th>
           <th style="border-bottom:0px;" class="center">Last Active</th>
           <th style="border-bottom:0px;" class="center">RRD</th>
           <th style="border-bottom:0px;" class="center">LoA</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                      $counter = 0;
                                      while ( $row = mysqli_fetch_assoc($results) )
                                      {
                                        $promotionDateRow = $row['rpromoted_on'];
                                        $promotionDate = date('m/d/y',strtotime($promotionDateRow));

                                        $lastActiveRow = $row['last_active'];
                                        $lastActiveDate = date('m/d/y',strtotime($lastActiveRow));

                                        $inactive = new DateTime( $row['last_active'] );
    $inactiveDate = $inactive->format('Y-m-d');
    echo '<tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;">';
    if ( hasRank('SFC') || hasPermission('can_update') )
    {
    if ( $row['is_loa'] )
    {
      echo "<tr class='tr-loa' style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /><a style='color:inherit;text-decoration:none;' href='editroster.php?id=" . $row['ruser_id']."'> " .$row['rname'] . "</a> <span class='label label-default label-loa'>LOA</span></td>";
    }
    elseif ( $oneweek->format('Y-m-d') >= $inactiveDate )
    {
      echo "<tr class='tr-awol' style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> <a style='color:inherit;text-decoration:none;' href='editroster.php?id=" . $row['ruser_id']."'> " .$row['rname'] . "</a><span class='label label-danger label-awol'>AWOL</span></td>";
    }
    elseif ( $row['is_rrd'] )
    {
      echo "<tr class='tr-rrd' style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> <a style='color:inherit;text-decoration:none;' href='editroster.php?id=" . $row['ruser_id']."'> " .$row['rname'] . "</a><span class='label label-rrd'>RRD</span></td>";
    }
    else
    {
    echo "<tr style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /><a style='color:inherit;text-decoration:none;' href='editroster.php?id=" . $row['ruser_id']."'> " .$row['rname'] . "</a></td>";
  }
  }
  else
  {
    if ( $row['is_loa'] )
    {
      echo "<tr class='tr-loa' style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /><a style='color:inherit;text-decoration:none;' href='#'> " .$row['rname'] . "</a> <span class='label label-default label-loa'>LOA</span></td>";
    }
    elseif ( $oneweek->format('Y-m-d') >= $inactiveDate )
    {
      echo "<tr class='tr-awol' style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> <a style='color:inherit;text-decoration:none;' href='#'> " .$row['rname'] . "</a><span class='label label-danger label-awol'>AWOL</span></td>";
    }
    elseif ( $row['is_rrd'] )
    {
      echo "<tr class='tr-rrd' style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> <a style='color:inherit;text-decoration:none;' href='#'> " .$row['rname'] . "</a><span class='label label-rrd'>RRD</span></td>";
    }
    else
    {
    echo "<tr style='border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;'><td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /><a style='color:inherit;text-decoration:none;' href='#'> " .$row['rname'] . "</a></td>";
  }
  }
                                        ?>

<!-- <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);"> -->
<!-- <td style="border-top: 0px;"><?php //echo $row['name'] . ' ' . $row['rname']; ?></td> -->
<td style="border-top: 0px;" class="center"><?php echo $promotionDate; ?></td>
<!-- <td style="border-top: 0px;" class="center"><?php //echo $row['rawards']; ?></td> -->
<?php 
$userid12 = $row['ruser_id'];
$awardssql = "SELECT awards.award_name FROM awards inner join user_awards on user_awards.award_id=awards.id where user_awards.user_id=$userid12";
$awardResaults = mysqli_query($con, $awardssql);
if(!$awardResaults and $mysqliDebug) {
    echo "<p>There was an error in query:". $awardResaults."</p>";
    echo $con->error;
}
$num_rows = mysqli_num_rows($awardResaults);
?>
<td style="border-top: 0px;" class="center"><div class="tooltip4"><?php echo $num_rows; ?><span class="tooltiptext4"><?php while ( $row2 = mysqli_fetch_assoc($awardResaults))
{
  $counter++;

  echo $row2['award_name'] . '<br />';
}

?></span></div></td>
<td style="border-top: 0px;" class="center"><?php echo $lastActiveDate; ?></td>

<?php 
if ( hasRank('SFC') || hasPermission('can_update') )
{
if ( $row['is_rrd'] )
{
  echo '<td style="border-top: 0px;" class="roster-loa-true"><a href="updaterrd.php?id='.$userid12.'&type=0"><i class="fa fa-check fa-lg"></i></a></td>';
}
else
{
  echo '<td style="border-top: 0px;" class="roster-loa-false"><a href="updaterrd.php?id='.$userid12.'&type=1"><i class="fa fa-times fa-lg"></i></a></td>';
}


if ( $row['is_loa'] )
{
  echo '<td style="border-top: 0px;" class="roster-loa-true"><a href="updateloa.php?id='.$userid12.'&type=0"><i class="fa fa-check fa-lg"></i></a></td>';
}
else
{
  echo '<td style="border-top: 0px;" class="roster-loa-false"><a href="updateloa.php?id='.$userid12.'&type=1"><i class="fa fa-times fa-lg"></i></a></td>';
}
//end if hasRank
}
//end if hasRank
else
{
  if ( $row['is_rrd'] )
{
  echo '<td style="border-top: 0px;" class="roster-loa-true"><a href="#"><i class="fa fa-check fa-lg"></i></a></td>';
}
else
{
  echo '<td style="border-top: 0px;" class="roster-loa-false"><a href="#"><i class="fa fa-times fa-lg"></i></a></td>';
}


if ( $row['is_loa'] )
{
  echo '<td style="border-top: 0px;" class="roster-loa-true"><a href="#"><i class="fa fa-check fa-lg"></i></a></td>';
}
else
{
  echo '<td style="border-top: 0px;" class="roster-loa-false"><a href="#"><i class="fa fa-times fa-lg"></i></a></td>';
}
//end else hasRank
}
//end else hasRank
?>


                                      </tr>




                                        <?php
                                      }
                                      $rrdsql = "SELECT * FROM rrd_rotation
                                      inner join rosters on rosters.ruser_id = rrd_rotation.user_id";
                                      $rrdres = mysqli_query($con, $rrdsql);
                                      if(!$rrdres and $mysqliDebug) {
                                          echo "<p>There was an error in query:". $rrdres."</p>";
                                          echo $con->error;
                                      }

                                      $rrdNumRows = mysqli_num_rows($rrdres);

                                      $loasql = "SELECT * FROM rosters
                                      inner join user_loa on user_loa.user_id = rosters.ruser_id
                                      where is_loa=1";
                                      $loares = mysqli_query($con, $loasql);
                                      if(!$rrdres and $mysqliDebug) {
                                          echo "<p>There was an error in query:". $loares."</p>";
                                          echo $con->error;
                                      }
                                      $loaNumRows = mysqli_num_rows($loares);
                                      ?>
                                    	
</tbody>
                                </table>
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
              <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                            On Leave <span class="badge"><?php if ( $loaNumRows > 0 ) { echo $loaNumRows; } else { echo '0'; } ?></span>
                  </div>
                  <div class="panel-body">
                             <table width="100%">
                              <thead>
                                <tr style="border-bottom: 2px solid rgb(147, 147, 147);">
                                <th colspan="5">Name</th>
                                <th style="float:right;">End Date</th>
                                <th style="float:right;padding-right:50px;">Start Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php
                                while ( $loa = mysqli_fetch_assoc($loares) )
                                {
                                    $loaStartDate = $loa['start_date'];
                                    $loaUSStartDate = date('m/d/y',strtotime($loaStartDate));

                                    if ( empty($loa['end_date']) )
                                    { ?>
                                      <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5"><?php echo $loa['rname']; ?></td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;">N/A</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;padding-right: 90px;"><?php echo $loaUSStartDate; ?></td>
                              
                                   <?php }
                                   else
                                   {
                                    
                                    $loaEndDate = $loa['end_date'];
                                    $loaUSEndDate = date('m/d/y',strtotime($loaEndDate));
                                  

                                  ?>
                                
                                <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5"><?php echo $loa['rname']; ?></td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;"><?php if ( !$loaUSEndDate) { echo 'N/A'; } else { echo $loaUSEndDate; } ?></td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;padding-right: 66px;"><?php echo $loaUSStartDate; ?></td>
                              </tr>
                              <?php }
                              } ?>
                              </tbody>
                            </table>
                            </div>
                </div>
              </div>
               <!-- <div class="col-md-2"> -->
                <!-- <div class="panel panel-default">
                  <div class="panel-heading">
                            Viking
                  </div>
                </div> -->
              <!-- </div> -->
               <div class="col-md-3">
                <div class="panel panel-default">
                  <div class="panel-heading">
                            On RRD Rotation <span class="badge"><?php if ( $rrdNumRows > 0 ) { echo $rrdNumRows; } else { echo '0'; } ?></span>

                  </div>
                  <div class="panel-body">
                             <table width="100%">
                              <thead>
                                <tr style="border-bottom: 2px solid rgb(147, 147, 147);">
                                <th colspan="5">Name</th>
                                <th style="float:right;">End Date</th>
                                <th style="float:right;padding-right:50px;">Rotation</th>
                                
                              </tr>
                              </thead>
                              <tbody>
                                <?php
                                while ( $rrd = mysqli_fetch_assoc($rrdres) )
                                  { 
                                    $rrdDate = $rrd['start_date'];
                                    $rrdEndDate = date('m/d/y',strtotime($rrdDate. ' + '.$rrd['rotation']));

           ?>
                                <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5"><?php echo $rrd['rname']; ?></td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;"><?php echo $rrdEndDate; ?></td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;padding-right: 62px;">30 Days</td>
                              </tr>
                              <?php } ?>
                              
                              </tbody>
                            </table>
                            </div>
                </div>
              </div>
            </div>
            
            
        </div>
        <!-- /#page-wrapper -->
      </div>

    <?php
include('../../templates/footer.php');
?>