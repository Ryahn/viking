<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');
$uplatoon = userValue(null, "platoon");
$grabAttendace = "SELECT * FROM attendances";
$grabResults = mysqli_query($con, $grabAttendace);

?>


        

           

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><span class="hupper"><?php echo $uplatoon . " Attendance";?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="row daterow">
                    
                <div class="col-md-9"></div>
                   
                <div class="col-md-1 dateback datebackm">Month:</div>
                <div class="col-md-1 dateback">Auguest</div>
                        
               
                 <div class="col-md-9"></div>
                 <div class="col-md-1 dateback datebacky">Year:</div>
                 <div class="col-md-1 dateback">2016</div>
            
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Attendance Approvals
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="center">Username</th>
                                            <th class="center">Platoon</th>
                                            <th class="center">Present</th>
                                            <th class="center">Training</th>
                                            <th class="center">Approved?</th>
                                            <th class="center">Approved on</th>
                                            <th class="center">Approved by</th>
                                            <th class="center"></th>
                                            <th class="center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function vasPermCheck($permID) {
                                            if ($permID == 1) {
                                                echo "<span style=\"color:lime;\">YES</span>";
                                            } else {
                                                echo "<span style=\"color:red;\">NO</span>";
                                        }
                                        }
                                        if(!$grabResults and $mysqliDebug) {
    echo "<p>There was an error in query: $grabAttendance</p>";
    echo $con->error;
}
if($grabResults) {
    while($row = mysqli_fetch_assoc($grabResults)) {
        $userid = $row['user_id'];
        $approvedby = $row['approved_by'];
        $usersql = "SELECT username FROM login_users WHERE id=$userid";
        $usersql1 = "SELECT username FROM login_users WHERE id=$approvedby";
        $grabUsers = mysqli_query($con, $usersql);
        $grabApprove = mysqli_query($con, $usersql1);
        if(!$grabUsers and $mysqliDebug) {
            echo "<p>There was an error in query: $grabUsers</p>";
        echo $con->error;
        }
        if(!$grabApprove and $mysqliDebug) {
            echo "<p>There was an error in query: $grabUsers</p>";
        echo $con->error;
        }
        while($urow = mysqli_fetch_assoc($grabUsers)) {
            while($arow = mysqli_fetch_assoc($grabApprove)) {
        $platoon = $row['platoon'];
        $username = $urow['username'];
        $ausername = $arow['username'];
        
            ?>
        
                                        
                                        <tr>
                                            <td class="center"><?php echo $username; ?></td>
                                            <td class="center"><?php echo $platoon; ?></td>
                                             <td class="center"><?php vasPermCheck($row['is_present']);?></td>
                                             <td class="center"><?php vasPermCheck($row['is_training']);?></td>
                                            <td class="center"><?php vasPermCheck($row['is_approved']);?></td>
                                             <td class="center"><?php echo $row['approved_on'];?></td>
                                             <td class="center"><?php echo $ausername;?></td>
                                            <td><?php echo "<a class='btn btn-success btn-xs center' href='editperms.php?id=" . $row['id'] . "&uid=" . $row['user_id'] ."'>Approved</a>";?></td>
                                            <td><?php echo "<a class='btn btn-danger btn-xs center' href='delperms.php?id=" . $row['id'] . "'>Deny</a>";?></td>
                                        </tr>
                                        <?php
                                  
    }
        }
}
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
            
            
            
        </div>
        <!-- /#page-wrapper -->

    <?php
include('templates/footer.php');
?>