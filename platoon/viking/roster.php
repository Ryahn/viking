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
           <th style="border-bottom:0px;" class="center">LoA</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                      $counter = 0;
                                      while ( $row = mysqli_fetch_assoc($results) )
                                      {
                                        $inactive = new DateTime( $row['last_active'] );
    $inactiveDate = $inactive->format('Y-m-d');
    echo '<tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);font-size:16px;">';
    if ( $row['is_loa'] )
    {
      echo "<td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . " <span class='label label-default label-loa'>LOA</span></td>";
    }
    elseif ( $oneweek->format('Y-m-d') >= $inactiveDate )
    {
      echo "<td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . " <span class='label label-danger'>AWOL</span></td>";
    }
    else
    {
    echo "<td style='border-top: 0px;'><img height='34px' src='" . $row['base64'] ."' alt='" . $row['name'] . "' /> " .$row['rname'] . "</td>";
  }
                                        ?>

<!-- <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);"> -->
<!-- <td style="border-top: 0px;"><?php //echo $row['name'] . ' ' . $row['rname']; ?></td> -->
<td style="border-top: 0px;" class="center"><?php echo $row['rpromoted_on']; ?></td>
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
<td style="border-top: 0px;" class="center"><?php echo $row['last_active']; ?></td>
<?php if ( $row['is_loa'] )
{
  echo '<td style="border-top: 0px;" class="roster-loa-true"><a href="updateloa.php?id='.$userid12.'&type=0"><i class="fa fa-check fa-lg"></i></a></td>';
}
else
{
  echo '<td style="border-top: 0px;" class="roster-loa-false"><a href="updateloa.php?id='.$userid12.'&type=1"><i class="fa fa-times fa-lg"></i></a></td>';
}
?>


                                      </tr>




                                        <?php
                                      }
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
                            On Leave <span class="badge">2</span>
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
                                <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5">Ejamonkey</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;">2016-08-11</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;padding-right: 40px;">2016-08-19</td>
                              </tr>
                              <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5">Ringo</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;">2016-08-11</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;padding-right: 40px;">2016-08-19</td>
                              </tr>
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
                            On RRD Rotation <span class="badge">2</span>

                  </div>
                  <div class="panel-body">
                             <table width="100%">
                              <thead>
                                <tr style="border-bottom: 2px solid rgb(147, 147, 147);">
                                <th colspan="5">Name</th>
                                <th style="float:right;">Rotation</th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5">Ejamonkey</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;">30 Days</td>
                              </tr>
                              <tr style="border-top: 1px solid rgba(221, 221, 221, 0.14);">
                                <td style="padding-top: 2px;padding-bottom:12px;" colspan="5">Ringo</td>
                                <td style="float:right;padding-top: 2px;padding-bottom:12px;">30 Days</td>
                              </tr>
                              </tbody>
                            </table>
                            </div>
                </div>
              </div>
            </div>
            
            
        </div>
        <!-- /#page-wrapper -->

    <?php
include('../../templates/footer.php');
?>