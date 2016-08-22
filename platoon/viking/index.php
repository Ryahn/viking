<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
include("src/geoipcity.inc");
    include("src/geoipregionvars.php");
    include("src/timezone.php");
$uid = userValue(null, "id");

$dateFormat = "m/d/y H:i:s";
$dateTime = $date = new DateTime();
$pst = $dateTime->setTimeZone(new DateTimeZone('America/Los_Angeles'));



?>
<?php
  //Get remote IP
    $ip = "74.89.56.203";
 
    //Open GeoIP database and query our IP
    $gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
    $record = geoip_record_by_addr($gi, $ip);
 
    //If we for some reason didnt find data about the IP, default to a preset location.
    //You can also print an error here.
    if(!isset($record))
    {
        $record = new geoiprecord();
        $record->latitude = 59.2;
        $record->longitude = 17.8167;
        $record->country_code = 'SE';
        $record->region = 26;
    }
 
    //Calculate the timezone and local time
    try
    {
        //Create timezone
        $user_timezone = new DateTimeZone(get_time_zone($record->country_code, ($record->region!='') ? $record->region : 0));
 
        //Create local time
        $user_localtime = new DateTime("now", $user_timezone);
        $user_timezone_offset = $user_localtime->getOffset();        
    }
    //Timezone and/or local time detection failed
    catch(Exception $e)
    {
        $user_timezone_offset = 7200;
        $user_localtime = new DateTime("now");
    }
 
    
?>
<div id="wrapper">
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Viking News</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
     <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Operation Timezone
                        </div>
                        <div class="panel-body">
                            <div style="font-size:30px;color:#0093dc;"><span style="font-weight:bold;text-decoration:underline;">Date:</span> <?php echo $pst->format('m/d/y'); ?></div>
                            <div style="font-size:30px;color:#0093dc;"><span style="font-weight:bold;text-decoration:underline;">Time:</span> <?php echo $pst->format('H:i:s'); ?></div>
                        </div>
                        <div class="panel-footer footer-dark">
                            <?php echo $pst->format('T'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Your Current Time
                        </div>
                        <div class="panel-body">
                            <div style="font-size:30px;color:#00abd4;"><span style="font-weight:bold;text-decoration:underline;">Date:</span> <?php echo $user_localtime->format('m/d/y'); ?></div>
                            <div style="font-size:30px;color:#00abd4;"><span style="font-weight:bold;text-decoration:underline;">Time:</span> <?php echo $user_localtime->format('H:i:s'); ?></div>
                        </div>
                        <div class="panel-footer footer-dark">
                            <?php echo $user_localtime->format('T'); ?>
                        </div>
                    </div>
                </div>
            
            
            
        </div>
        <!-- /#page-wrapper -->
    </div>






<?php
include('../../templates/footer.php');
?>