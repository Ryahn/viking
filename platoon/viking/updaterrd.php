<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
if ( hasRank('SFC') || hasPermission('can_update') )
{
    if (isset($_POST['submit']) )
    {
        date_default_timezone_set("America/Los_Angeles");
        $dateFormat = "Y-m-d";
        $date = new DateTime();
        $dateString = $date->format($dateFormat);
        $userid13 = $_POST['userid'];
        $rotation = $_POST['rotation'];
        $typeid = $_POST['type'];

        $updateSql = "UPDATE rosters SET is_rrd=$typeid WHERE rid=$userid13";
        $updateResults = mysqli_query($con, $updateSql);
        $rrdSql = "INSERT INTO rrd_rotation (user_id, rotation, start_date)
                    VALUES ('$userid13','$rotation','$dateString')";
        $rrdResults = mysqli_query($con, $rrdSql);
        if(!$rrdResults and $mysqliDebug) 
        {
           echo "<p>There was an error in query: $rrdResults</p>";
           echo $con->error;
        }
        if(!$updateResults and $mysqliDebug) 
        {
           echo "<p>There was an error in query: $updateResults</p>";
           echo $con->error;
        }
        echo '<a type="button" style="margin-left: 847px;padding: 25px 95px 25px 95px;margin-top: 25px;font-size: 24px;" class="btn btn-info" href="roster.php">Back</a>';
    }
    else
    {
    $id = $_GET['id'];
    $type = $_GET['type'];
    if ( $type == 1)
    {
        $sql = "SELECT rname,ruser_id FROM rosters WHERE ruser_id=$id";
        $results = mysqli_query($con, $sql);
        $username = array();
        while ( $row = mysqli_fetch_assoc($results) )
        {
        	$username[] = $row;
        }
    ?>
    <div id="wrapper">
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php foreach ( $username as $name ) 
                    {
                    	echo 'RRD Update: ' . $name['rname'];
                    }?>
                </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-4"></div>
            	<div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Update</h3>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" role="form">
                                <legend>Adjust Roation</legend>
                            
                                <div class="form-group">
                                    <label for="">Roation</label>
                                    <input type="hidden" name="userid" id="inputUserid" class="form-control" value="<?php foreach ( $username as $user_id12 )
                                    { echo $user_id12['ruser_id']; } ?>">
                                    <input type="hidden" name="type" id="inputType" class="form-control" value="<?php echo $type; ?>">
                                    <select name="rotation" id="inputRotation" class="form-control" required="required">
                                        <option value="30 Days">30 Days</option>
                                        <option value="60 Days">60 Days</option>
                                        <option value="90 Days">90 Days</option>
                                    </select>
                                </div>
                            
                                
                            
                                <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
        {
            $rrdRemoveSql = "UPDATE rosters SET is_rrd=$type WHERE rid=$id";
            $rrdRemoveResults = mysqli_query($con, $rrdRemoveSql);
            $rrdRemove = "DELETE FROM rrd_rotation WHERE user_id=$id";
            $rrdRemoveRes = mysqli_query($con, $rrdRemove);
            echo '<a type="button" style="margin-left: 847px;padding: 25px 95px 25px 95px;margin-top: 25px;font-size: 24px;" class="btn btn-info" href="roster.php">Back</a>';
        }
        }
    }
    else
        {
            ?>
            <div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Error</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-10">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Permission Issue                      
                        </div>
                        <div class="panel-body awards-panel">
                            Sorry, you do not have permission!  
                            <p>Please contact a Dev or SFC</p>          
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
       <?php } 
       include('../../templates/footer.php');

            ?>